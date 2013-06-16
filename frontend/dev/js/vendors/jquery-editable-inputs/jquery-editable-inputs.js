(function($){
    var options,
        namespace = 'editableInputs',
        defaults = {
            'width': 'auto',
            'containerClass': 'editable-input-container',
            'focusedContainerClass': 'focused',
            'inputClass': 'editable-input',
            'rightMenuClass': 'edit-menu',
            'editButtonClass': 'edit-icon input-edit-icon',
            'beforeEdit': null,
            'afterEdit': null
        };

    var protectedMethods = {
        bindHandlers: function(){
            var $container = $('.' + options.containerClass);

            $container.on('blur' + '.' + namespace, '.' + options.inputClass, function(){
                var $this = $(this);

                $this.prop('disabled', true);
                $this.parent().removeClass(options.focusedContainerClass);

                if(options.afterEdit !== null && typeof options.afterEdit === 'function'){
                    options.afterEdit($this.val());
                }
            });

            $container.on('click' + '.' + namespace, '.' + options.rightMenuClass, function(){
                var $this = $(this),
                    $input = $this.siblings('.' + options.inputClass);

                if(options.beforeEdit !== null && typeof options.beforeEdit === 'function'){
                    options.beforeEdit($input.val());
                }

                $input.prop('disabled', false).focus();
                $this.parent().addClass(options.focusedContainerClass);
            });
        }
    };

    var methods = {
        init : function( params ) {
            options = $.extend(defaults, params);

            this.each(function(){
                var $this = $(this),
                    $element = $this.clone(true),
                    data = $this.data(namespace);

                if (!data) {
                    $element.data(namespace, {
                        editable : true
                    });

                    $element.attr('disabled', true)
                            .addClass(options.inputClass);

                    var $rightMenu = $('<div/>', {
                        'class': options.rightMenuClass
                    }).append($('<i/>', {
                        'class': options.editButtonClass
                    }));

                    $this.replaceWith(
                        $('<div/>', {
                            'class': options.containerClass,
                            'width': options.width
                        }).append($element)
                          .append($rightMenu)
                    );
                }
            });

            protectedMethods.bindHandlers();
            return this;
        },
        destroy : function( ) {
            return this.each(function(){
                var $this = $(this),
                    $clonedElement = $this.clone(true);

                $clonedElement.removeClass(options.inputClass)
                              .removeData(namespace)
                              .attr('disabled', false);
                $this.parents('.' + options.containerClass).replaceWith($clonedElement);
            })

        }
    };

    $.fn.editableInputs = function( method ) {
        if ( methods[method] ) {
            return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error('Method with name "' +  method + '" don\'t exists' );
        }
    };
})(window.jQuery);