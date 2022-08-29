<?php
	include 'defines.php';   
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
	$endpoint .= '?' . http_build_query( $igParams );

	// setup curl
	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $endpoint );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

	// make call and get response
	$response = curl_exec( $ch );
	curl_close( $ch );
	$responseArray = json_decode( $response, true );
    $userInsightsEndpoint = ENDPOINT_BASE . $instagramAccountId . '/insights';
$userInsightParams = array(
    'metric' => 'follower_count,impressions,profile_views,reach',
    'period' => 'day',
    'access_token' => $accessToken
);
$userInsights = makeApiCall($userInsightsEndpoint, 'GET', $userInsightParams);

$mediaInsightsEndpoingFormat = ENDPOINT_BASE . '{ig-media-id}/insights?metric=engagement,impressions,reach,saved,video_views&access_token={access-token}';
	$userInsightsEndpoingFormat = ENDPOINT_BASE . '{ig-user-id}/insights?metric=follower_count,impressions,profile_views,reach&period=day&access_token={access-token}';
	// get media insights
	//$mediaInsightsEndpoint = ENDPOINT_BASE . $mediaObject['id'] . '/insights';
	$mediaInsightParams = array(
		'metric' => 'engagement,impressions,reach,saved,video_views',
		'access_token' => $accessToken
	);
	//$mediaInsights = makeApiCall( $mediaInsightsEndpoint, 'GET', $mediaInsightParams );

	// get user insights
	$userInsightsEndpoint = ENDPOINT_BASE . $instagramAccountId . '/insights';
	$userInsightParams = array(
		'metric' => 'follower_count,impressions,profile_views,reach',
		'period' => 'day',
		'access_token' => $accessToken
	);
	$userInsights = makeApiCall( $userInsightsEndpoint, 'GET', $userInsightParams );

	// get instagram user metadata endpoint
	$userInfoEndpointFormat = ENDPOINT_BASE . '{ig-user-id}?fields=business_discovery.username({ig-username}){username,website,name,ig_id,id,profile_picture_url,biography,follows_count,followers_count,media_count,media{caption,like_count,comments_count,media_url,permalink,media_type}}&access_token={access-token}';
	$userInfoEndpoint = ENDPOINT_BASE . $instagramAccountId;
	$username = 'majorproject2022';
	// endpoint params
	$userInfoParams = array(
		'fields' => 'business_discovery.username(' . $username . '){username,website,name,ig_id,id,profile_picture_url,biography,follows_count,followers_count,media_count,media{caption,like_count,comments_count,media_url,permalink,media_type}}',
		'access_token' => $accessToken
	);
	$userInfo = makeApiCall( $userInfoEndpoint, 'GET', $userInfoParams );

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>social media content analyser</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abel&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Blog---Recent-Posts-1.css">
    <link rel="stylesheet" href="assets/css/Blog---Recent-Posts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
    </nav>  -->

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>

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


    

 <!-- <div class="col" style="width: 40%;height: 300px;margin-left: 5%;"> -->
<br><br><pre>
      



</pre>
 <div class="row">
              <div class="col-md-3" id="swoosh">

              <div class="container" style="width: 650px;height: 800px;margin-left: 430px;margin-right: 0;margin-top:-200px">


    <?php 
   $len = count($responseArray['business_discovery']['media']['data']);
		
		//print_r( $responseArray['business_discovery']['media']['data'][0] );
		//print_r( $responseArray);

        echo ' <div class="col">
        <div style="width:100%;display:inline-block">
                <div style="float:left">';
                    
                    if ($responseArray['business_discovery']['media']['data'][0]['media_type']== 'VIDEO'){
                    echo '
                        <video height="390" width="310" controls="">
                        <source src="' . $responseArray["business_discovery"]["media"]["data"][0]["media_url"] . '">
                        </video>
                        ';
                    }
                    else{
                        echo '<img width="650px" src="'.$responseArray['business_discovery']['media']['data'][0]['media_url'].'">';
                    }
                    echo'
                        
                </div> 
                </div>

            
      ' . $responseArray["business_discovery"]["media"]["data"][0]["caption"] . '<br> Likes = ' . $responseArray["business_discovery"]["media"]["data"][0]["like_count"] . '
      
   ';

    echo '
    <html>
        <head>
            <title></title>
        </head>
    <body>
        <form action="comments_and_replies.php" method="post">
            <input type="hidden" value="' . $responseArray['business_discovery']['media']['data'][0]['id'] . '" name="id">
            <input type="hidden" value="' . $responseArray['business_discovery']['media']['data'][0]['caption'] . '" name="caption">
            <input type="hidden" value="' . $responseArray['business_discovery']['media']['data'][0]['media_url'] . '" name="media_url">
            <input type="hidden" value="' . $responseArray['business_discovery']['media']['data'][0]['permalink'] . '" name="permalink">
            <input type="hidden" value="' . $responseArray['business_discovery']['media']['data'][0]['media_type'] . '" name="media_type">
    
    
        

  <!-- Button trigger modal -->
  <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    View More
  </button>

            </form>


    

    
    
    </body>    
    </html>
    ';
		
	echo "\n\n";	
   
