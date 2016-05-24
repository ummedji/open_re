
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
                applicable_name: {
                                    required: true
                                }
            },
            messages: {
                applicable_name: {
                                            
                                        }
            }
        });
    });