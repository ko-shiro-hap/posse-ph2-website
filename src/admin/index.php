<?php
declare(strict_types = 1);

// PDOの設定を呼び出す
require('../dbconnect.php');

// 全問題の取り出し
$questions = $dbh->query("SELECT * FROM questions")->fetchAll(PDO::FETCH_ASSOC);
// 全選択肢の取り出し
$choices = $dbh->query("SELECT * FROM choices")->fetchAll(PDO::FETCH_ASSOC);

// 問題に対応する選択肢を、問題の配列の中にさらに配列で入れ込む
foreach ($choices as $key => $choice) {
  // $indexに$choice["question_id"]が$questionsのidと同じ場合、そのidを返している（foreachだから1~6まで）
  $index = array_search($choice["question_id"], array_column($questions, 'id'));
  // $questionsの$index番目にchoicesという連想配列を作り、$choiceを格納
  $questions[$index]["choices"][] = $choice;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>管理画面</title>

  <link rel="stylesheet" href="../scss/style.css">
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
        <a href="./users/invitation.php">
          <li class="admin__sidebar__item">ユーザー招待</li>
        </a>
        <a href="">
          <li class="admin__sidebar__item">問題一覧</li>
        </a>
        <a href="./questions/create.php">
          <li class="admin__sidebar__item">問題作成</li>
        </a>
      </ul>
    </div>
    <!-- end sidebar -->

    <!-- start questions -->
    <div class="admin__questions">
      <h2>問題一覧</h2>
      <table class="admin__questions__table">
        <tr>
          <th>ID</th>
          <th>問題</th>
          <th></th>
        </tr>

        <!-- 問題ごとに繰り返す -->
        <?php
      foreach ($questions as $index => $question) :

        // 問題の配列の中身をそれぞれ変数に格納する
        $question_id = $question['id'];
        $question_content = $question['content'];
      ?>
        <tr>
          <td><?= $question_id ?></td>
          <td>
            <a href="./questions/edit.php?id=<?= $question["id"] ?>">
                <?= $question_content ?>
            </a>
          </td>
          <form method="POST" action="../services/delete_question.php">
            <td>
              <input type="hidden" name="id" value="<?= $question['id'] ?>">
              <button type="submit">削除</button>
            </td>
          </form>
        </tr>
        <?php endforeach; ?>

      </table>
    </div>


  </main>
</body>

</html>
