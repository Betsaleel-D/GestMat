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

                ?> 
                    <div id= 'id_section'>

                    
                 
                <?php

                    if(isset($_GET['id_cmd']) && isset($_GET['lib_materiel']))
                    {
                ?>       
                       <div>
                       <?php
                       //Selection des information liées à une commande
                            $reponse = $bdd->prepare('SELECT * FROM demande WHERE id_demande = :id_demande');
                            $reponse -> execute(array(
                            'id_demande' => $_GET['id_cmd']
                            ));
                            $resultat_t_demande = $reponse->fetch();
                            
                            ?>
                            <p><strong>Les messages liés à ma commande</strong></p>
                            <p><strong>Réference commande :</strong> N°000<?php echo $_GET['id_cmd'];?></p>
                            <p><strong>Materiel :</strong> <?php echo $_GET['lib_materiel'];?></p>
                            <p><strong>Commentaire :</strong> <?php echo $resultat_t_demande['commentaire'];?></p>

                            <p>*************************************************</p>

                                <?php 
                                    $reponse = $bdd->prepare('SELECT * FROM messagerie WHERE id_demande_m = :id_demande ORDER by id_messagerie DESC');
                                    $reponse -> execute(array(
                                    'id_demande' => $_GET['id_cmd']
                                    ));
                                        while($resultat_t_msg = $reponse->fetch()) 
                                        {          
                                ?>  <p class='ligne_color'> <?php echo $resultat_t_msg['prenom_emetteur'];?> </p>

                                    <p><?php echo $resultat_t_msg['titre'] .' - ' .$resultat_t_msg['date_message'];?></p>

                                    <p><?php echo $resultat_t_msg['messages'];?></p>
                                
                                    <a href="envoie_message.php ?email=<?php echo $resultat_t_msg['email_recepteur'];?>&id_cmd=<?php echo $resultat_t_msg['id_demande_m'];?>&prenom_emetteur=<?php echo $_SESSION['Auth']['prenom'];?>">Répondre</a> </<a>
                                    
                                <?php
                                }
                                ?>
                       </div>
                       <?php
                        }
                        else
                        {
                         ?>
                            <p>Messagerie General</p>


                            <?php 
                                    $reponse = $bdd->prepare('SELECT * FROM messagerie WHERE email_emetteur= :email_emetteur ORDER by id_messagerie DESC');
                                    $reponse -> execute(array(
                                    'email_emetteur' => $_SESSION['Auth']['email']
                                    ));
                                        while($resultat_t_msg = $reponse->fetch()) 
                                        { 
                                                    
                                ?>  
                                    <!--<p><?php //echo $resultat_t_msg['lib_materiel'];?></p> -->
                                    <p class='ligne_color'> <?php echo $resultat_t_msg['prenom_emetteur'];?> </p>

                                    <p><?php echo $resultat_t_msg['titre'] .' - ' .$resultat_t_msg['date_message'];?></p>

                                    <p><?php echo $resultat_t_msg['messages'];?></p>
                                
                                    <a href="envoie_message.php ?email=<?php echo $resultat_t_msg['email_recepteur'];?>&id_cmd=<?php echo $resultat_t_msg['id_demande_m'];?>&prenom_emetteur=<?php echo $_SESSION['Auth']['prenom'];?>">Répondre</a> </<a>
                                    
                                <?php
                                }
                                ?>
                         <?php   
                        } 
                       ?>
                          
                    </div>                                      
        </div>
        
        <header class="pied">
			<?php include("pied.php");?>
        </header>
    </div>
    </body>
</HTML>