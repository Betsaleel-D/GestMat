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
    if(isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['servic']) AND isset($_POST['email']) AND isset($_POST['pass']) AND isset($_POST['pass2']))
    {
        echo "entre ";

        $req = $bdd->prepare('SELECT * FROM employe WHERE email = :email');
       
            $req->execute(array(
                'email' => $_POST["email"]));
            $resultat_empleye = $req->fetch();


            $req = $bdd->prepare('SELECT * FROM services  WHERE sigle = :sigle');
            $req->execute(array(
                'sigle' => $_POST["servic"]));
            $resultat_service = $req->fetch();

           // echo "le libelle service set :" .$resultat_service['lib_service'];

        if ($_POST['email'] != $resultat_empleye['email'])
        {
           //verification de la conformité de l'email
            if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']))
            {
                if($_POST['pass'] == $_POST['pass2'])
                {
                     echo " et insertion";   
                    $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);

                    // Tranformer les information Majuscule
                    $nom = strtoupper($_POST['nom']);
                    $prenom = ucfirst($_POST['prenom']);
                    $accreditation = 1;

                    $reponse = $bdd->prepare('INSERT INTO employe (nom, prenom, email, pass, id_service_empl, accreditation) VALUES
                     (:nom, :prenom, :email, :pass, :id_service_empl, :accreditation)');
                    $reponse -> execute(array(
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'email' => $_POST['email'],
                    'pass' => $pass_hache,
                    'id_service_empl' => $resultat_service['id_service'],
                    'accreditation' => $accreditation
                  ));
                 
             header("location: connexion.php");  
                }
                else 
                {
                
                echo "echec";

                }
           }
           else 
            {
            
            echo "echec de mail";

            }
       }
    } 
?>