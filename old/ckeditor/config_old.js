/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

config.ImageBrowser = false;
config.ImageBrowserURL = '/filemanager/index.html';
config.filebrowserBrowseUrl = 'http://automixs.com/ckeditor/filemanager/index.html';
 	config.filebrowserImageBrowseUrl = 'http://automixs.com/filemanager/index.html?type=Images&currentFolder=/Images/';
 	//config.filebrowserFlashBrowseUrl = 'http://automixs.com/filemanager/index.html?type=Flash&currentFolder=/Flash/';
 	//config.filebrowserUploadUrl = 'http://automixs.com/filemanager/connectors/php/filemanager.php?mode=add&type=Files&currentFolder=/File/';
 	config.filebrowserImageUploadUrl = 'http://automixs.com/filemanager/connectors/php/filemanager.php?mode=add&type=Images&currentFolder=/Images/';
 	//config.filebrowserFlashUploadUrl = 'http://automixs.com/filemanager/connectors/php/filemanager.php?mode=add&type=Flash&currentFolder=/Flash/';
	

};
CKEDITOR.replace('instancename', {
	filebrowserBrowseUrl: 'http://automixs.com/filemanager/index.html'
	
});