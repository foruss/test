String.prototype.camelize = function(){
	var arrThis = this.split('-');
	if(arrThis.length == 1){
		return this;
	}else{
		var wordCamelized = arrThis[0];
		var firstSymbol;
		for(var i = 1; i < arrThis.length; i++){
			firstSymbol = arrThis[i].substr(0, 1);
			arrThis[i] = arrThis[i].substr(1);
			arrThis[i] = firstSymbol.toUpperCase() + arrThis[i];
			wordCamelized+=arrThis[i];
		}
		return wordCamelized;
	}
}
var Style = {
	_check_browser: function(){
		if(window.getComputedStyle){
			if(window.opera)	{
				return "Opera";
			}else{
				return "Gecko";
			}
		}else{
			return "IE";
		}
	},
	_browser_version: function(){
		return this["_" + this._browser + "_version"]();
	},
	_IE_version: function(){
		var i = navigator.appVersion.indexOf("MSIE") + 5;
		var version = "";
		while(navigator.appVersion.charAt(i) != ";"){
			version += navigator.appVersion.charAt(i);
			i++;
		}
		return version;
	},
	_Gecko_version: function(){
		if(navigator.userAgent.indexOf("Firefox") == -1){
			return "unknown";
		}
		var i = navigator.userAgent.indexOf("Firefox\/") + 8;
		return navigator.userAgent.substr(navigator.userAgent.indexOf("Firefox\/") + 8);
		
	},
	_Opera_version: function(){
		return navigator.appVersion.substring(0, navigator.appVersion.indexOf(" "));
	},
	getElementStyle: function(elem, property){
		var ME = arguments.callee;
		var value = null;
		if(window.getComputedStyle)		{
			var compStyle = window.getComputedStyle(elem, '');
			value = compStyle.getPropertyValue(property);
		}else if(elem.currentStyle){
			if(property == "float")
				property = "style-float";
			value  = elem.currentStyle[property.camelize()]; //!!String.camelize()
		}
		if(typeof value != "undefined")
			return value;
	},
	getBorder: function(elem){
		var bLeft = parseInt(Style.getElementStyle(elem, 'border-left-width'));
		var bRight = parseInt(Style.getElementStyle(elem, 'border-right-width'));
		var bTop = parseInt(Style.getElementStyle(elem, 'border-top-width'));
		var bBottom = parseInt(Style.getElementStyle(elem, 'border-bottom-width'));
		var bX = bRight + bLeft;
		var bY = bTop + bBottom;
		return {
			left: isNaN(bLeft) ? 0 : bLeft,
			top: isNaN(bTop) ? 0 : bTop,
			right: isNaN(bRight) ? 0 : bRight,
			left: isNaN(bLeft) ? 0 : bLeft,
			x: isNaN(bX) ? 0 : bX,
			y: isNaN(bY) ? 0 : bY
		};
	},
	getMargin: function(elem){
		var mLeft, mRight, mTop, mBottom;
		mLeft = parseInt(Style.getElementStyle(elem, 'margin-left'));
		mRight = parseInt(Style.getElementStyle(elem, 'margin-right'));
		mTop = parseInt(Style.getElementStyle(elem, 'margin-top'));
		mBottom = parseInt(Style.getElementStyle(elem, 'margin-bottom'));
		return {
			left: isNaN(mLeft) ? 0 : mLeft,
			right: isNaN(mRight) ? 0 : mRight,
			top: isNaN(mTop) ? 0 : mTop,
			bottom: isNaN(mBottom) ? 0 : mBottom
		}
	},
	getPadding: function(elem){
		var pLeft, pRight, pTop, pBottom;
		pLeft = parseInt(Style.getElementStyle(elem, 'padding-left'));
		pRight = parseInt(Style.getElementStyle(elem, 'padding-right'));
		pTop = parseInt(Style.getElementStyle(elem, 'padding-top'));
		pBottom = parseInt(Style.getElementStyle(elem, 'padding-bottom'));
		return {
			left: pLeft,
			right: pRight,
			top: pTop,
			bottom: pBottom
		}
	},
	getOffset: function(elem){
		return {left: elem.offsetLeft, top: elem.offsetTop};
	},
	getRelativeOffset: function(elem){
		var oOffset = this.getOffset(elem);
		var parents = this._getParents(elem);
		var eachFunc = this["correct" + this._browser];
		var no_go = false;
		parents.each(
			function(item, index){
				no_go = eachFunc(item, oOffset, no_go);

			}
		);//each
		return oOffset;
	},
	correctOpera: function(item, oOffset, no_go){
		if(no_go)
			return true;
		var pos = Style.getElementStyle(item, "position");
		if(pos == "relative" || pos == "absolute"){
			var oBorder = Style.getBorder(item);
			oOffset.left -= oBorder.left;
			oOffset.top -= oBorder.top;
			return true;
		}
		return false;
	},
	correctIE: function(item, oOffset){
		var pos = Style.getElementStyle(item, "position");
		var hght = Style.getElementStyle(item, "height");
		var flt = Style.getElementStyle(item, "float");
		if(pos == "relative"){
			if(hght == "auto" && flt == "none"){
				var oBorder = Style.getBorder(item);
				oOffset.left -= oBorder.left;
				oOffset.top -= oBorder.top;
				var oMargin = Style.getMargin(item);
				if(oMargin.left != 0){
					var iOffset = Style.getOffset(item);
					oOffset.left -= iOffset.left;
				}

			}
		}else if(pos == "absolute"){
		}else{
			if(hght != "auto" || flt != "none"){
				var iOffset = Style.getOffset(item);
				var oBorder = Style.getBorder(item);
				oOffset.left += iOffset.left;
				oOffset.top += iOffset.top;
				oOffset.left += oBorder.left;
				oOffset.top += oBorder.top;
			}
		}
		return false;
	},
	correctGecko: function(){
		return false;
	},
	getAbsoluteOffset: function(elem){
		var oOffset = this.getRelativeOffset(elem);
		var parents = this._getParents(elem);
		parents.each(
			function(item, index){
				var pos = Style.getElementStyle(item, 'position');
				if(pos == 'relative' || pos == 'absolute'){
					var iOffset = Style.getRelativeOffset(item);
					var iBorder = Style.getBorder(item);
					oOffset.left += iOffset.left;
					oOffset.top += iOffset.top;
					oOffset.left += iBorder.left;
					oOffset.top += iBorder.top;
				}
			}
		);
		return oOffset;
	},
	getDimensions: function(elem){
		var width, height;
		width = parseInt(this.getElementStyle(elem, "width"));
		if(isNaN(width))
			width = elem.offsetWidth;
		height = parseInt(this.getElementStyle(elem, "height"));
		if(isNaN(height))
			height = elem.offsetHeight;
		return {width: width, height: height};
	},
	setElementStyle: function(objElem, propName, propVal, usePx){
		var elem = (typeof objElem == "string") ? document.getElementById(objElem) : objElem;
		if(typeof propName == "string"){
			if(usePx && (typeof propVal == "number")){
				propVal += "px";
			}
			elem.style[propName] = propVal;
		}else if(typeof propName == "object"){
			for(var i in propName){
				var val = propName[i];
				if(typeof val == "number" && usePx){
					val += "px";
				}//if
				elem.style[i] = val;
			}//for
		}//if-else-if
		//End of FUCNTION
	},
	getCoords: function(elem){
		var left = parseInt(this.getElementStyle(elem, 'left'));
		var top = parseInt(this.getElementStyle(elem, 'top'));
		var right = parseInt(this.getElementStyle(elem, 'right'));
		var bottom = parseInt(this.getElementStyle(elem, 'bottom'));
		left = isNaN(left) ? 0 : left;
		top = isNaN(top) ? 0 : top;
		right = isNaN(right) ? 0 : right;
		bottom = isNaN(bottom) ? 0 : bottom;
		return {
			left: left,
			top: top,
			right: right,
			bottom: bottom
		}

	}
}
Style._getParents = function(elem){
	var pars = [];
	elem = elem.parentNode;
	while(elem.tagName.toUpperCase() != "BODY"){
		pars.push(elem);
		elem = elem.parentNode;
	}
	return pars;
}
Style._getRelativeParent = function(elem){
	var pars = this._getParents(elem);
	var relItem;
	for(var i = 0; i < pars.length; i++){
		var item = pars[i];
		if(Style.getElementStyle(item, "position") == "relative"){
			return item;
		}
	}
}
Style._browser = Style._check_browser();
Style._br_version = Style._browser_version();