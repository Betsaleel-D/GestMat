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


        
            <section>
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

                    <!--Table commande-->
                    <?php

                    if(!empty($_SESSION['Auth']))
                    {
                        //Commande effectuées par les employés SE
                    $req = $bdd->query('SELECT demande.id_demande, employe.nom, employe.prenom, employe.email, materiel.lib_materiel, demande.quantite_cmd, demande.commentaire, demande.niveau, date_cmd
                    FROM employe, demande, materiel 
                    where employe.id_employe = demande.id_employe_d
                    and materiel.id_materiel = demande.id_materiel_d
                    order by demande.id_demande DESC
                    ');
                    ?>
               
                    <div class='table_cmd'>

                        <table class='table_msg'>
                        <tr>

                                <th class='titre_table' colspan="8"> <strong>Table des Commandes</strong></th>
                        </tr>
                            <tr>
                                <th> <strong>Nom et Prénom</strong></th>
                                <th> <strong>Email</strong></th>
                                <th> <strong>Materiel Commandé</strong></th>
                                <th><strong>Quantités Commandées</strong></th>
                                <th><strong>Commentaires</strong></th>
                                <th><strong>Etat</strong></th>
                                <th><strong>Validation</strong></th>
                                <th colspan="2"><strong>Messagerie</strong></th>
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
                                <td><strong><?php echo $resultat_t_msg['niveau'];?></strong></td>
                                <td><a href="validation_cmd.php ?id_cmd=<?php echo $resultat_t_msg['id_demande'];?>&email=<?php echo $resultat_t_msg['email'];?>">Valider</a></td>
                                <td> <a href="envoie_message.php ?email=<?php echo $resultat_t_msg['email'];?>&id_cmd=<?php echo $resultat_t_msg['id_demande'];?>&prenom_emetteur=<?php echo $_SESSION['Auth']['prenom'];?>">Envoyer un Message</a> </td>
                                <td><a href="messagerie.php ?id_cmd=<?php echo $resultat_t_msg['id_demande'];?>&lib_materiel=<?php echo $resultat_t_msg['lib_materiel'];?>"><strong>Consulter</strong></a></td>
                            </tr>
                        <?php
                                }
                        ?>
                        </table>
                    </div>
                 
                    <p class = "ligne_color">.</p>
                    <?php

                    }
                    ?>                           
            </section>
            <article id="Id_article_cmpt2">
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
        <div class="verification">
            <!--Formulaire de verification du stocks disponible-->
            <fieldset class ="fieldset_verif">    
            <legend>Vérification du stock disponible</legend>
                    <div class="verif_stock">
                            <form action="gestion.php" method = "post" >   
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
                    else
                    {
                    ?>

                    <div class='table_verif'>
                        <table>
                            <tr>
                                <th>Materiel</th>
                                <th>Quantité Disponible</th>
                            </tr>
                            <tr>
                                    <td>Veillez Selctionner un materiel</td>
                                    <td>Aucune selection</td>
                                </tr>
                        </table>
                    </div>

                    <?php
                    }
                    }   
                    ?> 
                </fieldset>
        </div>
                    <!--Ajout d'un Materiel-->
        <div class ="ajout_m">
                    <form action="insertion_materiel.php" method = "post" >
                        <fieldset>
                        <legend>Ajout d'un materiel</legend>
                            <div>
                                <label for="lib_materiel">Libelle</label>
                                <input type="text" name="lib_materiel" id="lib_materiel">
                            </div>
                            <div>
                                <label for="quantite">Quantité</label>
                                <input type="text" name="quantite_stocks" id="emaiquantitel">
                            </div>

                            <button type="submit">Ajouter</button>
                        </fieldset>
                </form>
        </div>   
                           
    </article>                            
    


    <p class = "ligne_color">.</p>
                    <!--Formulaire de modification ou d'Ajout d'un Materiel-->
        <div class ="ajout_m">
                    <form action="modifier_ajouter_materiel.php" method = "post" >
                        <fieldset>
                        <legend>Ajout ou Modification</legend>
                            <div>
                                <label for="lib_materiel">Libelle</label>
                                <select name="lib_materiel" id="materiel" >
                                <?php 
                                    $req = $bdd->query('SELECT * FROM materiel');
                                                    
                                while ( $resultat = $req->fetch()) { 
                                ?>
                                <option><?php echo $resultat["lib_materiel"]; } ?></option>
                                </select>
                               
                            </div>
                            <div>
                                <label for="quantite">Quantité</label>
                                <input type="text" name="quantite_stocks" id="emaiquantitel">
                            </div>

                            

                            <button type="submit">Valider</button>
                            <div class="larg_bouton">
                            <input type="radio" name = "action" value = "ajout" class="taill_radio">
                            <label for="ajout" class="labe_radio">Ajout</label>
                         

                          
                           <input type="radio" name = "action" value = "modifier"class="taill_radio">
                            <label for="modifier" class="labe_radio">Modifier</label>
                           </div>
                        </fieldset>
                </form>
        </div>   


         <header class="pied">
			<?php include("pied.php");?>
        </header>
    </div>
</body>
</HTML>