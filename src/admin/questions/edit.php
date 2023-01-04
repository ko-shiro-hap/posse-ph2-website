<?php
  session_start();

  if (empty($_SESSION['user_name'])) {
    $_SESSION['err_msg'] = array('サインインしてください');
      header('Location: ./auth/signin.php');
      exit;
  }

  // urlで直接飛んできた場合に問題一覧にリダイレクトさせる
  if (!isset($_REQUEST["id"])) {
    header('Location: ../index.php');
    die();
  }

  // PDOの設定を呼び出す
  require('../../dbconnect.php');

  // クエリパラメータで取得したidと一致するデータを取得する
  $questions_sql = "SELECT * FROM questions WHERE id = :id";
  $questions_stmt = $dbh->prepare($questions_sql);
  $questions_stmt->bindParam(":id", $_REQUEST["id"]);
  $questions_stmt->execute();
  $question = $questions_stmt->fetch();

  $choices_sql = "SELECT * FROM choices WHERE question_id = :id";
  $choices_stmt = $dbh->prepare($choices_sql);
  $choices_stmt->bindParam(":id", $_REQUEST["id"]);
  $choices_stmt->execute();
  $choices = $choices_stmt->fetchAll();

  // 正解の選択肢のindexを格納し、selectで表示させる文字列を作る
  foreach ($choices as $index => $choice) {
    if ($choice["valid"] == 1) {
      $correct_choice_index = $index;
      $correct_choice_option = "選択肢" . $correct_choice_index + 1;
    }
  }
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
    <a href="../../services/signout.php">ログアウト</a>
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
        <a href="./create.php">
          <li class="admin__sidebar__item">問題作成</li>
        </a>
      </ul>
    </div>
    <!-- end sidebar -->

    <!-- start questions -->
    <div class="admin__questions">
      <h2>問題編集</h2>
      <form method="POST" action="/../../services/update_question.php" enctype="multipart/form-data">
        <input type="hidden" name="question_id" value="<?= $question["id"] ?>">
        <p class="admin__create__text">問題文:</p>
        <input type="text" class="admin__input" name="content" value="<?= $question["content"] ?>" >

        <?php foreach ($choices as $index => $choice) { ?>
        <p class="admin__create__text">選択肢:</p>
        <input type="text" class="admin__input" name="choice<?= $index + 1 ?>" value="<?= $choice["name"] ?>" >
        <?php } ?>

        <p class="admin__create__text">正解の選択肢:</p>
        <div class="admin__choices">
        <select name="valid"required>
          <option value="<?= $correct_choice_index + 1 ?>" selected disabled><?= $correct_choice_option ?></option>
          <option value="1">選択肢1</option>
          <option value="2">選択肢2</option>
          <option value="3">選択肢3</option>
        </select>
      </div>

        <p class="admin__create__text">問題の画像:</p>
        <input type="file" class="admin__file" name="image" >

        <p class="admin__create__text">補足:</p>
        <input type="text" class="admin__input" name="supplement" value="<?= $question["supplement"] ?>" placeholder="補足を入力してください">

        <input type="submit" class="admin__create__submit" value="作成">
      </form>
    </div>

  </main>
</body>

</html>
