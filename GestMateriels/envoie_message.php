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
                   
                        ?>
                        <form action="traitement_envoie_message.php ?email=<?php echo $_GET['email'];?>&id_cmd=<?php echo $_GET['id_cmd'];?>&prenom_emetteur=<?php echo $_GET['prenom_emetteur'];?>" method = "post" >
                        <fieldset>
                        <legend>Envoie de message</legend>
                            <div>
                                <label for="titre">Titre du message</label>
                                <input type="text" name="titre" id="titre">
                            </div>
                             <div>
                                <label for="message">Ridiger votre message</label>
                                <textarea name="message" id="message" cols="30" rows="10"></textarea>
                            </div>
                            <button type="submit">Envoyer</button>
                        </fieldset>
                        </form>
            <?php
                    }
                   
                ?>
    </div>
         <header class="pied">
			<?php include("pied.php");?>
        </header>
        </div>
    </body>
</HTML>