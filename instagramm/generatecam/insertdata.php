<?php
include "db.php"; 
$url = $_POST['image_url'];
$caption = $_POST['caption'];
//$accesstoken;
$sql = "INSERT INTO camp (url, caption)
VALUES ('$url' , '$caption')";

if ($conn->query($sql) === TRUE) {
  header('location: index.php');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>