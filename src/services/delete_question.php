<?php
declare(strict_types = 1);

// PDOの設定を呼び出す
require('../dbconnect.php');

if(isset($_POST['id'])) {
  $id = $_POST['id'];

  try {
    $sql = "DELETE FROM questions WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    header('Location: ../admin/index.php');
    exit();

  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
}
?>