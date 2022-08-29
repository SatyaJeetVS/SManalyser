<?php
include 'db.php';
$id=17841450822510905;
//$sql = "SELECT user_id, followers,date FROM data where user_id= $id and year(date)= 2022";
$sql = "SELECT * FROM data";
$result = $conn->query($sql);
$str="";
//print_r($result->fetch_assoc());
if ($result->num_rows > 0) {
  // output data of each row
  
  while($row = $result->fetch_assoc()) {
   // echo "id: " . $row["user_id"]. " - followers: " . $row["followers"]." Date:".$row['date']."<br>";
    //array_push($followers, $row['followers']);
    $str = $str.$row['followers'].",";
  }
} else {
  echo "0 results";
}
$conn->close();
//print_r($followers);
// for($i=0;$i< count($followers);$i++){
//   //echo $followers[$i];
//   $str = $str.$followers[$i].",";
// }
$finalstring = "[".$str."]";
//echo $finalstring;
echo'
<!DOCTYPE html>
<head>
    <title>

    </title>
    <script src="https://cdn.plot.ly/plotly-2.6.3.min.js"></script>
</head>
<body>
<div id="myDiv" style="width:400px;height:600px;"><!-- Plotly chart will be drawn inside this DIV --></div>   

<script>
    
      var trace1 = {
  x: ["Jan", "Feb", "Mar", "Apr","May"],
  y: '.$finalstring.',
  type: "bar",
  name: "Primary Product",
  marker: {
    color: "#3498DB",
    opacity: 1,
  }
};


var data = [trace1];

var layout = {
  title: "2021 followers",
  xaxis: {
    tickangle: -45
  },
  barmode: "group"
};

Plotly.newPlot("myDiv", data, layout);
       
    </script>

</body>
<html>
';
?>


