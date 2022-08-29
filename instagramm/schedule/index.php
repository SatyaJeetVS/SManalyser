<?php 


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>social media content analyser</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abel&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="../assets/css/Blog---Recent-Posts-1.css">
    <link rel="stylesheet" href="../assets/css/Blog---Recent-Posts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="../assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="../assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="../assets/css/Registration-Form-with-Photo.css">
   
    <link rel="stylesheet" href="../assets/css/styles.css">
   <style>
    .center {
        margin: auto;
        width: 300px;
        background: #ECF0F1;
        padding: 20px;
        margin-top: 100px;
    }
    .box{
        position: relative;
        left: 1000px;
        top: 1px;
        width: 500px;
        background: #ECF0F1;
        padding: 20px;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg bg-info navigation-clean">
        <div class="container-fluid"><a class="navbar-brand" href="#">Social Media Analysis</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Schedule Post</a></li>
                    <li class="nav-item"><a class="nav-link" href="../">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="../generatecam">Generate Campaign</a></li>
                    <li class="nav-item"><a class="nav-link" href="../insights_old">Instagram Insights</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="center">
        <!-- <input type="checkbox" id="image" name="image" value="yes">
        <label for="image"> Post Image </label><br>
        <input type="checkbox" id="video" name="video" value="yes">
  <label for="video"> Post Video </label><br> -->
        <form method="post" action="posting_content.php">
            <h2 class="visually-hidden">Login Form</h2>
            <div class="illustration"></div>
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
            <div class="mb-3">
                Select Time: <input type="time" name="time">
            </div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100"  type="submit">Schedule Post</button></div>
        </form>
        <div id="hashgen"></div>
        <button class="btn btn-primary d-block w-100" id="sub" >Generate hashtag</button>
        
                <input type="text" id="hash" placeholder="enter keyword">
                  
        <div id="hashsuggest"></div>
        <button class="btn btn-primary d-block w-100" id="sug" >Suggest hashtag</button>
    
    </section>
    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="./assets/js/bs-init.js"></script>
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
<!-- <i class="icon ion-ios-compose-outline"></i> -->
