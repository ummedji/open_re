
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
                customer_level: {
                                    required: true
                                },customer_type_name: {
                                    required: true
                                },customer_type_code: {
                                    required: true
                                }
            },
            messages: {
                customer_level: {
                                            
                                        },customer_type_name: {
                                            
                                        },customer_type_code: {
                                            
                                        }
            }
        });
    });