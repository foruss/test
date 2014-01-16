/*
 * Скрипт управления админкой
 */

/**
 * Окошко добавления новости
 */
function createNews(btn) {
	this.doCancel=function() {
		this.dlg.destroy(true);
	}
	
	this.doSubmit = function() {
		var res = this.form.submit({waitMsg: 'Отправка данных'});
	}
	
	this.submitComplete = function(form, action) {
		if (action.type == 'load') {
		} else {
			this.destroy(true);
			btn.updateGridController();
		}
	}
	
	this.loadDataComplete = function(form) {
		this.form.setValues(this.datastore.reader.jsonData);
		this.dlg.show(btn.dom);
	}
	
	this.width = 800;
	
	this.dlg = new Ext.BasicDialog('news-dlg', {
			autoCreate: true,
			width: this.width,
			height: 500,
			minWidth: 600,
			minHeight: 250,
			modal: true,
			proxyDrag: true,
			shadow: true,
			collapsible: false,
			resizable: false,
			closable: true,
			title: (btn.newsId ? "Редактировать новость" : "Добавить новость")
	});
	
	this.dlg.addKeyListener(27, this.doCancel, this.dlg);
	this.dlg.addButton({
			text: (btn.newsId ? 'Изменить' : 'Добавить'),
			bindForm:true
			}, this.doSubmit, this);
	this.dlg.addButton('Отмена', this.doCancel, this);
	
	this.form = new Ext.form.Form({
			labelAlign: 'top',
			url: 'news.php?action=add',
			method: 'post',
			monitorValid:true,
			errorReader: new Ext.data.JsonReader(
			{
				successProperty: 'success',
				root: 'errors'
			}, 
			[
			 	'id', 'msg'
			])
	});
	this.form.on('actioncomplete', this.submitComplete, this.dlg);
	
	if (btn.newsId) {
		// Добавляем id (hidden)
		this.form.add(new Ext.form.Field({
				labelStyle: 'display: none;',
				name: 'id',
				inputType: 'hidden',
				value: btn.newsId
		}));
	} 
	// Добавляем заголовок
	this.form.add(new Ext.form.TextField({
			fieldLabel: 'Заголовок новости',
			name: 'title',
			width: this.width - 70,
			maxLength: 255,			
			allowBlank: false,
			emptyText: 'Заголовок',
			blankText: 'Необходимо заполнить заголовок'
	}));
	// Добавляем раздел
	// simple array store
	this.comboStore = new Ext.data.SimpleStore({
	    fields: ['value', 'text'],
	    data : [['news', 'Новости'],
	    		['press', 'Пресса'],
	    		['joke', 'Анекдот']]
	});
	this.form.add(new Ext.form.ComboBox({
	    store: comboStore,
	    mode: 'local',
	    displayField: 'text',
	    valueField: 'value',
	    fieldLabel: 'Раздел',
	    name: 'section',
	    width: this.width - 70,
	    typeAhead: true,
	    editable: false,
	    triggerAction: 'all',
	    emptyText:'Выберите раздел...',
	    blankText: 'Необходимо выбрать раздел',
	    allowBlank: false,
	    selectOnFocus:true
	}));
	// Добавляем дату
	this.form.column(
		{width: this.width / 2 - 30},
		new Ext.form.DateField({
			fieldLabel: 'Дата',
			name: 'date',
			width: this.width / 2 - 40,
			format: 'd.m.Y',
			altFormats: 'd.m.Y|j.n.y|j/n/Y|j-n-y|j-n-Y|j/n|j-n|j.n|j',
			allowBlank: false,
			emptyText: 'Отображаемая дата',
			blankText: 'Необходимо указать дату новости',
			invalidText: '{0} не является правильной датой - дата должна быть в формате {1}'
		})
	);
	// Добавляем категорию
	this.form.column(
		{width: this.width / 2 - 30, clear:true},
		new Ext.form.TextField({
			fieldLabel: 'Теги',
			width: this.width / 2 - 40,
			name: 'tags',
			emptyText: 'Список тегов, разделенных пробелами',
			allowBlank: true
		})
	);
	// Добавляем краткую новость
	this.form.add(new Ext.form.TextArea({
			fieldLabel: 'Новость кратко',
			name: 'short',
			width: this.width - 70,
			allowBlank: false,
			blankText: 'Необходимо написать краткое описание новости'
	}));
	// Добавляем полную новость
	this.form.add(new Ext.form.HtmlEditor({
			fieldLabel: 'Новость полностью',
			name: 'long',
			width: this.width - 70,
			allowBlank: false,
			blankText: 'Саму-то новость тоже неплохо было бы написать'
	}));
	this.dlg.body.setStyle('padding', '8pt');
	this.form.render(this.dlg.body);
	if (btn.newsId != 0) {
		this.datastore = new Ext.data.Store({
			proxy: new Ext.data.HttpProxy({
				url: 'news.php?action=edit&id=' + btn.newsId
			}),
			reader: new Ext.data.JsonReader({}, ['title', 'tags'])
		});
		this.datastore.on('load', this.loadDataComplete, this);
		this.datastore.load();
	} else {
		this.dlg.show(btn.dom);
	}
}

/**
 * Окошко добавления/изменения статьи
 */
