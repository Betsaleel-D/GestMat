

<?php
    session_start();
?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLe>affichage des notes</TITLe>
        <link rel="stylesheet" href="style.css">
    </HEAD>
    <body>
                <div id="page_complet">
                <header id="contHeader">
                    <?php include("entete.php");?>
                </header>
                <div>

                <?php // include("section.php");?> 

        <?php

        //Connexion à la base de donnée
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

                $pseudo = $_SESSION{'pseudo'};
                
                // Recuperation du matricule de l'eleve
                $req1 = $bdd->prepare('SELECT *  FROM eleve WHERE pseudo = :pseudo');
                $req1->execute(array(
                    'pseudo' => $pseudo));
                $resultat_eleve = $req1->fetch();
            //   echo "le matricule est :" .$resultat_eleve['matricule'] ."id classe est :" .$resultat_eleve['id_classe_el'] .'idex' .$resultat_eleve[0] ."<br>";

                    // Calcule de la somme du coefficient selon la classe
                $req4 = $bdd->prepare('SELECT SUM(coefficient) as Tcoeff
               FROM  associer  
                where id_class_ass = :id_class');
               $req4->execute(array(
                  'id_class' => $resultat_eleve['id_classe_el']));
               $resultat_coeficiant = $req4->fetch();
               
           // echo "Total coefficiant : " .$resultat_coeficiant['Tcoeff'];      

            ?>
           

 
         <?php    
         //Calcule de la moyenne de l'eleve
               $req3 = $bdd->prepare('SELECT SUM(O.note*A.coefficient) as Total_note, SUM(O.note) as somme_note
                FROM associer A , obtenir O, classe C
                WHERE   O.id_eleve_obt = :matricule
                and C.id_classe = A.id_class_ass
                and O.id_matiere_obt = A.id_matiere_ass
                and C.id_classe = :id_class'); 
                $req3->execute(array(
                    'matricule' => $resultat_eleve['matricule'],
                    'id_class' => $resultat_eleve['id_classe_el']));
                   $resultat_total_note = $req3->fetch();

                    //Affichage
                    $lamoyenne = $resultat_total_note['Total_note'] / $resultat_coeficiant['Tcoeff'];
                    
                     ?>  

            
            <?php
            // Compter le nombre total d'eleve d'une classe
                 $req5 = $bdd->prepare('SELECT COUNT(id_eleve_obt) as Nombre_Classe FROM (SELECT DISTINCT obtenir.id_eleve_obt, eleve.nom
                 FROM obtenir, eleve
                 WHERE obtenir.id_eleve_obt = eleve.matricule
                 AND eleve.id_classe_el = :id_class) as nombre');
                 $req5->execute(array(
                    'id_class' => $resultat_eleve['id_classe_el'])); 
                    
                    $resultat_Nombre = $req5 ->fetch();
                   // echo "Le nombre tatal d'eleve est en ... est :"  .$resultat_Nombre['Nombre_Classe'];
            ?>


                    <?php
                         $req_cl1 = $bdd->prepare('SELECT lib_classe  FROM classe WHERE id_classe = :id_classe_el');
                         $req_cl1->execute(array(
                             'id_classe_el' => $resultat_eleve['id_classe_el']));
                         $resultat_classe = $req_cl1->fetch();
                    ?>


            <div class='profil'>
                <p> <strong>Matricule</strong>  : 00200<?php echo $resultat_eleve['matricule'];?> </p>
                <p> <strong>Nom</strong>  :<?php echo $resultat_eleve['nom'];?> </p>
                <p> <strong>Prenom</strong>  :<?php echo $resultat_eleve['prenom'];?> </p>
                <p> <strong>Classe</strong>  :<?php echo $resultat_classe['lib_classe'];?> </p>
            </div>


<?php
            /*
                while($resultat_moyenne)
                {
                    echo $resultat_moyenne['moyenne'] ;
                }
               */
              // Recuperation de toutes les notes de l'eleve et coefficiant
          
                $req10 = $bdd ->prepare('SELECT obtenir.note, matiere.lib_matiere
                FROM eleve, matiere, obtenir
                WHERE obtenir.id_eleve_obt = :matricule
                AND matiere.id_matiere = obtenir.id_matiere_obt
                GROUP BY matiere.lib_matiere'
                );
                $req10->execute(array(
                    'matricule' => $resultat_eleve['matricule']
                ));
   

                ?>
                <table class='table'>
                        <tr>
                            <th>Matiere</th>
                            <th>Note Obtenue</th>
                        </tr>
                <?php
               
                 while ($resultat_Note_matiere = $req10 ->fetch())
                
                 {

                ?>
                        <tr>
                            <th><?php echo  $resultat_Note_matiere['lib_matiere'];?></th>
                            <th><?php echo  $resultat_Note_matiere['note'];?></th>
                        </tr>
                    <?php
                  }
                 $lamoyenne_2 = round($lamoyenne, 2);
                 
                    ?> 
                    <tr>
                            <th>Totale General</th>
                            <th><?php echo  $resultat_total_note['somme_note'];?></th>
                        </tr> 
                     
         </table>

         <?php
                 // Recuperer les eleves d'une classe
                 $req12 = $bdd->prepare('SELECT DISTINCT obtenir.id_eleve_obt
                 FROM obtenir, eleve
                 WHERE obtenir.id_eleve_obt = eleve.matricule
                 AND eleve.id_classe_el = :id_class');
                 $req12->execute(array(
                    'id_class' => $resultat_eleve['id_classe_el']));    
            ?>
               
                <?php
                $req6 = $bdd -> exec('DELETE FROM moyenne');
                 while ($resultat_eleve_Note = $req12 ->fetch())
                 {
                  
                 //Calcule de la moyenne de toutes les eleves
                            $req4 = $bdd->prepare('SELECT SUM(O.note*A.coefficient) as Total_note
                            FROM associer A , obtenir O, classe C
                            WHERE   O.id_eleve_obt = :matricule
                            and C.id_classe = A.id_class_ass
                            and O.id_matiere_obt = A.id_matiere_ass
                            and C.id_classe = :id_class'); 
                            $req4->execute(array(
                                'matricule' => $resultat_eleve_Note['id_eleve_obt'],
                                'id_class' => $resultat_eleve['id_classe_el']));
                                $resultat_total_note = $req4->fetch();
                               
                                //Affichage
                                
                                $lesmoyenne = $resultat_total_note['Total_note'] / $resultat_coeficiant['Tcoeff'];
                        
                                $reponse = $bdd->prepare('INSERT INTO moyenne(moyenne) VALUES (:moyenne)');
                                $reponse -> execute(array(
                                   'moyenne' => $lesmoyenne));
                                }
               ?>

                <?php
                $req5 = $bdd->prepare('SELECT  count("moyenne") as lerang from moyenne where moyenne >= :lamoyenne ');
                $req5->execute(array(
                   'lamoyenne' => $lamoyenne));  

                   $resultat_lerang = $req5->fetch();

                   if($resultat_lerang['lerang']==1)
                   {
                       ?>
                    <div class='MoyenneRangCenter'>
                        <p> <strong>Moyenne Générale : </strong> <?php echo $lamoyenne_2 ;?> </p>
                        <p>  <strong>Rang : </strong> <?php echo $resultat_lerang['lerang'] . 'er';?> </p>
                        
                        <?php
                    }
                    else
                    {
                        ?>
                        <p> <strong>Moyenne Générale : </strong> <?php echo $lamoyenne_2 ;?> </p>
                        <p></p><strong>Rang : </strong> <?php echo $resultat_lerang['lerang'] . 'ème';?> </p>
                    </div>
                 <?php
                }
                ?> 
        
         <header class="pied">
			<?php include("pied.php");?>
        </header>
    </div>
</HTML>