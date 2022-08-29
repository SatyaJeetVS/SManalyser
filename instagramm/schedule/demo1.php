<?php
$string= $_POST['n3'];

$pyout  = exec('python HashTagGenerator.py '.$string);
echo $pyout;