/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here.
    // For the complete reference:
    // http://docs.ckeditor.com/#!/api/CKEDITOR.config
    config.extraPlugins = 'more';
    // The toolbar groups arrangement, optimized for two toolbar rows.
    config.toolbar_Full = [
        { name: 'document', items: [ 'More', 'Source', '-', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates' ] },
        { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
        { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt' ] },
        { name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
        { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
        '/',
        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
        { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },
        { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
        { name: 'tools', items: [ 'Maximize', 'ShowBlocks', '-', 'About' ] }
    ];

    // Remove some buttons, provided by the standard plugins, which we don't
    // need to have in the Standard(s) toolbar.
//    config.removeButtons = 'Underline,Subscript,Superscript';
    config.filebrowserImageBrowseUrl = '/admin/elfinder';
    config.language = 'ru';
    config.defaultLanguage = 'en';
    config.toolbar = 'Full';
//    config.filebrowserUploadUrl = '/efconnect';
//    config.filebrowserBrowseUrl = '/ckfinder/ckfinder.html';
//    config.filebrowserFlashBrowseUrl = '/ckfinder/ckfinder.html?type=Flash';
//    config.filebrowserImageUploadUrl = '/elfinder';
//    config.filebrowserFlashUploadUrl = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
//    config.filebrowserWindowWidth = '1000';
//    config.filebrowserWindowHeight = '700';
};
