/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

path = '../../../plugin';

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	//工具列設定
	config.toolbar = 'TadToolbar';
    config.toolbar_TadToolbar =
    [
        ['Source','-','Templates','-','Cut','Copy','Paste'],
        ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
        ['Link','Unlink','Anchor'],
        ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
        '/',
        ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
        ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
        ['Format','FontSize','-','TextColor','BGColor']
    ];
	
	//開啟圖片上傳功能
	config.filebrowserBrowseUrl = path + '/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = path + '/ckfinder/ckfinder.html?Type=Images';
	config.filebrowserFlashBrowseUrl = path + '/ckfinder/ckfinder.html?Type=Flash';
	config.filebrowserUploadUrl = path + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = path + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = path + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};