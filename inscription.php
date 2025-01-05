<?php
require_once "functions.php";
require "GLogin.php";

try {
    $pdo = new PDO("mysql: host=localhost; dbname=readnlead", "root", "");
    //echo "connexion réussie !";
} catch (PDOException $e) {
    echo "Erreur : ".$e->getMessage();
}

$etat_inscription = 0;// paramètre de la fonction inscription() dans functions.php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inscrire'])) { 
    $nom = recupereValeurChamps('nom');
    $prenom = recupereValeurChamps('prenom');
    $email = recupereValeurChamps('email');
    $password = recupereValeurChamps('password');
    $password_confirm = recupereValeurChamps('password_confirm');
    
    $rqt = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($rqt);
    $stmt->bindParam(":email",$email, PDO::PARAM_STR);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $etat_inscription = 3;
    }elseif ($password != $password_confirm) {
        $etat_inscription = 2;
    }else{
        //ALTER TABLE users RENAME COLUMN password pass_word
        $password = password_hash($password,PASSWORD_DEFAULT);
        $rqt = "INSERT INTO users(first_name,last_name,email,password) VALUES(:first_name,:last_name,:email,:password)";
        $stmt = $pdo->prepare($rqt);

        $params = [
            ":first_name" => $nom,
            ":last_name" => $prenom,
            ":email" => $email,
            ":password" => $password
        ];

        //$stmt->bindParam(":username,",$username, PDO::PARAM_STR);
        //$stmt->bindParam(":pass_word,",$password, PDO::PARAM_STR);

        if($stmt->execute($params)){
            $etat_inscription = 1;
            header("location: connexion.php");
        }else {
            $etat_inscription = 4;
        }
    }
    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription</title>
    <link rel="stylesheet" href="./src/output.css">
    <link rel="icon" href="/img/logo-rnl.png">
</head>
<body class="bg-gray-200">
    <h1 class="text-4xl text-center bold">📚Read and Lead Library !</h1>
    <div class="flex justify-center mt-10 h-15">
        <?php if(isset($_POST['inscrire'])) echo inscription($etat_inscription); ?>
    </div>
    <div class="flex w-fit p-2 mx-auto mt-5 bg-white border-8 border-gray-800 gap-x-3" >
        <img class="object-cover w-[400px] max-1000:w-[400px] max-900:w-[300px] max-850:w-[350px] 
        max-800:w-[300px] max-700:w-[250px] max-600:hidden" src="./img/sign_in_pic.webp" alt="">
        <form method="post" action="inscription.php" class="flex flex-col max-w-[450px] w-[300px] pr-3 gap-y-4">
            <h1 class="mb-2 text-2xl font-bold text-center">Inscription</h1>
            <input class="input" type="text" name="nom" autocomplete="off" placeholder="Entrez votre nom..." required>
            <input class="input" type="text" name="prenom" autocomplete="off" placeholder="Entrez votre prénom..." required>
            <input class="input" type="email" name="email" placeholder="Entrez votre email" required>
            <input class="input" type="password" name="password" placeholder="Saisissez votre mot de passe" required>
            <input class="input" type="password" name="password_confirm" placeholder="Confirmez votre mot de passe" required>

            <button class="transition duration-300 ease-out submit-btn" name="inscrire" type="submit">S'inscrire</button>
            <?php GLogin() ?>
            <a href="connexion.php" class="font-bold text-center underline hover:text-blue-800">Se connecter</a>
        </form>
    </div>
</body>
</html>