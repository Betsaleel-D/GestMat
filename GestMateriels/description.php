

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
		 if(isset($_SESSION['pseudo']))
		 {
		?>
			<div class="tete1">
            	<p class="bien"><strong>Employé : <?php echo $_SESSION{'id_employe'};?></strong></p>
				<p class="bien"><strong>Employé : <?php echo $_SESSION{'Nom'};?></strong></p>	
        		<div class='Banniere'>
				<p class="banne">GESTION DES MATERIELS</p>	
			<p class="banne2"> <a href="envoie_message.php">Messagerie</a></p>
			<p class="banne2"><a href="commande.php">Commande</a></p>	
				</div>
        	</div>
		<?php
		}
		else
		{
			?>
			<div class="tete1">
			<p class="banne">GESTION DES MATERIELS</p>	
			<p class="banne2"> <a href="inscription.php">Inscrivez-vous</a></p>
			<p class="banne2"><a href="connexion.php">Connexion</a></p>	
		<?php
		}
		
		?>
	</div>
</article>
</body>
</html>