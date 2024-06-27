<?php
var_dump($_POST);

$name = $_POST['name'];
$age = $_POST['age'];

// 受け取ったデータの処理
// ...

// レスポンスを返す
$response = 'データを受け取りました。';
echo $response;
?>