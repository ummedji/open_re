// When the browser is ready...
$(function() {
    // Setup form validation on the #register-form element
    $("#lg_form").validate({

        // Specify the validation rules
        rules: {
            login:{
                required: true,
                email :true
            },

            password: {

            }
        },

        // Specify the validation error messages
        messages: {
            login:{

            },
            password: {

            }
        },

        submitHandler: function(form) {
            form.submit();
        }
    });

});