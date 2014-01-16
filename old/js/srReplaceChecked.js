function replaceChecked() {
		
		//Счетчик количества radio точек
		var inputCol = 0;
		//Находим все элементы div, у которых класс "inquiry"
		searchElem = document.getElementsByTagName('DIV');
		for(i=0;i<searchElem.length;i++)
			{
				if(searchElem[i].className == 'radio')
					{
						parentObj = searchElem[i];
						break;
					};
			};
		//Находим в этих div элементы input и label
		searchInput = parentObj.getElementsByTagName('INPUT');
		searchLabel = parentObj.getElementsByTagName('LABEL');
		//Если найден хоть один этот элемент, то...
		if((searchInput.length != 0)&&(searchLabel.length != 0)) {
			for(i=0;i<searchInput.length;i++)
				{
					//Находим все input, у которых тип radio
					if(searchInput[i].id.indexOf('radio') != -1)
						{
							//Если это так, то скрываем эти элементы
							searchInput[i].style.display = 'none';
							//И считаем их
							inputCol++;
							//Если хоть у одного из этих элементов прописан checked, то изменяем соответсвенно стили элемента
							//label, принадлежащего ему
							if(searchInput[i].checked == true) {
									labelNum = searchInput[i].id.substring(5,searchInput[i].id.length);
									checkedElem = searchInput[i];
									checkedLabel = document.getElementById('label' + labelNum);
									checkedLabel.className = 'labelScriptAct';
								};
						};
				};
			//Если количество элементов input и label равно, то ...
			if(inputCol == searchLabel.length) {
				for(i=0;i<searchLabel.length;i++)
					{
						//задаем необходимые классы элементам label
						if(searchLabel[i].className != 'labelScriptAct') {
							searchLabel[i].className = 'labelScript';
						}
						//обрабатываем событие нажатия на элемент label
						searchLabel[i].onclick = function(){
									labelNum = this.id.substring(5,this.id.length);
									//Если до этого не был определен не один label, то тогда первый нажатый определяет его
									if(typeof checkedElem == 'undefined')
										{
											checkedElem = document.getElementById('radio' + labelNum);
											checkedElem.checked = true;
											checkedLabel = this;
											this.className = 'labelScriptAct';
										}
									//иначе мы снимаем флаг с нажатого раньше, и стаивим его на нажатый сейчас
									else
										{
											checkedElem.checked = '';
											checkedLabel.className = 'labelScript';
											checkedElem = document.getElementById('radio' + labelNum);
											checkedElem.checked = true;
											checkedLabel = this;
											this.className = 'labelScriptAct';
										};
								};
					};
			};
		};
	};