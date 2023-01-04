<?php
declare(strict_types = 1);

// PDOの設定を呼び出す
require('../dbconnect.php');

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];


  try {
    $emails = $dbh->query("SELECT email FROM users")->fetchAll(PDO::FETCH_ASSOC);

    foreach ($emails as $key => $searched_email) {
      if($searched_email == $email) {
        header('Location: ../admin/user/invitation.php');
        exit();
      }
    }

    $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->execute();

    header('Location: ../admin/index.php');
    exit();

  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }
?>
