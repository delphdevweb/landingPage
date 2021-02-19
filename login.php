<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>landing page</title>
  <meta name="description" content="Page d'accueil">
  <link rel="stylesheet" href="style.css">
</head>
    <?php 
        include("landingpage.dbconf.php");
        session_start();

        if (isset($_POST['goodUser'])){

            $user = $_POST['user'];
            $_SESSION['user'] = $user;
            $mdp = $_POST['mdp'];

            try{
                $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
                $requete = "SELECT * FROM `users`
                            WHERE `user` = :user
                            AND `mdp` = :mdp;";
                $prepare = $pdo->prepare($requete);
                $prepare->execute(array(
                    ':user' => $user,
                    ':mdp' => $mdp
                ));
                $res = $prepare->rowCount();
                if($res == 1){
                    $user = $prepare->fetch();
                    $_SESSION['user'] = $user['user'];
                    header("Location: admin.php");
                }else{
                    echo("Le nom d'utilisateur ou le mot de passe est incorrect");
                } 
            }
            catch (PDOException $e){
                exit("❌🙀❌ OOPS :\n" . $e->getMessage());
            }
        }
    ?>
<body>
  <div class='accueil'>
    <form action="login.php" method="post">
      <label for="user">Login</label>
      <input type="text" name="user" id="user" required>
      <label for="mdp">Mot de passe</label>
      <input type="password" name="mdp" id="mdp" required>
      <input type="submit" name="goodUser" id ="loginOK" value="valider">
    </form>
  </div>
</body>

</html>