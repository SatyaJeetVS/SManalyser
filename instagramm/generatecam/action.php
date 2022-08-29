<html>
    <head></head>
    <body>
    <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
        </script>
    
    <script>
            $(document).ready(function() {
                $("#sub").click(function() {
                    var fn = $("#caption").val();
                    $.post("demo1.php", {
                        n3: fn
                    }, function(data) {
                        $("#hashgen").html(data);
                    });

                });
            });
        </script>
    
    <script>
            $(document).ready(function() {
                $("#sug").click(function() {
                    var fn = $("#hash").val();
                    $.post("hashsug.php", {
                        n3: fn
                    }, function(data) {
                        $("#hashsuggest").html(data);
                    });

                });
            });
        </script>
    </body>
</html>