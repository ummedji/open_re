$(document).ready(function() {

    $(".admin-box").delegate(".activate-user", "click", function(e) {
        //var checkedBoxes = $("input:checkbox[name=checked[]]:checked").length;
        var checkedBoxes = $('input[name="checked[]"]:checked').length;
        if (checkedBoxes > 0) {
            $("#action").attr("value", "activateUser");
            submitForm();
        } else {
            alert("No Records Selected.Please Select Record First.")
        }
    });

    $(".admin-box").delegate(".deactivate-user", "click", function(e) {
        //var checkedBoxes = $("input:checkbox[name=checked[]]:checked").length;
        var checkedBoxes = $('input[name="checked[]"]:checked').length;
        if (checkedBoxes > 0) {
            $("#action").attr("value", "deactivateUser");
            submitForm();
        } else {
            alert("No Records Selected.Please Select Record First.");
        }
    });

    $(".admin-box").delegate(".ban-user", "click", function(e) {
        //var checkedBoxes = $("input:checkbox[name=checked[]]:checked").length;
        var checkedBoxes = $('input[name="checked[]"]:checked').length;
        if (checkedBoxes > 0) {
            $("#action").attr("value", "banUser");
            submitForm();
        } else {
            alert("No Records Selected.Please Select Record First.");
        }
    });

    $(".admin-box").delegate(".restore", "click", function(e) {
        $("#action").attr("value", "restoreUser");
        var data = $("#admin_listing_form").serializeArray();
        data.push({name: "delete_id", value: $(this).attr("rel")});
        var url = $("#admin_listing_form").attr("action");
        ajax(url, data, setResponse);
    });

    $(".admin-box").delegate(".purge", "click", function(e) {
        if (confirm("This row will be deleted permanantly, and removed from the database, are you sure?")) {
            $("#action").attr("value", "purgeUser");
            var data = $("#admin_listing_form").serializeArray();
            data.push({name: "delete_id", value: $(this).attr("rel")});
            var url = $("#admin_listing_form").attr("action");
            ajax(url, data, setResponse);
        }
    });

    $('#user_management_last_login').datetimepicker({dateFormat: 'yy-mm-dd', timeFormat: 'hh:mm:ss'});
    $('#user_management_display_name_changed').datepicker({dateFormat: 'yy-mm-dd'});
});
