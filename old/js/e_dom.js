//Array functions
function $A(obj){
	var arr = [];
	for(var i = 0; i < obj.length; i++){
		arr.push(obj[i]);
	}
	return arr;
}
var $break = new Object();
var $continue = new Object();
Array.prototype.each = function(iterator){
	try{
		for(var i = 0; i < this.length; i++){
			try{
				var ret = iterator(this[i], i);
				if(ret != null){
					this[i] = ret;
				}
			}catch(e){
				if(e != $continue)
					throw e;
			}
		}
	}catch(e){
		if(e != $break)
			throw e;
	}
	return this;
}
Array.prototype.random = function(){
	return this[Math.round(Math.random() * (this.length - 1))];
}
Array.prototype.last = function(){
	return this[this.length - 1];
}
/*
Array.prototype.invert = function(){
	var new_arr = [];
	for(var i = this.length - 1; i >= 0; i --){
		new_arr.push(this[i])
	}
	return new_arr;
}
*/
Array.prototype.invert = Array.prototype.reverse;
Array.prototype.remove = function(num){
	if(num >= this.length || num < 0)
		return;
	var ret = this[num]
	for(var i = num; i < this.length - 1; i++){
		this[i] = this[i+1];
	}
	this.pop();
	return ret;
}
Array.prototype.insert = function(value, position){
	position = position ? position : 0;
	if(position >= this.length){
		this.push(value);
		return;
	}
	for(var i = this.length - 1; i >= position; i--){
		this[i+1] = this[i];
	}
	this[position] = value;
}
if(typeof Array.prototype.indexOf == "undefined"){
	Array.prototype.indexOf = function(item){
		var index = -1;
		this.each(function(it, ind){
			if(it == item){
				index = ind;
				throw $break;
			}
		});
		return index;
	}
}
Array.prototype.toStart = function(item){
	var ind = this.indexOf(item);
	if(ind == -1){
		return false;
	}
	var itm = this[ind];
	var buff1 = this[0];
	var buff2 = this[0];
	for(var i = 1; i <= ind; i++){
		buff1 = this[i];
		this[i] = buff2;
		buff2 = buff1;
	}
	this[0] = itm;
}
Array.prototype.toEnd = function(item){
	var ind = this.indexOf(item);
	if(ind == -1){
		return false;
	}
	var itm = this[ind];
	for(var i = ind; i < this.length - 1; i++){
		this[i] = this[i + 1];
	}
	this[this.length - 1] = itm;
}

Array.prototype.previous = function(item){
	if(!this.length){
		return false;
	}
	var ind = this.indexOf(item);
	if(ind <= 0){
		ind = this.length;
	}
	return this[ind - 1];
}
Array.prototype.next = function(item){
	if(!this.length){
		return false;
	}
	var ind = this.indexOf(item);
	if(ind < 0 || ind == this.length - 1){
		ind = -1;
	}
	return this[ind + 1];
}
Array.prototype.max = function(){
	var max = this[0];
	this.each(function(item){
		if(item > max){
			max = item;
		}
	});
	return max;
}
Array.prototype.min = function(){
	var min = this[0];
	this.each(function(item){
		if(item < min){
			min = item;
		}
	});
	return min;
}
Number.prototype.signOf = function(){
	if(this == 0){
		return 1;
	}else{
		return Math.abs(this) / this;
	}
}
Number.prototype.sq = function(){
	return this * this;
}
Number.prototype.power = function(pow){
	if(pow == 0){
		return 1;
	}else if(pow < 0){
		throw "Sorry, I'm bad at mathematics. I can't raise a number to negative power";
	}
	var num = this;
	for(var i = 1; i < pow; i++){
		num *= this;
	}
	return num;
}


//String functions
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
String.prototype.s_each = function(iterator){
	var arr = this.split('');
	arr.each(iterator)
}
String.prototype.no_print_characters_only = function(){
	var ret = true;
	this.s_each(function(chr){
		if(chr.charCodeAt(0) >= 30){
			ret = false;
			throw $break;
		}
	});
	return ret;
}
String.prototype.splitBy = function(num){
	if(num <= 1){
		return this.split('')
	}
	var splitted = [];
	var start = 0;
	for(var i = 0; i < this.length; i+=num){
		splitted.push(this.substr(i, num))
	}
	return splitted;
}
String.prototype.multiply = function(){
	return this + this;
}

