// Переменная, устанавливающая задержку пребывания развернутого меню
var tm;
var b = document.createElement('B');
var bText = document.createTextNode('');
//Функция, дающая запрет закрытию подменю
function cancelClose(){
    if(tm) {
        clearTimeout(tm);
    };
};

//Функция, открывающая меню
function showMenu(obj) {
	
	//Если не существует доселе открытого подменю, то...
	if(typeof object == "undefined")
		{
			cancelClose();
			//Находим элементы. которые должны быть показаны
			parentObj = obj.parentNode;
			workObj = parentObj.childNodes;
			flag = 1;
			for (i=0;i<workObj.length;i++)
				{
					if(workObj[i].className != undefined)
						if(workObj[i].className.indexOf("submenu") == 0)
							{
								selObj = obj;
								if(selObj.className.indexOf("act") != 0)
									selObj.className = 'menuItem_act';
								//Обозначаем то, что пожменю уже открыто
								object = workObj[i];
								//Открываем само подменю
								object.style.display = 'block';
								if(selObj.parentNode.parentNode.className.indexOf('end') == 0){
									object.style.left = (selObj.parentNode.parentNode.scrollWidth-object.scrollWidth) + 'px';
								};
							};
				};
		};
};

//Функция устанавливающая задержку закрытия, при отведения мыши в поле, где не находтся другого элемента основного меню
function closeMenu() {
    tm = setTimeout("hideMenu()",1000);
};

//Закрывает открытое меню до этого меню
function hideMenu() {
	if (typeof object != "undefined")
		{
			object.style.display = "none";
			object = undefined;
			if(selObj.className.indexOf("act") != 0)
				selObj.className = '';
		};
};

//Функция расставляем события для элементов меню и подменю
//имеет в своем составе переменную, задающую id основного меню
function srMenu(menuId) {
	widthB = tableWidth = 0;
	counterA = 0;
	if(typeof menuId != 'undefined')
		{
			menuElem = document.getElementById(menuId);
			elementA = menuElem.getElementsByTagName('A');
			elementDl = menuElem.getElementsByTagName('DL');
			elementDiv = menuElem.getElementsByTagName('DIV');
			
			/* Задаем стандартные реакции на наведение мыши на элемент меню */
			for (i=0;i<elementA.length;i++)
				{
						if(elementA[i].parentNode.tagName.indexOf('DIV') == 0)
							 {
								  elementA[i].onmouseover = function() { hideMenu();showMenu(this); }
								  elementA[i].onmouseout = function() { closeMenu() }
								  /* Создаем внутри элемента span элемент b, для измерения длин текста */
								  oB = b.cloneNode(true);
								  oBText = bText.cloneNode(true);
								  oB.appendChild(oBText);
								  oB.firstChild.nodeValue = elementA[i].firstChild.firstChild.nodeValue;
								  elementA[i].firstChild.removeChild(elementA[i].firstChild.firstChild);
								  elementA[i].firstChild.appendChild(oB);
								  widthB += oB.scrollWidth;
								  counterA++;
							 };
				  };
			/* Опередяем длину таблицы */
			for (i=0;i<elementDiv.length;i++)
				{
					if(elementDiv[i].parentNode.tagName.indexOf('TD') == 0)
					 {
						  tableWidth += elementDiv[i].scrollWidth;
					 };
				 };
			 /* Узнаем размеры паддингов для элемента span 
			 spanPadding = Math.floor((tableWidth - widthB -2*counterA)/(2*counterA));
			 for (i=0;i<elementA.length;i++)
				{
						if(elementA[i].parentNode.tagName.indexOf('DIV') == 0)
							 {
								 elementA[i].firstChild.style.paddingLeft = spanPadding + 'px';
								 elementA[i].firstChild.style.paddingRight = spanPadding + 'px';
							 };
				};*/
			/* Задаем размеры выпадающего меню и ракции на его наведение */
			 for (i=0;i<elementDl.length;i++)
				{
						if(elementDl[i].parentNode.tagName.indexOf('DIV') == 0)
							 {
								  elementDl[i].onmouseover = function() { cancelClose(); }
								  elementDl[i].onmouseout = function() { closeMenu() }
								  if(elementDl[i].parentNode.scrollWidth + 28 >= 143)
								  		elementDl[i].style.width = (elementDl[i].parentNode.scrollWidth + 28) + 'px';
								  else
								  		elementDl[i].style.width = '143px';
							 };
				  };
		};
};