<?php
declare(strict_types = 1);

// PDOの設定を呼び出す
require('../dbconnect.php');

$users_data = $dbh->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);

//セッションを使う
session_start();

// 変数の初期化
$email = '';
$password = '';
$err_msg = array();

// POST送信があるかないか判定
if (!empty($_POST)) {
  // 各データを変数に格納
  $email = $_POST['email'];
  $password = $_POST['password'];

  // eメールアドレスバリデーションチェック
  // 空白チェック
  if ($email === '') {
    $err_msg[] = 'メールアドレスは入力必須です';
  }
  // 文字数チェック
  if (strlen($email) > 255) {
    $err_msg[] = 'メールアドレスは255文字で入力してください';
  }
  // パスワードバリデーションチェック
  // 空白チェック
  if ($password === '') {
    $err_msg[] = 'パスワードは入力必須です';
  }
  // 文字数チェック
  if (strlen($password) > 255 || strlen($password) < 5) {
    $err_msg[] = 'パスワードは６文字以上２５５文字以内で入力してください';
  }
  // 形式チェック
  if (!preg_match("/^[a-zA-Z0-9]+$/", $password)) {
    $err_msg[] = 'パスワードは半角英数字で入力してください';
  }
}

//バリデーションチェックに問題がなければ、
//$err_msgの中身が空なのでチェックを行う
if(empty($err_msg)){
    foreach ($users_data as $user_data) {
      $database_user_name = $user_data['name'];
      $database_user_email = $user_data['email'];
      $database_user_password = $user_data['password'];

      if($database_user_password === $password && $database_user_email === $email){
        //セッションにユーザーネームを挿入する
        $_SESSION['user_name'] = $database_user_name;
        //マイページへ遷移
        header('Location: ../admin/index.php');
        exit;
      } else {
        $err_msg[] = 'メールアドレスまたはパスワードが違います';
      }
    }
  } else {
    $err_msg[] = 'メールアドレスまたはパスワードが違います';
  }

  $_SESSION['err_msg'] = $err_msg;
  // var_dump($_SESSION);
  header('Location: ../admin/auth/signin.php');
  exit;

?>
