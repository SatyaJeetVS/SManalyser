<html>
    <head>

    </head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<body>
    <?php for($i=0;$i<2;$i++){?>
<div class="container">
  <div class="row">
    <div class="col">
      One of three columns
    </div>
    <div class="col">
      One of three columns
    </div>
  </div>
</div>  
<?php }?>

<!-- <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
        </script> -->
<!-- <input type="text" id="hash" placeholder="enter keyword"> -->
                  
        <!-- <div id="hashsuggest"></div>
        <button class="btn btn-primary d-block w-100" id="sug" >Suggest hashtag</button> -->
        <!-- <script>
            $(document).ready(function() {
                $("#sug").click(function() {
                    var fn = $("#hash").val();
                    $.post("test3.php", {
                        n3: fn
                    }, function(data) {
                        $("#hashsuggest").html(data);
                    });

                });
            });
        </script> -->
</body>  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> 
</html>    