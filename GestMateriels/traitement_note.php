<?php
    session_start();
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=ges_note;charset=utf8', 'root','');
    }
    catch(Exception $e)
    {
        die('Erreur' .$e->getMessage());
    }           
?>


<?php
   function division($nombre1, $nombre2)
   {
     

     return $resultat ;
   }
?>

<?php
    

    if(isset($_POST['français']) AND isset($_POST['anglais']) AND isset($_POST['svt']) AND isset($_POST['math']) AND isset($_POST['physique']) AND isset($_POST['hist_geo']))
    {
        echo "entre ";

    
           //echo "Pseudo existant"; 

           // Recupécation du pseudo

      
    $pseudo = $_SESSION{'pseudo'};
        $req = $bdd->prepare('SELECT *  FROM eleve WHERE pseudo = :pseudo');
        $req->execute(array(
            'pseudo' => $pseudo));
        $resultat_eleve = $req->fetch(); 

      //Enregistrement Fraiçais  
        // Recupécation du Id_Matière
        $matiere = 'français';
            
        $req = $bdd->prepare('SELECT *  FROM matiere WHERE lib_matiere = :lib_matiere_r');
        $req->execute(array(
            'lib_matiere_r' => $matiere));
        $resultat_matiere = $req->fetch();

     
        // Insertion des notes
        $reponse = $bdd->prepare('INSERT INTO obtenir (id_eleve_obt, id_matiere_obt, note) VALUES (:id_eleve, :id_matiere, :note)');
        $reponse -> execute(array(
        'id_eleve' => $resultat_eleve["matricule"],
        'id_matiere' => $resultat_matiere['id_matiere'],
        'note' => $_POST['français'] )); 

// ************************

//Enregistrement Fraiçais  
        // Recupécation du Id_Matière
        $matiere = 'anglais';
            
        $req = $bdd->prepare('SELECT *  FROM matiere WHERE lib_matiere = :lib_matiere_r');
        $req->execute(array(
            'lib_matiere_r' => $matiere));
        $resultat_matiere = $req->fetch();

     
        // Insertion des notes
        $reponse = $bdd->prepare('INSERT INTO obtenir (id_eleve_obt, id_matiere_obt, note) VALUES (:id_eleve, :id_matiere, :note)');
        $reponse -> execute(array(
        'id_eleve' => $resultat_eleve["matricule"],
        'id_matiere' => $resultat_matiere['id_matiere'],
        'note' => $_POST['anglais'] )); 
        
// ************************
//Enregistrement Fraiçais  
        // Recupécation du Id_Matière
        $matiere = 'svt';
            
        $req = $bdd->prepare('SELECT *  FROM matiere WHERE lib_matiere = :lib_matiere_r');
        $req->execute(array(
            'lib_matiere_r' => $matiere));
        $resultat_matiere = $req->fetch();

     
        // Insertion des notes
        $reponse = $bdd->prepare('INSERT INTO obtenir (id_eleve_obt, id_matiere_obt, note) VALUES (:id_eleve, :id_matiere, :note)');
        $reponse -> execute(array(
        'id_eleve' => $resultat_eleve["matricule"],
        'id_matiere' => $resultat_matiere['id_matiere'],
        'note' => $_POST['svt'] )); 
        
// ************************
//Enregistrement Fraiçais  
        // Recupécation du Id_Matière
        $matiere = 'hist_geo';
            
        $req = $bdd->prepare('SELECT *  FROM matiere WHERE lib_matiere = :lib_matiere_r');
        $req->execute(array(
            'lib_matiere_r' => $matiere));
        $resultat_matiere = $req->fetch();

     
        // Insertion des notes
        $reponse = $bdd->prepare('INSERT INTO obtenir (id_eleve_obt, id_matiere_obt, note) VALUES (:id_eleve, :id_matiere, :note)');
        $reponse -> execute(array(
        'id_eleve' => $resultat_eleve["matricule"],
        'id_matiere' => $resultat_matiere['id_matiere'],
        'note' => $_POST['hist_geo'] )); 
        
// ************************
//Enregistrement Fraiçais  
        // Recupécation du Id_Matière
        $matiere = 'math';
            
        $req = $bdd->prepare('SELECT *  FROM matiere WHERE lib_matiere = :lib_matiere_r');
        $req->execute(array(
            'lib_matiere_r' => $matiere));
        $resultat_matiere = $req->fetch();

     
        // Insertion des notes
        $reponse = $bdd->prepare('INSERT INTO obtenir (id_eleve_obt, id_matiere_obt, note) VALUES (:id_eleve, :id_matiere, :note)');
        $reponse -> execute(array(
        'id_eleve' => $resultat_eleve["matricule"],
        'id_matiere' => $resultat_matiere['id_matiere'],
        'note' => $_POST['math'] )); 
        
// ************************
//Enregistrement Fraiçais  
        // Recupécation du Id_Matière
        $matiere = 'physique';
            
        $req = $bdd->prepare('SELECT *  FROM matiere WHERE lib_matiere = :lib_matiere_r');
        $req->execute(array(
            'lib_matiere_r' => $matiere));
        $resultat_matiere = $req->fetch();

     
        // Insertion des notes
        $reponse = $bdd->prepare('INSERT INTO obtenir (id_eleve_obt, id_matiere_obt, note) VALUES (:id_eleve, :id_matiere, :note)');
        $reponse -> execute(array(
        'id_eleve' => $resultat_eleve["matricule"],
        'id_matiere' => $resultat_matiere['id_matiere'],
        'note' => $_POST['physique'] )); 
        
// ************************

      //  $reponse = $bdd->exec('INSERT INTO obtenir ( id_eleve_obt, id_matiere_obt , note) VALUES (1, 2, 5)');

     // echo $matiere .'-> N°  ' .$resultat_eleve["matricule"] ." IdM " .$resultat_matiere['id_matiere'] .'note ' .$_POST['français']  .'<br>' ;
        
        }
        header("location: affichage_note.php"); 
        
?>