//Object functions
function MergeObjects(obj1, obj2){
	for(var i in obj2){
		obj1[i] = obj2[i];
	}
	return obj1;
}
Object.extend = MergeObjects;
Object._toString = function(){
	var str = "object " + this["_name"];
	str += "\n";
	for(var i in this){
		if(typeof this[i] != "function" && i != "_name"){
			str += i + " => " + this[i] + "\n";
		}
	}
	return str;
}

//DOM functions
function $(){
	if(arguments.length == 0){
		return false;
	}else if(arguments.length == 1){
		return _$(arguments[0]);
	}else{
		var arr = [];
		for(var i = 0; i < arguments.length; i++){
			var node = _$(arguments[i]);
			if(node){
				arr.push(node);
			}
		}
		if(arr.length){
			return arr;
		}else{
			return false;	
		}
	}
}
function _$(arg){
	if(typeof arg == "string"){
		return document.getElementById(arg);
	}else if(typeof arg == "object" && typeof arg.nodeType != "undefined"){
		return arg;
	}else{
		return false;
	}
}
function $T(tName, parent){
	parent = parent ? parent : document;
	return $A(parent.getElementsByTagName(tName));
}

function $F(ipt){
	ipt = $(ipt);
	var node_names = ["SELECT", "INPUT", "TEXTAREA"];
	var node_name = "";
	var types = [];
	var ret = true;
	for(var i = 0; i < node_names.length; i++){
		if(ipt.nodeName == node_names[i]){
			node_name = node_names[i];
		}
	}
	if(!node_name)
		return;

	return $F[node_name.toLowerCase()](ipt);
}
$F.select = function(objSel){
	if(!!objSel.value){
		return objSel.value;
	}else{
		var ops = $T("OPTION", objSel);
		return ops[objSel.selectedIndex].innerText;
	}
};
$F.textarea = function(objTArea){
	return objTArea.value;
};
$F.input = function(objIpt){
	return objIpt.value;
};
function $C(className, parent, tagName){
	parent = (parent) ? parent : document;
	tagName = tagName ? tagName : "*";
	var arr = [];
	var collection = $T(tagName, parent);
	for(var i = 0; i < collection.length; i++){
		if(hasString(collection[i].className, className)){
			arr.push(collection[i]);
		}
	}
	if(arr.length != 0){
		return arr;
	}else{
		return false;
	}
}
function $C_arr(arr_classNames, parent, tagName, iterator){
	var ret_arr = [];
	parent = parent ? parent : document.body;
	tagName = tagName ? tagName : "*" ;
	iterator = iterator ? iterator : function(val){return val;}
	var collection = $T(tagName, parent);
	collection.each(function(col, c_ind){
		arr_classNames.each(function(cName, ind){
			if(hasString(col.className, cName)){
				ret_arr[ind] = 	iterator(col);
				throw $continue;
			}
		});
	});
	return ret_arr;
}
function $S(cssSelector){
	var arr = cssSelector.split(" ");
	for(var i = 0; i < arr.length; i++){
		var type = "_tag";
		if(arr[i].charAt(0) == "."){
			type = "_class";
		}else if(arr[i].charAt(0) == "#"){
			type = "_id";
		}
		$S[type](arr[i]);
	}
}
$S._tag = function(){};
$S._class = function(){};
$S._id = function(){};

