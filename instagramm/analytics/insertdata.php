<?php

include 'db.php';
include '../defines.php';
$userInsightsEndpoingFormat = ENDPOINT_BASE . '{ig-user-id}/insights?metric=follower_count,impressions,profile_views,reach&period=day&access_token={access-token}';
$userInsightsEndpoint = ENDPOINT_BASE . $instagramAccountId . '/insights';
$userInsightParams = array(
		'metric' => 'follower_count,impressions,profile_views,reach',
		'period' => 'day',
		'access_token' => $accessToken
	);


function makeApiCall( $endpoint, $type, $params ) {
		$ch = curl_init();

		if ( 'POST' == $type ) {
			curl_setopt( $ch, CURLOPT_URL, $endpoint );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $params ) );
			curl_setopt( $ch, CURLOPT_POST, 1 );
		} elseif ( 'GET' == $type ) {
			curl_setopt( $ch, CURLOPT_URL, $endpoint . '?' . http_build_query( $params ) );
		}

		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$response = curl_exec( $ch );
		curl_close( $ch );

		return json_decode( $response, true );
	}
	$userInsights = makeApiCall( $userInsightsEndpoint, 'GET', $userInsightParams );
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

	 foreach ( $userInsights['data'] as $insight ) : 
				
						 foreach ( $insight['values'] as $value ) :
						 	 // below line assigns values to $impressions, $reach, $profile_views
							${$insight['name']} = $value['value']; 
						 endforeach; 
				
		 endforeach; 

  $follower_count=$responseArray['business_discovery']['followers_count'];
    $sql = "SELECT CURRENT_DATE";
    $result = $conn->query($sql);
    $date = $result->fetch_assoc()['CURRENT_DATE'];

    
$sql = "INSERT INTO data (user_id, impressions, reach, profile_views, followers, date)
VALUES ($instagramAccountId, $impressions, $reach, $profile_views, $follower_count,'$date')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
