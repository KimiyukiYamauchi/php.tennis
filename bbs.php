<?php
  include 'includes/login.php';

  // クッキーを読み込んでフォームの名前を設定する
  if (isset($_COOKIE['name'])) {
    $name = $_COOKIE['name'];
  } else {
    $name = '';
  }


  // 1ページに表示される書き込みの数
  $num = 10;

  // DBに接続
  $dsn = 'mysql:host=localhost;dbname=tennis;charset=utf8';
  $user = 'tennisuser';
  $password = 'password';   // tennisusesrに設定したパスワード

  // GETメソッドで2ページ目以降が指定されているとき
  $page = 1;
  if (isset($_GET['page']) && $_GET['page'] > 1) {
    $page = intval($_GET['page']);
  }

  $savePage = $page;

  try {
    // PDOインスタンスの生成
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // プリペアードステートメントを生成
    $stmt = $db->prepare('SELECT * FROM bbs ORDER BY date DESC LIMIT :page, :num');
    // パラメータを割り当て
    $page = ($page-1) * $num;
    $stmt->bindParam(':page', $page, PDO::PARAM_INT);
    $stmt->bindParam(':num', $num, PDO::PARAM_INT);
    // クエリの実行
    $stmt->execute();
  } catch (PDOException $e) {
    exit('エラー：' . $e->getMessage());
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <title>サークルサイト</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <script>
    
  </script>

</head>
<body>

  <?php include('navbar.php'); ?>

  <main role="main" class="container" style="padding:60px 15px 0">
    <div>
      <h1>掲示板</h1>
      <form action="write.php" method="post" onsubmit="return validate(this)">
        <div class="form-group">
          <label>タイトル</label>
          <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
          <label>名前</label>
          <input type="text" name="name" class="form-control" value="<?php echo $name ?>">
        </div>
        <div class="form-group">
          <textarea name="body" rows="5" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label>削除パスワード（数字4桁）</label>
          <input type="text" name="pass" class="form-control">
        </div>
        <input type="submit" value="書き込む" class="btn btn-primary">
        <input type="hidden" name="token" value="<?php echo hash('sha256', session_id()) ?>">
      </form>

      <hr>

<?php while ($row = $stmt->fetch()) : ?>
      <div class="card">
        <div class="card-header">
          <?php echo $row['title'] ? $row['title'] : '（無題）'; ?>
        </div>
        <div class="card-body">
          <p class="card-text">
            <!-- <?php echo nl2br($row['body']) ?> -->
            <?php echo nl2br(htmlspecialchars($row['body'], ENT_QUOTES, 'UTF-8')) ?>
          </p>
        </div>
        <div class="card-footer">
          <form class="form-inline delete">
            <?php echo $row['name'] ?>
            (<?php echo $row['date'] ?>)
            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
            <input type="text" name="pass" placehodler="削除パスワード" class="form-control ml-3">
            <!-- <input type="button" value="削除" class="btn btn-secondary ml-3 delete" > -->
            <input type="submit" value="削除" class="btn btn-secondary ml-3" >
            <input type="hidden" name="token" value="<?php echo hash('sha256', session_id()) ?>">
          </form>
        </div>
      </div>
      <hr>
<?php endwhile; ?>

<?php
// ページ数の表示
try {
  // プリペアードステートメントの作成
  $stmt = $db->prepare('SELECT COUNT(*) FROM bbs');
  // クエリの実行
  $stmt->execute();
} catch (PDOException $e) {
  exit('エラー：' . $e->getMessage());
}

// 書き込みの件数を取得
$comments = $stmt->fetchColumn();
// ページ数を計算
$max_page = ceil($comments / $num);
// ページングの必要性があれば表示
if ($max_page >= 1) {
  echo '<nav><ul class="pagination">';
  for ($i=1; $i<=$max_page; $i++) {
    if ($i == $savePage) {
      echo '<li class="page-item active">';
    } else {
      echo '<li class="page-item">';
    }
    echo '<a class="page-link" href="bbs.php?page=' . $i . '">' . $i . '</a></li>';
  }
  echo '</ul></nav>';
}
?>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
'use scrict'

function validate(form) {

  // console.log('validate')

  fail = validateName(form.name.value)
  // console.log(fail)

  fail += validateBody(form.body.value)
  // console.log(fail)

  fail += validatePass(form.pass.value)
  // console.log(fail)

  if (fail == '') return true
  else {
    alert(fail); 
    return false;
  }
}
function validateName(field) {
  return (field == '') ? '名前が入力されていません。\n' : ''
}
function validateBody(field) {
  return (field == '') ? '本文が入力されていません。\n' : ''
}
function validatePass(field) {
  if (field == '') return '削除パスワードが設定されていません。\n'
  if (field.length != 4)
    return '削除パスワードが4文字になっていません。\n'
  else {
    const regex = new RegExp('^[0-9]{4}$');
    if (!regex.test(field)) {
      return '削除パスワードが数字のみになっていません。\n'
    }
    return '';
  }
}

// $(function(){
//   $('.delete').submit(function(e) {
//     e.preventDefault();

//     const id = this.id.value;
//     const pass = this.pass.value;
//     const token = this.token.value;
//     // console.log(id, pass);

//     fail = validatePass(pass);
//     if (fail != '') {
//       alert(fail);
//     }
//     else {
//       const del = confirm("本当にに削除しますか？");
//       if (del == true) {
//         deletedb(id, pass, token);
//       }
//     }
//   });
// });


// $(function(){
//   $('.delete').on('click', function() {
//     const id = this.parentNode.id.value;
//     const pass = this.parentNode.pass.value;
//     const token = this.parentNode.token.value;
//     // console.log(id, pass);

//     fail = validatePass(pass);
//     if (fail != '') {
//       alert(fail);
//     }
//     else {
//       const del = confirm("本当にに削除しますか？");
//       if (del == true) {
//         deletedb(id, pass, token);
//       }
//     }
//   });
// });


const formTags = document.querySelectorAll('.delete');

formTags.forEach(function (item, index) {
    item.onsubmit = function (event) {
      event.preventDefault();
      const id = this.id.value;
      const pass = this.pass.value;
      const token = this.token.value;
      // console.log(id, pass);

      fail = validatePass(pass);
      if (fail != '') {
        alert(fail);
      }
      else {
        const del = confirm("本当にに削除しますか？");
        if (del == true) {
          deletedb(id, pass, token);
        }
      }
    }
});


function deletedb(id, pass, token) {

  var data = {
      // name: 'John',
      // age: 25
      id: id,
      pass: pass,
      token: token
    };

  $.post('delete.php', 
        {
          id: id,
          pass: pass,
          token: token
        },
        function (response) {
          // レスポンスの処理
          // console.log(response);
          if (response != '') {
            alert(response);
          } else {
            window.location.reload();
          }
        }
  );
}


</script>
</body>
</html>