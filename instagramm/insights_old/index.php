<?php

include '../defines.php';
// get instagram user metadata endpoint
$endpointFormat = ENDPOINT_BASE . '{ig-user-id}?fields=business_discovery.username({ig-username}){username,website,name,ig_id,id,profile_picture_url,biography,follows_count,followers_count,media_count,media{caption,like_count,comments_count,media_url,permalink,media_type}}&access_token={access-token}';
$endpoint = ENDPOINT_BASE . $instagramAccountId;

// username
$username = 'majorproject2022';


// endpoint params
$igParams = array(
    'fields' => 'business_discovery.username(' . $username . '){username,website,name,ig_id,id,profile_picture_url,biography,follows_count,followers_count,media_count,media{caption,like_count,comments_count,media_url,permalink,media_type}}',
    'access_token' => $accessToken
);

// add params to endpoint
$endpoint .= '?' . http_build_query($igParams);

// setup curl
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $endpoint);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// make call and get response
$response = curl_exec($ch);
curl_close($ch);
$responseArray = json_decode($response, true);
function makeApiCall($endpoint, $type, $params)
{
    $ch = curl_init();

    if ('POST' == $type) {
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_POST, 1);
    } elseif ('GET' == $type) {
        curl_setopt($ch, CURLOPT_URL, $endpoint . '?' . http_build_query($params));
    }

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

