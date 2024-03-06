/**
 * @license Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function(config) {
  config.filebrowserBrowseUrl = BASE_URL + 'backend/plugin/ckfinder/ckfinder.html';
  config.filebrowserImageBrowseUrl = BASE_URL + 'backend/plugin/ckfinder/ckfinder.html?type=Images';
  config.filebrowserFlashBrowseUrl = BASE_URL + 'backend/plugin/ckfinder/ckfinder.html?type=Flash';
  config.filebrowserUploadUrl = BASE_URL + 'backend/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
  config.filebrowserImageUploadUrl = BASE_URL + 'backend/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
  config.filebrowserFlashUploadUrl = BASE_URL + 'backend/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';


var toolbar = [
    // Các nút công cụ của thanh công cụ
    { name: 'document', items: ['Source', '-', 'NewPage', 'Preview', '-', 'Templates'] },
    { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
    { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll'] },
    { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak'] },
    { name: 'styles', items: ['Styles', 'Format'] },
    // ...
];
};


	// Define changes to default configuration here.
	// For complete reference see:
	// https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html

	// The toolbar groups arrangement, optimized for two toolbar rows.
	// config.toolbarGroups = [
	// 	{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
	// 	{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
	// 	{ name: 'links' },
	// 	{ name: 'insert' },
	// 	{ name: 'forms' },
	// 	{ name: 'tools' },
	// 	{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
	// 	{ name: 'others' },
	// 	'/',
	// 	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	// 	{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
	// 	{ name: 'styles' },
	// 	{ name: 'colors' },
	// 	{ name: 'about' }
	// ];

	// Remove some buttons provided by the standard plugins, which are
	// // not needed in the Standard(s) toolbar.
	// config.removeButtons = 'Underline,Subscript,Superscript';

	// // Set the most common block elements.
	// config.format_tags = 'p;h1;h2;h3;pre';

	// // Simplify the dialog windows.
	// config.removeDialogTabs = 'image:advanced;link:advanced';

