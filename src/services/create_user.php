<?php
declare(strict_types = 1);

// PDOの設定を呼び出す
require('../dbconnect.php');

$invited_email = $_POST['email'];

try {
    $emails = $dbh->query("SELECT email FROM users")->fetchAll(PDO::FETCH_ASSOC);

    foreach ($emails as $key => $email) {
      if($email == $invited_email) {
        header('Location: ../admin/user/invitation.php');
        exit();
      }
    }

    // なぜかエラーメッセージが出るため,先にリダイレクトさせてからメールを送信させる
    header('Location: ../admin/index.php');

    // メール送信処理
    mb_language('ja');
    mb_internal_encoding('UTF-8');

    $from = 'from@example.com';
    $to   = $invited_email;
    $subject = '招待URL';
    $body = 'https://example.com';

     // 変換したい文字列のエンコーディングをセット
    mb_internal_encoding('UTF-8');
    // 送信元名称
    $from = mb_convert_encoding($from, "UTF-8");
    // 本文
    $body = mb_convert_encoding($body, "UTF-8");
    // メールヘッダー
    $head .= "From: " . '"' . $from . '"' . " <{$from}> \r\n";
    $head .= "Return-Path: " . '"' . $from . '"' . " <{$from}> \r\n";
    $head .= "Reply-To: " . '"' . $from . '"' . " <{$from}> \r\n";
    $head .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $param = "-f " . $from;
    $param .= "MIME-Version: 1.0\n";
    $param .= "Content-Transfer-Encoding: BASE64\n";
    $param .= "Content-Type: text/plain; charset=UTF-8\n";
    // メール送信
    mb_send_mail($to, $subject, $body, $head, $param);

    exit();

  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
?>
