function moveable(elem, relative){
	this.elem = elem;
	this.type = relative ? 'relative' : 'absolute';
	this.onmove = new DOMEvent();
	this.onaftermove = new DOMEvent();
	this.STOP_X = false;
	this.STOP_Y = false;
	this.STOP = false;
	this.movedX = 0;
	this.movedY = 0;
	this.moveX = 0;
	this.moveY = 0;
	this.saveFloatX = new Nums.SaveFloatPoint();
	this.saveFloatY = new Nums.SaveFloatPoint();
	this.limits = {};
	this.PREVENT_DOUBLE_FIRE = true;
	this.init();
}
moveable.prototype.init = function(){
	this.elem.style.position = this.type;
	var coords = Style.getCoords(this.elem);
	this.left = coords.left; 
	this.top = coords.top;
	this.startX = this.left;
	this.startY = this.top;
}
moveable.prototype.move = function(){
	this.elem.style.left = this.left + 'px';
	this.elem.style.top = this.top + 'px';
	this.onaftermove.fire();
}
moveable.prototype.moveTo = function(x, y){
	this.moveBy(x - this.left, y - this.top);
}
moveable.prototype.moveBy = function(x, y){
	this.moveX = this.saveFloatX.add(x);
	this.moveY = this.saveFloatY.add(y)
//	toConsole(this.top);
	this.onmove.fire();
	this.movedX += this.moveX;
	this.movedY += this.moveY;
	this.distanceX += Math.abs(this.moveX);
	this.distanceY += Math.abs(this.moveY);
	this.left += this.moveX;
	this.top += this.moveY;
	if(!this.STOP){
		this.move();
	}else{
		this.STOP = false;
	}
}
moveable.prototype.setLimits = function(type, value, startValue){
	type = type.toUpperCase();
	if(this.limits[type]){
		return;
	}
	var PRESETS = moveable.LIMITS[type]
	this.limits[type] = new Limit(0, value);
	if(startValue){
		this.limits[type].value = startValue;
	}
	this.limits[type].type = type;
	this.limits[type].MINUS_REACHED = false
	this.limits[type].PLUS_REACHED = false;
	this.limits[type]._REACHED = false;
	this.limits[type].onmore.register(
		'limit-more',
		function(objLim){
			this['move' + objLim.type] = objLim.MORE_VALUE;
			objLim._REACHED = true;
			objLim.MORE_REACHED = true;
		}.bind(this, this.limits[type])
	);
	this.limits[type].onless.register(
		'limit-less',
		function(objLim){
			this['move' + objLim.type] = objLim.LESS_VALUE;
			objLim._REACHED = true;
			objLim.LESS_REACHED = true;
		}.bind(this, this.limits[type])
	);
	this[PRESETS.onmore] = DOMEvent.cloneEvent(this.limits[type].onmore);
	this[PRESETS.onless] = DOMEvent.cloneEvent(this.limits[type].onless);
	this[PRESETS.onmore].register = function(name, func, times){
		this.limits[type].onmore.register(name, function(){
			this.onaftermove.register(name, func, 1);
		}.bind(this), times);
	}.bind(this);
	this[PRESETS.onless].register = function(name, func, times){
		this.limits[type].onless.register(name, function(){
			this.onaftermove.register(name, func, 1);
		}.bind(this), times);
	}.bind(this);
	this.onmove.register(
		'limit' + type, 
		function(objLim){
			objLim.change(this['move' + objLim.type]);
		}.bind(this, this.limits[type])
	);
}	
moveable.prototype.unsetLimits = function(type){
	type = type.toUpperCase();
	if(!this.limits[type]){
		return;
	}
	this.onmove.remove('limit' + type);
	var PRESETS = moveable.LIMITS[type];
	this[PRESETS.onmore] = null;
	this[PRESETS.onless] = null;
	this.limits[type] = null;
}
moveable.prototype.resetLimits = function(type, value, startValue){
	this.unsetLimits(type);
	this.setLimits(type, value);
}
moveable.prototype.resetLimLBound = function(type, value){
	this.limits[type.toUpperCase()].to = value;
}
moveable.prototype.resetLimUBound = function(type, value){
	this.limits[type.toUpperCase()].from = value;	
}
moveable.prototype.setMoveSpace = function(X, Y, sX, sY){
	if(!this.moveSpace){
		this.moveSpace = {};
		this.onmovespacereach = new MajorDOMEvent();
	}
	if(X || X === 0){
		this.moveSpace.X = X;
		this.setLimits('X', X, sX || 0);
		this.onmovespacereach._link(this.onleftlimitreach, "left");
		this.onmovespacereach._link(this.onrightlimitreach, "right");
	}
	if(Y || Y === 0){
		this.moveSpace.Y = Y;
		this.setLimits('Y', Y, sY || 0);
		this.onmovespacereach._link(this.ontoplimitreach, "top");
		this.onmovespacereach._link(this.onbottomlimitreach, "bottom");
	}
	return this.moveSpace;
}
moveable.LIMITS = {
	X: {
		onless: 'onleftlimitreach',
		onmore: 'onrightlimitreach',
		less: 'left',
		more: 'right'
	},
	Y: {
		onless: 'ontoplimitreach',
		onmore: 'onbottomlimitreach',
		less: 'top',
		more: 'bottom'		
	}
}
moveable.detectMoveable = function(oMoveable){	 
	if(!oMoveable){
		return false;
	}
	if(oMoveable instanceof moveable){
		oMoveable._MUTUAL = true;
		return oMoveable;
	}else{
		return new moveable(oMoveable, false)
	}
}