function $ATTR(a_name, a_value, parent, tag_name){//getElementsByAttribute
	var arr = [];
	a_value = a_value ? a_value : false;
	parent = parent ? parent : document.body;
	tag_name = tag_name ? tag_name : "*";
	var collection = $T(tag_name, parent);
	collection.each(function(node){
		var attr = node.getAttribute(a_name);
		if(!attr){
			throw $continue;
		}
		if(!a_value){
			arr.push(node);
		}else{
			if(hasString(attr, a_value)){
				arr.push(node);
			}
		}
	});
	return arr.length ? arr : false;
}
function $TEXT(elem, no_text){
	if(!elem){
		return;
	}
	var arr = [];
	var children = $A(elem.childNodes);
	children.each(function(child){
		if(child.nodeType == 3){
			if(no_text){
				arr.push(child);
			}else{
				if(!child.nodeValue.no_print_characters_only()){
					arr.push(child);
				}
			}
		}
	});
	return arr;
}

//Function functions
Function.prototype.bind = function(){
	var _args = [];
	var _method = this;
	var _object = arguments[0];
	for(var i = 1; i < arguments.length; i++){
		_args.push(arguments[i]);
	}
	var retfunc = function(){
		return _method.apply(_object, $A(arguments).concat(_args));
	}
	retfunc.bound = $A(arguments);
	return retfunc;
}
Function.prototype.bindAvoidingEvent = function(){
	var _args = [];
	var _method = this;
	var _object = arguments[0];
	for(var i = 1; i < arguments.length; i++){
		_args.push(arguments[i]);
	}
	return function(){
		return _method.apply(_object, $A(_args).concat(arguments));
	}	
}
Function.prototype.bindArray = function(arr){
	var _args = [];
	var _method = this;
	var _object = arr[0];
	for(var i = 1; i < arr.length; i++){
		_args.push(arr[i]);
	}
	var retfunc = function(){
		return _method.apply(_object, $A(arguments).concat(_args));
	}
	retfunc.bound = arr;
	return retfunc;
}
Function.prototype.bindMore = function(){
	if(!this.bound){
		return;
	}
	return this.bindArray(this.bound.concat(arguments));

}

//Else functions
function _isChild(elem, parent){
	if(!elem)
		return false;
	var par = elem.parentNode;
	try{
		while(par && par != parent && par.nodeType != 9){
			par = par.parentNode;
		}
	}catch(e){
		alert(alert(par.nodeType));
	}
	return !par ? false : (par == parent);
}
function hasString(str_space_separated, str, separator){
	var ret = false;
	if(!str_space_separated){
		return ret;
	}
	var sep = separator || ' ';
	var reg = new RegExp('^' + str + '$');
	var strings = str_space_separated.split(sep);
	strings.each(
		function(s){
			if(s.match(reg)){
				ret = true;
				throw $break;
			}
		}	
	)
	return ret;
}

//Debug functions
function toConsole(what, console){
	console = console ? console : typeof document.body != "undefined" ? document.body : null;
	if(!console){
		document.write(what);
	}
	var oDiv = document.createElement('DIV');
	oDiv.className = toConsole.defaultElemClassName;
	oDiv.appendChild(document.createTextNode(what));
	console.appendChild(oDiv);
}
toConsole.defaultElemClassName = "printed-elem";
var print = toConsole;
function printObject(o){
	for(var i in o){
		print(i + " => " + o[i]);
	}
}
function clearElem(elem){
	while(elem.firstChild){
		elem.removeChild(elem.firstChild);
	}
}
function clearPrinted(){
	var elems = $C(toConsole.defaultElemClassName);
	if(!elems){
		return;
	}
	elems.each(function(el){
		el.parentNode.removeChild(el);
	})
}
function Line(width, color, weight, parent){
	if(!width){
		width = 100;
	}
	if(!color){
		color = "#000";
	}	
	if(!weight){
		weight = 1;
	}
	if(!parent){
		parent = document.body;
	}
	var line = document.createElement("DIV");
	line.style.width = width + "px";
	line.style.border = "solid " + weight + "px " + color;
	line.style.margin = "5px 10px";
	line.style.fontSize = "0";
	parent.appendChild(line);
}
function nodeLevelFilter(node, parent, parent_level){
	var parLevel = 1;
	var n = node.parentNode;
	while(n != parent){
		n = n.parentNode;
		parLevel ++;
	}
	if(parLevel <= parent_level){
		return node;
	}else{
		return false;
	}
}