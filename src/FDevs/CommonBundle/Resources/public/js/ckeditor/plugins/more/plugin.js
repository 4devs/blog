CKEDITOR.plugins.add('more',
    {
        init: function (editor) {
            var pluginName = 'more';
            editor.ui.addButton('More',
                {
                    label: 'More',
                    command: 'addMore',
                    icon: CKEDITOR.plugins.getPath('more') + 'more.png'
                });
            editor.addCommand('addMore', { exec: function (a) {
                var b = CKEDITOR.dom.element.createFromHtml('<div id="fdevscut" contenteditable="false" class="moreEdit"><span style="display:none">&nbsp;</span></div>', a.document);
                a.insertElement(b)
            } });
        },
        onLoad: function () {
            var a = ["{", "background: url(" + CKEDITOR.getUrl(this.path + "more_bug.gif") + ") no-repeat center right;", "clear: both;width:100%; _width:99.9%;border-top: #999999 1px dotted;border-bottom: #999999 1px dotted;padding:0;height: 5px;cursor: default;}"].join("").replace(/;/g, " !important;");
            CKEDITOR.addCss("div.moreEdit" + a)
        }
    });
