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
//formulaire de traitement d'ajout de materiel
    if(isset($_POST['lib_materiel']) AND isset($_POST['quantite_stocks']))
    {
        $req = $bdd->prepare('SELECT * FROM materiel WHERE lib_materiel = :lib_materiel');
            
        $req->execute(array(
            'lib_materiel' => $_POST["lib_materiel"]));
        $resultat_r_materiel = $req->fetch();

        if($_POST['action'] == "modifier")
        {
            echo "entre ";

                    

                           $stocks_final = $_POST['quantite_stocks'] ;
                            $reponse = $bdd->prepare('UPDATE materiel SET quantite_stocks = :quantite_stocks WHERE
                        lib_materiel = :lib_materiel');
                            $reponse -> execute(array(
                            'lib_materiel' => $_POST['lib_materiel'],
                            'quantite_stocks' => $stocks_final
                        ));

                        echo $_POST['quantite_stocks'];
        }
        else
        {
           
                            $stocks_final = $_POST['quantite_stocks'] + $resultat_r_materiel['quantite_stocks'] ;
                            $reponse = $bdd->prepare('UPDATE materiel SET quantite_stocks = :quantite_stocks WHERE
                        lib_materiel = :lib_materiel');
                            $reponse -> execute(array(
                            'lib_materiel' => $_POST['lib_materiel'],
                            'quantite_stocks' => $stocks_final
                        ));

                        echo $stocks_final;
                
        }
        
    }
    header("location: gestion.php");
?>