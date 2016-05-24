
    $(document).ready(function() {
        /*
        jQuery.validator.addMethod('accept', function(value, element, param) {
          return value.match(new RegExp('.' + param + '$'));
        });
        */
        jQuery.validator.addMethod('accept', function(value, element, param) {
            return this.optional(element) || param.test(value);
        });
        $('form').validate({
            ignoreTitle: true,
            rules: {
                name: {
                                    required: true
                                },printable_name: {
                                    required: true
                                },numcode: {
                                    required: true,accept: /^[\-+]?[0-9]*\.?[0-9]+$/
                                }
            },
            messages: {
                name: {
                                            
                                        },printable_name: {
                                            
                                        },numcode: {
                                            accept: 'Please enter only numeric values'
                                        }
            }
        });
    });