$userInsightsEndpoint = ENDPOINT_BASE . $instagramAccountId . '/insights';
$userInsightParams = array(
    'metric' => 'follower_count,impressions,profile_views,reach',
    'period' => 'day',
    'access_token' => $accessToken
);
$userInsights = makeApiCall($userInsightsEndpoint, 'GET', $userInsightParams);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Getting an Instagram Users Metadata</title>
    <meta charset="utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abel&amp;display=swap">
    <link rel="stylesheet" href="/assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="/assets/css/Blog---Recent-Posts-1.css">
    <link rel="stylesheet" href="/assets/css/Blog---Recent-Posts.css">
    <link rel="stylesheet" href="/https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="/assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="/assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="/assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
     
    <style>
        .box {
            width: 1350px;
            border: 2px;
            margin: 75px;
            padding: 2px;
            opacity: 3.0;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

        }
       
			body{
    margin-top:20px;
    background:#eee;
}
.db-social .jumbotron {
    margin: 0;
    background: url(https://bootdey.com/img/Content/flores-amarillas-wallpaper.jpeg);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    background-position: bottom center;
    color: #fff!important;
    height: 300px;
    position: relative;
    box-shadow: inset 0 0 20px rgba(0,0,0,.3);
    padding: 0;
}

.container-fluid {
    padding: 30px 30px;
}

.db-social .head-profile {
    margin-top: -120px;
    border-radius: 4px;
    position: relative;
}

.widget {
    background: #fff;
    border-radius: 0;
    border: none;
    margin-bottom: 30px;
}
.has-shadow {
    box-shadow: 0 1px 15px 1px rgba(52,40,104,.08);
}
.db-social .head-profile:before {
    content: "";
    background: rgba(255,255,255,.6);
    height: 20px;
    width: 90%;
    position: absolute;
    top: -20px;
    left: 0;
    right: 0;
    margin: 0 auto;
    border-radius: 4px 4px 0 0;
}
.db-social .head-profile:after {
    content: "";
    background: rgba(255,255,255,.3);
    height: 20px;
    width: 80%;
    position: absolute;
    top: -40px;
    left: 0;
    right: 0;
    margin: 0 auto;
    border-radius: 4px 4px 0 0;
}
.db-social .widget-body {
    padding: 1rem 1.4rem;
}
.widget-body {
    padding: 1.4rem;
}
.pb-0, .py-0 {
    padding-bottom: 0!important;
}
.db-social .image-default img {
    width: 120px;
    position: absolute;
    top: -80px;
    left: 0;
    right: 0;
    margin: 0 auto;
    box-shadow: 0 0 0 6px rgba(255,255,255,1);
    z-index: 10;
}
.db-social .infos {
    text-align: center;
    margin-top: 4rem;
    margin-bottom: 1rem;
    line-height: 1.8rem;
}
.db-social h2 {
    color: #2c304d;
    font-size: 1.6rem;
    font-weight: 600;
    margin-bottom: .2rem;
}
.db-social .location {
    color: #aea9c3;
    font-size: 1rem;
}
.db-social .follow .btn {
    padding: 10px 30px;
}
.btn:not(:disabled):not(.disabled) {
    cursor: pointer;
}
.btn-shadow, .btn-shadow a {
    color: #5d5386;
    background-color: #fff;
    border-color: #fff;
    box-shadow: 0 1px 15px 1px rgba(52,40,104,.15);
}
.db-social .head-profile .actions {
    display: inline-block;
    vertical-align: middle;
    margin-left: .5rem;
}
.actions {
    z-index: 999;
    display: block;
}
.actions.dark .dropdown-toggle {
    color: #2c304d;
}
.actions .dropdown-toggle {
    color: #98a8b4;
    background: none;
    border: none;
    padding: 0;
    font-size: 1.7rem;
}
.actions .dropdown-menu {
    border: none;
    min-width: auto;
    font-size: 1rem;
    border-radius: 4px;
    padding: 1.4rem 1.8rem;
    text-align: left;
    box-shadow: 1px 1px 30px rgba(0,0,0,.15);
}

.actions .dropdown-menu .dropdown-item {
    padding: .5rem 0;
}
.actions .dropdown-menu a {
    color: #2c304d;
    font-weight: 500;
}

.db-social .head-profile li:first-child {
    padding-left: 0;
}
.db-social .head-profile li {
    display: inline-block;
    text-align: center;
    padding: 0 1rem;
}
.db-social .head-profile li .counter {
    color: #2c304d;
    font-size: 1.4rem;
    font-weight: 600;
}
.db-social .head-profile li .heading {
    color: #aea9c3;
    font-size: 1rem;
}
    </style>
<link rel="stylesheet" href="assets1/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets1/css/styles.css">
</head>

<body>
    <!-- <nav class="navbar navbar-light navbar-expand-lg bg-info navigation-clean">
        <div class="container-fluid"><a class="navbar-brand" href="#"><br><strong>Social Media&nbsp;</strong>Analysis</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link " href="/">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="createpost/">Schedule Post</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Generate Campaign</a></li>
                    <li class="nav-item"><a class="nav-link active" href="insights">Instagram Insights</a></li>
                </ul>
            </div>
        </div>
    </nav> -->
    <div class="container db-social">
    <div class="jumbotron jumbotron-fluid"></div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-11">
                <div class="widget head-profile has-shadow">
                    <div class="widget-body pb-0">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-4 col-md-4 d-flex justify-content-lg-start justify-content-md-start justify-content-center">
                                <ul>
                                    <li>
                                        <div class="counter"><b><?php echo  $responseArray['business_discovery']['media_count']; ?></b></div>
                                        <div class="heading">Posts</div>
                                    </li>
                                    <li>
                                        <div class="counter"><b><?php echo  $responseArray['business_discovery']['follows_count']; ?></b></div>
                                        <div class="heading">Following</div>
                                    </li>
                                    <li>
                                        <div class="counter"><b><?php echo  $responseArray['business_discovery']['followers_count']; ?></b></div>
                                        <div class="heading">Followers</div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xl-4 col-md-4 d-flex justify-content-center">
                                <div class="image-default">
                                    <img class="rounded-circle" src="<?php echo $responseArray['business_discovery']['profile_picture_url']; ?>" alt="...">
                                </div>
                                <div class="infos">
								<a target="_blank" href="https://www.instagram.com/<?php echo $responseArray['business_discovery']['username']; ?>">
                                    <h2><?php echo  $responseArray['business_discovery']['username']; ?></h2>
								</a>

                                </div>
                            </div>
                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


      
    <div class="container text-center">
        <div class="row">
            <?php foreach ($userInsights['data'] as $insight) : ?>
                <div class="col">

                    <b> <?php echo $insight['title'];  ?> </b>
                    <?php foreach ($insight['values'] as $value) :  ?>
                        <div class="row">
                            <h1 class="text-warning"> <?php echo $value['value']; ?></h1>

                        </div>

                    <?php endforeach; ?>


                </div>
            <?php endforeach; ?>
        </div>
    </div>




    <!-- <textarea style="width:100%;height:300px;"> -->
<h1 style="text-align: center;">Posts</h1>
    <div class="container">

        <div class="row">
        <div class="card" style="margin-right: 10px;margin-left: 10px;margin-top: 15px;">
            <?php
            for ($i = 0; $i < 10; $i++) {
              
                //print_r( $responseArray['business_discovery']['media']['data'][$i] );
                //print_r( $responseArray);
                if ($responseArray["business_discovery"]["media"]["data"][$i]["media_type"] == 'VIDEO') {
                   
                    echo ' <div class="col">  <div class="card-body">
                        <div style="width:100%;display:inline-block">
                    			<div style="float:left">
                    				<video style="height: 300px;"width="500px" controls="">
                    					<source src="' . $responseArray["business_discovery"]["media"]["data"][$i]["media_url"] . '">
                    				</video>
                    			</div> 
                                </div>
</div>
                    		
<p class="card-text">  ' . $responseArray["business_discovery"]["media"]["data"][$i]["caption"] . '</p><br>  <p class="card-text">Likes = ' . $responseArray["business_discovery"]["media"]["data"][$i]["like_count"] . '
                      
                 </p>  ';

                    echo '
                    <html>
                        <head>
                            <title></title>
                        </head>
                    <body>
                         <form method="post"> 
                            <input type="hidden" id="id" value="' . $responseArray['business_discovery']['media']['data'][$i]['id'] . '" name="id">
                            <input type="hidden" id="caption" value="' . $responseArray['business_discovery']['media']['data'][$i]['caption'] . '" name="caption">
                            <input type="hidden" id="media_url" value="' . $responseArray['business_discovery']['media']['data'][$i]['media_url'] . '" name="media_url">
                            <input type="hidden" id="permalink" value="' . $responseArray['business_discovery']['media']['data'][$i]['permalink'] . '" name="permalink">
                            <input type="hidden" id="media_type" value="' . $responseArray['business_discovery']['media']['data'][$i]['media_type'] . '" name="media_type">
                    
                    
                            <button class="btn btn-primary" id="sug" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal">View Insights</button>
                     </form> 
                     <hr>
                    
                    </body>    
                    </html>
                    ';






                    //                     print_r('



                    //     <div class="col">
                    //     <div style="width:100%;display:inline-block">
                    // 			<div style="float:left">
                    // 				<video height="390" width="310" controls="">
                    // 					<source src="' . $responseArray["business_discovery"]["media"]["data"][$i]["media_url"] . '">
                    // 				</video>
                    // 			</div> 
                    // 		</div>
                    //   ' . $responseArray["business_discovery"]["media"]["data"][$i]["caption"] .'<br> Likes = '. $responseArray["business_discovery"]["media"]["data"][$i]["like_count"] . '
                    //   <br>
                    // <form action="insights.php" method="post">
                    //     <input type="hidden" value="' . $responseArray['business_discovery']['media']['data'][$i]['id'] . '" name="id">
                    //     <input type="hidden" value="' . $responseArray['business_discovery']['media']['data'][$i]['caption'] . '" name="caption">
                    //     <input type="hidden" value="' . $responseArray['business_discovery']['media']['data'][$i]['media_url'] . '" name="media_url">
                    //     <input type="hidden" value="' . $responseArray['business_discovery']['media']['data'][$i]['permalink'] . '" name="permalink">
                    //     <input type="hidden" value="' . $responseArray['business_discovery']['media']['data'][$i]['media_type'] . '" name="media_type">


                    //     <button type="submit">show insights</button>
                    //     </div>




                    // ');


                    // echo '---------------------------------------------------------------------------------------------------------';
                    //     echo '
                    // <form action="insights.php" method="post">
                    //     <input type="hidden" value="'.$responseArray['business_discovery']['media']['data'][$i]['id'].'" name="id">
                    //     <input type="hidden" value="'.$responseArray['business_discovery']['media']['data'][$i]['caption'].'" name="caption">
                    //     <input type="hidden" value="'.$responseArray['business_discovery']['media']['data'][$i]['media_url'].'" name="media_url">
                    //     <input type="hidden" value="'.$responseArray['business_discovery']['media']['data'][$i]['permalink'].'" name="permalink">
                    //     <input type="hidden" value="'.$responseArray['business_discovery']['media']['data'][$i]['media_type'].'" name="media_type">


                    //     <button type="submit">submit</button>
                    // </form>

                    // '; 

                    echo "\n\n";
                }
            } ?>
</div>
        </div>
        <div style="
  position: absolute;
  left: 800px;
  top: 650px;">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insights</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php

if (isset($_POST['id']) && isset($_POST['caption']) && isset($_POST['media_url']) && isset($_POST['permalink']) && isset($_POST['media_type'])) {
    include 'insights.php';
}
?>
        </div>
    </div>
    </div>
    <div id="hashsuggest"></div>

   
    <!-- </textarea> -->






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/js/bs-init.js"></script>
    <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
        </script>
    <script>
            $(document).ready(function() {
                $("#sug").click(function() {
                    var fn1 = $("#id").val();
                    var fn2 = $("#caption").val();
                    var fn3 = $("#media_url").val();
                    var fn4 = $("#permalink").val();
                    var fn5 = $("#media_type").val();
                    $.post("insights.php", {
                        id: fn1,
                        caption : fn2,
                        media_url : fn3,
                        permalink : fn4,
                        media_type : fn5

                    }, function(data) {
                        $("#hashsuggest").html(data);
                    });

                });
            });

            </script>  
            </div>


            </div>
      
    </div>
  </div>
</div>


        

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>

<?php





