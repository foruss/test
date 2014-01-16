function Movement(oMov, timer){
	this.Moveable = moveable.detectMoveable(oMov);
	this.stepX = 0;
	this.stepY = 0;
	this.timer = Timer.detectTimer(timer);
	this.distance = false;
	this.moveSpace = false;
	this.STOP_ON_FIRST = true;
	this.onstart = new DOMEvent();
	this.onstop = new DOMEvent();
	this.ondistance = new DOMEvent();
	this.ondistance.register("default", function(){
		this.onmove.remove("distance");
		this.stop();
	}.bind(this))
	this.refreshCount = 0;
	this.isMoving = false;
	this.onreach = new DOMEvent();
	this.onreach.register(
		Movement.defaultOnReach.name,
		Movement.defaultOnReach.func.bind(this)
	);
	this.init();
}
Movement.prototype.init = function(){
	this.onmove = DOMEvent.cloneEvent(this.Moveable.onmove);
	if(this.timer._MUTUAL){
		if(this.timer.registerMovement){
			this.timer.registerMovement(this);
		}else{	
			Movement.handleMutualTimer(this.timer);
			this.timer.registerMovement(this);
		}
	}else{
		this.timer.registerEvent(
		{
			name: "Movement",
			func: function(objMoveable){
				objMoveable.moveBy(this.stepX, this.stepY);
			},
			oThis: this,
			args: [this.Moveable]
		}
		);
	}
}
Movement.prototype.start = function(){
	this.onstart.fire();
	this.isMoving = true;
	if(this.Timer){
		this.Timer.start();
	}
}
Movement.prototype.stop = function(cause){
	this.onstop.fire();
	this.isMoving = false;
	if(this.Timer){
		this.Timer.clear();
	}
}
Movement.prototype.toggle = function(){
	if(this.isMoving){
		this.stop("toggle");
	}else{
		this.start();
	}
}
Movement.prototype.setSteps = function(x, y){
	this.stepX = x ? x : 0;
	this.stepY = y ? y : 0;
}
Movement.prototype.setLimits = function(type, value, startValue){
	this.Moveable.setLimits(type, value, startValue);
	var PRESETS = moveable.LIMITS[type];
	this[PRESETS.onless] = DOMEvent.cloneEvent(this.Moveable[PRESETS.onless]);
	this[PRESETS.onmore] = DOMEvent.cloneEvent(this.Moveable[PRESETS.onmore]);
}
Movement.prototype.unsetLimits = function(type){
	this.Moveable.unsetLimits(type);
}
Movement.prototype.resetLimits = function(type, value, startValue){
	this.Moveable.resetLimits(type, value, startValue);
}
Movement.prototype.setMoveSpace = function(X, Y, sX, sY){
	this.moveSpace = this.Moveable.setMoveSpace(X, Y, sX, sY);
	if(!this.onmovespacereach){
		this.onmovespacereach = DOMEvent.cloneEvent(this.Moveable.onmovespacereach);
	}
}
Movement.prototype.moveTo = function(x, y, speed){
	speed = speed ? speed : 3;
	var curLeft = this.Moveable.left;
	var curTop = this.Moveable.top;
	var nextLeft = x;
	var nextTop = y;
	var distX = nextLeft - curLeft;
	var distY = nextTop - curTop;
	var biggerDist = Math.abs(distX) > Math.abs(distY) ? distX : distY;
	var numOfSteps = Math.abs(Math.round(biggerDist / speed));
	if(numOfSteps == 0){
		return;
	}
	var stepX = distX / numOfSteps;
	var stepY = distY / numOfSteps;
	this.mt_stepCount = 0;
	this.mt_numOfSteps = numOfSteps;
	this.distY = distY;
	this.distX = distX;
	this.moveToX = nextLeft;
	this.moveToY = nextTop;
	this.setSteps(stepX, stepY);
	this.Moveable.movedToX = 0;
	this.Moveable.movedToY = 0;
	this.Moveable.onmove.remove('move-to');
	this.Moveable.onmove.register(
		'move-to',
		function(objMovement){
			var STOP_X = false, STOP_Y = false;
			if(Math.abs(this.movedToX + this.moveX ) >= Math.abs(objMovement.distX)){
				this.moveX = (Math.abs(objMovement.distX) - Math.abs(this.movedToX)) * this.moveX.signOf();
				STOP_X = true;
			}
			if(Math.abs(this.movedToY + this.moveY ) >= Math.abs(objMovement.distY)){
				this.moveY = (Math.abs(objMovement.distY) - Math.abs(this.movedToY)) * this.moveY.signOf();
				STOP_Y = true;
			}
			this.movedToX += this.moveX;
			this.movedToY += this.moveY;
			objMovement.mt_stepCount++;
			if(STOP_X && STOP_Y){
				//objMovement.stopMoveTo();
				this.onaftermove.register(
					'move-to-stop',
					function(){
						this.onreach.fire();
					}.bind(objMovement),
					1
				);
			}
		}.bind(this.Moveable, this)
	);
	if(!this.isMoving){
		this.start();
	}
}
Movement.prototype.stopMoveTo = function(cause){
	this.onmove.remove('move-to');
	this.stop(cause || "move-to");
}
Movement.prototype.moveDistance = function(type, distance){
	/*
	this.distance = distance;
	this.distanceMoved = 0;
	this.distanceType = type.toUpperCase();
	this.onmove.register("distance", function(){
		var nextVal = this.distanceMoved + Math.abs(this["step" + this.distanceType]);
		if(nextVal >= this.distance){
			this.Moveable["move" + this.distanceType] = (this.distance - this.distanceMoved) * this.Moveable["move" + this.distanceType].signOf();
			this.ondistance.fire();
		}
		this.distanceMoved += Math.abs(this["step" + this.distanceType]);
	}.bind(this));
	this.start();
	*/
}
Movement.defaultOnReach = {
	name: 'onreach',
	func: function(){
		this.stopMoveTo();
	}
}
Movement.mutualTimer = null;
Movement.handleMutualTimer = function(oTimer){
	oTimer.movements = [];
	oTimer.registerMovement = function(objMovement){
		this.movements.push(objMovement)
	}
	oTimer.registerEvent(
		{
			name: "Movement",
			func: function(){
				this.movements.each(function(mov){
					if(mov.isMoving){
						mov.Moveable.moveBy(mov.stepX, mov.stepY);
					}
				});
			},
			oThis: oTimer,
			args: []
		}
	);	
}