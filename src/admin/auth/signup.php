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
    <a href="">ログアウト</a>
  </header>
  <!-- end header -->

  <!-- start main -->
  <main class="admin__main">

    <!-- start sidebar -->
    <div class="admin__sidebar">
      <ul class="admin__sidebar__items">
        <a href="../users/invitation.php">
          <li class="admin__sidebar__item">ユーザー招待</li>
        </a>
        <a href="../index.php">
          <li class="admin__sidebar__item">問題一覧</li>
        </a>
        <a href="#">
          <li class="admin__sidebar__item">問題作成</li>
        </a>
      </ul>
    </div>
    <!-- end sidebar -->

    <div class="admin__signup">
      <h2>ユーザー登録</h2>
      <form action="../../services/signup.php" method="post">
        <input type="text" class="admin__signup__input" name="name" placeholder="ユーザーネームを入力してください">
        <input type="text" class="admin__signup__input" name="email" placeholder="メールアドレスを入力してください">
        <input type="text" class="admin__signup__input" name="password" placeholder="パスワードを入力してください">
        <input type="submit" value="登録">
      </form>
    </div>


  </main>
</body>

</html>
