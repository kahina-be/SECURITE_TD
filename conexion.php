<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=minitchat;','root','root');
$recupUsers = $bdd->query('SELECT * FROM utilisateursss');

if (isset($_POST['valider'])){
    if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){
        $pseudo_default = "admin";
        $mdp_default = "admin123";
        


        
        $pseudo_saisi = htmlspecialchars($_POST['pseudo']);
        $mdp_saisi = htmlspecialchars($_POST['mdp'] );
        

        if($pseudo_saisi == $pseudo_default AND $mdp_saisi == $mdp_default){
            $_SESSION['admin'] = $mdp_saisi;
            $_SESSION['peudo'] = $pseudo_saisi;
            header('Location: accueil.php');
            
            
        }else 
        {
            while($user = $recupUsers->fetch()){
                if($pseudo_saisi == $user['pseudonyme'] AND $mdp_saisi == password_verify($_POST['mdp'], $user['motdepasse']))
                {
                    $_SESSION['mdp'] = $mdp_saisi;
                    $_SESSION['peudo'] = $pseudo_saisi;
                    header('Location: accueil.php');
                }
            }
            echo "identifiant ou mot de passe incorrect";
        }
            

    }else {
        echo "vous devez completer tous les champs";
    }
}
?>
<!DOCTYPE html >
<html> 
<head>
	<title>Espace de connexion admin</title>
	<meta charset="utf-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	
</head>

<body>
<div class="p-3 mb-2 bg-secondary text-white">
	<header>
  <nav>
  <ul>
    <li><a href="inscription.php" class="btn btn-success">Inscription</a></li>
  </ul>
  </nav>
</header>

	<form method="POST" action="">
		<div align="center">
			<br><br>
			<h1>Connexion</h1>
			<br><br>
			<input type="text" name="pseudo" placeholder=" pseudo">
			<br><br>
			<input type="password" name="mdp" placeholder=" mot de passe">
			<br><br>
			<input type="submit" name="valider" value="valider" class="btn btn-primary">
		</div>
	</form>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	</div>
</body>

</html>