<?php
	require 'database.php';

	$message = '';
  	if (!empty($_POST['email']) && !empty($_POST['name_user']) && !empty($_POST['password']) && !empty($_POST['pais'])) {
    	$sql = "INSERT INTO Usuarios (NomUsuario, Clave, Email, Pais) VALUES (:name_user, :password, :email, :pais)";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':name_user', $_POST['name_user']);
    	$stmt->bindParam(':email', $_POST['email']);
    	$stmt->bindParam(':pais', $_POST['pais']);
    	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    	$stmt->bindParam(':password', $password);
    if ($stmt->execute()) {
    	echo "<script>
                alert('Successfully created new user');
    		</script>";
      header("Location: /Proyecto5to");
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sign up</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

	<?php require 'partials/header.php'?>
	<?php require 'Db.php'?>

	<?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

	<h1>Sign up</h1>

	<span>or <a href="login.php">Sign in</a> </span>

	<form action="signup.php" method="post">
		<input type="text" name="email" placeholder="Enter your email" id="email">
		<input type="text" name="name_user" placeholder="Choose name user" id="name_user">
		<input type="password" name="password" placeholder="Enter your password" id="passwd">
		<input type="password" name="confirm_password" placeholder="Confirm your password" id="confirm_passwd">
		<select name="pais">
        <option value="0">Choose a country:</option>
        <?php
        	$db = new Db();
        	$query ="SELECT * FROM Paises";
        	$result = $db->mysqli_select($query);
          while ($valores = mysqli_fetch_array($result)) {
            echo '<option value="'.$valores[idPais].'">'.$valores[NomPais].'</option>';
          }
        ?>
       </select>
		<input type="submit" value="Send">
	</form>

</body>
</html>