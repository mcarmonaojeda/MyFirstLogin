<?php
  session_start();
  if (isset($_SESSION['user_id'])) {
    header('Location: /Proyecto5to');
  }
  require 'database.php';
  if (!empty($_POST['name_user']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT idUsuario, NomUsuario, Email, Clave FROM Usuarios WHERE NomUsuario = :name_user');
    $records->bindParam(':name_user', $_POST['name_user']);
    $records->execute(); 
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $message = '';
	if ($results) {
         if (password_verify($_POST['password'], $results['Clave'])) {
         	$_SESSION['user_id'] = $results['idUsuario'];
      		header("Location: /Proyecto5to");
            /*if ($results['tipo_cuenta'] == 'Administrador') {
                $_SESSION['usuario'] = $usuario;

                header("Location:administrador.php");

            } else if($results['tipo_cuenta'] == 'Usuario'){

                $_SESSION['usuario'] = $usuario;
                header("Location:usuario.php");
            }*/
		} else {
            $message = 'Sorry, those credentials do not match';
    	}
	} else {
 		   $message = 'Sorry, User doesnt exist';
	}
  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sign in</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<?php 
	require 'partials/header.php' 
	?>
	<h1>Sign in</h1>
	<span>or <a href="signup.php">SignUp</a> </span>
    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

	<form action="login.php" method="post">
		<input type="text" name="name_user" placeholder="Enter your name user" id="name_user">
		<input type="password" name="password" placeholder="Enter your password" id="passwd">
		<input type="submit" value="Send">
	</form>
</body>
</html>