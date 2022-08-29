<?php 



?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Untitled</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/LinkedIn-like-Profile-Box.css">
    <link rel="stylesheet" href="assets/css/Ludens-Users---1-Login.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    
</head>

<body  style="background: url('assets/yt.jpeg');">

<section class="login-clean" style="background-color: transparent;font-family: Poppins, sans-serif;">
<form action="index.php" class="border rounded border-light shadow-lg" style="margin-top: 40px;" method="post">
<div class="illustration"><i class="icon ion-ios-navigate" style="color: #00b5a8;"></i></div><a class="forgot">Enter YouTube Channel id</a>
<div class="form-group mb-3"><input type="text" class="form-control" name="channel"><br></div>
<div class="form-group mb-3">
<input class="btn btn-primary d-block w-100" style="background-color: #00b5a8;" type="submit" onclick="func()" formaction="index.php"></div>
<p id="demo"></p>
</form>
<br>

<script>
function func(){
  document.getElementById("demo").innerHTML = "Loading please wait";
}
</script>
</body>
</html>
<?php

/**
 * Sample PHP code for youtube.search.list
 * See instructions for running these code samples locally:
 * https://developers.google.com/explorer-help/code-samples#php
 */

if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
  throw new Exception(sprintf('Please run "composer require google/apiclient:~2.0" in "%s"', __DIR__));
}
require_once __DIR__ . '/vendor/autoload.php';

$client = new Google_Client();
$client->setApplicationName('API code samples');
$client->setDeveloperKey('AIzaSyB8MAbR4CXudZuDOYIGJJ5E_Ctig5ezOCE');

// Define service object for making API requests.
$service = new Google_Service_YouTube($client);


if (isset($_POST['channel'])) {
  $queryParams = [
    'channelId' => $_POST['channel'],
    'maxResults' => 25,
    'order' => 'relevance'
];
echo '';
  $response = $service->search->listSearch('snippet', $queryParams);
  foreach ($response["items"] as $res)
  {
  echo('<div class="card" style="width:900px;margin-right: 10px;margin-left: 20%;margin-top: 15px;"><img src="'.$res['snippet']['thumbnails']['medium']['url'].'" class="card-img-top w-200 d-block" style="height: 180px;width:200px;margin-left:40%;"><div class="card-body"><h4 align="center" class="card-text">');
  print("<br>".$res['snippet']['title']);
 
  ?>

  <form action="yt2.php" method="get">

    <button name="videoId" class="btn btn-primary" type="submit" onclick="func()" value="<?php echo $res['id']['videoId'];?>">submit</button><hr>
    <div id="demo2"></div>
  </div>
    </div>
  </form>
  <script src="assets/bootstrap/js/bootstrap.min.js">
</script>
<script>

function func(){
  
  document.getElementById("demo2").innerHTML = "Loading please wait...";
  
}

</script>
  <?php

  
}
}
