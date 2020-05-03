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
			<?php include("./pages/entete.php");?>
        </header>


        <div id="corps">
            
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

            <!--Virifier si la session n'est pas vide-->
            <?php
            if(!empty($_SESSION['Auth']))
            {
            // Recupération des commandes effection par un employé
            $req = $bdd->prepare('SELECT demande.id_demande, materiel.lib_materiel, demande.quantite_cmd, demande.commentaire, demande.niveau, date_cmd
            FROM employe, demande, materiel 
            where employe.id_employe = demande.id_employe_d
            and materiel.id_materiel = demande.id_materiel_d
            and employe.email = :email
            order by date_cmd ASC
            ');
             $req -> execute(array(
                'email' => $_SESSION['Auth']['email']));
            ?>  
                <div id='table_cmd_empl'>
              
                    <table class='table_envoye'>
                    <tr>
                            <th class='titre_table' colspan="6"> <strong>Table des Commandes</strong></th>
                    </tr>
                        <tr>
                         
                            <th> <strong>Materiel Commandé</strong></th>
                            <th><strong>Quantités Commandées</strong></th>
                            <th>Commentaires</th>
                            <th>Etat</th>
                            <th><strong>Envoyer un message</strong></th>
                            <th><strong>Messagerie</strong></th>
                          
                        </tr>
                        <?php 
                                while($resultat_t_msg = $req->fetch()) 
                                {
                            ?>
                        <tr>
                           
                            <td><?php echo $resultat_t_msg['lib_materiel'];?></td>
                            <td class="ion-text-center"><?php echo $resultat_t_msg['quantite_cmd'];?></td>
                            <td><?php echo $resultat_t_msg['commentaire'];?></td>
                            <td><strong><?php echo $resultat_t_msg['niveau'];?></strong></td>
                            <td> <a href="envoie_message.php ?email=<?php echo $_SESSION['Auth']['email'];?>&id_cmd=<?php echo $resultat_t_msg['id_demande'];?>&prenom_emetteur=<?php echo $_SESSION['Auth']['prenom'];?>">Répondre</a> </td>
                            <td><a href="messagerie.php ?id_cmd=<?php echo $resultat_t_msg['id_demande'];?>&lib_materiel=<?php echo $resultat_t_msg['lib_materiel'];?>"><strong>Consulter</strong></a></td>
                         
                        </tr>
                    <?php
                            }
                    ?>
                    </table>                   
                </div>
                <?php
                }

                ?>
                <!--Description--> 
                <div id ="comptMC">
                        <p class = "comptCmd" ><a href="commande.php">Faire une commande</a></p> 
                </div>
                <div>
                    <p>
                    <img src="commande.png" alt="commande" class="imgDesc">
                        n répandue, le Lorem Ipsum n'est pas simplement du texte aléatoire. Il trouve ses racines dans une oeuvre de la littérature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie, s'est intéressé à un des mots latins les plus obscurs, consectetur, extrait d'un passage du Lorem Ipsum, et en étudiant tous les usages de ce mot dans la littérature classique, découvrit la source incontestable du Lorem Ipsum. Il provient en fait des sections 1.10.32 et 1.10.33 du "De Finibus Bonorum et Malorum" (Des Suprêmes Biens et des Suprêmes Maux) de Cicéron. Cet ouvrage, très populaire pendant la Renaissance, est un traité sur la théorie de l'éthique. Les premières lignes du Lorem Ipsum, "Lorem ipsum dolor sit amet...", proviennent de la section 1.10.32.
                        L'extrait standard de Lorem Ipsum utilisé depuis le XVIè siècle est reproduit ci-dessous pour les curieux. Les sections 1.10.32 et 1.10.33 du "De Finibus Bonorum et Malorum" de Cicéron sont aussi reproduites dans leur version originale, accompagnée de la traduction anglaise de H. Rackham (1914).	
                    </p>
                </div>
            </div>               
        </div>
    
         <header class="pied">
			<?php include("./pages/pied.php");?>
        </header>
    </div>
</body>
</HTML>