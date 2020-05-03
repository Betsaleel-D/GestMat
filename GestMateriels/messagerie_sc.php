<?php
session_start();
?>

<!DOCTYPE HTML>
<HTML>
    <HEAd>
        <TITLe>compte</TITLe>
        <link rel="stylesheet" href="style.css">
    </HEAd>
    <BODY>

    <div id="page_complet">
        
        <header id="contHeader">
			<?php include("entete.php");?>
        </header>


        <div id="corps">
            <section id="id_section">
                <div id="msg">

                <?php
/*********Connexion*************** */
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

                if(!empty($_SESSION['Auth']))
                {
                   ?>
                <div>
                    <p>
                    <img src="commande.png" alt="commande" class="imgDesc">
                        n répandue, le Lorem Ipsum n'est pas simplement du texte aléatoire. Il trouve ses racines dans une oeuvre de la littérature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie, s'est intéressé à un des mots latins les plus obscurs, consectetur, extrait d'un passage du Lorem Ipsum, et en étudiant tous les usages de ce mot dans la littérature classique, découvrit la source incontestable du Lorem Ipsum. Il provient en fait des sections 1.10.32 et 1.10.33 du "De Finibus Bonorum et Malorum" (Des Suprêmes Biens et des Suprêmes Maux) de Cicéron. Cet ouvrage, très populaire pendant la Renaissance, est un traité sur la théorie de l'éthique. Les premières lignes du Lorem Ipsum, "Lorem ipsum dolor sit amet...", proviennent de la section 1.10.32.
                        L'extrait standard de Lorem Ipsum utilisé depuis le XVIè siècle est reproduit ci-dessous pour les curieux. Les sections 1.10.32 et 1.10.33 du "De Finibus Bonorum et Malorum" de Cicéron sont aussi reproduites dans leur version originale, accompagnée de la traduction anglaise de H. Rackham (1914).	
                    </p>
                </div>
            </section>
             <article id="Id_article">
                <div id= 'table_cmd'>
                
                    <table class='table_msg'>
                    <tr>
                            <th class='titre_tb_mcd' colspan="6"> <strong>Table des Commandes</strong></th>
                    </tr>
                        <tr>
                            <th> <strong>Email</strong></th>
                            <th> <strong>Titre</strong></th>
                            <th> <strong>Messages</strong></th>
                            <th> <strong>Date et Heure</strong></th>
                            <th>Répondre</th>
                        </tr>
                        <?php 

                        $reponse = $bdd->prepare('SELECT * FROM messagerie WHERE email_emetteur = :email_emetteur ORDER by id_messagerie DESC');
                        $reponse -> execute(array(
                        'email_emetteur' => $_SESSION['Auth']['email'] 
                        ));

                                while($resultat_t_msg = $reponse->fetch()) 
                                {     
                                
                        ?>
    
                        <tr>
                           
                            <td><?php echo $resultat_t_msg['email_recepteur'];?></td>
                            <td><?php echo $resultat_t_msg['titre'];?></td>
                            <td><?php echo $resultat_t_msg['messages'];?></td>
                            <td><?php echo $resultat_t_msg['date_message'];?></td>
                            <td> <a href="envoie_message.php ?email=<?php echo $resultat_t_msg['email_recepteur'];?>">Répondre</a> </td>
                        </tr>
                    <?php
                            }
                    ?>
                    </table>
                </div>
                
                <div id ="comptMC">
                                        <p class = "comptMsg"><a href="envoie_message.php? email=<?php echo $resultat_t_msg['email_recepteur']; ?>">Envoyer un Message</a></p>
                                        <p class = "comptCmd" ><a href="commande.php">Faire une commande</a></p> 
                                </div>

                </article>
                <?php
                }

                ?> 
                
        </div>
    </div>
         <header class="pied">
			<?php include("pied.php");?>
        </header>
    </body>
</HTML>