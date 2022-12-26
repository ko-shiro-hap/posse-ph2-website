<?php
declare(strict_types = 1);

// PDOの設定を呼び出す
require('../dbconnect.php');

$content = $_POST['content'];
$image = $_POST['image'];
$supplement = isset($_POST['supplement']) ? $_POST['supplement'] : null;
$choice1 = $_POST['choice1'];
$choice2 = $_POST['choice2'];
$choice3 = $_POST['choice3'];
$valid = $_POST['valid'];

// echo $content;
// echo $image;
// echo $supplement;
// echo  $choice1;
// echo  $choice2;
// echo  $choice3;
// echo $valid;



  try {
    // questionsテーブルにデータを入れる
    $questions_sql = "INSERT INTO questions (content, image, supplement) VALUES (:content, :image, :supplement)";
    $questions_stmt = $dbh->prepare($questions_sql);
    $questions_stmt->bindParam(":content", $content);
    $questions_stmt->bindParam(":image", $image);
    $questions_stmt->bindParam(":supplement", $supplement);
    $questions_stmt->execute();

    // choicesテーブルにデータを入れる
    $last_question_id = $dbh->query("SELECT id FROM questions ORDER BY id DESC")->fetch();
    $insert_question_id = $last_question_id['id'] + 1;

    for ($i=1; $i <= 3 ; $i++) {
      $choice = 'choice' . $i;

      $choices_sql = "INSERT INTO choices (question_id, name, valid) VALUES ((select id from questions where id = :question_id), :name, :valid)";
      $choices_stmt = $dbh->prepare($choices_sql);
      $choices_stmt->bindParam(":question_id", $insert_question_id);
      $choices_stmt->bindParam(":name", $choice);
      $choices_stmt->bindParam(":valid", $valid);
      $choices_stmt->execute();
    }

    header('Location: ../admin/index.php');
    exit();

  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
?>
