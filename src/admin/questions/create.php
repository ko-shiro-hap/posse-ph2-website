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
        <a href="">
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

    <!-- start questions -->
    <div class="admin__questions">
      <h2>問題作成</h2>
      <form method="POST" action="/../../services/create_question.php" enctype="multipart/form-data">
        <p class="admin__create__text">問題文:</p>
        <input type="text" class="admin__input" name="content" placeholder="問題文を入力してください" >

        <p class="admin__create__text">選択肢:</p>
        <input type="text" class="admin__input" name="choice1" placeholder="選択肢1を入力してください" >
        <input type="text" class="admin__input" name="choice2" placeholder="選択肢2を入力してください" >
        <input type="text" class="admin__input" name="choice3" placeholder="選択肢3を入力してください" >

        <p class="admin__create__text">正解の選択肢:</p>
        <div class="admin__choices">
        <select name="valid">
          <option value="" selected disabled></option>
          <option value="1">選択肢1</option>
          <option value="2">選択肢2</option>
          <option value="3">選択肢3</option>
        </select>
      </div>

        <p class="admin__create__text">問題の画像:</p>
        <input type="file" class="admin__file" name="image">

        <p class="admin__create__text">補足:</p>
        <input type="text" class="admin__input" name="supplement" placeholder="補足を入力してください">

        <input type="submit" class="admin__create__submit" value="作成">
      </form>
    </div>

  </main>
</body>

</html>
