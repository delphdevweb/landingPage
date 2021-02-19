<?php
    require "landingpage.dbconf.php";
        // Contenu page

        try{
            $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
            $requete_page = "SELECT * FROM `page`;";
            $prepare_page = $pdo->prepare($requete_page);
            $prepare_page->execute();
            $page = $prepare_page->fetchAll();  
        }
        catch (PDOException $e){
            exit("❌☠️❌ OOPS :\n" . $e->getMessage());
        }

    // UPDATE contenu page

    if(isset($_POST['updatePage'])) {
        $meta_description = $_POST['meta_description'];
        $title = $_POST['title'];
        $presentation= $_POST['presentation'];
        $couleur_fond = $_POST['couleur_fond'];
        $couleur_texte = $_POST['couleur_texte'];

        try{
            $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
            $requete = "UPDATE `page` 
                        SET `meta_description` = :meta_description,
                            `title` = :title,
                            `presentation` = :presentation,
                            `couleur_fond` = :couleur_fond,
                            `couleur_texte` = :couleur_texte
                        WHERE `id` = :id;";
            $prepare = $pdo->prepare($requete);
            $prepare->execute(array(
                        ":id" => 1,
                        ":meta_description" => $meta_description,
                        ":title" => $title,
                        ":presentation" => $presentation,
                        ":couleur_fond" => $couleur_fond,
                        ":couleur_texte" => $couleur_texte,
                        ));
            $res = $prepare->rowCount();

            if ($res ==1) {
                header('Location: admin.php');
            }
        }
        catch (PDOException $e){
            exit("❌☠️❌ OOPS :\n" . $e->getMessage());
        }
    }
   
        // Lien réseaux et mail  
    
        try{
            $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
            $requete_reseaux = "SELECT * FROM `reseaux`;";
            $prepare_reseaux = $pdo->prepare($requete_reseaux);
            $prepare_reseaux->execute();
            $reseaux = $prepare_reseaux ->fetchAll();
        }
        catch (PDOException $e){
            exit("❌☠️❌ OOPS :\n" . $e->getMessage());
        }
  
    // CREATE

    if(isset($_POST['create'])) {
        $name_lien = $_POST['name_lien'];
        $lien = $_POST['lien'];

        try{
            $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
            $requete = "INSERT INTO `reseaux` (`name_lien`, `lien`)
                        VALUES ( :name_lien, :lien);";
            $prepare = $pdo->prepare($requete);
            $prepare->execute(array(
                        ":name_lien" => $name_lien,
                        ":lien" => $lien,
                    ));
            $res = $prepare->rowCount();
    
            if($res == 1){
                header("Location: admin.php");
            }
            }
            catch (PDOException $e){
                exit("❌☠️❌ OOPS :\n" . $e->getMessage());
            }
    }

    // UPDATE

    if(isset($_POST['update'])) {
        $id = $_POST['id'];
        $name_lien = $_POST['name_lien'];
        $lien = $_POST['lien'];

        try{
            $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
            $requete = "UPDATE `reseaux`
                        SET `name_lien` = :name_lien,
                            `lien` = :lien
                        WHERE `id` = :id";
            $prepare = $pdo->prepare($requete);
            $prepare->execute(array(
                        ":id"   => $id,
                        ":name_lien" => $name_lien,
                        ":lien"   => $lien,
                        ));
            $res = $prepare->rowCount();

            if($res == 1){
                header("Location: admin.php");
            }
            }
        catch (PDOException $e){
                    exit("❌☠️❌ OOPS :\n" . $e->getMessage());
        }
    }


    // DELETE

    if(isset($_POST['delete'])){
        $id = $_POST['id'];

        try{
            $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
            $requete = "DELETE FROM `reseaux`
                        WHERE `id` = :id;"; 
            $prepare = $pdo->prepare($requete);
            $prepare->execute(array(
                        ":id" => $id
                        ));
            $reseaux = $prepare->fetchAll();

                header("Location: admin.php");  
        }
        catch (PDOException $e){
            exit("❌☠️❌ OOPS :\n" . $e->getMessage());
        }
    }
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Page admin</title>
</head>
<body>

    <p>Modifiez la meta_description</p>
        <form action="admin.php" method="POST">
            <input type="text" name="meta_description" id="meta" value="<?php echo(htmlentities(($page[0]['meta_description'])));?>">
            <input type="submit" name='updatePage' value='ok'/>

    <p>Modifiez le titre</p>
        
            <input type="text" name="title" id="titre" value="<?php echo(htmlentities(($page[0]['title'])));?>">
            <input type="submit" name='updatePage' value='ok'/>
       

    <p>Modifiez votre présentation</p>
       
            <input type="text" name="presentation" id="presentation" value="<?php echo(htmlentities(($page[0]['presentation'])));?>">
            <input type="submit" name='updatePage' value='ok'/>
     

    <p>Modifiez la couleur de fond</p>
       
            <input type="color" name="couleur_fond" value="<?php echo(htmlentities(($page[0]['couleur_fond'])));?>">
            <input type="submit" name='updatePage' value='ok'/>

    <p>Modifiez la couleur du texte</p>
       
            <input type="color" name="couleur_texte" value="<?php echo(htmlentities(($page[0]['couleur_texte'])));?>">
            <input type="submit" name='updatePage' value='ok'/>
        </form>

    <p>Ajoutez un lien</p>
        <form action="admin.php" method="POST">
            <label>Nom du réseau</label>
            <input type="text" name="name_lien">
            <label>URL du réseau</label>
            <input type="text" name="lien">
            <input type="submit" name='create' value='ok'/>
        </form>

    <p>Modifiez un lien</p>
    <?php
    foreach($reseaux as $key => $value) {
    ?>
        <form action="admin.php" method="POST">
            <label>Nom du réseau: </label>
            <input type='text' name='name_lien' value='<?php echo(htmlentities(($value['name_lien'])));?>'>
            <label>URL lien: </label>
            <input type='text' name='lien' value='<?php echo(htmlentities(($value['lien'])));?>'>
            <input type='hidden' name='id' value='<?php echo(htmlentities(($value['id'])));?>'>
            <input type="submit" name='update' value='ok'/>
        </form>
    <?php
    }
    ?>

    <p>Supprimez un lien</p>
    <?php
    foreach($reseaux as $key => $value) {
    ?>
        <form action="admin.php" method="POST">
            <label>Nom du réseau: </label>
            <input type='text' name='name_lien' value='<?php echo(htmlentities(($value['name_lien'])));?>'>
            <input type='hidden' name='id' value='<?php echo(htmlentities(($value['id'])));?>'>
            <input type="submit" name='delete' value='ok'/>
        </form>
    <?php
    }
    ?>
    
</body>
</html>