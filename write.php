<?php
  include 'includes/login.php';


  // var_dump($_POST);
  // exit();

  // データの受け取り
  $name = $_POST['name'];
  $title = $_POST['title'];
  $body = $_POST['body'];
  $pass = $_POST['pass'];

  $token = $_POST['token']; // CSRF対策

  // CSRF対策：トークンが正しいか？
  if ($token != hash('sha256', session_id())) {
    header('Location: bbs.php');
    exit();
  }

  // 必須項目チェック（名前か本文が空ではないか？）
  if ($name == '' || $body == '') {
    header('Location: bbs.php');  // 空の時bbs.phpへ移動
    exit();
  }

  // 必須項目チェック（パスワードは４桁の数字か？）
  if (!preg_match('/^[0-9]{4}$/', $pass)) {
    header('Location: bbs.php');  // 書式が違うときbbs.phpへ移動
  }

  // 名前をクッキーにセット
  setcookie('name', $name, time() + 60*60*24*30);

  // DBに接続
  $dsn = 'mysql:host=localhost;dbname=tennis;charset=utf8';
  $user = 'tennisuser';
  $password = 'password';   // tennisusesrに設定したパスワード

  try {
    // PDOインスタンスの作成
    $db = new PDO($dsn, $user, $password);
    $db-> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // プリペアードステートメント
    $stmt = $db->prepare('
      INSERT INTO bbs (name, title, body, date, pass)
      VALUES (:name, :title, :body, now(), :pass)
    ');
    // プリペアードステートメントにパラメータを割り当てる
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':body', $body, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
    // クエリの実行
    $stmt->execute();

    // bbs.phpに戻る
c    header('Location: bbs.php');
    exit();
  } catch (PDOException $e) {
    exit('エラー：' . $e->getMessage());
  }