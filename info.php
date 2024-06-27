<?php
  include 'includes/login.php';

  $fp = fopen("info.txt", "r"); // ファイルを開く
  $line = array();  // ファイルの内容を１行ずつ要素に格納するための配列を用意
  $body = '';       // 本文を格納するための変数
  // ファイルが正しく開けたとき
  if ($fp) {
    while(!feof($fp)) {
      $line[] = fgets($fp);
    }
    fclose($fp);
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
      <h1>お知らせ</h1>
  <?php
    // お知らせがある時
    if (count($line) > 0) {
      for ($i = 0; $i < count($line); $i++) {
        if ($i == 0) {
          // １行目 (=０番目の要素)はタイトル
          echo '<h2>' . $line[0] . '</h2>';
        } else {
          // $i行目に改行タグを付けて本文変数にだいにゅうう
          $body .= $line[$i] . '<br>';
        }
      }
    } else {
      // ファイルが開けなかった時
      echo '<p>お知らせはありません。</p>';
    }
    echo '<p>' . $body . '</p>';
  ?>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>