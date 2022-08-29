<?php
	include 'defines.php';

	function hashsuggest($string) {

        /* Match hashtags */
       
        preg_match_all('/#(\w+)/', $string, $matches);
       
        $keywords="";
       
         /* Add all matches to array */
       
         foreach ($matches[1] as $match) {
       
           $keywords .= "#".$match . ', ';
       
         }
       
        
       
        return rtrim(trim($keywords), ',');
       
       }
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

	$hashtag = $_POST['n3'];
	

	// ENDPOINT_BASE = https://graph.facebook.com/v5.0/
	$hashtagSearchEndpoingFormat = ENDPOINT_BASE . 'ig_hashtag_search?user_id={user-id}&q={hashtag-name}&fields=id,name';
	$hashtagDataEndpointFormat = ENDPOINT_BASE . '{hashtag-id}?fields=id,name';
	$hashtagTopMediaEndpointFormat = ENDPOINT_BASE . '{ig-hashtag-id}/top_media?user_id={user-id}&fields=id,caption,children,comments_count,like_count,media_type,media_url,permalink';
	$hashtagRecentEndpointFormat = ENDPOINT_BASE . '{ig-hashtag-id}/recent_media?user_id={user-id}&fields=id,caption,children,comments_count,like_count,media_type,media_url,permalink';

	// get hashtag by name
	$hashtagSearchEndpoint = ENDPOINT_BASE . 'ig_hashtag_search';
	$hashtagSearchParams = array(
		'user_id' => $instagramAccountId,
		'fields' => 'id,name',
		'q' => $hashtag,
		'access_token' => $accessToken
	);
	$hashtagSearch = makeApiCall( $hashtagSearchEndpoint, 'GET', $hashtagSearchParams );
	$hashtagId = $hashtagSearch['data'][0]['id'];
	// get hashtag by id
	$hashtagDataEndpoint = ENDPOINT_BASE . $hashtagId;
	$hashtagDataParams = array(
		'fields' => 'id,name',
		'access_token' => $accessToken
	);
	$hashtagData = makeApiCall( $hashtagDataEndpoint, 'GET', $hashtagDataParams );

	// top media for hashtag
	$hashtagTopMediaEndpoint = ENDPOINT_BASE . $hashtagId . '/top_media';
	$hashtagTopMediaParams = array(
		'user_id' => $instagramAccountId,
		'fields' => 'id,caption,children,comments_count,like_count,media_type,media_url,permalink',
		'access_token' => $accessToken
	);
	$hashtagTopMedia = makeApiCall( $hashtagTopMediaEndpoint, 'GET', $hashtagTopMediaParams );
	$topPost = $hashtagTopMedia['data'][0];

	// recent media
	$hashtagRecentEndpoint = ENDPOINT_BASE . $hashtagId . '/recent_media';
	$hashtagRecentParams = array(
		'user_id' => $instagramAccountId,
		'fields' => 'id,caption,children,comments_count,like_count,media_type,media_url,permalink',
		'access_token' => $accessToken
	);
	$hashtagRecent = makeApiCall( $hashtagRecentEndpoint, 'GET', $hashtagRecentParams );
	$recentPost = $hashtagRecent['data'][0];
?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			Hashtag Search with the Instagram Graph API
		</title>
		<meta charset="utf-8" />
	</head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<body>

	
			<!-- Hashtag
			<a target="_blank" href="https://www.instagram.com/explore/tags/<?php echo $hashtag; ?>">
				#<?php echo $hashtag; ?> (id <?php echo $hashtagData['id']; ?>)
			</a> -->
		
		<h3>
			<?php echo $hashtagData['name']; ?>
		</h3>
		
			<!-- <div>
				<?php //if ( 'IMAGE' == $topPost['media_type'] || 'CAROUSEL_ALBUM' == $topPost['media_type'] ) : ?>
					<img style="height:320px" src="<?php // echo $topPost['media_url']; ?>" />
				<?php //else : ?>
					<video height="240" width="320" controls>
						<source src="<?php //echo $topPost['media_url']; ?>" />
					</video>
				<?php //endif; ?>
			</div> -->
			
				<b><?php
                $string= $topPost['caption'];
                echo hashsuggest($string);?>
              
                
                
			
			
		<h3>
			<?php echo $hashtagData['name']; ?>
		</h3>
		
			<!-- <div>
				<?php //if( 'IMAGE' == $recentPost['media_type'] || 'CAROUSEL_ALBUM' == $recentPost['media_type'] ) : ?>
					<img style="height:320px" src="<?php //echo $recentPost['media_url']; ?>" />
				<?php //else : ?>
					<video height="240" width="320" controls>
						<source src="<?php // echo $recentPost['media_url']; ?>" />
					</video>
				<?php //endif; ?>
			</div> -->
			
				<?php 
                $string= $recentPost['caption'];
                echo hashsuggest($string);
                
                //echo nl2br( $recentPost['caption'] ); ?></b>
			
			<!-- <div>
				Post ID: <?php //echo nl2br( $recentPost['id'] ); ?>
			</div>
			<div>
				Media Type: <?php //echo nl2br( $recentPost['media_type'] ); ?>
			</div>
			<div>
				Media URL: <?php //echo nl2br( $recentPost['media_url'] ); ?>
			</div>
			<div>
				Link: <a target="_blank" href="<?php //echo $recentPost['permalink']; ?>"><?php echo $recentPost['permalink']; ?></a>
			</div> -->
		
		<!-- <h3>
			Hashtag Search Endpoint: <?php //echo $hashtagSearchEndpoint; ?>
		</h3>
		<textarea style="width:100%;height:200px"><?php //print_r( $hashtagSearch ); ?></textarea>
		<hr /> -->
		<!-- <h3>
			Hashtag Data Endpoint: <?php //echo $hashtagDataEndpoint; ?>
		</h3>
		<textarea style="width:100%;height:100px"><?php //print_r( $hashtagData ); ?></textarea>
		<hr /> -->
		
          
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>  
	</body>
</html>