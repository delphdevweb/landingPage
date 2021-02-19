<?php
        include "landingpage.dbconf.php";

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
  
        try{
            $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
            $requete_reseaux = "SELECT * FROM `reseaux`;";
            $prepare_reseaux = $pdo->prepare($requete_reseaux);
            $prepare_reseaux->execute();
            $reseaux = $prepare_reseaux;
                }
        catch (PDOException $e){
             exit("❌☠️❌ OOPS :\n" . $e->getMessage());
                }   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo(htmlentities(($page[0]['meta_description'])));?>">
    <link rel="stylesheet" href="style.css">
    <title><?php echo($page[0]['title']);?></title>
</head>

<style>
    body {
        background-color: <?php echo(htmlentities(($page[0]['couleur_fond'])));?>;
        color: <?php echo($page[0]['couleur_texte']);?>;
    }
</style>
<body>
    <div class='container'>
    <?php
    foreach($page as $key => $value){
    ?>
    <div class='page'>
        <div><?php echo($value['presentation']);?></div>
    </div>
    <?php
    }
    ?>
    
    <div class='reseaux'>
    <?php 
    while($reseau=$reseaux -> fetch()){
    ?>
        <a href='<?php echo($reseau['lien'])?>'><?php echo($reseau['name_lien']) ?></a>
    <?php
    }
    ?>
    </div>
</body>
</html>



