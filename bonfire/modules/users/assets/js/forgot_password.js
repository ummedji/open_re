// When the browser is ready...
$(function() {
    // Setup form validation on the #register-form element
    $("#forget_pass").validate({

        // Specify the validation rules
        rules: {
            email:{
                required: true,
                email :true
            }
        },

        // Specify the validation error messages
        messages: {
            email:{

            }
        },

        submitHandler: function(form) {
            form.submit();
        }
    });

});