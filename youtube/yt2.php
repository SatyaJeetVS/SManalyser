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
<body style="background: url('assets/yt.jpeg');">
<div class="text-center bg-danger border rounded border-info shadow-sm profile-box" style="width: 700px;height: 500px;background-color: #ffffff;margin-left: 25%;margin-top:5%;">
<div style="height: 80px;">
        <h4>Comments analysis</h4>
        <p style="font-size: 12px;">Analysis of video in the form of pie chart</p>
    </div>
    <div style="margin-left:15%;">
<?php

/**
 * Sample PHP code for youtube.commentThreads.list
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

$queryParams = [
    'maxResults' => 100,
    'order' => 'relevance',
    'videoId' =>  $_GET['videoId']
];

$response = $service->commentThreads->listCommentThreads('snippet,id', $queryParams);

$string='';

foreach ($response["items"] as $res)
{
	// print($res['snippet']['topLevelComment']['snippet']['textDisplay']);
	// echo '<br>';

		
		//print_r( $responseArray ); 
		
		
		$finaldata = $res['snippet']['topLevelComment']['snippet']['textDisplay'];
		
		
    
    
		$string.= ' '.$finaldata.' .';
		
		//$pyout  = exec('python inference.py '.$string);

}

//echo $string;
$myfile = fopen("comments.txt", "w") or die("Unable to open file!");
$txt = $string;
fwrite($myfile, $txt);
fclose($myfile);

$pyout  = exec('python inference.py ');
//echo $pyout;
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
// echo $pos."<br>";
// echo $neg;
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
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>