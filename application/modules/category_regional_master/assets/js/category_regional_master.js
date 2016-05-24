
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
            rules: {
                category_name: {
                                    required: true
                                },category_code: {
                                    required: true
                                }
            },
            messages: {
                category_name: {
                                            
                                        },category_code: {
                                            
                                        }
            }
        });
    });