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
   
?>

<?php
    

    if( isset($_POST['email'])  AND isset($_POST['pass']))
    {
       // $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
       // echo $pass_hache;
       // echo "  entre ";
        

        $req = $bdd->prepare('SELECT * FROM employe WHERE email = :email');
       
            $req->execute(array(
                'email' => $_POST["email"]));
            $resultat = $req->fetch();

           // echo $resultat['pass'];

          // echo $resultat['nom'];
           
            $pass_Recup = password_verify($_POST['pass'], $resultat['pass']);
        //    echo $resultat['pass'];

         //   echo "et********" .$resultat['nom'] .$resultat['id_service_empl'];
            
                if ($pass_Recup) 
                {
                    
                    $_SESSION['Auth'] = Array(
                        'pass' => $resultat['pass'],
                        'nom' => $resultat["nom"],
                        'prenom' => $resultat["prenom"],
                        'email' => $resultat["email"],
                        'id_service_empl' => $resultat['id_service_empl']
                    );

                   //echo $_SESSION['Auth']['nom'];

                   // echo $resultat['pass'];
                    
                header("location: compte.php");
                   
                }
                else 
                {
                   // header("location: connexion.php");
                   
                ?> <p class='MauvaisPass'> <?php echo ' Mauvais identifiant ou mot de passe !'; ?> </p>
                    <?php include("connexion.php");
                }
    }
    
?>