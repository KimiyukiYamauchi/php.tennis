<?php
$fp = fopen("test.txt", "w");
if ($fp) {
  // fwrite($fp, "書き込みテスト１行目\n");
  // fwrite($fp, "書き込みテスト２行目");
  $contents = "書き込みテスト１行目\n書き込みテスト２行目";
  file_put_contents("test.txt", $contents);
  fclose($fp);
  echo '書き込みました。';
} else {
  echo 'エラーが起きました。';
}