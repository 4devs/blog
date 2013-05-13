 /**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here.
    // For the complete reference:
    // http://docs.ckeditor.com/#!/api/CKEDITOR.config

    // The toolbar groups arrangement, optimized for two toolbar rows.
    config.toolbarGroups = [
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
        { name: 'links' },
        { name: 'insert' },
        { name: 'forms' },
        { name: 'tools' },
        { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
        { name: 'others' },
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ] },
        { name: 'styles' },
        { name: 'colors' },
        { name: 'document', groups: [ 'mode'] }, // shows the source button
        { name: 'pbckcode' } ,                   // shows the pbckcode button
    ];

    // Remove some buttons, provided by the standard plugins, which we don't
    // need to have in the Standard(s) toolbar.
//    config.removeButtons = 'Underline,Subscript,Superscript';
    config.filebrowserImageBrowseUrl = '/admin/elfinder';
    config.language = 'ru';
    config.defaultLanguage = 'en';

    config.extraPlugins = 'pbckcode,onchange';
    config.pbckcode = {
        modes :  [ ['PHP', 'php'], ['HTML', 'html'], ['CSS', 'css'] ],
        theme : 'chrome',
        highlighter : "SYNTAX_HIGHLIGHTER"
    };
//    config.filebrowserUploadUrl = '/efconnect';
//    config.filebrowserBrowseUrl = '/ckfinder/ckfinder.html';
//    config.filebrowserFlashBrowseUrl = '/ckfinder/ckfinder.html?type=Flash';
//    config.filebrowserImageUploadUrl = '/elfinder';
//    config.filebrowserFlashUploadUrl = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
//    config.filebrowserWindowWidth = '1000';
//    config.filebrowserWindowHeight = '700';
};
