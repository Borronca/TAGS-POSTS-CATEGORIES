/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
	
	// configuração kcfinder sempre colocar o caminho absoluto começando com barra
	// ...
   		config.filebrowserBrowseUrl = '/bookmarkers/webroot/js/ckeditor/kcfind/browse.php?opener=ckeditor&type=files';
   		config.filebrowserImageBrowseUrl = '/bookmarkers/webroot/js/ckeditor/kcfind/browse.php?opener=ckeditor&type=images';
   		config.filebrowserFlashBrowseUrl = '/bookmarkers/webroot/js/ckeditor/kcfind/browse.php?opener=ckeditor&type=flash';
   		config.filebrowserUploadUrl = '/bookmarkers/webroot/js/ckeditor/kcfind/upload.php?opener=ckeditor&type=files';
   		config.filebrowserImageUploadUrl = '/bookmarkers/webroot/js/ckeditor/kcfind/upload.php?opener=ckeditor&type=images';
   		config.filebrowserFlashUploadUrl = '/bookmarkers/webroot/js/ckeditor/kcfind/upload.php?opener=ckeditor&type=flash';
	// ...

};
