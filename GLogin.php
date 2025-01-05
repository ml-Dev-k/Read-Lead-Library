<?php
session_start();
require 'vendor/autoload.php';

// Charger les variables d'environnement à partir du fichier .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Récupérer les variables d'environnement


// Mail de bienvenu(e)
define("SUBJECT", "Bienvenue sur ReadNLead Library!");
$headers = "From: ".$_ENV["MAIL_ADRESS"]."\r\n"; 
$headers .= "Reply-To: ".$_ENV["MAIL_ADRESS"]."\r\n";
$headers .= "Content-type: text/plain; charset=UTF-8\r\n";
define("HEADERS", $headers);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function envoyerEmail($userEmail, $userName ,$message) {
    $mail = new PHPMailer(true);
    try {
        // Paramètres de configuration du serveur SMTP
        $mail->isSMTP();                                          
        $mail->Host       = $_ENV["HOST"];               
        $mail->SMTPAuth   = true;                          
        $mail->Username   = $_ENV["MAIL_ADRESS"];
        $mail->Password   = $_ENV["MAIL_PASSWORD"];           
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
        $mail->Port       = 587;                                

        // Destinataires
        $mail->setFrom($_ENV["MAIL_ADRESS"], 'ReadNLead');
        $mail->addAddress($userEmail, $userName);          

        // Contenu de l'email en HTML
        $mail->isHTML(true);               
        $mail->Subject = SUBJECT;
        $mail->Body    = $message;

        // Envoi de l'email
        $mail->send();
        echo 'Message envoyé avec succès';
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi de l'email: $e";
    }
}

// Fonction pour gérer la connexion Google
function GLogin(){
  // Définir les constantes de connexion Google
  define("clientID", $_ENV['GOOGLE_CLIENT_ID']);
  define("ClientSecret", $_ENV['GOOGLE_CLIENT_SECRET']);
  define("redirectURL", "http://localhost:5000/inscription.php");    

  $client = new Google_Client();
  $client->setClientId(clientID);
  $client->setClientSecret(ClientSecret);
  $client->setRedirectUri(redirectURL);
  $client->addScope("email");
  $client->addScope("profile");  

  // Connexion à la base de données
  try {
    $pdo = new PDO("mysql:host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
  } catch (PDOException $e) {
      die("Erreur : " . $e->getMessage());
  }

  if (isset($_GET["code"])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);
    $client->setAccessToken($token);
    
    // Récupérer les informations de l'utilisateur
    $service = new Google_Service_Oauth2($client);
    $userInfo = $service->userinfo->get();

    $userId = $userInfo->id;
    $userName = $userInfo->givenName;
    $userEmail = $userInfo->email;
    $verifiedEmail = $userInfo->verified_email;
    $userPicture = $userInfo->picture;

    $rqt = "SELECT * FROM gusers WHERE userEmail = :userEmail";
    $stmt = $pdo->prepare($rqt);
    $param = [":userEmail"=> $userEmail];
    $stmt->execute($param);

    if ($stmt->rowCount() > 0) {
        $_SESSION['authentification'] = 'validé';
        $_SESSION['userBase'] = 'gusers';//google_user
        $_SESSION['email'] = $userEmail;
        $_SESSION['username'] =  strtolower($userName);
        $_SESSION['userPicture'] = $userPicture;
        header("location: accueil.php");
      } else {
        // Insérer un nouvel utilisateur
        $rqt = "INSERT INTO gusers (google_id, userName, userEmail, verified_email, userPicture) 
                VALUES (:google_id, :userName, :userEmail, :verified_email, :userPicture)";
        $stmt = $pdo->prepare($rqt);
        $params = [
            ":google_id" => $userId,
            ":userName" => $userName,
            ":userEmail" => $userEmail,
            ":verified_email" => $verifiedEmail,
            ":userPicture" => $userPicture,
        ];
        
        if ($stmt->execute($params)) {
          $_SESSION['authentification'] = 'validé';
          $_SESSION['userBase'] = 'gusers';//google_user
          $_SESSION['email'] = $userEmail;
          $_SESSION['username'] =  strtolower($userName);       
          $_SESSION['userPicture'] = $userPicture;       
          $message = "
            <html>
            <head>
                <title>Bienvenue sur ReadNLead</title>
            </head>
            <body>
                <h1>Bonjour $userName,</h1>
                <p>Merci de vous être inscrit sur la plateforme <strong>ReadNLead</strong>. Nous sommes ravis de vous accueillir dans notre communauté.</p>
                <p>Connectez-vous dès maintenant pour explorer notre plateforme !</p>
                <br>
                <p>Cordialement,<br>L'équipe ReadNLead</p>
            </body>
            </html>
            ";
          envoyerEmail($userEmail, $userName, $message);
          header("location: accueil.php");
        } else {
          header("location: inscription.php");
        }
    }
  } else {
    // Afficher le bouton de connexion Google
    echo 
      "<a href='" . $client->createAuthUrl() . "'>
          <div class='flex justify-center p-1 gap-x-3 border border-gray-700 cursor-pointer bg-gray-100 
          hover:bg-gray-200 font-semibold'>
              <div class='w-[25px] h-[25px] bg-contain bg-center' style='background-image: url(./img/G_logo.webp);'></div>
              <p>Login with Google</p>
          </div>
      </a>";
  }
}
?>
