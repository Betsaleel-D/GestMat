

<?php
    session_start();
?>
<!DOCTYPE HTML>
<HTML>
    <HEAd>
        <TITLe>affichage des notes</TITLe>
        <link rel="stylesheet" href="style.css">
    </HEAd>
    <body>
            <div id="page_complet">
                <header id="contHeader">
                    <?php include("entete.php");?>
                </header>
                <div>

        <?php
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
                
                $req1 = $bdd->prepare('SELECT *  FROM eleve WHERE pseudo = :pseudo');
                $req1->execute(array(
                    'pseudo' => $pseudo));
                $resultat_eleve = $req1->fetch();
                echo "le matricule est :" .$resultat_eleve['matricule'] ."id classe est :" .$resultat_eleve['id_classe_el'] .'idex' .$resultat_eleve[0] ."<br>";

                $matricule_rep = $resultat_eleve['matricule'];
                $Key = array_search($matricule_rep, $resultat_eleve);
                echo "Le rang de : " .$matricule_rep .' est : ' .$Key .' <br>';
         
               
                $req4 = $bdd->prepare('SELECT SUM(coefficient) as Tcoeff
               FROM  associer  
                            
              where id_class_ass = :id_class');
               $req4->execute(array(
                  'id_class' => $resultat_eleve['id_classe_el']));
               $resultat_coeficiant = $req4->fetch();
               
           // echo "Total coefficiant : " .$resultat_coeficiant['Tcoeff'];      

            ?>
 
         <?php    
               $req3 = $bdd->prepare('SELECT SUM(O.note*A.coefficient) as Total_note
                FROM associer A , obtenir O, classe C
                WHERE   O.id_eleve_obt = :matricule
                and C.id_classe = A.id_class_ass
                and O.id_matiere_obt = A.id_matiere_ass
                and C.id_classe = :id_class');
                
                $req3->execute(array(
                    'matricule' => $resultat_eleve['matricule'],
                    'id_class' => $resultat_eleve['id_classe_el']));
                   $resultat_total_note = $req3->fetch();

                    echo $resultat_total_note['Total_note']; ?> <br> <?php
                    echo $resultat_coeficiant['Tcoeff']; ?> <br> <?php
                    $lamoyenne = $resultat_total_note['Total_note'] / $resultat_coeficiant['Tcoeff'];
            ?>
                <p>Votre Moyenne Générale est : <?php echo ' la moyenne  :' .$lamoyenne  .
                    '  lTotal coeff :'?> </p>
        
            <?php
            /*
                while($resultat_moyenne)
                {
                    echo $resultat_moyenne['moyenne'] ;
                }
               */
                $id_class = 2;
                $req4 = $bdd -> query('SELECT E.matricule, E.nom, M.lib_matiere, A.coefficient, E.matricule, E.nom, 
                SUM(O.note*A.coefficient)/ SUM(A.coefficient) as Moyenne, count(matricule) as NombreM
                FROM eleve E, matiere M, obtenir O, associer A, classe C 
                WHERE  O.id_eleve_obt = E.matricule 
                and M.id_matiere = O.id_matiere_obt 
                and M.id_matiere = A.id_matiere_ass

                GROUP BY E.matricule, E.nom
                ORDER BY  Moyenne DESC'
                );
                $resultat_total_classe = $req4 ->fetch();

                $matricule_rep = $resultat_eleve['matricule'];
                $Key = array_search($matricule_rep, $resultat_total_classe);
                echo "Le rang de : " .$matricule_rep .' est : ' .$Key;
                
               /* $req4 -> execute(array(
                    'id_class'=> '1'
                ));*/

                //if ( $req4-> rowCount ()> 0)
                ?>
                <table>
                        <tr>
                            <th>Nom</th>
                            <th>Moyenne</th>
                        </tr>
                <?php
                /*
                $resultat_total_classe = $req4 ->fetch();
                $i=1;
                 while ($lamoyenne < $resultat_total_classe['Moyenne'])
                
                 {
                    $i++;
                 }
                 echo 'Il occupe la : ' .$i;
*/n
                ?>

                        <tr>
                            <th><?php //echo  $resultat_total_classe['nom'];?></th>
                            <th><?php //echo  $resultat_total_classe['Moyenne'];?></th>
                        </tr>

                    <?php
              
                    ?>    
        
           </table>


           <?php 

           ?>

    </body>
</HTML>