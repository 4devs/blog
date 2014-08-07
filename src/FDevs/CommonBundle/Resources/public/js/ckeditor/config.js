/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here.
    // For the complete reference:
    // http://docs.ckeditor.com/#!/api/CKEDITOR.config

    // The toolbar groups arrangement, optimized for two toolbar rows.
    config.toolbar_Full = [
//        { name: 'others', items: [  ] },
        { name: 'document', items: [ 'Source', '-', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates' ] },
        { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
        { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt' ] },
        { name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
        { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
        '/',
        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
        { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },
        { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
        { name: 'tools', items: [ 'pbckcode', 'More', 'Maximize', 'ShowBlocks', '-', 'About' ] },
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] }
    ];

    // Remove some buttons, provided by the standard plugins, which we don't
    // need to have in the Standard(s) toolbar.
//    config.removeButtons = 'Underline,Subscript,Superscript';
    config.filebrowserImageBrowseUrl = '/elfinder';
    config.language = 'ru';
    config.defaultLanguage = 'en';
    config.toolbar = 'Full';
    config.format_pre = { element: 'pre', attributes: { 'class': 'prettyprint linenums','data-language':'' } };
    config.extraPlugins = 'pbckcode,onchange,more';
    config.pbckcode = {
        modes :  [
            ['PHP', 'php'],
            ['HTML', 'html'],
            ['CSS', 'css'],
            ['JS', 'javascript'],
            ['YAML', 'yaml'],
            ['XML', 'xml'],
            ['SQL', 'sql'],
            ['SH', 'sh'],
            ['JSON', 'json'],
            ['Java', 'java']
        ],
        theme : 'chrome',
        highlighter : "SYNTAX_HIGHLIGHTER"
    };
};
