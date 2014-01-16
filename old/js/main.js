// Переменная, устанавливающая задержку пребывания развернутого меню
var tm;
var ie6 = (navigator.userAgent.indexOf('MSIE') != -1);

//Функция, дающая запрет закрытию подменю
function cancelClose(){
    if(tm) {
        clearTimeout(tm);
    }
}

//Функция, открывающая меню
function showMenu(obj) {
	
	//Если не существует доселе открытого подменю, то...
	if(typeof object == "undefined")
		{
			//Находим элементы. которые должны быть показаны
			parentObj = obj.parentNode;
         objSelect = obj;
			workObj = parentObj.childNodes;
			for (i=0;i<workObj.length;i++)
				{
					if(workObj[i].className != undefined)
						if(workObj[i].className.indexOf("submenu") == 0)
							{
								//Обозначаем то, что пожменю уже открыто
								object = workObj[i];
								//Открываем само подменю
								object.style.display = 'block';
								cancelClose();
							}
				}
		}
	//И если было открыто до селе подменю, мы его закрываем, а лишь потом открываем новое
	else 
		hideMenu();
}

//Функция устанавливающая задержку закрытия, при отведения мыши в поле, где не находтся другого элемента основного меню
function closeMenu() {
    tm = setTimeout("hideMenu()",500);
}

//Закрывает открытое меню до этого меню
function hideMenu() {
	if (typeof object != "undefined")
		{
			object.style.display = "none";
			object = undefined;
		}
}

//Функция расставляем события для элементов меню и подменю
//имеет в своем составе две основные переменные, задающие id основного(верхнего) меню и 
//меню слева
function srMenu(menuIdFirst) {
	if(typeof menuIdFirst != 'undefined')
		{
			menuFirst = document.getElementById(menuIdFirst);
			
			elementsA = menuFirst.getElementsByTagName('A');
			for (j=0;j<elementsA.length;j++)
				{
					if(elementsA[j].parentNode.tagName.indexOf('LI') == 0)
						{
							elementsA[j].onmouseover = function() { hideMenu();};
						};
				};
			
			elementDiv = menuFirst.getElementsByTagName('DIV');
			 for (i=0;i<elementDiv.length;i++)
				{
						if(elementDiv[i].parentNode.tagName.indexOf('LI') == 0)
							 {
								  elementA = elementDiv[i].parentNode.getElementsByTagName('A');
								  for (j=0;j<elementA.length;j++)
									{
											if(elementA[j].parentNode.tagName.indexOf('LI') == 0)
												 {
													  elementA[j].onmouseover = function() { hideMenu();showMenu(this); };
													  elementA[j].onmouseout = function() { closeMenu() };
												 };
									  };
								  elementDiv[i].onmouseover = function() { cancelClose(); };
								  elementDiv[i].onmouseout = function() { closeMenu() };
							 };
				  };
		};
}
