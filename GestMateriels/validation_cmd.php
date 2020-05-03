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
 
    <?php  echo $_GET["email"] ; ?>

<?php
    if(isset($_GET['id_cmd']))
    {
       
        echo "entre ";

        $req = $bdd->prepare('SELECT * FROM demande WHERE id_demande = :id_demande');
       
            $req->execute(array(
                'id_demande' => $_GET["id_cmd"]));
            $resultat_r_demande = $req->fetch();



            $req = $bdd->prepare('SELECT * FROM materiel WHERE id_materiel = :id_materiel');
       
            $req->execute(array(
                'id_materiel' => $resultat_r_demande["id_materiel_d"]));
            $resultat_r_materiel = $req->fetch();



            $niveau_val = "Commande validée" ;

           // echo "le libelle service set :" .$resultat_service['lib_service'];

        if ( $resultat_r_demande['niveau'] != $niveau_val)
        {
          
              

                    $stocks_final = $resultat_r_materiel['quantite_stocks'] - $resultat_r_demande['quantite_cmd'] ;

                    if($stocks_final>=0)
                    {
                        $reponse = $bdd->prepare('UPDATE materiel SET quantite_stocks = :quantite_stocks WHERE
                        lib_materiel = :lib_materiel');
                            $reponse -> execute(array(
                            'lib_materiel' => $resultat_r_materiel['lib_materiel'],
                            'quantite_stocks' => $stocks_final
                        ));

                 

                        $reponse1 = $bdd->prepare('UPDATE demande SET niveau = :niveau WHERE
                        id_demande = :id_demande');
                            $reponse1 -> execute(array(
                            'id_demande' => $resultat_r_demande['id_demande'],
                            'niveau' => $niveau_val
                ));
                    }        
       } 
      
    }
   header("location: gestion.php");
?>