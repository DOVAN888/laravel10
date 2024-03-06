/*
Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
For licensing, see license.txt or http://cksource.com/ckfinder/license
*/

CKFinder.customConfig = function( config )
{

	CKEDITOR.editorConfig = function( config ) {
	config.filebrowserBrowseUrl=BASE_URL+'backend/plugin/ckfinder/ckfinder.html',
	config.filebrowserImageBrowseUrl=BASE_URL+'backend/plugin/ckfinder/ckfinder.html?type=Images',
	config.filebrowserFlashBrowseUrl=BASE_URL+'backend/plugin/ckfinder/ckfinder.html?type=Flash',
	config.filebrowserUploadUrl=BASE_URL+'backend/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	config.filebrowserImageUploadUrl=BASE_URL+'backend/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	config.filebrowserFlashUploadUrl=BASE_URL+'backend/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

	// Define changes to default configuration here.
	// For the list of available options, check:
	// http://docs.cksource.com/ckfinder_2.x_api/symbols/CKFinder.config.html

	// Sample configuration options:
	// config.uiColor = '#BDE31E';
	// config.language = 'fr';
	// config.removePlugins = 'basket';

};
