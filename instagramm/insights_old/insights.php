<?php
	//include '../defines.php';
	

	$mediaObject = array( // media post we are working with
		'id' => $_POST['id'],
		'caption' => $_POST['caption'],
		'media_url' => $_POST['media_url'],
		'permalink' => $_POST['permalink'],
		'media_type' => $_POST['media_type']
	);
	
	// function makeApiCall( $endpoint, $type, $params ) {
	// 	$ch = curl_init();

	// 	if ( 'POST' == $type ) {
	// 		curl_setopt( $ch, CURLOPT_URL, $endpoint );
	// 		curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $params ) );
	// 		curl_setopt( $ch, CURLOPT_POST, 1 );
	// 	} elseif ( 'GET' == $type ) {
	// 		curl_setopt( $ch, CURLOPT_URL, $endpoint . '?' . http_build_query( $params ) );
	// 	}

	// 	curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
	// 	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
	// 	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

	// 	$response = curl_exec( $ch );
	// 	curl_close( $ch );

	// 	return json_decode( $response, true );
	// }

	$mediaInsightsEndpoingFormat = ENDPOINT_BASE . '{ig-media-id}/insights?metric=engagement,impressions,reach,saved,video_views&access_token={access-token}';
	$userInsightsEndpoingFormat = ENDPOINT_BASE . '{ig-user-id}/insights?metric=follower_count,impressions,profile_views,reach&period=day&access_token={access-token}';
	// get media insights
	$mediaInsightsEndpoint = ENDPOINT_BASE . $mediaObject['id'] . '/insights';
	$mediaInsightParams = array(
		'metric' => 'engagement,impressions,reach,saved,video_views',
		'access_token' => $accessToken
	);
	$mediaInsights = makeApiCall( $mediaInsightsEndpoint, 'GET', $mediaInsightParams );

	// get user insights
	// $userInsightsEndpoint = ENDPOINT_BASE . $instagramAccountId . '/insights';
	// $userInsightParams = array(
	// 	'metric' => 'follower_count,impressions,profile_views,reach',
	// 	'period' => 'day',
	// 	'access_token' => $accessToken
	// );
	// $userInsights = makeApiCall( $userInsightsEndpoint, 'GET', $userInsightParams );

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
<html>
	<head>
		<title>Getting Insights on Instagram Posts and User Accounts with the Instagram Graph API</title>
		<meta charset="utf-8" />
	</head>
	<body>
		
		
		<ul>
			<?php foreach ( $mediaInsights['data'] as $insight ) : ?>
				<li>
					<div>
						<b><?php echo $insight['title'];?></b>
					</div>
					<div>
						<?php foreach ( $insight['values'] as $value ) : ?>
							<div>Value: <?php echo $value['value']; ?> <?php //echo $value['end_time']; ?>
						<?php endforeach; ?>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
		
	
	</textarea> 
	</body>
</html>