

<html>
	<head>
	<link rel='stylesheet' href='style.css'>
	</head>
	<body>
			<div id='entete'>
				<img src="woumiah.png" alt="woumiah" class="woumiah_logo">


					<?php

					try
					{
						$bdd = new PDO('mysql:host=localhost;dbname=gestionmateriels;charset=utf8', 'root','');
					}
					catch(Exception $e)
					{
						die('Erreur' .$e->getMessage());
					}           
					?>

				<?php

				if (!empty($_SESSION['Auth'])) 
					{
						$req = $bdd->prepare('SELECT * FROM employe WHERE email =:email');
					
						$req->execute(array(
							'email' => $_SESSION["Auth"]['email']
						));
						$resultat = $req->fetch();
						
						?>
									<nav>
										<ul>
											<li><a href="../compte.php">Compte</a></<a></li>
											<li><a href="controle_messagerie.php" class="MessageColor">Messagerie <?php echo "3" ; ?></a></li>
											<li><a href="index.php">Accueil</a></li>
											<li><a href="deconnexion.php">Deconnexion</a></li>
										</ul>
									</nav>
						<?php    
						
					} 
					else
					{
					?>						
								<nav>
									<ul>
										
										<li><a href="index.php">Accueil</a></li>
										<li><a href="pages/connexion.php">Connexion</a></li>
										<li><a href="pages/inscription.php">Inscription</a></li>
									</ul>
								</nav>
					<?php			
					}
				
					?>
					
				</div>
				
					<!--Bannière de la page--->
				<div class="cont">
						<img src="baniere2.jpg" alt="baniere" class="image">
						<p class="texte_centrer_ban">WOUMIAH TECHNOLOGIE !</p>
				</div>
	</body>
</html>