<meta charset="utf-8" />
<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/style_form.css" />
<link rel="stylesheet" type="text/css" href="css/main.css" />
<link rel="stylesheet" type="text/css" href="css/demo_form.css" />
<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
<title>Camagru - Connexion/Inscription</title>
<?php
// session_start();
// $titre="connection";

require "header.php";
require_once "./config/database.php";


if (!isset($_POST['pseudo'])) //On est dans la page de formulaire
{
?>

<section>
  <div id="container_demo" >
    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

	<div id="wrapper">
		<div id="login" class="animate form">
				<form method="post" action="connection.php" autocomplete="on">
						<h1>Connexion</h1>
						<p>
							<label for="pseudo" >Votre pseudo</label>
							<input name="pseudo" type="text" id="pseudo_login" required="required" placeholder="Pseudo" />
						</p>
						<p>
							<label for="password" class="youpasswd">Votre mot de passe </label>
							<input type="password" name="password" required="required" id="password" placeholder="Mot de passe"/>
						</p>
						<!-- <p class="keeplogin">
						<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" />
						<label for="loginkeeping">Keep me logged in</label>
						</p> -->
						<p class="login button">
								<input type="submit" value="Ok" />
						</p>
						<p>
							<a id="forgot_password">Mot de passe oublié ?</a>
						</p>
						<p class="change_link">
							 Pas encore inscrit ?
							<a href="#toregister" class="to_register">S'inscrire</a>
						</p>
				</form>
		</div>
		<div id="register" class="animate form" >
				<form  method="post" action="register.php" autocomplete="off" enctype="multipart/form-data" onsubmit="return verifForm(this)">
						<h1> Inscription </h1>
						<p>
								<label for="pseudo" >Votre pseudo</label>
								<input name="pseudo" type="text" id="pseudo" required="required" placeholder="Pseudo" onkeyup="verifPseudo(this)" />
						</p>
						<p>
								<label for="email">Votre email</label>
								<input name="email" id="email" required="required" type="email" placeholder="Adresse email" onkeyup="verifMail(this)"/>
						</p>
						<p>
								<label for="password">Votre mot de passe (au minimum une lettre ET un chiffre)</label>
								<input type="password" name="password" id="passw" required="required" placeholder="Entrez un mot de passe" onkeyup="verifPass(this)"/>
						</p>
						<p>
								<label for="confirm">Confirmation du mot de passe </label>
								<input type="password" name="confirm" id="confirm" required="required" placeholder="Veuillez confirmer le mot de passe" onkeyup="verifConfirm(this)"/>
						</p>
						<p class="signin button">
							<input type="submit" value="Enregister"/>
						</p>
						<p class="change_link">
							Déjà membre ?
							<a href="#tologin" class="to_register"> Se connecter </a>
						</p>
				</form>
			</div>
			</div>
</div>
</section>
<?php

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
//On récupère les variables
$i = 0;

if (isset($_POST['pseudo']))
  $pseudo = test_input($_POST['pseudo']);
else
  $pseudo = "";

if (isset($_POST['email']))
  $email = $_POST['email'];
else
  $email = "";

if (isset($_POST['password']))
	$pass = $_POST['password'];
else
  $pass = "";

if (isset($_POST['confirm']))
  $confirm = $_POST['confirm'];
else
  $confirm = "";
//
// 		/* Verifier si l'adresse e-mail existe déjà */
// 		$req_email=$bdd->prepare('SELECT COUNT(*) AS nbr FROM users WHERE email =:email');
// 		$req_email->bindValue(':email',$email, PDO::PARAM_STR);
// 		$req_email->execute();
// 		$email_free=($req_email->fetchColumn()==0)?1:0;
// 		$req_email->CloseCursor();
//
// 	/* Verifier si le pseudo existe déjà */
//     $query=$bdd->prepare('SELECT COUNT(*) AS nbr FROM users WHERE pseudo =:pseudo');
//     $query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
//     $query->execute();
//     $pseudo_free=($query->fetchColumn()==0)?1:0;
//     $query->CloseCursor();
//     if($pseudo != NULL && !$pseudo_free)
//     {
//         echo "Votre pseudo est déjà utilisé par un membre";
//     }
// 		else if ($email != NULL && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
// 	    echo "Cette adresse email est invalide.";
// 		}
// 		else if ($email != NULL && !$email_free)
// 		{
// 			echo "Votre adresse e-mail est déjà utilisée par un membre";
// 		}
// 		else if ($pass != $confirm || !isset($confirm) || !isset($pass))
// 		{
// 			echo "Votre mot de passe et votre confirmation diffèrent, ou sont vides";
// 		}
// 		else if ($pass != NULL && !preg_match('/[A-Za-z]+[0-9]/', $pass)) /* Verifier la sécurité */
// 		{
// 			echo "Votre mot de passe doit être composé de lettres ET de chiffres";
// 		}
// 		else if ($pseudo && $pass) {
// 			$pass = md5($pass);
// 			$req = $bdd->prepare("INSERT INTO users (pseudo, password, email) VALUES (:pseudo, :password, :email)");
// 			$requete = $req -> execute(array(
// 				'pseudo' => $pseudo,
// 				'password' => $pass,
// 				'email' => $email
// 			));
// 		}
	}
//On reprend la suite du code
else
{
    $message='';
    if (empty($_POST['pseudo']) || empty($_POST['password']) ) //Oubli d'un champ
    {
        $message = '<p>une erreur s\'est produite pendant votre identification.
	Vous devez remplir tous les champs</p>
	<p>Cliquez <a href="./connection.php">ici</a> pour revenir</p>';
    }
    else //On check le mot de passe
    {
        $query=$bdd->prepare('SELECT * FROM users WHERE pseudo = :pseudo');
        $query->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
        $query->execute();
        $data=$query->fetch();
				// var_dump($data);
	if ($data['password'] == md5($_POST['password'])) // Acces OK !
	{
	    $_SESSION['pseudo'] = $data['pseudo'];
	    $_SESSION['id'] = $data['id'];

	    $message = '<p>Bienvenue '.$data['pseudo'].',
			vous êtes maintenant connecté!</p>
			';
			header('Location: ./main_page.php');
	  	exit();
	}
	else // Acces pas OK !
	{
	    $message = '<p>Une erreur s\'est produite
	    pendant votre identification.<br /> Le mot de passe ou le pseudo
            entré n\'est pas correct.</p><p>Cliquez <a href="./connection.php">ici</a>
	    pour revenir à la page précédente
	    <br /><br />Cliquez <a href="./index.php">ici</a>
	    pour revenir à la page d accueil</p>';
	}
    $query->CloseCursor();
    }
    echo $message.'</div></body></html>';


}

require "footer.php" ?>
<script src="js/verif_champs.js"></script>
