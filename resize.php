<?php

include 'includes/login.php';

$msg = null;  // アップロード状況を表すメッセージ
$alert = null;  // メッセージのデザイン用

if (isset($_FILES['file']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
  $old_name = $_FILES['file']['tmp_name'];
  $new_name = date("YmdHis");   // ベースとなるファイル名は日付
  $new_name .= mt_rand();       // ランダムな数字も追加

  // 元画像の縦横サイズおよび画像形式をを取得
  list($width, $height, $type) = getimagesize($_FILES['file']['tmp_name']);

  $new_width = 300; // サムネイルの幅
  // 画像のサイズ比率を計算
  $rate = $new_width / $width;    // 比率
  $new_height = $rate * $height;  // 比率から計算したサムネイルの高さ

  // サムネイルサイズでキャンバスを作成する
  $canvas = imagecreatetruecolor($new_width, $new_height);

  // アップした画像の拡張子によって新ファイル名と画像の読み込み方を変える
  switch ($type) {
      // JPEG
    case IMAGETYPE_JPEG:
      $new_name .= '.jpg';
      $image = imagecreatefromjpeg($_FILES['file']['tmp_name']);
      imagecopyresampled(
        $canvas,
        $image,
        0,
        0,
        0,
        0,
        $new_width,
        $new_height,
        $width,
        $height
      );
      imagejpeg($canvas, 'thumbnail/' . $new_name);
      break;

      // GIF
    case IMAGETYPE_GIF:
      $new_name .= '.gif';
      $image = imagecreatefromgif($_FILES['file']['tmp_name']);
      imagecopyresampled(
        $canvas,
        $image,
        0,
        0,
        0,
        0,
        $new_width,
        $new_height,
        $width,
        $height
      );
      imagegif($canvas, 'thumbnail/' . $new_name);
      break;

      // PNG
    case IMAGETYPE_PNG:
      $new_name .= '.png';
      $image = imagecreatefrompng($_FILES['file']['tmp_name']);
      imagecopyresampled(
        $canvas,
        $image,
        0,
        0,
        0,
        0,
        $new_width,
        $new_height,
        $width,
        $height
      );
      imagepng($canvas, 'thumbnail/' . $new_name);
      break;

      // 1画像以外のファイルのとき
    default:
      imagedestroy($canvas);
      header('Location: upload.php');
      exit();
  }
  imagedestroy($image);
  imagedestroy($canvas);
  if (move_uploaded_file($old_name, 'album/' . $new_name)) {
    $msg = "アップロードしました。";
    $alert = 'success'; // Bootstrapで緑色のボックスにする
  } else {
    $msg = "アップロードできませんでした。";
    $alert = 'danger';  // Bootstrapで赤いボックスにする
  }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <title>サークルサイト</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>

  <?php include('navbar.php'); ?>

  <main role="main" class="container" style="padding:60px 15px 0">
    <div>
      <h1>画像アップロード</h1>
      <?php
      if ($msg) {
        echo '<div class="alert alert-' . $alert . '" role="alert">' . $msg . '</div>';
      }
      ?>
      <form action="resize.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label>アップロードファイル</label>
          <input type="file" name="file" class="form-control-file">
        </div>
        <input type="submit" value="アップデートする" class="btn btn-primary">
      </form>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>