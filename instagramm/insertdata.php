<?php

include 'db.php';
//include '../defines.php';

	

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
    $follower_count=$responseArray['business_discovery']['followers_count'];
    echo $follower_count;
	$sql = "SELECT CURRENT_DATE";
    $result = $conn->query($sql);
    $date = $result->fetch_assoc()['CURRENT_DATE'];

    
$sql = "INSERT INTO data (user_id, followers, date)
VALUES ($instagramAccountId, $follower_count,'$date')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
  //header("Location: index.php");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}




