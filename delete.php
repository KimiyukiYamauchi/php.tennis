<?php
  include 'includes/login.php';

  // var_dump($_POST);
  // exit();

  // データの受け取り
  $id = intval($_POST['id']);
  $pass = $_POST['pass'];

   $token = $_POST['token']; // CSRF対策

  // CSRF対策：トークンが正しいか？
  if ($token != hash('sha256', session_id())) {
    echo '削除できませんでした';
    exit();
  }

  // 必須項目チェック
  if ($id == '' || $pass == '') {
    echo '削除できませんでした';
    exit();
  }

  // DBに接続
  $dsn = 'mysql:host=localhost;dbname=tennis;charset=utf8';
  $user = 'tennisuser';
  $password = 'password';   // tennisusesrに設定したパスワード

  try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // プリペアードステートメントを作成
    $stmt = $db->prepare('DELETE FROM bbs WHERE id=:id AND pass=:pass');
    // パラメータ割り当て
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
    // クエリの実行
    $stmt->execute();

    if ($stmt-> rowCount() > 0) {
      // 削除成功
      echo json_encode(['error' => '']);
    } else {
      // 削除失敗
      echo json_encode(['error' => 'パスワードが間違っています。']);
    }
    exit();

  } catch (PDOException $e) {
    exit('エラー：' . $e->getMessage());
  }
  // header('Location: bbs.php');
  // exit();