//     if (isset($_POST['id']) && isset($_POST['caption']) && isset($_POST['media_url']) && isset($_POST['permalink']) && isset($_POST['media_type'])) {
// include 'comments_and_replies.php';
// }

	
        
        ?>





<script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="assets/js/bs-init.js"></script>

    </div>

   <a href="business_discovery.php"> <button class="btn btn-primary" target="business_discovery.php">More posts</button></a>
<pre>









</pre>

<?php
include 'db.php';
$id=17841450822510905;
$sql = "SELECT user_id, followers,date,impressions,reach FROM data where user_id= $id and year(date)= 2022";
$result = $conn->query($sql);


$str="";
$str2="";
$str3="";
//print_r($result->fetch_assoc());
if ($result->num_rows > 0) {
  // output data of each row
  
  while($row = $result->fetch_assoc()) {
   // echo "id: " . $row["user_id"]. " - followers: " . $row["followers"]." Date:".$row['date']."<br>";
    //array_push($followers, $row['followers']);
    $str = $str.$row['followers'].",";
    $str2 = $str2.$row['impressions'].",";
    $str3 = $str3.$row['reach'].",";
  }
} else {
  // echo "0 results";
}
// $conn->close();
//print_r($followers);
// for($i=0;$i< count($followers);$i++){
//   //echo $followers[$i];
//   $str = $str.$followers[$i].",";
// }
$finalstring = "[".$str."]";
$finalstring2 = "[".$str2."]";
$finalstring3 = "[".$str3."]";

?> 

</div>
    </div>

<script src="assets/bootstrap/js/bootstrap.min.js"></script>

<div class="col-4" style="height: 250px; margin-top: 380px; margin-left: -200px">
<?php 

echo'
<!DOCTYPE html>
<head>
    <title>

    </title>
    <script src="https://cdn.plot.ly/plotly-2.6.3.min.js"></script>
</head>
<body>
<div id="myDiv2" style="width:400px;height:600px;"><!-- Plotly chart will be drawn inside this DIV --></div>
    <script>
    
      var trace1 = {
  x: ["Jan", "Feb", "Mar", "Apr","May"],
  y: '.$finalstring.',
  type: "bar",
  name: "Primary Product",
  marker: {
    color: "#3498DB",
    opacity: 1,
  }
};


var data = [trace1];

var layout = {
  title: "2021 followers",
  xaxis: {
    tickangle: -45
  },
  barmode: "group"
};

Plotly.newPlot("myDiv2", data, layout);
       
    </script>
  
    
</body>
<html>
';

?> 

</div>
    <div class="col-4" style="height: 250px;margin-left: 615px;margin-top: -250px;">

<?php 
echo'
<!DOCTYPE html>
<head>
    <title>

    </title>
    <script src="https://cdn.plot.ly/plotly-2.6.3.min.js"></script>
</head>
<body>
<div id="myDiv3" style="width:400px;height:600px;"><!-- Plotly chart will be drawn inside this DIV --></div>
    <script>
    
      var trace1 = {
  x: ["Jan", "Feb", "Mar", "Apr","May"],
  y: '.$finalstring2.',
  type: "bar",
  name: "Primary Product",
  marker: {
    color: "#3498DB",
    opacity: 1,
  }
};


var data = [trace1];

var layout = {
  title: "2021 impressions",
  xaxis: {
    tickangle: -45
  },
  barmode: "group"
};

Plotly.newPlot("myDiv3", data, layout);
       
    </script>
  
    
</body>
<html>
';
?>


</div>
    <div class="col-4" style="height: 250px;margin-left: 1050px;margin-top: -250px;">
  
  <?php  echo'
<!DOCTYPE html>
<head>
    <title>

    </title>
    <script src="https://cdn.plot.ly/plotly-2.6.3.min.js"></script>
</head>
<body>
<div id="myDiv" style="width:400px;height:600px;"><!-- Plotly chart will be drawn inside this DIV --></div>
    <script>
    
      var trace1 = {
  x: ["Jan", "Feb", "Mar", "Apr","May"],
  y: '.$finalstring3.',
  type: "bar",
  name: "Primary Product",
  marker: {
    color: "#3498DB",
    opacity: 1,
  }
};


var data = [trace1];

var layout = {
  title: "2021 reach",
  xaxis: {
    tickangle: -45
  },
  barmode: "group"
};

Plotly.newPlot("myDiv", data, layout);
       
    </script>
  
    
</body>
<html>
'; ?>

</div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>


</body>

</html>