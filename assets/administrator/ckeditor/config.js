/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	//config.extraPlugins = 'image2';
  config.extraPlugins = 'uploadimage';
	// config.extraPlugins = 'simple-image-browser';
	// Add this line to configure for AJAX / JSON Reponse.
	// CKEDITOR.config.simpleImageBrowserURL = 'http://localhost:5050/manage-upload-list';
};
