$(document).ready(function(e) {

    //delete image, photo, video...
    $(".del").click(function() {

        var type = $(this).attr("type");
        var rel = $(this).attr("rel");
        var cs  = $("input[name=ci_csrf_token]").val();
        //alert(type);
        if (type != "" && rel != "" && cs != "") {
            if (confirm("Are you sure you want to delete this " + type)) {
                var url = urlPath;
                var data = new Object();
                data.id = rel;
                data.type = type;
                data.ci_csrf_token = $("input[name=ci_csrf_token]").val();
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
});
