
<?php
session_start();
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
    
    if(isset($_POST['lib_materiel']) AND isset($_POST['quantite']) AND isset($_POST['commentaire']))
    {
        //echo "entre ";

        $req = $bdd->prepare('SELECT * FROM employe WHERE email = :email');
       
            $req->execute(array(
                'email' => $_SESSION["Auth"]['email']));
            $resultat_empleye = $req->fetch();


            //echo 'le llib est' .$_POST['lib_materiel'];


            $req = $bdd->prepare('SELECT * FROM materiel  WHERE lib_materiel = :lib_materiel');
            $req->execute(array(
                'lib_materiel' => $_POST['lib_materiel']));
            $resultat_materiel = $req->fetch();

           // echo "le libelle service set :" .$resultat_materiel['id_materiel'];

      
           /*determination de id_commande
                        $req = $bdd->query('SELECT MAX(id_commande) as id_cmd FROM demande');
                      
                        $resultat_id_cmd = $req->fetch();
                        $id = $resultat_id_cmd['id_cmd'] + 1;

*/
        
$date=date("Y.m.d.H:i:s");
//echo $date;
$niveau = "En cours";
    $reponse = $bdd->prepare('INSERT INTO demande (id_materiel_d, id_employe_d, 
    quantite_cmd,commentaire ,date_cmd, niveau) VALUES(:id_materiel_d, :id_employe_d, :quantite, :commentaire, 
    :date_cmd, :niveau)');
    $reponse -> execute(array(
    'id_materiel_d' => $resultat_materiel['id_materiel'],
    'id_employe_d' => $resultat_empleye["id_employe"],
    'quantite' => $_POST['quantite'],
    'commentaire' => $_POST['commentaire'],
    'date_cmd' => $date,
    'niveau' => $niveau
    ));
    
                header("location: compte.php");            
    }
   
    
?>