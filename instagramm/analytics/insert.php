<?php

//  define( 'FACEBOOK_APP_ID', '668003424554776' );
//  define( 'FACEBOOK_APP_SECRET', 'a468c630926bcc025e6a2681e712f1a5' );
//  define( 'FACEBOOK_REDIRECT_URI', 'YOUR-REDIRECT-URI' );
//  define( 'ENDPOINT_BASE', 'https://graph.facebook.com/v5.0/' );

include 'db.php';
include '../defines.php';
$endpointFormat = ENDPOINT_BASE . '{ig-user-id}?fields=business_discovery.username({ig-username}){username,website,name,ig_id,id,profile_picture_url,biography,follows_count,followers_count,media_count,media{caption,like_count,comments_count,media_url,permalink,media_type}}&access_token={access-token}';
$sql = "SELECT instaid, username, accesstoken, pageid FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["instaid"]. " - Name: " . $row["username"]. " " . $row["accesstoken"]. "<br>";
    
    //insert($row['instaid'], $row['accesstoken'], $row['username']);
}
} else {
  echo "0 results";
}
  	
    // get instagram user metadata endpoint

	
	 
	  
	  
  
	  // accessToken
	  //$accessToken = 'EAAJfi6rUTxgBAByjDc8Pgfjkp74phM9TWxV55ShLyfIoZARVrKt7ZCwrqcnRQ93K6sbFzolrvA6hvbPJZCWzBSGi5Pzyfg09zzSZBuxYkKgx7qQ9qEJJq8Cq4rOfgD3k7ZCgotFfdWSsx2qZCY3MePdwFn5eBw5fQfMwmmrJQ6Yl5zUHYzi7wP';
	//   $accessToken = $row['accesstoken'];
  
	//   // page id
	//   //$pageId = '668003424554776';
	//   $pageId = $row['pageid'];
  
  
  
	//   // instagram business account id
	//   $instagramAccountId = $row['instaid'];
insert($row['instaid'], $row['accesstoken'], $row['username']);
//$username = 'majorproject2022';


function insert($instagramAccountId,$accessToken, $user_name){
    include 'db.php';
    //include '../defines.php';
   
	$endpoint = ENDPOINT_BASE . $instagramAccountId;

	// username
	//$username = $row['username'];
	$username = $user_name;
	

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
}
//}
// } else {
//   echo "0 results";
// }
// $conn->close();


