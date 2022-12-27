<?php
declare(strict_types = 1);

// PDOの設定を呼び出す
require('../dbconnect.php');

$selected_question_id = $_POST['question_id'];
$content = $_POST['content'];
$supplement = isset($_POST['supplement']) ? $_POST['supplement'] : null;
$valid = $_POST['valid'];

// // 画像のアップロード
if (!empty($_FILES['image']['size'])) {
  $image_name = uniqid(chr(mt_rand()), true) . '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);
  $image_path = '../img/quiz/' . $image_name;
  move_uploaded_file(
    $_FILES['image']['tmp_name'],
    $image_path
  );
} else {
  echo 'アップロードに失敗しました';
  die();
}

  try {
    // questionsテーブルにデータを更新
    $questions_sql = "UPDATE questions SET content = :content, image= :image, supplement = :supplement WHERE id = :id";
    $questions_stmt = $dbh->prepare($questions_sql);
    $questions_stmt->bindParam(":content", $content);
    $questions_stmt->bindParam(":image", $image_name);
    $questions_stmt->bindParam(":supplement", $supplement);
    $questions_stmt->bindParam(":id", $selected_question_id);
    $questions_stmt->execute();

    // choicesテーブルは古いデータを削除した後に、新しいデータを追加する
    // 削除
    $choices_sql = "DELETE FROM choices WHERE question_id = :id";
    $choices_stmt = $dbh->prepare($choices_sql);
    $choices_stmt->bindParam(":id", $selected_question_id);
    $choices_stmt->execute();

    // 追加
    $valid_true = 1;
    $valid_false = 0;

    for ($i = 1; $i <= 3 ; $i++) {
      $choice = $_POST["choice$i"];

      $choices_sql = "INSERT INTO choices (question_id, name, valid) VALUES (:question_id, :name, :valid)";
      $choices_stmt = $dbh->prepare($choices_sql);
      $choices_stmt->bindParam(":question_id", $selected_question_id);
      $choices_stmt->bindParam(":name", $choice);
      // 問題作成時に正解として選択された選択肢のみvalidに1を入れる
      if ($i == $valid) {
        $choices_stmt->bindParam(":valid", $valid_true);
      } else {
        $choices_stmt->bindParam(":valid", $valid_false);
      }
      $choices_stmt->execute();
    }

    header('Location: ../admin/index.php');
    exit();

  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
?>
