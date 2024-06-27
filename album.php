<?php
  include 'includes/login.php';

  $images = [];   // 画像ファイルのリストを格納する配列
  $num = 4;       // 1ページに表示する画像の枚数

  // 画像フォルダから画像のファイル名を読み込む
  if ($handle = opendir('./album')) {
    while ($entry = readdir($handle)) {
      // 「.」および「..」でないとき、ファイル名を配列に追加
      if ($entry != "." && $entry != "..") {
        $images[] = $entry;
      }
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
      <h1>アルバム</h1>
  <?php
    if (count($images) > 0) {
      echo '<div class="row">';

      // 指定枚数ごとに画像ファイル名を分割
      $images = array_chunk($images, $num);
      // ページ数指定、基本は1ページ目を示す
      $page = 1;

      // GETでページ数が指定されていた場合
      if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $page = intval($_GET['page']);      // GETでページ数を取得
        // $images[ページ数]は存在するかチェック
        if (!isset($images[$page-1])) {
          $page = 1;
        }
      }

      foreach ($images[$page-1] as $img) {
        echo '<div class="col-sm-3">';
        echo '  <div class="card">';
        echo '    <a href="./album/' . $img . '" target="_blank"> <img src="./thumbnail/' . $img . '" class="img-fluid"></a>';
        echo '  </div>';
        echo '</div>';
      }
      echo '</div>';

      // ページ数リンクを表示
      echo '<nav><ul class="pagination">';

      for ($i = 1; $i <= count($images); $i++) {
      
        // 現在のページはactiveを追加する
        if ($i == $page) {
          echo '<li class="page-item active">';
        } else {
          echo '<li class="page-item">';
        }

        echo '<a class="page-link" href="album.php?page=' . $i . '">' . $i . '</a></li>';

      //   echo '<li class="page-item"><a class="page-link" href="album.php?page=' . $i . '">' . $i . '</a></li>';
      }
      echo '</ul></nav>';

    } else {
      echo '<div class="alert alert-dark" role="alert">画像はまだありません。</div>';
    }
  ?>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>