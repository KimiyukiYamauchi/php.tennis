<?php
try {
    // データベースへの接続
    $dsn = 'mysql:host=localhost;dbname=tennis;charset=utf8';
    $username = 'root';
    $password = '';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $pdo = new PDO($dsn, $username, $password, $options);

    // 挿入するデータ
    $names = [
        'Name 1', 'Name 2', 'Name 3', 'Name 4', 'Name 5',
        'Name 6', 'Name 7', 'Name 8', 'Name 9', 'Name 10',
        'Name 11', 'Name 12', 'Name 13', 'Name 14', 'Name 15',
        'Name 16', 'Name 17', 'Name 18', 'Name 19', 'Name 20',
        'Name 21', 'Name 22', 'Name 23', 'Name 24', 'Name 25',
        'Name 26', 'Name 27', 'Name 28', 'Name 29', 'Name 30'
    ];
    $titles = [
        'Title 1', 'Title 2', 'Title 3', 'Title 4', 'Title 5',
        'Title 6', 'Title 7', 'Title 8', 'Title 9', 'Title 10',
        'Title 11', 'Title 12', 'Title 13', 'Title 14', 'Title 15',
        'Title 16', 'Title 17', 'Title 18', 'Title 19', 'Title 20',
        'Title 21', 'Title 22', 'Title 23', 'Title 24', 'Title 25',
        'Title 26', 'Title 27', 'Title 28', 'Title 29', 'Title 30'
    ];
    $body = 'This is a sample body for the BBS table.';
    $date = date('Y-m-d H:i:s');
    $pass = '1234'; // 固定の4桁のパスワード

    // データを挿入するためのSQLクエリ
    $sql = "INSERT INTO bbs (name, title, body, pass) VALUES (:name, :title, :body, :pass)";
    $stmt = $pdo->prepare($sql);

    // トランザクションを開始
    $pdo->beginTransaction();

    // データを挿入
    for ($i = 0; $i < 30; $i++) {
        $stmt->execute([
            ':name' => $names[$i],
            ':title' => $titles[$i],
            ':body' => $body,
            ':pass' => str_pad((string)rand(0, 9999), 4, '0', STR_PAD_LEFT), // ランダムな4桁のパスワード
        ]);
    }

    // トランザクションをコミット
    $pdo->commit();

    echo "Data has been successfully inserted.";

} catch (PDOException $e) {
    // エラー発生時にトランザクションをロールバック
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "Error: " . $e->getMessage();
}
?>