function createArticle(btn) {
	this.width = 800;
	
	this.dlg = new Ext.BasicDialog('articles-dlg', {
			autoCreate: true,
			width: this.width,
			height: 500,
			minWidth: 600,
			minHeight: 250,
			modal: true,
			proxyDrag: true,
			shadow: true,
			collapsible: false,
			resizable: false,
			closable: true,
			title: (btn.articleId ? "Изменить публикацию" : "Добавить публикацию")
	});

	this.dlg.addKeyListener(27, this.doCancel, this.dlg);
	this.dlg.addButton({
			text: (btn.articleId ? 'Изменить' : 'Добавить'),
			bindForm:true
			}, function() {
		var res = this.form.submit({waitMsg: 'Отправка данных'});
	}, this);
	this.dlg.addButton('Отмена', function() {
		this.dlg.destroy(true);
	}, this);
	
	this.form = new Ext.form.Form({
			labelAlign: 'top',
			url: 'articles.php?action=add',
			method: 'post',
			monitorValid:true,
			errorReader: new Ext.data.JsonReader(
			{
				successProperty: 'success',
				root: 'errors'
			}, 
			[ 
			 	'id', 'msg'
			])
	});

	this.form.on('actioncomplete', function(form, action) {
		this.destroy(true);
		btn.updateGridController();
	}, this.dlg);
	
	if (btn.articleId) {
		// Добавляем id (hidden)
		this.form.add(new Ext.form.Field({
				labelStyle: 'display: none;',
				name: 'id',
				inputType: 'hidden',
				value: btn.articleId
		}));
	} 

	// Добавляем раздел
	this.comboStore = new Ext.data.SimpleStore({
	    fields: ['value', 'text'],
	    data : [['9', 'Главная'],
	    		['10', 'О компании'],
	    		['11', 'Полезная информация'],
	    		['12', 'Наши партнеры'],
	    		['13', 'Консультация онлайн'],
	    		['14', 'Отслеживание груза'],
	    		['15', 'Запчасти'],
	    		['16', 'Авто в наличии'],
	    		['17', 'Неаварийные авто'],
	    		['18', 'Аварийные авто'],
	    		['19', 'Торги online'],
	    		['21', 'Новые авто'],
	    		['24', 'Контакты'],
	    		['25', 'об авто из сша'],
	    		['26', 'об аукционах'],
	    		['27', 'типы повреждений'],
	    		['28', 'carfax autocheck'],
	    		['29', 'доставка - сроки']]
    		
	});
	this.form.add(new Ext.form.ComboBox({
	    store: comboStore,
	    mode: 'local',
	    displayField: 'text',
	    valueField: 'value',
	    fieldLabel: 'Тип публикации',
	    name: 'section',
	    width: this.width - 70,
	    typeAhead: true,
	    editable: false,
	    triggerAction: 'all',
	    emptyText:'Выберите тип...',
	    blankText: 'Необходимо выбрать тип',
	    allowBlank: false,
	    selectOnFocus:true
	}));
	
	// Добавляем заголовок
	this.form.add(new Ext.form.TextField({
			fieldLabel: 'Заголовок публикации',
			name: 'title',
			width: this.width - 70,
			maxLength: 255,			
			allowBlank: false,
			emptyText: 'Заголовок',
			blankText: 'Необходимо заполнить заголовок'
	}));
	
	// Добавляем дату
	this.form.column(
		{width: this.width / 2 - 30},
		new Ext.form.DateField({
			fieldLabel: 'Дата',
			name: 'date',
			width: this.width / 2 - 40,
			format: 'd.m.Y',
			altFormats: 'd.m.Y|j.n.y|j/n/Y|j-n-y|j-n-Y|j/n|j-n|j.n|j',
			allowBlank: false,
			emptyText: 'Отображаемая дата',
			blankText: 'Необходимо указать дату публикации',
			invalidText: '{0} не является правильной датой - дата должна быть в формате {1}'
		})
	);
	
	// Добавляем теги
	this.form.column(
		{width: this.width / 2 - 30, clear:true},
		new Ext.form.TextField({
			fieldLabel: 'Теги',
			width: this.width / 2 - 40,
			name: 'tags',
			emptyText: 'Список тегов, разделенных пробелами',
			allowBlank: true
		})
	);

	// Добавляем публикацию
	this.form.add(new Ext.form.HtmlEditor({
			fieldLabel: 'Текст публикации',
			name: 'long',
			width: this.width - 70,
			allowBlank: false,
			blankText: 'Саму-то публикацию тоже неплохо было бы написать'
	}));

	this.dlg.body.setStyle('padding', '8pt');
	this.form.render(this.dlg.body);
	if (btn.articleId != 0) {
		this.datastore = new Ext.data.Store({
			proxy: new Ext.data.HttpProxy({
				url: 'articles.php?action=edit&id=' + btn.articleId
			}),
			reader: new Ext.data.JsonReader({}, ['title', 'tags'])
		});
		this.datastore.on('load', function(form) {
			this.form.setValues(this.datastore.reader.jsonData);
			this.dlg.show(btn.dom);
		}, this);
		this.datastore.load();
	} else {
		this.dlg.show(btn.dom);
	}
}

/**
 * Окошко добавления/изменения статьи
 */
function createLibrary(btn) {
	this.width = 800;
	
	this.dlg = new Ext.BasicDialog('library-dlg', {
			autoCreate: true,
			width: this.width,
			height: 500,
			minWidth: 600,
			minHeight: 250,
			modal: true,
			proxyDrag: true,
			shadow: true,
			collapsible: false,
			resizable: false,
			closable: true,
			title: (btn.libraryId ? "Изменить книгу" : "Добавить книгу")
	});

	this.dlg.addKeyListener(27, this.doCancel, this.dlg);
	this.dlg.addButton({
			text: (btn.libraryId ? 'Изменить' : 'Добавить'),
			bindForm:true
			}, function() {
		var res = this.form.submit({waitMsg: 'Отправка данных'});
	}, this);
	this.dlg.addButton('Отмена', function() {
		this.dlg.destroy(true);
	}, this);
	
	this.form = new Ext.form.Form({
			labelAlign: 'top',
			url: 'library.php?action=add',
			method: 'post',
			monitorValid: true,
			fileUpload: true,
			errorReader: new Ext.data.JsonReader(
			{
				successProperty: 'success',
				root: 'errors'
			}, 
			[ 
			 	'id', 'msg'
			])
	});

	this.form.on('actioncomplete', function(form, action) {
		this.destroy(true);
		btn.updateGridController();
	}, this.dlg);
	
	if (btn.libraryId) {
		// Добавляем id (hidden)
		this.form.add(new Ext.form.Field({
				labelStyle: 'display: none;',
				name: 'id',
				inputType: 'hidden',
				value: btn.libraryId
		}));
	} 

	// Добавляем раздел
	this.comboStore = new Ext.data.JsonStore({
		url : 'library.php?action=categories',
		root : 'categories',
	    fields: ['value', 'text']
	});
	this.form.add(new Ext.form.ComboBox({
	    store: comboStore,
	    mode: 'remote',
	    displayField: 'text',
	    valueField: 'value',
	    fieldLabel: 'Категория',
	    name: 'category',
	    width: this.width - 70,
	    typeAhead: true,
	    editable: false,
	    triggerAction: 'all',
	    emptyText:'Выберите категорию...',
	    blankText: 'Необходимо выбрать категорию',
	    allowBlank: false,
	    selectOnFocus:true
	}));
	
	// Добавляем заголовок
	this.form.add(new Ext.form.TextField({
			fieldLabel: 'Название книги',
			name: 'title',
			width: this.width - 70,
			maxLength: 255,			
			allowBlank: false,
			emptyText: 'Название',
			blankText: 'Необходимо написать название'
	}));
	// Добавляем краткое описание
	this.form.add(new Ext.form.TextArea({
			fieldLabel: 'Краткое описание',
			name: 'short',
			width: this.width - 70,
			allowBlank: false,
			blankText: 'Необходимо написать краткое описание книги'
	}));	
	// Добавляем полное описание
	this.form.add(new Ext.form.HtmlEditor({
			fieldLabel: 'Полное описание',
			name: 'description',
			width: this.width - 70,
			allowBlank: false,
			blankText: 'Необходимо написать полное описание книги'
	}));

	this.dlg.body.setStyle('padding', '8pt');
	this.form.render(this.dlg.body);
	if (btn.libraryId != 0) {
		this.datastore = new Ext.data.Store({
			proxy: new Ext.data.HttpProxy({
				url: 'library.php?action=edit&id=' + btn.libraryId
			}),
			reader: new Ext.data.JsonReader({}, ['title', 'tags'])
		});
		this.datastore.on('load', function(form) {
			this.form.setValues(this.datastore.reader.jsonData);
			this.dlg.show(btn.dom);
		}, this);
		this.datastore.load();
	} else {
		this.dlg.show(btn.dom);
	}
}

