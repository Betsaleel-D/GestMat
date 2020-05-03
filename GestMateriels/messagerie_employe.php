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
                        <div>
                            <form action="messagerie.php" method = "post" >   
                            <legend>Veillez selctionner le materiel</legend>
                                <select name="lib_materiel" id="materiel" >
                                <?php 
                                    $req = $bdd->query('SELECT * FROM materiel');
                                                    
                                while ( $resultat = $req->fetch()) { 
                                ?>
                                <option><?php echo $resultat["lib_materiel"]; } ?></option>
                                </select>
                                <button type="submit" class="btn_verif">Vérifier</button>
                            </form>
                        </div>

                    <?php


                    if(isset($_POST['lib_materiel']))
                    {
                    $req = $bdd->prepare('SELECT * FROM materiel WHERE lib_materiel = :lib_materiel');

                    $req->execute(array(
                        'lib_materiel' => $_POST['lib_materiel']
                    ));
                    $resultat_demande = $req->fetch();
                    ?>

                    <div>
                        <table class='table_verif'>
                            <tr>
                                <th>Materiel</th>
                                <th>Quantité Disponible</th>
                            </tr>
                            <tr>
                                    <td><?php echo $resultat_demande['lib_materiel'];?></td>
                                    <td><?php echo $resultat_demande['quantite_stocks'];?></td>
                                </tr>
                        </table>
                    </div>
                    <?php
                    } 
                }   
                    ?>   
            
        
                <div id ="comptMC">
                        <p class = "comptMsg"><a href="messagerie.php">Envoyer un Message</a></p>
                        <p class = "comptCmd" ><a href="commande.php">Faire une commande</a></p> 
                </div>
                <div>
                    <p>
                    <img src="commande.png" alt="commande" class="imgDesc">
                        n répandue, le Lorem Ipsum n'est pas simplement du texte aléatoire. Il trouve ses racines dans une oeuvre de la littérature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie, s'est intéressé à un des mots latins les plus obscurs, consectetur, extrait d'un passage du Lorem Ipsum, et en étudiant tous les usages de ce mot dans la littérature classique, découvrit la source incontestable du Lorem Ipsum. Il provient en fait des sections 1.10.32 et 1.10.33 du "De Finibus Bonorum et Malorum" (Des Suprêmes Biens et des Suprêmes Maux) de Cicéron. Cet ouvrage, très populaire pendant la Renaissance, est un traité sur la théorie de l'éthique. Les premières lignes du Lorem Ipsum, "Lorem ipsum dolor sit amet...", proviennent de la section 1.10.32.
                        L'extrait standard de Lorem Ipsum utilisé depuis le XVIè siècle est reproduit ci-dessous pour les curieux. Les sections 1.10.32 et 1.10.33 du "De Finibus Bonorum et Malorum" de Cicéron sont aussi reproduites dans leur version originale, accompagnée de la traduction anglaise de H. Rackham (1914).	
                    </p>
                </div>
            </section>
             <article id="Id_article">
            <div class="form_email">
            <form action="traitement_email.php" method = "post" >

                    <fieldset>
                    <legend>Envoie de mail</legend>
                  
                        <div>
                            <label for="titre">Titre du mail</label>
                            <input type="text" name="titre" id="titre">
                        </div>
                        <div>
                            <label for="email">Adesse mail</label>
                            <input type="text" name="email" id="email">
                        </div>

                        <div>
                            <label for="message">Rigiger le message</label>
                            <textarea name="message" id="message" cols="30" rows="10"></textarea>
                        </div>
                        <button type="submit">Envoyer</button>
                    </fieldset>
                    </form>
            </div>
            <?php

            if(!empty($_SESSION['Auth']))
            {
            $req = $bdd->query('SELECT employe.nom, employe.prenom, employe.email, materiel.lib_materiel, demande.quantite_cmd, demande.commentaire, demande.niveau, date_cmd
            FROM employe, demande, materiel 
            where employe.id_employe = demande.id_employe_d
            and materiel.id_materiel = demande.id_materiel_d
            order by date_cmd ASC
            ');
            ?>
                <div id= 'table_cmd'>
                
                    <table class='table_msg'>
                    <tr>
                            <th class='titre_tb_mcd' colspan="6"> <strong>Table des Commandes</strong></th>
                    </tr>
                        <tr>
                            <th> <strong>Nom et Prénom</strong></th>
                            <th> <strong>Email</strong></th>
                            <th> <strong>Materiel Commandé</strong></th>
                            <th><strong>Quantités Commandées</strong></th>
                            <th>Commentaires</th>
                            <th>Niveau</th>
                            <th>Répondre</th>
                        </tr>
                        <?php 
                                while($resultat_t_msg = $req->fetch()) 
                                {
                            ?>
                        <tr>
                            <td><?php echo $resultat_t_msg['nom'] .'  ' .$resultat_t_msg['prenom'];?></td>
                            <td><?php echo $resultat_t_msg['email'];?></td>
                            <td><?php echo $resultat_t_msg['lib_materiel'];?></td>
                            <td class="ion-text-center"><?php echo $resultat_t_msg['quantite_cmd'];?></td>
                            <td><?php echo $resultat_t_msg['commentaire'];?></td>
                            <td><?php echo $resultat_t_msg['niveau'];?></td>
                            <td> <a href="envoie_message.php">Répondre</a> </td>
                        </tr>
                    <?php
                            }
                    ?>
                    </table>
                </div>
                <div class="form_email">
            <form action="traitement_email.php" method = "post" >

                    <fieldset>
                    <legend>Envoie de mail</legend>
                  
                        <div>
                            <label for="titre">Titre du mail</label>
                            <input type="text" name="titre" id="titre">
                        </div>
                        <div>
                            <label for="email">Adesse mail</label>
                            <input type="text" name="email" id="email">
                        </div>

                        <div>
                            <label for="message">Rigiger le message</label>
                            <textarea name="message" id="message" cols="30" rows="10"></textarea>
                        </div>
                        <button type="submit">Envoyer</button>
                    </fieldset>
                    </form>
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