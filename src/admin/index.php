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

// 問題をシャッフルする
$count = range(1, count($questions));
shuffle($questions);
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

</body>

</html>