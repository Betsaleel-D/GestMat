<?php
session_start();
?>

<!DOCTYPE HTML>
<HTML>
    <HEAd>
        <TITLe>compte</TITLe>
        <link rel="stylesheet" href="style.css">
    </HEAd>
    <body>
    <div id="page_complet">

        
        <header id="contHeader">
			<?php include("entete.php");?>
        </header>


        <div id="corps">

            <section id="id_section">
                <div id="msg">

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

               
                if (empty($_SESSION['Auth'])) 
                {
                    echo "Vous ne disposez pas de compte veillez vous inscrire";
                } 
                else 
                {
                   
                    $req = $bdd->prepare('SELECT * FROM employe WHERE nom =:nom');
                 
                    $req->execute(array(
                        'nom' => $_SESSION["Auth"]['nom']
                    ));
                    $resultat = $req->fetch();
                ?>
               
                    <form action="traitement_commande.php" method = "post" >

                    <fieldset>
                    <legend>commande</legend>
                    <label for="materiel">Materiel</label>
                    <select name="lib_materiel" id="materiel" >
                        <?php 
                            $req = $bdd->query('SELECT * FROM materiel');
                                            
                        while ( $resultat = $req->fetch()) { 
                        ?>
                        <option><?php echo $resultat["lib_materiel"]; } ?></option>
                        </select>

                        <div>
                            <label for="qte">Quantite</label>
                            <input type="number" name="quantite" id="qte" class ="label_qte">
                        </div>

                        <div>
                            <label for="commentaire">Rigiger le message</label>
                            <textarea name="commentaire" id="commentaire" cols="30" rows="10"></textarea>
                        </div>
                        <button type="submit">Envoyer</button>
                    </fieldset>
                    </form>

               <div id ="comptMC">
                 <p class = "comptMsg"><a href="message.php">Envoyer un Message</a></p>
               <p class = "comptCmd" ><a href="commande.php">Faire une commande</a></p> 
               </div>

               <img src="commande.png" alt="commande" class="imgDesc">
				n répandue, le Lorem Ipsum n'est pas simplement du texte aléatoire. Il trouve ses racines dans une oeuvre de la littérature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie, s'est intéressé à un des mots latins les plus obscurs, consectetur, extrait d'un passage du Lorem Ipsum, et en étudiant tous les usages de ce mot dans la littérature classique, découvrit la source incontestable du Lorem Ipsum. Il provient en fait des sections 1.10.32 et 1.10.33 du "De Finibus Bonorum et Malorum" (Des Suprêmes Biens et des Suprêmes Maux) de Cicéron. Cet ouvrage, très populaire pendant la Renaissance, est un traité sur la théorie de l'éthique. Les premières lignes du Lorem Ipsum, "Lorem ipsum dolor sit amet...", proviennent de la section 1.10.32.
				L'extrait standard de Lorem Ipsum utilisé depuis le XVIè siècle est reproduit ci-dessous pour les curieux. Les sections 1.10.32 et 1.10.33 du "De Finibus Bonorum et Malorum" de Cicéron sont aussi reproduites dans leur version originale, accompagnée de la traduction anglaise de H. Rackham (1914).
				
			</p>
                
               
                <?php
                    
                }
                ?>

                </div>
            </section>

            <?php include("description.php"); ?>
        </div>
        

    </div>
         <header class="pied">
			<?php include("pied.php");?>
        </header>
    </body>
</HTML>