<?php
require './config/database.php';

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

    //Vérification du pseudo
		//
		// $pseudo_free = $bdd->prepare("SELECT pseudo FROM users WHERE pseudo =:pseudo");
		// $pseudo_free ->execute(array(
		// 	'pseudo' => $pseudo
		// ));
		// $free_pseudo = $pseudo_free->fetchAll();
		// if (!empty($free_pseudo))
		// {
		// 	$pseudo_erreur1 = "Votre pseudo est déjà utilisé par un membre";
		// 	$i++;
		// }

		/* Verifier si l'adresse e-mail existe déjà */
		$req_email=$bdd->prepare('SELECT COUNT(*) AS nbr FROM users WHERE email =:email');
		$req_email->bindValue(':email',$email, PDO::PARAM_STR);
		$req_email->execute();
		$email_free=($req_email->fetchColumn()==0)?1:0;
		$req_email->CloseCursor();

	/* Verifier si le pseudo existe déjà */
    $query=$bdd->prepare('SELECT COUNT(*) AS nbr FROM users WHERE pseudo =:pseudo');
    $query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
    $query->execute();
    $pseudo_free=($query->fetchColumn()==0)?1:0;
    $query->CloseCursor();
    if($pseudo != NULL && !$pseudo_free)
    {
        echo "Votre pseudo est déjà utilisé par un membre";
    }
		else if ($email != NULL && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
	    echo "Cette adresse email est invalide.";
		}
		else if ($email != NULL && !$email_free)
		{
			echo "Votre adresse e-mail est déjà utilisée par un membre";
		}
		else if ($pass != $confirm || !isset($confirm) || !isset($pass))
		{
			echo "Votre mot de passe et votre confirmation diffèrent, ou sont vides";
		}
		else if ($pass != NULL && !preg_match('/[A-Za-z]+[0-9]/', $pass))
		{
			echo "Votre mot de passe doit être composé de lettres ET de chiffres";
		}
		else if ($pseudo && $pass) {
			$pass = md5($pass);
			$req = $bdd->prepare("INSERT INTO users (pseudo, password, email) VALUES (:pseudo, :password, :email)");
			$req -> execute(array(
				'pseudo' => $pseudo,
				'password' => $pass,
				'email' => $email
			));
			// echo "acces ok";

			if ($req)
			{

			// 	$cle = md5(microtime(TRUE)*100000);
			//
			//
			// // Insertion de la clé dans la base de données (à adapter en INSERT si besoin)
			// $stmt = $bdd->prepare("UPDATE users SET cle=:cle WHERE pseudo like :pseudo");
			// $stmt->bindParam(':cle', $cle);
			// $stmt->bindParam(':pseudo', $pseudo);
			// $stmt->execute();
			//
			//
			// // Préparation du mail contenant le lien d'activation
			// $destinataire = $email;
			// $sujet = "Activer votre compte" ;
			// $entete = "From: inscription@camagru.com" ;
			//
			// // Le lien d'activation est composé du login(log) et de la clé(cle)
			// $message = 'Bienvenue sur Camagru,
			//
			// Pour activer votre compte, veuillez cliquer sur le lien ci dessous
			// ou copier/coller dans votre navigateur internet.
			//
			// http://localhost/Camagru/index.php?log='.urlencode($pseudo).'&cle='.urlencode($cle).'
			//
			//
			// ---------------
			// Ceci est un mail automatique, Merci de ne pas y répondre.';


			// mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail

			// $pseudo = $_GET['log'];
			// $cle = $_GET['cle'];
			//
			// // Récupération de la clé correspondant au $login dans la base de données
			// $stmt = $bdd->prepare("SELECT cle,actif FROM users WHERE pseudo like :pseudo ");
			// if($stmt->execute(array(':pseudo' => $pseudo)) && $row = $stmt->fetch())
			//   {
			//     $clebdd = $row['cle'];	// Récupération de la clé
			//     $actif = $row['actif']; // $actif contiendra alors 0 ou 1
			//   }
			//
			//
			// // On teste la valeur de la variable $actif récupéré dans la BDD
			// if($actif == '1') // Si le compte est déjà actif on prévient
			//   {
			//      echo "Votre compte est déjà actif !";
			//   }
			// else // Si ce n'est pas le cas on passe aux comparaisons
			//   {
			//      if($cle == $clebdd) // On compare nos deux clés
			//        {
			//           // Si elles correspondent on active le compte !
			//           echo "Votre compte a bien été activé !";
			//
			//           // La requête qui va passer notre champ actif de 0 à 1
			//           $stmt = $dbh->prepare("UPDATE membres SET actif = 1 WHERE login like :login ");
			//           $stmt->bindParam(':login', $login);
			//           $stmt->execute();
			//        }
			//      else // Si les deux clés sont différentes on provoque une erreur...
			//        {
			//           echo "Erreur ! Votre compte ne peut être activé...";
			//        }
			//   }
		header('Location: ./index.php');
		exit();
	}
	else {
		echo 'erreur requete';
	}

		}

?>
