<!DOCTOTYPE HTML>
<head>
	<title>acceuil</title>
	<meta charset=UTF-8>
	<link rel="stylesheet" href="style.css">	
</head>

<body>

<article id="Id_article">
	<img src="GImage.jpg" alt="gestion" class="image2">

<div>
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
				
				<div class='Banniere'>
				<p class="banne">GESTION DES MATERIELS</p>	
			

		<?php


			

			if (!empty($_SESSION['Auth'])) 
                {
                    $req = $bdd->prepare('SELECT * FROM employe WHERE email =:email');
                 
                    $req->execute(array(
                        'email' => $_SESSION["Auth"]['email']
                    ));
                    $resultat = $req->fetch();
               
                     if($resultat['accreditation'] == 2) 

                    {
					?>

						
						<p class="banne2"> <a href="controle_messagerie.php">Messagerie</a></p>
						<p class="banne2"><a href="gestion.php">Gestion des Commandes</a></p>
						<p class="banne2"><a href="compte.php">Mon compte</a></p>
                    <?php    
                    }
                    elseif($resultat['accreditation'] == 1)
                    { 
					?>
						<p class="banne2"><a href="commande.php">Commander</a></p>
						<p class="banne2"> <a href="controle_messagerie.php">Messagerie</a></p>
						<p class="banne2"><a href="compte_commande_employes.php">Mes Commandes</a></p>
						<p class="banne2"><a href="compte.php">Mon compte</a></p>
					<?php
                    }    
		?>
        			
				</div>
        	</div>
		<?php

		}
		else
		{
			?>
			<div class="tete1">	
			<p class="banne2"> <a href="inscription.php">Inscrivez-vous</a></p>
			<p class="banne2"><a href="connexion.php">Connexion</a></p>
			


		<?php
		}
		
		?>
</div>
</article>
</body>
</html>