function libraryFileUpload(btn) {
	dialog = new Ext.ux.UploadDialog.Dialog(null, {
		autoCreate: true,
		closable: true,
		collapsible: false,
		draggable: true,
		minWidth: 400,      
		minHeight: 200,
		width: 800,
		height: 500,
		proxyDrag: true,
		resizable: true,
		constraintoviewport: true,
		title: 'Очередь загрузки файлов.',
		url: 'upload.php?mode=library',
		reset_on_hide: false,
		allow_close_on_upload: true
	});
	dialog.on('hide', function () {
		btn.updateGridController()
	});
	dialog.show();
}

function imagesFileUpload(btn) {
	dialog = new Ext.ux.UploadDialog.Dialog(null, {
		autoCreate: true,
		closable: true,
		collapsible: false,
		draggable: true,
		minWidth: 400,      
		minHeight: 200,
		width: 800,
		height: 500,
		proxyDrag: true,
		resizable: true,
		constraintoviewport: true,
		title: 'Очередь загрузки файлов.',
		url: 'upload.php?mode=img',
		reset_on_hide: false,
		allow_close_on_upload: true
	});
	dialog.on('hide', function () {
		btn.updateGridController()
	});
	dialog.show();
}

/**
 * Функция инициализации админки
 */
AdminWindow = function(){
	var layout;
	return {
		init : function(){
			// Инициализация систем подскахок
			Ext.QuickTips.init();
			
			// vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
			// v                       Инициализация вкладки новости                        v
			// vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
			var ds = new Ext.data.Store({
		        proxy: new Ext.data.HttpProxy({
					url: 'news.php?action=list'
				}),
				reader: new Ext.data.JsonReader({
					root: 'news',
					totalProperty: 'totalCount',
					id: 'newsid'
				}, [
					{name: 'date', mapping: 'date'},
					{name: 'author', mapping: 'author'},
					{name: 'title', mapping: 'title'},
					{name: 'tags', mapping: 'tags'}
				]),
				remoteSort: true
			});

			var colModel = new Ext.grid.ColumnModel([
				{header: "Дата", width: 160, sortable: true, locked:false, dataIndex: 'date'},
				//{header: "Автор", width: 160, sortable: true, dataIndex: 'author'},
				{id: "title", header: "Заголовок", sortable: true, dataIndex: 'title'},
				{header: "Теги", width: 160, sortable: true, dataIndex: 'tags'}
			]);
			
	        var grid = new Ext.grid.Grid('center1', {
	            ds: ds,
	            cm: colModel,
				selModel: new Ext.grid.RowSelectionModel({singleSelect:true}),
				enableColLock:false,
				loadMask: true,
	            autoExpandColumn: 'title'
	        });
	        
	        grid.render();
			grid.getSelectionModel().selectFirstRow();
			
			grid.on('rowdblclick', function () {
				var obj = this.getSelectionModel().getSelected();
				//this.newsId = obj.json.id;
				var sendobj = {};
				sendobj.newsId = obj.json.id;
				sendobj.updateGridController = function () {
					ds.load();
				}
				createNews(sendobj);
			});
			
			var gridFoot = grid.getView().getFooterPanel(true);
			
			var paging = new Ext.PagingToolbar(gridFoot, ds, {
				pageSize: 25,
				displayInfo: true,
				displayMsg: 'Отображаются новости {0} - {1} из {2}',
				emptyMsg: "Нет новостей для отображения"
			});

			paging.addButton({
				enableToggle:false,
				tooltip: 'Новая новость',
				icon: '/admin/img/new.gif',
				iconCls: 'buttonIcon',
				handler: function () {
					this.newsId = 0;
					this.updateGridController = function () {
						ds.load();
					}
					createNews(this);
				}
			});
			paging.addButton({
				enableToggle:false,
				tooltip: 'Редактировать новость',
				icon: '/admin/img/edit.gif',
				iconCls: 'buttonIcon',
				handler: function () {
					var obj = grid.getSelectionModel().getSelected();
					if (!obj) {
						Ext.Msg.alert('Новости','Ничего не выбрано');
					} else {
						this.newsId = obj.json.id;
						this.updateGridController = function () {
							ds.load();
						}
						createNews(this);
					}
				}
			});
			paging.addButton({
				enableToggle: false,
				tooltip: 'Удалить',
				icon: '/admin/img/delete.gif',
				iconCls: 'buttonIcon',
				handler: function() {
					var obj = grid.getSelectionModel().getSelected();
					if (!obj) {
						Ext.Msg.alert('Новости','Ничего не выбрано');
						return;
					}
					Ext.MessageBox.show({
						title: obj.json.title,
						buttons: {
							yes: 'Да',
							no: 'Нет'
						},
						msg: 'Удалить новость \'' + obj.json.title + '\'?',
						fn: function(btn) {
							if (btn == 'yes') {
								var delConnection = new Ext.data.Connection({});
								delConnection.request({
									url: 'news.php',
									method: 'POST',
									params: {
										action: 'delete',
										id: obj.json.id
									},
									success: function () {
										ds.load();
									}
								});
							}
						}
					});
				}
			});
	        
			// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
			// ^                       Инициализация вкладки новости                        ^
			// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

			// vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
			// v                      Инициализация вкладки каталога                        v
			// vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
			/*
			var catalogDS = new Ext.data.Store({
		        proxy: new Ext.data.HttpProxy({
					url: 'catalog.php?action=list'
				}),
				reader: new Ext.data.JsonReader({
					root: 'catalog',
					totalProperty: 'totalCount',
					id: 'id'
				}, [
					{name: 'date'},
					{name: 'company'},
					{name: 'company_name'},
					{name: 'compant_logo'},
					{name: 'company_about'},
					{name: 'number_of_employees'},
					{name: 'code_okpo'},
					{name: 'directors_name'},
					{name: 'site'},
					{name: 'email'},
					{name: 'region'},
					{name: 'city'},
					{name: 'index'},
					{name: 'legal_address'},
					{name: 'actual_address'},
					{name: 'directorate'},
					{name: 'supply_department'},
					{name: 'marketing_department'},
					{name: 'sales_department'},
					{name: 'accounting_department'},
					{name: 'legal_department'},
					{name: 'engineering_department'},
					{name: 'production'},
					{name: 'state'},
				]),
				remoteSort: true
			});

			var catalogColModel = new Ext.grid.ColumnModel([
				{header: "Дата", width: 160, sortable: true, locked:false, dataIndex: 'date'},
				{id: "summary", header: "Описание", sortable: true},
				{header: "Компания", sortable: true, dataIndex: 'company_name', hidden: true},
				{header: "О компания", sortable: true, dataIndex: 'company_about', hidden: true},
				{header: "Число рабочих", sortable: true, dataIndex: 'number_of_employees', hidden: true},
				{header: "Код ОКПО", sortable: true, dataIndex: 'code_okpo', hidden: true},
				{header: "ФИО Директора", sortable: true, dataIndex: 'directors_name', hidden: true},
				{header: "Сайт", sortable: true, dataIndex: 'site', hidden: true},
				{header: "E-mail", sortable: true, dataIndex: 'email', hidden: true},
				{header: "Область", sortable: true, dataIndex: 'region', hidden: true},
				{header: "Город", sortable: true, dataIndex: 'city', hidden: true},
				{header: "Индекс", sortable: true, dataIndex: 'index', hidden: true},
				{header: "Юридический адрес", sortable: true, dataIndex: 'legal_address', hidden: true},
				{header: "Фактический адрес", sortable: true, dataIndex: 'actual_address', hidden: true},
				{header: "Дирекция", sortable: true, dataIndex: 'directorate', hidden: true},
				{header: "Отдел снабжения", sortable: true, dataIndex: 'supply_department', hidden: true},
				{header: "Отдел маркетинга", sortable: true, dataIndex: 'marketing_department', hidden: true},
				{header: "Отдел сбыта", sortable: true, dataIndex: 'sales_department', hidden: true},
				{header: "Бухгалтерия", sortable: true, dataIndex: 'accounting_department', hidden: true},
				{header: "Юридический отдел", sortable: true, dataIndex: 'legal_department', hidden: true},
				{header: "Технический отдел", sortable: true, dataIndex: 'engineering_department', hidden: true},
				{header: "Продукция", sortable: true, dataIndex: 'production', hidden: true},
				{id: 'state', header: "Состояние", width: 160, sortable: true, dataIndex: 'state'}
			]);
			
	        var catalogGrid = new Ext.grid.Grid('center2', {
	            ds: catalogDS,
	            cm: catalogColModel,
				selModel: new Ext.grid.RowSelectionModel({singleSelect:true}),
				enableColLock:false,
				trackMouseOver: false,
				loadMask: true,
	            autoExpandColumn: 'summary'
	        });
			
			catalogColModel.getColumnById('summary').renderer = function(data, metadata, record, row, column, store) {
				return '<div style="text-align: center; font-weight: bold; ">'+record.data['company']+'</div><br />' +
					(record.data['company_logo'] == '1' ? '<img src="/cataloglogo/' + record.data['id'] + '.jpg" width="100" height="100" align="right" />' : '') +
					(record.data['company_about'] ? '<b><i>Описание:</i></b> ' + record.data['company_about'] + '<br />' : '') +
					(record.data['number_of_employees'] ? '<b><i>Число работников:</i></b> ' + record.data['number_of_employees'] + '<br />' : '') +
					(record.data['code_okpo'] ? '<b><i>Код ОКПО:</i></b> ' + record.data['code_okpo'] + '<br />' : '') +
					(record.data['directors_name'] ? '<b><i>ФИО Директора:</i></b> ' + record.data['directors_name'] + '<br />' : '') +
					(record.data['site'] ? '<b><i>Сайт:</i></b> ' + record.data['site'] + '<br />' : '') +
					(record.data['email'] ? '<b><i>E-mail:</i></b> ' + record.data['email'] + '<br />' : '') +
					(record.data['region'] ? '<b><i>Область:</i></b> ' + record.data['region'] + '<br />' : '') +
					(record.data['city'] ? '<b><i>Город:</i></b> ' + record.data['city'] + '<br />' : '') +
					(record.data['index'] ? '<b><i>Индекс:</i></b> ' + record.data['index'] + '<br />' : '') +
					(record.data['legal_address'] ? '<b><i>Юридический адрес:</i></b> ' + record.data['legal_address'] + '<br />' : '') +
					(record.data['actual_address'] ? '<b><i>Фактический адрес:</i></b> ' + record.data['actual_address'] + '<br />' : '') +
					(record.data['directorate'] ? '<b><i>Дирекция:</i></b> ' + record.data['directorate'] + '<br />' : '') +
					(record.data['supply_department'] ? '<b><i>Отдел снабжения:</i></b> ' + record.data['supply_department'] + '<br />' : '') +
					(record.data['marketing_department'] ? '<b><i>Отдел маркетинга:</i></b> ' + record.data['marketing_department'] + '<br />' : '') +
					(record.data['sales_department'] ? '<b><i>Отдел продаж:</i></b> ' + record.data['sales_department'] + '<br />' : '') +
					(record.data['accounting_department'] ? '<b><i>Бухгалтерия:</i></b> ' + record.data['accounting_department'] + '<br />' : '') +
					(record.data['legal_department'] ? '<b><i>Юридический отдел:</i></b> ' + record.data['legal_department'] + '<br />' : '') +
					(record.data['engineering_department'] ? '<b><i>Технический отдел:</i></b> ' + record.data['engineering_department'] + '<br />' : '') +
					(record.data['production'] ? '<b><i>Продукция:</i></b> ' + record.data['production'] + '<br />' : '');
			};
			
			catalogColModel.getColumnById('state').renderer = function(data) {
				var resText = 'Ожидание';
				if (data == 'approved') {
					resText = 'Одобрено';
				} else if (data == 'disapproved') {
					resText = 'Отклонено';
				} 
				return '<div style="text-align: center;"><img src="/admin/img/' + data + '.gif" alt="' + resText + '" /></div>';
			}
			
			catalogGrid.render();
			catalogGrid.getSelectionModel().selectFirstRow();

			catalogGrid.on('rowdblclick', function () {
				var obj = this.getSelectionModel().getSelected();
				Ext.MessageBox.show({
					title: obj.json.company_name,
					buttons: {
						yes: 'Одобрить',
						no: 'Отклонить',
						ok: 'Отложить решение',
						cancel: 'Оставить как есть'
					},
					msg: 'Что сделать с записью о \'' + obj.json.company_name + '\'?',
					fn: function(btn) {
						if (btn != 'cancel') {
							var delConnection = new Ext.data.Connection({});
							delConnection.request({
								url: 'catalog.php',
								method: 'POST',
								params: {
									action: 'changestate',
									id: obj.json.id,
									state: btn
								},
								success: function () {
									catalogDS.load();
								}
							});
						}
					}
				});
			});
			
			var catalogGridFoot = catalogGrid.getView().getFooterPanel(true);
			
			var catalogPaging = new Ext.PagingToolbar(catalogGridFoot, catalogDS, {
				pageSize: 25,
				displayInfo: true,
				displayMsg: 'Отображаются записи {0} - {1} из {2}',
				emptyMsg: "Нет записей для отображения"
			});
			
			catalogPaging.addButton({
				enableToggle: false,
				tooltip: 'Удалить',
				icon: '/admin/img/delete.gif',
				iconCls: 'buttonIcon',
				handler: function() {
					var obj = catalogGrid.getSelectionModel().getSelected();
					if (!obj) {
						Ext.Msg.alert('Каталог','Ничего не выбрано');
						return;
					}
					Ext.MessageBox.show({
						title: obj.json.title,
						buttons: {
							yes: 'Да',
							no: 'Нет'
						},
						msg: 'Удалить компанию \'' + obj.json.title + '\'?',
						fn: function(btn) {
							if (btn == 'yes') {
								var delConnection = new Ext.data.Connection({});
								delConnection.request({
									url: 'catalog.php',
									method: 'POST',
									params: {
										action: 'delete',
										id: obj.json.id
									},
									success: function () {
										catalogDS.load();
									}
								});
							}
						}
					});
					
				}
			});
			*/
			// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
			// ^                      Инициализация вкладки каталога                        ^
			// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

			// vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
			// v                     Инициализация вкладки публикации                       v
			// vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv

			var articlesDS = new Ext.data.Store({
		        proxy: new Ext.data.HttpProxy({
					url: 'articles.php?action=list'
				}),
				reader: new Ext.data.JsonReader({
					root: 'articles',
					totalProperty: 'totalCount',
					id: 'id'
				}, [
					{name: 'date', mapping: 'date'},
					{name: 'author', mapping: 'author'},
					{name: 'title', mapping: 'title'},
					{name: 'tags', mapping: 'tags'},
					{name: 'category'}
				]),
				remoteSort: true
			});

			var articlesColModel = new Ext.grid.ColumnModel([
				{id: "category", header: "Категория", width: 160, sortable: true, locked:false, dataIndex: 'category'},
				{header: "Дата", width: 160, sortable: true, locked:false, dataIndex: 'date'},
				//{header: "Автор", width: 160, sortable: true, dataIndex: 'author'},
				{id: "title", header: "Заголовок", sortable: true, dataIndex: 'title'},
				{header: "Теги", width: 160, sortable: true, dataIndex: 'tags'}
			]);
			
	        var articlesGrid = new Ext.grid.Grid('center3', {
	            ds: articlesDS,
	            cm: articlesColModel,
				selModel: new Ext.grid.RowSelectionModel({singleSelect:true}),
				enableColLock:false,
				loadMask: true,
	            autoExpandColumn: 'title'
	        });
			
			articlesColModel.getColumnById('category').renderer = function(data, metadata, record, row, column, store) {
				switch (data) {
				case '9': return 'Главная';
				case '10': return 'О компании';
				case '11': return 'Полезная информация';
				case '12': return 'Наши партнеры';
				case '13': return 'Консультация онлайн';
				case '14': return 'Отслеживание груза';
				case '15': return 'Запчасти';
				case '16': return 'Авто в наличии';
				case '17': return 'Неаварийные авто';
				case '18': return 'Аварийные авто';
				case '19': return 'Торги online';
				case '21': return 'Новые авто';
				case '24': return 'Контакты';
				case '25': return 'об авто из сша';
				case '26': return 'об аукционах';
				case '27': return 'типы повреждений';
				case '28': return 'carfax autocheck';
				case '29': return 'доставка - сроки'; 
   		
		    	}
			};
			
			articlesGrid.render();
			articlesGrid.getSelectionModel().selectFirstRow();
			
			articlesGrid.on('rowdblclick', function () {
				var obj = this.getSelectionModel().getSelected();
				//this.newsId = obj.json.id;
				var sendobj = {};
				sendobj.articleId = obj.json.id;
				sendobj.updateGridController = function () {
					articlesDS.load();
				}
				createArticle(sendobj);
			});

			var articlesGridFoot = articlesGrid.getView().getFooterPanel(true);
			
			var articlesPaging = new Ext.PagingToolbar(articlesGridFoot, articlesDS, {
				pageSize: 25,
				displayInfo: true,
				displayMsg: 'Отображаются записи {0} - {1} из {2}',
				emptyMsg: "Нет записей для отображения"
			});

			articlesPaging.addButton({
				enableToggle:false,
				tooltip: 'Новая публикация',
				icon: '/admin/img/new.gif',
				iconCls: 'buttonIcon',
				handler: function () {
					this.articleId = 0;
					this.updateGridController = function () {
						articlesDS.load();
					}
					createArticle(this);
				}
			});
			articlesPaging.addButton({
				enableToggle:false,
				tooltip: 'Редактировать публикацию',
				icon: '/admin/img/edit.gif',
				iconCls: 'buttonIcon',
				handler: function () {
					var obj = articlesGrid.getSelectionModel().getSelected();
					if (!obj) {
						Ext.Msg.alert('Публикации','Ничего не выбрано');
					} else {
						this.articleId = obj.json.id;
						this.updateGridController = function () {
							articlesDS.load();
						}
						createArticle(this);
					}
				}
			});
			articlesPaging.addButton({
				enableToggle: false,
				tooltip: 'Удалить',
				icon: '/admin/img/delete.gif',
				iconCls: 'buttonIcon',
				handler: function() {
					var obj = articlesGrid.getSelectionModel().getSelected();
					if (!obj) {
						Ext.Msg.alert('Публикации','Ничего не выбрано');
						return;
					}
					Ext.MessageBox.show({
						title: obj.json.title,
						buttons: {
							yes: 'Да',
							no: 'Нет'
						},
						msg: 'Удалить публикацию \'' + obj.json.title + '\'?',
						fn: function(btn) {
							if (btn == 'yes') {
								var delConnection = new Ext.data.Connection({});
								delConnection.request({
									url: 'articles.php',
									method: 'POST',
									params: {
										action: 'delete',
										id: obj.json.id
									},
									success: function () {
										articlesDS.load();
									}
								});
							}
						}
					});
					
				}
			});
			
			// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
			// ^                     Инициализация вкладки публикации                       ^
			// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

			// vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
			// v                       Инициализация вкладки тендеры                        v
			// vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
			/*
			var tenderDS = new Ext.data.Store({
		        proxy: new Ext.data.HttpProxy({
					url: 'tender.php?action=list'
				}),
				reader: new Ext.data.JsonReader({
					root: 'tender',
					totalProperty: 'totalCount',
					id: 'id'
				}, [
					{name: 'title'},
					{name: 'start'},
					{name: 'end'},
					{name: 'ogranizer'},
					{name: 'contact_face'},
					{name: 'phones'},
					{name: 'faxes'},
					{name: 'email'},
					{name: 'state'}
				]),
				remoteSort: true
			});

			var tenderColModel = new Ext.grid.ColumnModel([
				{header: "Начало", width: 160, sortable: true, locked:false, dataIndex: 'start'},
				{header: "Конец", width: 160, sortable: true, locked:false, dataIndex: 'end'},
				{id: "summary", header: "Описание", sortable: true},
				{header: "Заголовок", sortable: true, dataIndex: 'title', hidden: true},
				{header: "Организатор", sortable: true, dataIndex: 'organizer', hidden: true},
				{header: "Контактное лицо", sortable: true, dataIndex: 'contact_face', hidden: true},
				{header: "Телефоны", sortable: true, dataIndex: 'phones', hidden: true},
				{header: "Факсы", sortable: true, dataIndex: 'faxes', hidden: true},
				{header: "E-mail", sortable: true, dataIndex: 'email', hidden: true},
				{id: 'state', header: "Состояние", width: 160, sortable: true, dataIndex: 'state'}
			]);
			
	        var tenderGrid = new Ext.grid.Grid('center4', {
	            ds: tenderDS,
	            cm: tenderColModel,
				selModel: new Ext.grid.RowSelectionModel({singleSelect:true}),
				enableColLock:false,
				trackMouseOver: false,
				loadMask: true,
	            autoExpandColumn: 'summary'
	        });
			
			tenderColModel.getColumnById('summary').renderer = function(data, metadata, record, row, column, store) {
				return '<div style="text-align: center; font-weight: bold; ">'+record.data['title']+'</div><br />' +
					(record.data['organizer'] ? '<b><i>Организатор:</i></b> ' + record.data['organizer'] + '<br />' : '') +
					(record.data['contact_face'] ? '<b><i>Контактное лицо:</i></b> ' + record.data['contact_face'] + '<br />' : '') +
					(record.data['phones'] ? '<b><i>Телефоны:</i></b> ' + record.data['phones'] + '<br />' : '') +
					(record.data['faxes'] ? '<b><i>Факсы:</i></b> ' + record.data['faxes'] + '<br />' : '') +
					(record.data['email'] ? '<b><i>E-mail:</i></b> ' + record.data['email'] + '<br />' : '');
			};
			
			tenderColModel.getColumnById('state').renderer = function(data) {
				var resText = 'Ожидание';
				if (data == 'approved') {
					resText = 'Одобрено';
				} else if (data == 'disapproved') {
					resText = 'Отклонено';
				} 
				return '<div style="text-align: center;"><img src="/admin/img/' + data + '.gif" alt="' + resText + '" /></div>';
			}
			
			tenderGrid.render();
			tenderGrid.getSelectionModel().selectFirstRow();

			tenderGrid.on('rowdblclick', function () {
				var obj = this.getSelectionModel().getSelected();
				Ext.MessageBox.show({
					title: obj.json.title,
					buttons: {
						yes: 'Одобрить',
						no: 'Отклонить',
						ok: 'Отложить решение',
						cancel: 'Оставить как есть'
					},
					msg: 'Что сделать с записью о \'' + obj.json.title + '\'?',
					fn: function(btn) {
						if (btn != 'cancel') {
							var delConnection = new Ext.data.Connection({});
							delConnection.request({
								url: 'tender.php',
								method: 'POST',
								params: {
									action: 'changestate',
									id: obj.json.id,
									state: btn
								},
								success: function () {
									tenderDS.load();
								}
							});
						}
					}
				});
			});
			
			var tenderGridFoot = tenderGrid.getView().getFooterPanel(true);
			
			var tenderPaging = new Ext.PagingToolbar(tenderGridFoot, tenderDS, {
				pageSize: 25,
				displayInfo: true,
				displayMsg: 'Отображаются записи {0} - {1} из {2}',
				emptyMsg: "Нет записей для отображения"
			});
			
			tenderPaging.addButton({
				enableToggle: false,
				tooltip: 'Удалить',
				icon: '/admin/img/delete.gif',
				iconCls: 'buttonIcon',
				handler: function() {
					var obj = tenderGrid.getSelectionModel().getSelected();
					if (!obj) {
						Ext.Msg.alert('Тендеры','Ничего не выбрано');
						return;
					}
					Ext.MessageBox.show({
						title: obj.json.title,
						buttons: {
							yes: 'Да',
							no: 'Нет'
						},
						msg: 'Удалить тендер \'' + obj.json.title + '\'?',
						fn: function(btn) {
							if (btn == 'yes') {
								var delConnection = new Ext.data.Connection({});
								delConnection.request({
									url: 'tender.php',
									method: 'POST',
									params: {
										action: 'delete',
										id: obj.json.id
									},
									success: function () {
										tenderDS.load();
									}
								});
							}
						}
					});
					
				}
			});
	        */
			// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
			// ^                       Инициализация вкладки тендеры                        ^
			// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

			// vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
			// v                     Инициализация вкладки библиотека                       v
			// vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
/*
			var libraryDS = new Ext.data.Store({
		        proxy: new Ext.data.HttpProxy({
					url: 'library.php?action=list'
				}),
				reader: new Ext.data.JsonReader({
					root: 'library',
					totalProperty: 'totalCount',
					id: 'id'
				}, [
					{name: 'title'},
					{name: 'short'},
					{name: 'description'},
					{name: 'cat'},
					{name: 'date'},
					{name: 'filename'}
				]),
				remoteSort: true
			});

			var libraryColModel = new Ext.grid.ColumnModel([
				{header: "Дата", width: 160, sortable: true, dataIndex: 'date'},
				{header: "Имя файла", width: 160, sortable: true, dataIndex: 'filename'},
				{id: 'title', header: "Заголовок", sortable: true, dataIndex: 'title'},
				{header: "Категория", width: 240, sortable: true, dataIndex: 'cat'}
			]);
			
	        var libraryGrid = new Ext.grid.Grid('center5', {
	            ds: libraryDS,
	            cm: libraryColModel,
				selModel: new Ext.grid.RowSelectionModel({singleSelect:true}),
				enableColLock:false,
				trackMouseOver: false,
				loadMask: true,
	            autoExpandColumn: 'title'
	        });

			libraryGrid.render();
			libraryGrid.getSelectionModel().selectFirstRow();

			libraryGrid.on('rowdblclick', function () {
				var obj = this.getSelectionModel().getSelected();
				//this.newsId = obj.json.id;
				var sendobj = {};
				sendobj.libraryId = obj.json.id;
				sendobj.updateGridController = function () {
					libraryDS.load();
				}
				createLibrary(sendobj);
			});
			
			var libraryGridFoot = libraryGrid.getView().getFooterPanel(true);
			
			var libraryPaging = new Ext.PagingToolbar(libraryGridFoot, libraryDS, {
				pageSize: 25,
				displayInfo: true,
				displayMsg: 'Отображаются записи {0} - {1} из {2}',
				emptyMsg: "Нет записей для отображения"
			});

			libraryPaging.addButton({
				enableToggle:false,
				tooltip: 'Загрузка файлов',
				icon: '/admin/img/new.gif',
				iconCls: 'buttonIcon',
				handler: function () {
					this.libraryId = 0;
					this.updateGridController = function () {
						libraryDS.load();
					}
					libraryFileUpload(this);
				}
			});

			libraryPaging.addButton({
				enableToggle:false,
				tooltip: 'Редактировать книгу',
				icon: '/admin/img/edit.gif',
				iconCls: 'buttonIcon',
				handler: function () {
					var obj = libraryGrid.getSelectionModel().getSelected();
					if (!obj) {
						Ext.Msg.alert('Библиотека','Ничего не выбрано');
					} else {
						this.libraryId = obj.json.id;
						this.updateGridController = function () {
							libraryDS.load();
						}
						createLibrary(this);
					}
				}
			});
			
			libraryPaging.addButton({
				enableToggle: false,
				tooltip: 'Удалить',
				icon: '/admin/img/delete.gif',
				iconCls: 'buttonIcon',
				handler: function() {
					var obj = libraryGrid.getSelectionModel().getSelected();
					if (!obj) {
						Ext.Msg.alert('Библиотека','Ничего не выбрано');
						return;
					}
					Ext.MessageBox.show({
						title: obj.json.filename,
						buttons: {
							yes: 'Да',
							no: 'Нет'
						},
						msg: 'Удалить книгу \'' + obj.json.filename + '\'?',
						fn: function(btn) {
							if (btn == 'yes') {
								var delConnection = new Ext.data.Connection({});
								delConnection.request({
									url: 'library.php',
									method: 'POST',
									params: {
										action: 'delete',
										id: obj.json.id
									},
									success: function () {
										libraryDS.load();
									}
								});
							}
						}
					});
					
				}
			});
			*/
			// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
			// ^                     Инициализация вкладки библиотека                       ^
			// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

			// vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
			// v                      Инициализация вкладки картинки                        v
			// vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
/*
			var imagesDS = new Ext.data.Store({
		        proxy: new Ext.data.HttpProxy({
					url: 'images.php?action=list'
				}),
				reader: new Ext.data.JsonReader({
					root: 'images',
					totalProperty: 'totalCount',
					id: 'id'
				}, [
					{name: 'filename'},
					{name: 'mtime'},
					{name: 'size'}
				]),
				remoteSort: true
			});

			var imagesColModel = new Ext.grid.ColumnModel([
				{id: 'filename', header: "Имя файла", sortable: true, dataIndex: 'filename'},
				{header: "Размер", width: 160, sortable: true, dataIndex: 'size'},
				{header: "Дата изменения", width: 160, sortable: true, dataIndex: 'mtime'}
			]);
			
	        var imagesGrid = new Ext.grid.Grid('center6', {
	            ds: imagesDS,
	            cm: imagesColModel,
				selModel: new Ext.grid.RowSelectionModel({singleSelect:true}),
				enableColLock:false,
				trackMouseOver: false,
				loadMask: true,
	            autoExpandColumn: 'filename'
	        });

			imagesGrid.render();
			imagesGrid.getSelectionModel().selectFirstRow();
			
			imagesGrid.on('rowdblclick', function () {
				var obj = this.getSelectionModel().getSelected();
				/*
       site_url = getSiteUrl();
        */
/*				Ext.Msg.alert('URL', '/img/' + obj.json.filename);
			});
			
			var imagesGridFoot = imagesGrid.getView().getFooterPanel(true);
			
			var imagesPaging = new Ext.PagingToolbar(imagesGridFoot, imagesDS, {
				pageSize: 25,
				displayInfo: true,
				displayMsg: 'Отображаются записи {0} - {1} из {2}',
				emptyMsg: "Нет записей для отображения"
			});

			imagesPaging.addButton({
				enableToggle:false,
				tooltip: 'Загрузка файлов',
				icon: '/admin/img/new.gif',
				iconCls: 'buttonIcon',
				handler: function () {
					this.updateGridController = function () {
						imagesDS.load();
					}
					imagesFileUpload(this);
				}
			});
			
			imagesPaging.addButton({
				enableToggle: false,
				tooltip: 'Удалить',
				icon: '/admin/img/delete.gif',
				iconCls: 'buttonIcon',
				handler: function() {
					var obj = imagesGrid.getSelectionModel().getSelected();
					if (!obj) {
						Ext.Msg.alert('Картинки','Ничего не выбрано');
						return;
					}
					Ext.MessageBox.show({
						title: obj.json.filename,
						buttons: {
							yes: 'Да',
							no: 'Нет'
						},
						msg: 'Удалить файл \'' + obj.json.filename + '\'?',
						fn: function(btn) {
							if (btn == 'yes') {
								var delConnection = new Ext.data.Connection({});
								delConnection.request({
									url: 'images.php',
									method: 'POST',
									params: {
										action: 'delete',
										filename: obj.json.filename
									},
									success: function () {
										imagesDS.load();
									}
								});
							}
						}
					});
					
				}
			});
*/
			// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
			// ^                      Инициализация вкладки картинки                        ^
			// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

			// vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
			// v                       Инициализация вкладки сайты                          v
			// vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
/*			
			var siteDS = new Ext.data.Store({
		        proxy: new Ext.data.HttpProxy({
					url: 'site.php?action=list'
				}),
				reader: new Ext.data.JsonReader({
					root: 'site',
					totalProperty: 'totalCount',
					id: 'id'
				}, [
					{name: 'title'},
					{name: 'url'},
					{name: 'state'}
				]),
				remoteSort: true
			});

			var siteColModel = new Ext.grid.ColumnModel([
				{header: "URL", width: 320, sortable: true, locked:false, dataIndex: 'url'},
				{id: 'title', header: "Заголовок", sortable: true, dataIndex: 'title'},
				{id: 'state', header: "Состояние", width: 160, sortable: true, dataIndex: 'state'}
			]);
			
	        var siteGrid = new Ext.grid.Grid('center7', {
	            ds: siteDS,
	            cm: siteColModel,
				selModel: new Ext.grid.RowSelectionModel({singleSelect:true}),
				enableColLock:false,
				trackMouseOver: false,
				loadMask: true,
	            autoExpandColumn: 'title'
	        });
						
			siteColModel.getColumnById('state').renderer = function(data) {
				var resText = 'Ожидание';
				if (data == 'approved') {
					resText = 'Одобрено';
				} else if (data == 'disapproved') {
					resText = 'Отклонено';
				} 
				return '<div style="text-align: center;"><img src="/admin/img/' + data + '.gif" alt="' + resText + '" /></div>';
			}
			
			siteGrid.render();
			siteGrid.getSelectionModel().selectFirstRow();

			siteGrid.on('rowdblclick', function () {
				var obj = this.getSelectionModel().getSelected();
				Ext.MessageBox.show({
					title: obj.json.title,
					buttons: {
						yes: 'Одобрить',
						no: 'Отклонить',
						ok: 'Отложить решение',
						cancel: 'Оставить как есть'
					},
					msg: 'Что сделать с записью о \'' + obj.json.title + '\'?',
					fn: function(btn) {
						if (btn != 'cancel') {
							var delConnection = new Ext.data.Connection({});
							delConnection.request({
								url: 'site.php',
								method: 'POST',
								params: {
									action: 'changestate',
									id: obj.json.id,
									state: btn
								},
								success: function () {
									siteDS.load();
								}
							});
						}
					}
				});
			});
			
			var siteGridFoot = siteGrid.getView().getFooterPanel(true);
			
			var sitePaging = new Ext.PagingToolbar(siteGridFoot, siteDS, {
				pageSize: 25,
				displayInfo: true,
				displayMsg: 'Отображаются записи {0} - {1} из {2}',
				emptyMsg: "Нет записей для отображения"
			});
			
			sitePaging.addButton({
				enableToggle: false,
				tooltip: 'Удалить',
				icon: '/admin/img/delete.gif',
				iconCls: 'buttonIcon',
				handler: function() {
					var obj = siteGrid.getSelectionModel().getSelected();
					if (!obj) {
						Ext.Msg.alert('Сайты','Ничего не выбрано');
						return;
					}
					Ext.MessageBox.show({
						title: obj.json.title,
						buttons: {
							yes: 'Да',
							no: 'Нет'
						},
						msg: 'Удалить сайты \'' + obj.json.title + '\'?',
						fn: function(btn) {
							if (btn == 'yes') {
								var delConnection = new Ext.data.Connection({});
								delConnection.request({
									url: 'site.php',
									method: 'POST',
									params: {
										action: 'delete',
										id: obj.json.id
									},
									success: function () {
										siteDS.load();
									}
								});
							}
						}
					});
					
				}
			});
*/	        
			// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
			// ^                       Инициализация вкладки сайты                          ^
			// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
	        
			// vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
			// v                        Общая инициализация системы                         v
			// vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
		
			layout = new Ext.BorderLayout(document.body, {
				center: {
					titlebar: true,
					autoScroll:true,
					closeOnTab: true
				}
			});

			layout.beginUpdate();
			newsPanel = new Ext.GridPanel(grid, {title: 'Новости | Пресса', closeable: false});
			layout.add('center', newsPanel);
			articlesPanel = new Ext.GridPanel(articlesGrid, {title: 'Страницы', closeable: false});
			layout.add('center', articlesPanel);
			/*
			catalogPanel = new Ext.GridPanel(catalogGrid, {title: 'Каталог', closeable: false});
			layout.add('center', catalogPanel);
			
			sitePanel = new Ext.GridPanel(siteGrid, {title: 'Гостевая', closeable: false});
			layout.add('center', sitePanel);
			
			tenderPanel = new Ext.GridPanel(tenderGrid, {title: 'Тендеры', closeable: false});
			layout.add('center', tenderPanel);

			libraryPanel = new Ext.GridPanel(libraryGrid, {title: 'Медиа', closeable: false});
			layout.add('center', libraryPanel);
			imagesPanel = new Ext.GridPanel(imagesGrid, {title: 'Файлы', closeable: false});
			layout.add('center', imagesPanel);

			newsPanel.on('activate', function () {
				ds.load();
			});
*/			/*
			catalogPanel.on('activate', function () {
				catalogDS.load();
			});
			*/
			articlesPanel.on('activate', function () {
				articlesDS.load();
			});
			/*
			tenderPanel.on('activate', function () {
				tenderDS.load();
			})
			;*/
			/*
			libraryPanel.on('activate', function () {
				libraryDS.load();
			});
			
			imagesPanel.on('activate', function () {
				imagesDS.load();
			});
			
			sitePanel.on('activate', function () {
				siteDS.load();
			});
*/
			layout.getRegion('center').showPanel('center1');
			layout.endUpdate();

			ds.load();
			
			// Конец загрузки
			var loading = Ext.get('loading');
			var mask = Ext.get('loading-mask');
			mask.setOpacity(.8);
			mask.shift({
				xy:loading.getXY(),
				width:loading.getWidth(),
				height:loading.getHeight(), 
				remove:true,
				duration:1,
				opacity:.3,
				easing:'bounceOut',
				callback : function(){
					loading.fadeOut({duration:.2,remove:true});
				}
			});
		}
	};
}();

Ext.EventManager.onDocumentReady(AdminWindow.init, AdminWindow, true);
