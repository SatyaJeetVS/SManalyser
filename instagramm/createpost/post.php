<html>

<head></head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>
    /* div {
  width: 300px;
  border: 2px;
  padding: 50px;
  margin: 20px;
  background: #ECF0F1 ;
} */
    .center {
        margin: auto;
        width: 300px;
        background: #ECF0F1;
        padding: 20px;
    }
</style>

<body>
    <div class="center">
        <form method="post" action="posting_content.php">


            <div class="mb-3"></div><strong>Please enter image URL</strong><input type="text" id="image_url" name="image_url">

            <!-- <div class="mb-3">
                <div id="hashgen">
                    
                </div>
                <button class="btn btn-primary d-block w-100" id="sub" >Generate hashtag</button>
            </div> -->

            <!-- <div class="mb-3"></div><strong>Please enter video URL</strong><input type="text" id="video_url" name="video_url"> -->
            <div class="mb-3">
                <hr><input class="form-control" type="text" id="caption" name="caption" placeholder="Enter caption">
            </div>


            <div class="mb-3"><button class="btn btn-danger d-block w-100" type="submit">Create Post</button></div>

        </form>


        <div id="hashgen"></div>
        <div class="mb-3"><button class="btn btn-primary d-block w-100" id="sub">Generate hashtag</button></div>



        <input type="text" id="hash" placeholder="enter keyword">

        <div id="hashsuggest"></div>
        <button class="btn btn-primary d-block w-100" id="sug">Suggest hashtag</button>

    </div>

    <button type="button" class="btn btn-lg btn-danger" data-bs-toggle="popover" title="Popover title" data-bs-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
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
<script>
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})
</script>
</body>

</html>