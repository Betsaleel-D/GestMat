<!DOCTYPE HTML>
<HTML>
    <HEAd>
        <TITLe>inscription</TITLe>
        <link rel="stylesheet" href="style.css">
    </HEAd>
    <body>
    <div id="page_complet">

        
        <header id="contHeader">
			<?php include("../contenu/entete.php");?>
        </header>


        <div id="corps">

        <section id="id_section">
        <form action="traitement_inscription.php" method="post" class = "form">

        <fieldset>
            <legend>Inscription</legend>

            <div>
                <label for="nom"> Nom</label>
                <input type="text" name="nom" id="nom" >
            </div>

            <div>
                <label for="prenom">Prenom</label>
                <input type="text" name="prenom" id="prenom" >
            </div>

            <div>
                <label for="email">Adresse Mail</label>
                <input type="text" name="email" id="email" >
            </div>

           
            <label for="servic">Service</label>
					<select name="servic" id="servic" class="service">	
							<option value="SA">SA</option>
							<option value="SE">SE</option>
					</select>
            <div>

                <label for="pass">Votre Mot de Passe</label>
                <input type="text" name="pass" id="pass" >
            </div>
            <div>
                <label for="pass2">Confirmer Votre Mot de Passe</label>
                <input type="password" name="pass2" id="pass2" >
            </div>
           <div>
           <button type="submit">Enregistrer</button>
           </div>
        </fieldset>
        </form>
        </section>

        <?php include("../contenu/description.php"); ?>
    
        

    </div>
         <header class="pied">
			<?php include("../contenu/pied.php");?>
        </header>
    </div>
    </body>
</HTML>