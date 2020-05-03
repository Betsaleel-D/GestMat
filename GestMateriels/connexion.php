<!DOCTYPE HTML>
<HTML>
    <HEAd>
        <TITLe>Connexion</TITLe>
        <link rel="stylesheet" href="style.css">
    </HEAd>
    <body>
    <div id="page_complet">
        <header id="contHeader">
			<?php include("entete.php");?>
        </header>

        <section id="id_section">
        <form action="traitement_connexion.php" method="post">

            <fieldset>
                <legend>Inscription</legend>

                <div>
                    <label for="email">Adresse Email</label>
                    <input type="text" name="email" id="email">
                </div>
                <div>

                    <label for="pass">Votre Mot de Passe</label>
                    <input type="password" name="pass" id="pass" >
                </div>
            
                <button type="submit">Connexion</button>
            </fieldset>
        </form>
        </section>

    </div>
    <header class="pied">
			<?php include("pied.php");?>
        </header>
    </body>
</HTML>