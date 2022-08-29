<?php
	include 'defines.php';

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
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Getting an Instagram Users Metadata</title>
		<meta charset="utf-8" />
	</head>
	<body style="background: url(&quot;assets/img/socialmedia.jpg&quot;);">
	
	<div class="card" style="width:900px;margin-right: 10px;margin-left: 15%;margin-top: 15px;">	
		<?php 
		for($i=0;$i<10;$i++){
		//print_r( $responseArray['business_discovery']['media']['data'][$i]['media_url'] );
		//echo '<img width = "25%" src="'.$responseArray['business_discovery']['media']['data'][$i]['media_url'].'">';
		
		if ($responseArray["business_discovery"]["media"]["data"][$i]["media_type"] == 'VIDEO') {
		echo ' <div class="col">
                        <div style="width:100%;display:inline-block">
                    			<div style="margin-right: 10px;margin-left: 10px;margin-top: 15px;">
                    				<video height="390" width="500" controls="" style="height: 300px;">
                    					<source src="' . $responseArray["business_discovery"]["media"]["data"][$i]["media_url"] . '">
                    				</video>
                    			</div> 
                                </div>

								<div class="card-body"><p class="card-text">
                      ' . $responseArray["business_discovery"]["media"]["data"][$i]["caption"] . '</p><br> Likes = ' . $responseArray["business_discovery"]["media"]["data"][$i]["like_count"] . '</div>
					  </div>
                      
                   ';
		
		}else{
			echo '<div class="card" style="margin-right: 10px;margin-left: 10px;margin-top: 15px;"><img class="card-img-top" style="height: 300px;width :500px"; src="'.$responseArray['business_discovery']['media']['data'][$i]['media_url'].'"><div class="card-body">
            <p class="card-text">'.$responseArray["business_discovery"]["media"]["data"][$i]["caption"] . '</p><br> Likes = ' . $responseArray["business_discovery"]["media"]["data"][$i]["like_count"].'<br></div>
			</div>';
		}
	//	echo'</div></div></div>';
		//print_r( $responseArray);
		echo '
<html>
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<title>Untitled</title>
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/styles.css">
    </head>
<body>
    <form action="comments_and_replies.php" method="post">
        <input type="hidden" value="'.$responseArray['business_discovery']['media']['data'][$i]['id'].'" name="id">
		<input type="hidden" value="'.$responseArray['business_discovery']['media']['data'][$i]['caption'].'" name="caption">
		<input type="hidden" value="'.$responseArray['business_discovery']['media']['data'][$i]['media_url'].'" name="media_url">
		<input type="hidden" value="'.$responseArray['business_discovery']['media']['data'][$i]['permalink'].'" name="permalink">
		<input type="hidden" value="'.$responseArray['business_discovery']['media']['data'][$i]['media_type'].'" name="media_type">

<br>
        <div><button onclick="func()" style="margin-right: 10px;margin-left: 10px;margin-top: 15px;" type="submit" class="btn btn-primary">submit</button> <span id="demo2"></span></div>
    </form>
	<hr>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	
<script>
function func(){
  
	document.getElementById("demo2").innerHTML = "Loading please wait...";
	
  }
</script>
</body>    
</html>
'; 
		
	echo "\n\n";	
		
		
		
		}?>
		<!-- </textarea> -->
	</body>
</html>