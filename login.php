<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

//echo !empty($_POST);
/*
if(!empty($_POST)){
	if($utilisateur['mail'] == $_POST['mail']){
		if($utilisateur['password'] == $_POST['pass']){
			$msg = "Bien connecté";
		}
		else {
			$msg = "Mot de passe incorrect";
			$mailTmp = $_POST['mail'];
		}
	}
	else {
		$msg = "Adresse mail inconnue";
	}
}
*/
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=blog_e_commerce;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$mailTmp="";
$msg = "";

if(!empty($_POST)){
    // On récupère le $_POST['mail'] et le $_POST['pass']
    $mail = $_POST['mail'];
    $password = $_POST['pass'];

    // On regarde si $_POST['mail'] est connu dans la table user
    $req = $bdd->prepare('SELECT id FROM user WHERE mail= :mail');
    $req->bindParam(':mail', $mail);
    $req->execute();
    // Un fetch n'affiche qu'une seule ligne de la BDD
    // Un fetchAll affiche toutes les lignes de la BDD
    // On récupère un objet
    $result = $req->fetch();
    // SI oui
    if(!empty($result)){
        // On regarde si $_POST['pass'] correspond au pass de $_POST['mail']
        $req = $bdd->prepare('SELECT id FROM user WHERE mail= :mail AND password= :password');
        $req->bindParam(':mail', $mail);
        $req->bindParam(':password', $password);
        $req->execute();
        $result2 = $req->fetch();

        // Si oui
        if(!empty($result2)){
            $msg = "Bien connecté";
        }
        else {
            // Si non
            $msg = "Mot de passe incorrect";
            $mailTmp = $_POST['mail'];
        }
    }
    else{
        // Si non
        $msg = "Adresse mail inconnue";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V3</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST">
					<span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="mail" name="mail" placeholder="Adresse mail" value="<?=$mailTmp?>" >
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>
					<span><?=$msg?></<span>
					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="#">
							Forgot Password?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>