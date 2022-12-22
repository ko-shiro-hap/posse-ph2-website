<?php
declare(strict_types = 1);

// PDOの設定を呼び出す
require('../dbconnect.php');

$content = $_POST['content'];
$image = $_POST['image'];
$supplement = isset($_POST['supplement']) ? $_POST['supplement'] : null;
$choice1 = $_POST['choice1'];
$choice2 = $_POST['choice2'];
$choice3 = $_POST['choice3'];
$valid = $_POST['valid'];

echo $content;
echo $image;
echo $valid;
?>
