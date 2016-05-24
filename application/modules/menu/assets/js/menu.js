$(document).ready(function(e) {

    //delete image, photo, video...
    $(".del").click(function() {

        var type = $(this).attr("type");
        var rel = $(this).attr("rel");
        var cs = $("input[name=ci_csrf_token]").val();
        //alert(type);
        if (type != "" && rel != "" && cs != "") {
            if (confirm("Are you sure you want to delete this " + type)) {
                var url = urlPath;
                var data = new Object();
                data.id = rel;
                data.type = type;
                data.ci_csrf_token = cs;
                $.post(url, data, function(response) {
                    if (typeof response != "undefined") {
                        if (response.id != "") {
                            $("." + type + "[rel=" + response.id + "]").remove();
                        }
                    }
                    //alert(response);
                    //console.log(response);
                });
            }
        }
    });

    $(".link-assets").on("change", function() {
//        alert($(this).val());
        var val = $(this).val();
        var cs = $("input[name=ci_csrf_token]").val();
        if (val != "") {
            var url = linkTypeUrl;
            if (val == "other") {
                var textField = "<input type='text' name='link' placeholder='http://example.com/' value=''/>";
                $("#link-content").html(textField);
                $("#link-content-div").css("display", "block");
            } else {
                var data = new Object();
                data.link_type = val;
                data.ci_csrf_token = cs;
                $.post(url, data, function(response) {
//                console.log(response);
                    if (typeof response != "undefined") {
                        if (response.status == "success") {
                            $("#link-content").html(response.data);
                            $("#link-content-div").css("display", "block");
                        }
                    }
                });
            }
        }
    });

    $(".back").click(function(ev) {
//        alert("clicked!");
        ev.preventDefault();
        $("#backform").submit();
    });

});
