<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>管理画面</title>

  <link rel="stylesheet" href="../../scss/style.css">
  <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&family=Plus+Jakarta+Sans:wght@400;700&display=swap"
    rel="stylesheet">
</head>

<body>
  <!-- start header -->
  <header class="admin__header">
    <h1>クイズ管理画面</h1>
  </header>
  <!-- end header -->

  <!-- start main -->
  <main class="admin__main">

    <div class="admin__signin">
      <h2>サインイン</h2>
      <?php if (!empty($_SESSION)) { ?>
        <ul>
          <?php foreach ($_SESSION['err_msg'] as $message) { ?>
            <li class="error-message"><?= $message ?></li>
          <?php } ?>
        </ul>
      <?php } ?>
      <form action="../../services/signin.php" method="post">
        <input type="text" class="admin__signin__input" name="email" placeholder="メールアドレスを入力してください" require>
        <input type="text" class="admin__signin__input" name="password" placeholder="パスワードを入力してください" require>
        <input type="submit" value="サインイン">
      </form>
    </div>


  </main>
</body>

</html>

<?php
$_SESSION = [];
session_destroy();
?>
