<?php
  session_start();
  require 'database.php';
  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT idUsuario, NomUsuario, Email, Clave FROM Usuarios WHERE idUsuario = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $user = null;
    if (count($results) > 0) {
      $user = $results;
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Welcome to admin access</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<?php require 'partials/header.php'?>
	<?php if(!empty($user)): ?>
      <br> Welcome. <?= $user['NomUsuario']; ?>
      <br>You are Successfully Logged In
      <a href="logout.php">
        Logout
      </a>
    <?php else: ?>
      <h1>Please choose</h1>

      <a href="login.php">Sign in</a> or
      <a href="signup.php">Sign up</a>
    <?php endif; ?>
</body>
</html>
