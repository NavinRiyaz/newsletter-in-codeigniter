/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/
 CKEDITOR.env.isCompatible = true;
CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	// Add WIRIS to the plugin list
	config.extraPlugins += (config.extraPlugins.length == 0 ? '' : ',') + 'ckeditor_wiris';
	// Add WIRIS buttons to the "Full toolbar"
	// Optionally, you can remove the following line and follow http://docs.cksource.com/CKEditor_3.x/Developers_Guide/Toolbar
	config.toolbar_Full.push({name:'wiris', items:['ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS']});
	
	//config.extraPlugins = 'mediaembed';
	config.filebrowserBrowseUrl = 'http://localhost:8088/hemant/newsletter_email/assets/grocery_crud/texteditor/kcfinder/browse.php?opener=ckeditor&type=files';
   config.filebrowserImageBrowseUrl = 'http://localhost:8088/hemant/newsletter_email/assets/grocery_crud/texteditor/kcfinder/browse.php?opener=ckeditor&type=images';
   config.filebrowserFlashBrowseUrl = 'http://localhost:8088/hemant/newsletter_email/assets/grocery_crud/texteditor/kcfinder/browse.php?opener=ckeditor&type=flash';
   config.filebrowserUploadUrl = 'http://localhost:8088/hemant/newsletter_email/assets/grocery_crud/texteditor/kcfinder/upload.php?opener=ckeditor&type=files';
   config.filebrowserImageUploadUrl = 'http://localhost:8088/hemant/newsletter_email/assets/grocery_crud/texteditor/kcfinder/upload.php?opener=ckeditor&type=images';
   config.filebrowserFlashUploadUrl = 'http://localhost:8088/hemant/newsletter_email/assets/grocery_crud/texteditor/kcfinder/upload.php?opener=ckeditor&type=flash';
};
