<?php
declare(strict_types = 1);

// PDOの設定を呼び出す
require('../dbconnect.php');

$content = $_POST['content'];
$supplement = isset($_POST['supplement']) ? $_POST['supplement'] : null;
$choice1 = $_POST['choice1'];
$choice2 = $_POST['choice2'];
$choice3 = $_POST['choice3'];
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
    // questionsテーブルにデータを入れる
    $questions_sql = "INSERT INTO questions (content, image, supplement) VALUES (:content, :image, :supplement)";
    $questions_stmt = $dbh->prepare($questions_sql);
    $questions_stmt->bindParam(":content", $content);
    $questions_stmt->bindParam(":image", $image_name);
    $questions_stmt->bindParam(":supplement", $supplement);
    $questions_stmt->execute();

    // choicesテーブルにデータを入れる
    // choices=テーブル末尾のquestion_idを取得する
    $last_question_id = $dbh->query("SELECT id FROM questions ORDER BY id DESC")->fetch();
    $insert_question_id = $last_question_id['id'];
    $valid_true = 1;
    $valid_false = 0;

    for ($i = 1; $i <= 3 ; $i++) {
      $choice = 'choice' . $i;

      $choices_sql = "INSERT INTO choices (question_id, name, valid) VALUES (:question_id, :name, :valid)";
      $choices_stmt = $dbh->prepare($choices_sql);
      $choices_stmt->bindParam(":question_id", $insert_question_id);
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
