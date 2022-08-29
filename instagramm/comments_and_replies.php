<?php
	include 'defines.php';

	$mediaObject = array( // media post we are working with
		'id' => $_POST['id'],
		'caption' => $_POST['caption'],
		'media_url' => $_POST['media_url'],
		'permalink' => $_POST['permalink'],
		'media_type' => $_POST['media_type']
	);
echo $_POST['caption'];

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

	// endpoint formats
	$commentsEndpointFormat = ENDPOINT_BASE . '{ig-media-id}/comments?fields=like_count,replies,username,text';
	$repliesEndpointFormat = ENDPOINT_BASE . '{ig-comment-id}/replies?fields=username,text,like_count';
	$postCommentEndpointFormat = ENDPOINT_BASE . '{ig-media-id}/comments?message={message}';
	$postReplyEndpointFormat = ENDPOINT_BASE . '{ig-comment-id}/replies?message={message}';

	// post comment to IG
	// $postCommentEndpoint = ENDPOINT_BASE . $mediaObject['id'] . '/comments';
	// $postCommentIgParams = array(
	// 	'message' => 'Commenting from IG Graph API!! :)',
	// 	'access_token' => $accessToken
	// );
	// $postCommentResponseArray = makeApiCall( $postCommentEndpoint, 'POST', $postCommentIgParams );
	// echo '<pre>';
	// print_r($postCommentResponseArray);
	// die();

	// post reply to comment
	// $commentId = '17982899548288082';
	// $postReplyEndpoint = ENDPOINT_BASE . $commentId . '/replies';
	// $postReplyIgParams = array(
	// 	'message' => 'Reply coming from IG Graph API!! :)',
	// 	'access_token' => $accessToken
	// );
	// $postReplyResponseArray = makeApiCall( $postReplyEndpoint, 'POST', $postReplyIgParams );
	// echo '<pre>';
	// print_r($postReplyResponseArray);
	// die();


	// get comments from IG
	$commentsEndpoint = ENDPOINT_BASE . $mediaObject['id'] . '/comments';
	
	$igParams = array(
		'fields' => 'like_count,replies,username,text',
		'access_token' => $accessToken
	);
	$responseArray = makeApiCall( $commentsEndpoint, 'GET', $igParams );
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Getting and Replying to Comments on Instagram with the Instagram Graph API</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/LinkedIn-like-Profile-Box.css">
    <link rel="stylesheet" href="assets/css/styles.css">
	<style>
        .rounded-circle {
  /*position: absolute;*/
  margin-top: -30px;
  margin-left: auto;
  margin-right: auto;
  /*width: 50%;*/
}

.profile-box {
}

    </style>
	</head>
	<body style="background: url(&quot;assets/img/socialmedia.jpg&quot;);">
	<!--	<h1>Getting and Replying to Comments on Instagram with the Instagram Graph API</h1> -->
		<hr />
		<br />
		<div style="width:100%;display:inline-block">
			<div style="float:left">
				<!-- <video height="390" width="310" controls="">
					<source src="<?php //echo $mediaObject['media_url']; ?>">
				</video> -->
				<img src="<?php //echo $mediaObject['media_url']; ?>">
			</div>
			<div style="float:left;margin-left:20px;">
				<a target="_blank" href="<?php //echo $mediaObject['permalink']; ?>">
					<h3>
						<?php //echo $mediaObject['caption']; ?>
					</h3>
				</a>
			</div>
		</div>
		<br />
		<div class="text-center bg-warning border rounded border-danger shadow-lg profile-box" data-bss-hover-animate="jello" style="width: 500px;height: 900px;background-color: #ffffff;margin-left: 30%;margin-top: 50px;">
        <div style="height: 50px;background-image: url(&quot;assets/img/bg-pattern.png&quot;);background-color: rgba(54,162,177,0);"></div>
        <div></div>
        <div style="height: 80px;">
            <h4>Comments</h4>
	
		<ul style="list-style: none">
			<?php foreach ( $responseArray['data'] as $comment ) : ?>
				<?php
					// get comment replies from instagram
					$repliesEndpoint = ENDPOINT_BASE . $comment['id'] . '/replies';
					$repliesIgParams = array(
						'fields' => 'username,text,like_count',
						'access_token' => $accessToken
					);
					$repliesResponseArray = makeApiCall( $repliesEndpoint, 'GET', $repliesIgParams );
				?>
				<li style="margin-top:20px;margin-bottom:20px">
					<div>
						<a href="https://instagram.com/<?php echo $comment['username']; ?>" target="_blank">
							<b><?php echo $comment['username']; ?></b>
						</a>
					</div>
					<div>
						<?php echo $comment['text']; ?>
					</div>
					<div style="font-size:10px">
						Likes <?php echo $comment['like_count']; ?>
					</div>
					<div>
						<h5>
							Replies (<?php echo count( $repliesResponseArray['data'] ); ?>)
						</h5>
					</div>
					<div style="margin-left:20px">
						<ul style="list-style: none">
							<?php foreach ( $repliesResponseArray['data'] as $reply ) : ?>
								<div>
									<a href="https://instagram.com/<?php echo $reply['username']; ?>" target="_blank">
										<b><?php echo $reply['username']; ?></b>
									</a>
								</div>
								<div>
									<?php echo $reply['text']; ?>
								</div>
								<div style="font-size:10px">
									Likes <?php echo $reply['like_count']; ?>
								</div>
							<?php endforeach; ?>
						</ul>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
		
		<!-- <textarea style="width:100%;height:300px"> -->
		<?php 
		$string="";
		//print_r( $responseArray ); 
		
		//echo "-----------------------------";
		$finaldata = $responseArray['data'];
		for ($i=0;$i<count($finaldata);$i++){
		
		$string.= " ".$finaldata[$i]['text']." .";
		}
		$pyout  = exec('python inference.py '.$string);

		
		//echo $pyout[0];
		//echo $string;
		$string = $pyout;
$f_string="";
$pos=0;
$neg=0;

for($i=1;$i<strlen($string)-1;$i++){
    if($string[$i] == "1"){
        $pos+=1;    
    }
    else if($string[$i]=="0"){
        $neg+=1;
    }
}
$f_string= "[".$pos.",".$neg."]";

echo "<head>
<!-- Load plotly.js into the DOM -->
<script src='https://cdn.plot.ly/plotly-2.8.3.min.js'></script>
</head>

<body>
<div id='myDiv'><!-- Plotly chart will be drawn inside this DIV --></div>
<script>
var data = [{
    values: ".$f_string.",
    labels: ['positive', 'negative'],
    type: 'pie'
  }];
  
  var layout = {
    height: 400,
    width: 500
  };
  
  Plotly.newPlot('myDiv', data, layout);
</script>
</body>



";
		?>
		<!-- </textarea> -->
	


		</div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
	<!-- End of box modal -->
	</body>
</html>