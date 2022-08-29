
<?php
	include '../defines.php';

	$mediaObject = array( // media post we are working with
		'id' => '17906280353293676',
		'caption' => "Pls ignore for study purpose only
.
The metadata we can get from the Instagram Graph API for a user includes, profile image url, account I'd, username, website, name, biography, follow count, follower count, media count.
.
#coding #instagram #coder #tech #php #html #fullstackdeveloper #webdevelopment #webstagram #computers #frontenddeveloper #instagramgraphapi #instagramapi #api #backend #website #softwareengineer #code #programming #facebook",
		'media_url' => 'https://scontent-iad3-2.cdninstagram.com/v/t51.29350-15/272105520_1085545885350748_2650881389544192092_n.webp.jpg?_nc_cat=103&ccb=1-5&_nc_sid=8ae9d6&_nc_ohc=ndhA23HnLq0AX_30R68&_nc_ht=scontent-iad3-2.cdninstagram.com&edm=AL-3X8kEAAAA&oh=00_AT-TfnGNmQqSmjT2XUaQL5K3DBe6EdTVwaQbVgfrtJyN3Q&oe=61E9C606',
		'permalink' => 'https://www.instagram.com/p/CY0owaWMjGX/',
		'media_type' => "IMAGE"
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
<html>
	<head>
		<title>Getting Insights on Instagram Posts and User Accounts with the Instagram Graph API</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="assets1/bootstrap/css/bootstrap.min.css">
    	<link rel="stylesheet" href="assets1/css/styles.css">
		<link rel="stylesheet" href="assets2/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets2/css/Projects-Clean.css">
    <link rel="stylesheet" href="assets2/css/styles.css">
		<style>
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
                                        <div class="counter"><b><?php echo $userInfo['business_discovery']['media_count']; ?></b></div>
                                        <div class="heading">Posts</div>
                                    </li>
                                    <li>
                                        <div class="counter"><b><?php echo $userInfo['business_discovery']['follows_count']; ?></b></div>
                                        <div class="heading">Following</div>
                                    </li>
                                    <li>
                                        <div class="counter"><b><?php echo $userInfo['business_discovery']['followers_count']; ?></b></div>
                                        <div class="heading">Followers</div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xl-4 col-md-4 d-flex justify-content-center">
                                <div class="image-default">
                                    <img class="rounded-circle" src="<?php echo $userInfo['business_discovery']['profile_picture_url']; ?>" alt="...">
                                </div>
                                <div class="infos">
								<a target="_blank" href="https://www.instagram.com/<?php echo $userInfo['business_discovery']['username']; ?>">
                                    <h2><?php echo $userInfo['business_discovery']['username']; ?></h2>
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


  


	<!--<h2>User Insights</h2>
-->
	<div class="card-group">
			<?php foreach ( $userInsights['data'] as $insight ) : ?>
			<div class="card"><img class="card-img-top w-100 d-block">
					<div class="card-body">
					<h4 class="card-title"><b><?php echo $insight['title']; ?></b></h4>	
	
					
						<?php foreach ( $insight['values'] as $value ) : ?>
						<div><b><i>Value:</i></b> <?php echo $value['value']; ?> <?php echo "<i><b>For date </b></i>", $value['end_time']; ?></div>
						<?php endforeach; ?>
					</div>
			 </div>
			<?php endforeach; ?>
	</div>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>


	<section class="projects-clean">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Posts </h2>
            </div>
            <div class="row projects">
                <div class="col-sm-6 col-lg-4 item"><video height="390" width="310" controls="">
					<source src="<?php echo $mediaObject['media_url']; ?>">
				</video>
				<img src="<?php echo $mediaObject['media_url']; ?>">
				<a target="_blank" href="<?php echo $mediaObject['permalink']; ?>">
					<h3>
						<?php echo $mediaObject['caption']; ?>
					</h3>
				</a>
			                </div>

<!--
                <div class="col-sm-6 col-lg-4 item"><img class="img-fluid" src="assets/img/building.jpg">
                    <h3 class="name">Project Name</h3>
                    <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p>
                </div>
                <div class="col-sm-6 col-lg-4 item"><img class="img-fluid" src="assets/img/loft.jpg">
                    <h3 class="name">Project Name</h3>
                    <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p>
                </div>
                <div class="col-sm-6 col-lg-4 item"><img class="img-fluid" src="assets/img/minibus.jpeg">
                    <h3 class="name">Project Name</h3>
                    <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p>
                </div>
            </div>
						-->
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>





	<!--	<h2 align="center">Posts<h2>


					

		<div style="width:100%;display:inline-block">
		 <div style="float:left">
				<video height="390" width="310" controls="">
					<source src="<?php echo $mediaObject['media_url']; ?>">
				</video>
			</div>
			<img src="<?php echo $mediaObject['media_url']; ?>">
			<div style="float:left;margin-left:20px;">
				<a target="_blank" href="<?php echo $mediaObject['permalink']; ?>">
					<h3>
						<?php echo $mediaObject['caption']; ?>
					</h3>
				</a>
			</div>
		</div>
			-->

	<!--
		<h3>Media Object Insights</h3>
		<ul>
			<?php foreach ( $mediaInsights['data'] as $insight ) : ?>
				<li>
					<div>
						<b><?php echo $insight['title']; ?></b>
					</div>
					<div>
						<?php foreach ( $insight['values'] as $value ) : ?>
							<div>Value: <?php echo $value['value']; ?> <?php echo $value['end_time']; ?>
						<?php endforeach; ?>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
		<h3>
			Get Media Insights Endpoint: <?php echo $mediaInsightsEndpoingFormat; ?>
		</h3>
		<h4>Response<h4>
		<textarea style="width:100%;height:300px"><?php print_r( $mediaInsights ); ?></textarea>
		<h3>
			Get User Insights Endpoint: <?php echo $userInsightsEndpoingFormat; ?>
		</h3>
		<h4>Response<h4>
		<textarea style="width:100%;height:300px"><?php print_r( $userInsights ); ?></textarea>
						-->
	</body>
</html>

