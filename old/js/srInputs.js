/* Создаем элемент input */
var inputEl =  document.createElement('INPUT');
/* придаем ему аттрибут type=text */
inputEl.setAttribute('type','text');

function inputClear()
	{
		/* Находим все элементы input на странице */
		inputElements = document.getElementsByTagName('input');
		
		/* Сканируем их */
		for(k=0;k<inputElements.length;k++) {
			/* Если этот элемент пренадлижит к типу текст*/
			if((inputElements[k].getAttribute('type').indexOf('text') != -1)) {
				/* То при фокусе */
				inputElements[k].onfocus = function(){
					/* Задаем ему свойство */
					if(typeof this.oldText == 'undefined'){
						/* Сохраняем туда предыдущее имя */
						this.oldText = this.value;
						/* Обнуляем значения в строке */
						this.value = '';
					};
					/* Если свойство с запомненным текстом пустое */
					if(this.oldText == ''){
						/*Записываем туда опять текст*/
						this.oldText = this.value;
						/* Обнуляем значение в строке */
						this.value = '';
					};
					/* Присваеваем новый класс для синего цвета шрифта */
					this.className = 'input grayCol';
				};
				/* При отведении курсора от него */
				inputElements[k].onblur = function(){
					/* Проверяем, если человек ничего не ввел */
					if(this.value == ''){
						/* Вводим в строку значения свойства oldText */
						this.value = this.oldText;
						/* Обнуляем это свойство */
						this.oldText = '';
						/* Задаем класс с серым цветом шрифта */
						this.className = 'input';
					};
				};
			};
		};
		
		/* Находим все элементы textarea на странице */
		textareaElements = document.getElementsByTagName('textarea');
		
		/* Сканируем их */
		for(i=0;i<textareaElements.length;i++) {
			/* при фокусе */
			textareaElements[i].onfocus = function(){
				/* Задаем ему свойство */
				if(typeof this.oldText == 'undefined'){
					/* Сохраняем туда предыдущее имя */
					this.oldText = this.value;
					/* Обнуляем значения в строке */
					this.value = '';
				};
				/* Если свойство с запомненным текстом пустое */
				if(this.oldText == ''){
					/*Записываем туда опять текст*/
					this.oldText = this.value;
					/* Обнуляем значение в строке */
					this.value = '';
				};
				/* Присваеваем новый класс для синего цвета шрифта */
				this.className = 'grayCol';
			};
			/* При отведении курсора от него */
			textareaElements[i].onblur = function(){
				/* Проверяем, если человек ничего не ввел */
				if(this.value == ''){
					/* Вводим в строку значения свойства oldText */
					this.value = this.oldText;
					/* Обнуляем это свойство */
					this.oldText = '';
					/* Задаем класс с серым цветом шрифта */
					this.className = '';
				};
			};
		};
		
	};