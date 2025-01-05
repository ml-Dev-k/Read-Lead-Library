<?php
 require "GLogin.php";
 require "functions.php";

 try {
  $pdo = new PDO("mysql: host=localhost; dbname=readnlead", "root", "");
  //echo "connexion réussie !";
} catch (PDOException $e) {
  echo "Erreur : ".$e->getMessage();
}

/*$sql = "ALTER TABLE users MODIFY pass_word VARCHAR(255)";
$pdo->query($sql);*/

$etat_connexion = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['connexion'])) { 
  $email = recupereValeurChamps('email');
  $password = recupereValeurChamps('password');

  $rqt = "SELECT * FROM users WHERE email = :email";
  $stmt = $pdo->prepare($rqt);
  //$stmt->bindParam(":email",$email, PDO::PARAM_STR);
  $param =[":email"=>$email];
  $stmt->execute($param);
  $user = $stmt->fetch();

  if ($user && password_verify($password,$user['password'])) {
    $_SESSION['authentification'] = 'validé';
    $_SESSION['userBase'] = 'users';//user classique
    $_SESSION['email'] = $email;
    $_SESSION['username'] =  strtolower($user["first_name"]). " " .$user["last_name"];
    header("location: accueil.php");
    
  }else{
    $etat_connexion = 1;
  }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <link rel="stylesheet" href="./src/output.css">
  <link rel="icon" href="/img/logo-rnl.png">
</head>
<body class="bg-gray-200">
    <h1 class="text-4xl text-center bold">📚Read and Lead Library !</h1>
    <div class="flex justify-center mt-10 h-15">
        <?php if(isset($_POST['connexion'])) echo Connexion($etat_connexion); ?>
    </div>
    <div class="flex w-fit p-2 mx-auto mt-5 bg-white border-8 border-gray-800 gap-x-3" >
        <img class="object-cover w-[400px] max-1000:w-[400px] max-900:w-[300px] max-850:w-[350px] 
        max-800:w-[300px] max-700:w-[250px] max-600:hidden" src="./img/sign_in_pic.webp" alt="">
        <form method="post" action="connexion.php" class="flex flex-col max-w-[450px] w-[300px] pr-3 gap-y-4">
            <h1 class="mb-2 text-2xl font-bold text-center">Inscription</h1>
            <input class="input" type="email" name="email" placeholder="Entrez votre email" required>
            <input class="input" type="password" name="password" placeholder="Saisissez votre mot de passe" required>
            <button class="transition duration-300 ease-out submit-btn" name="connexion" type="submit">Se connecter</button>
            <?php GLogin() ?>
            <a href="inscription.php" class="font-bold text-center underline hover:text-blue-800">S'inscrire</a>
        </form>
    </div>
</body>
</html>