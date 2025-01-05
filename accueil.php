<?php
session_start();
ob_start();
require "functions.php";
require "vendor/autoload.php";

$headers = "From: kanemouhamadoulamine50@gmail.com\r\n"; 
$headers .= "Reply-To: kanemouhamadoulamine50@gmail.com\r\n";
$headers .= "Content-type: text/plain; charset=UTF-8\r\n";
define("HEADERS", $headers);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function recevoirEmail($userEmail, $userName, $subject ,$message) {
    $mail = new PHPMailer(true);
    try {
        // Paramètres de configuration du serveur SMTP
        $mail->isSMTP();                                          
        $mail->Host       = 'smtp.gmail.com';               
        $mail->SMTPAuth   = true;                          
        $mail->Username   = 'kanemouhamadoulamine50@gmail.com';
        $mail->Password   = 'ukuj yqgb mmql lrrb';           
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
        $mail->Port       = 587;                                

        // Destinataires
        $mail->setFrom($userEmail, $userName);          
        $mail->addAddress('kanemouhamadoulamine50@gmail.com', 'ReadNLead');

        // Contenu de l'email en HTML
        $mail->isHTML(true);               
        $mail->Subject = $subject;
        $mail->Body    = $message;

        // Envoi de l'email
        $mail->send();
        echo 'Message envoyé avec succès !';
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi de l'email !";
    }
}

if ($_SESSION['authentification'] != 'validé') {
  header("location: connexion.php");
} else {
  $pseudo = $_SESSION['email'];
  $username = $_SESSION['username'];
  $userBase = $_SESSION['userBase'];
  if (isset($_SESSION['userPicture'])) {
    $userPicture = $_SESSION['userPicture'];
    echo "<script>const userPicture = ".json_encode($userPicture)."</script>";
  }
}
echo "<script>const pseudo = ".json_encode($pseudo)."</script>";
echo "<script>const userBase = ".json_encode($userBase)."</script>";

// Gestion des messages des utilisateurs

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Read & Lead Library</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <script src="./scripts/jquery.js"></script>
  <script type="module" src="./scripts/accueil.js"></script>
  <link rel="stylesheet" href="./src/output.css">
  <link rel="icon" href="/img/logo-rnl.png">
</head>

<body class="bg-gray-700 overflow-y-scroll">
  <div id="SPA" class="flex flex-col bg-black-700">
    <header class="bg-black-700 header-wrapper">
      <div class="header">
        <div class="flex items-center logo gap-x-3 ">
          <img width="50" src="/img/yellow-rnl-logo.png" alt="">
          <div class="flex flex-col max-550:hidden">
            <p class="text-2xl font-bold">Read & Lead</p>
            <p class="text-[12px]">un environnement de travail libre !</p>
          </div>
        </div>
        <div class="search-bar">
          <input id="main-search-field" class="text-gray-300 input bg-black-600" type="text" placeholder="Search...">
          <button id="main-search-btn max-550:w-[50px]"><img class="search-btn max-550:w-[20px]" src="./img/icons/search-icon.png" alt=""></button>
        </div>
      </div>
    </header>
    <nav class="ml-2 mt-2 relative flex justify-center bg-gray-800">
      <p id="sidebar-toggler" class="absolute hidden max-850:block left-0 top-1 
       text-white bg-gray-800 hover:text-orange-500 cursor-pointer ">
       <i class="fa-solid m-1 min-600:fa-2x fa-bars"></i>
      </p>
      <ul class="flex nav max-w-fit gap-x-1 max-600:text-xs">
        <li data-ecran-A="home" class="nav-li max-450:hidden active">Home</li>
        <li data-ecran-A="categories" data-ecran-B="category-grids" class="nav-li categ">categories</li>
        <li data-ecran-A="authors" data-ecran-B="author-grids" class="nav-li">Auteurs</li>
        <li data-ecran-A="contact" class="nav-li">Contact us</li>
      </ul>
    </nav>
    <section class="relative flex justify-between">
      <div id="sidebar" class="max-850:absolute max-850:w-[235px] z-20 top-0 left-0 p-2" style="display: none;">
        <div class="sticky max-850:w-[235px] top-2 flex flex-col gap-y-2 pseudo bg-black-800">
          <div class="flex items-center justify-center p-1 mx-auto gap-x-2">
            <div id="userPicture" class="ml-2 w-[45px] h-[45px] max-850:w-[35px] max-850:h-[35px] rounded-full bg-cover" 
            style="background-image: url('../img/icons/pseudo.jpeg');"></div>
            <p id="username" class="font-bold text-white w-[190px] max-850:w-[175] flex items-center h-[40px] max-850:text-xs text-wrap"><?php echo $username ?></p>
          </div>
          <div class="flex flex-col w-[95%] mx-auto">
            <div class="flex items-center p-1 text-white sign-out gap-x-2">
              <i class="fa-solid text-orange-500 fa-power-off"></i>
              <p class="hover:text-orange-500 cursor-pointer"><a href="./deconnexion.php">se déconnecter</a></p>
            </div>
            <div class="relative flex items-center p-1 text-white  gap-x-2">
              <i class="fa-solid text-orange-500 fa-user-pen"></i>
              <div class="relative group">
                <p class="noAcces-tooltip text-nowrap">non accessible pour le moment</p>
                <p class="hover:text-orange-500 cursor-pointer">profil</p>
              </div>         
            </div>
            <div class="flex items-center p-1 text-white sign-out gap-x-2">
              <i class="fa-solid text-orange-500 fa-book-open-reader"></i>
              <div class="relative group">
                <p class="noAcces-tooltip text-nowrap">non accessible pour le moment</p>
                <p class="hover:text-orange-500 cursor-pointer">dernière lecture</p>
              </div>
            </div>
            <div class="mt-2 p-1">
              <div class="flex justify-center items-center bg-warmGray-500 gap-x-2 mr-2">
                <i class="fa-solid text-black-700 fa-book"></i>
                <p class="font-semibold cursor-pointer">mes livres</p>
              </div>
              <div class="flex mr-2">
                <button id="fav-usrBooks-btn" class="text-white border-red-600 bg-black-800 w-1/2 font-light">favoris</button>
                <button id="like-usrBooks-btn" class="w-1/2 bg-black-800 border-blue-800 text-white font-light">liked</button>
              </div>
              <p id="user-book-title" class="mt-2 mb-1 text-center text-warmGray-200 underline">...</p>
              <div id="user-book-grids" class="grid grid-cols-2 h-[360px] pr-1 overflow-y-auto overflow-x-hidden scrollbar-thin scrollbar-track-transparent scrollbar-thumb-gray-600 border border-gray-900 gap-y-2 gap-x-2 p-1 mr-2">

              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="onglets" class="w-3/4 min-h-[500px] max-850:w-[95%] max-450:w-[100%] mx-auto ">
        <div id="home" class="w-full ecranA border-8 max-450:hidden max-850:w-[4/5] max-850:mx-auto max-[1100px]:h-auto  border-gray-900 mt-1 flex h-[520px] bg-black-700" >
          <div id="slide1" class="relative slide w-full h-full p-1 bg-[url('../img/slides/slide1.jpg')] bg-cover ">
            <div class="slide-overlay">
              <h1 class="slide-title">Bienvenue dans notre bibliothèque en ligne !</h1>
              <p class="slide-content">
                Découvrez un vaste choix de livres, romans, bandes dessinées, et bien plus encore.
                Accédez à vos lectures favorites en un clic
              </p>
            </div>
          </div>
          <div id="slide2" class="relative slide w-full h-full p-1 bg-[url('../img/slides/slide2.jpg')] bg-cover" style="display: none;">
            <div class="slide-overlay">
              <h1 class="slide-title">Explorez nos collections variées</h1>
              <p class="slide-content">
                Découvrez un vaste choix de <B>livres, romans, bandes dessinées</B>, et bien plus encore.
                Accédez à vos lectures favorites en un clic
              </p>
            </div>
          </div>
          <div id="slide3" class="relative slide w-full h-full p-1 bg-[url('../img/slides/slide3.jpg')] bg-cover" style="display: none;">
            <div class="slide-overlay">
              <h1 class="slide-title">À la rencontre des auteurs qui vous inspirent</h1>
              <p class="slide-content">
                Explorez les biographies, interviews et œuvres des auteurs célèbres et émergents.
                Apprenez-en plus sur leurs univers et leurs inspirations.
              </p>
            </div>
          </div>
        </div>
        <div id="categories" class="w-full pb-10 border-8 border-gray-900 ecranA bg-black-700" style="display: none;">
          <div class="entete flex items-center">
            <button id="back-to-categories" class="back-btn" style="display: none;">Retour</button>
            <button class="max-350:hidden"><i id="info-categories" class="text-gray-400 hover:text-orange-700 fa-solid fa-2x fa-circle-info"></i></button>
            <p id="category-name" class="mx-auto max-650:hidden text-sm font-bold text-white">Recherchez un categorie</p>
            <div id="category-search-bar" class="search-bar">
              <input id="category-search-field" class="input" placeholder="search category..."><img class="search-btn" src="./img/icons/search-icon.png" alt=""></button>
            </div>
          </div>
          <div id="category-grids" class="relative grid grid-cols-4 items-center max-750:grid-cols-2 max-850:grid-cols-3 
            max-950:grid-cols-2  max-[1175px]:grid-cols-3 gap-3 p-4 mt-2 ecranB">
            <!--Classification des livres par catégorie-->
          </div>
          <div id="category-book-grids" class="grid grid-cols-5 max-750:grid-cols-3 max-250:grid-cols-1 max-850:grid-cols-4 max-1250:grid-cols-4 max-1000:grid-cols-3 
          mt-8 border-8 border-gray-800 gap-y-2 max-450:gap-x-4 max-400:grid-cols-2 gap-x-10 ecranB" style="display: none;">
            <!--Selection d'un categorie de livre-->
          </div>
        </div>
        <div id="authors" class="w-full border-8 border-gray-900 bg-gray-900 ecranA" style="display: none;">
          <div class="entete">
            <button id="back-to-authors" class="back-btn" style="display: none;">Retour</button>
            <button class="max-350:hidden"><i id="info-authors" class="text-gray-400 hover:text-orange-700 fa-solid fa-2x fa-circle-info"></i></button>
            <p id="author-name" class="mx-auto max-650:hidden text-sm font-bold text-white">Recherchez un auteur</p>
            <div id="author-search-bar" class="search-bar">
              <input id="author-search-field" class="input" type="text" placeholder="Search author...">
              <button id="author-search-btn"><img class="search-btn" src="./img/icons/search-icon.png" alt=""></button>
            </div>
          </div>
          <div id="author-grids" class="grid grid-cols-5 max-950:grid-cols-2 max-850:grid-cols-3 max-700:grid-cols-2 
            max-1150:grid-cols-3  max-1350:grid-cols-4 relative pt-4 border-8 bg-right border-gray-800 gap-y-5 gap-x-3 ecranB">
          </div>
          <div id="author-book-grids" class="grid grid-cols-6 max-750:grid-cols-3 max-850:grid-cols-4 max-1250:grid-cols-4 
          max-1000:grid-cols-3 max-450:gap-x-4 max-400:grid-cols-2  pt-4 border-8 border-gray-800 p-2 gap-y-2 gap-x-10 ecranB" style="display: none;">
            <!--Selection des oeuvres de l'auteur-->
          </div>
        </div>
        <div id="contact" class="relative w-full border-8 border-gray-900 bg-black-900 ecranA bg-cover" style="display: none; 
            background-image: url(./img/Contact.JPG);">
          <div class="h-full flex flex-col items-center w-full gap-y-8 p-8 text-warmGray-100 bg-gradient-to-r
           from-black-900 to-black-900 opacity-90">
            <div class="flex items-center flex-col gap-y-2">
              <h1 class="text-[30px] font-bold text-orange-500">Recherche Stage développeur web FullStack</h1>
              <p class="text-xs">
              Étudiant en licence Méthodes Informatiques Appliquées à la Gestion des Entreprises (MIAGE) 
              et titulaire d'une licence en Management Informatisé des Organisations, passionné par l’informatique 
              et à la recherche d’un stage en développement web full stack, disponible de début avril à fin août pour 
              une durée minimale de 8 semaines. Mon parcours universitaire m’a permis d’acquérir une solide base en programmation, 
              que j’ai enrichie grâce à des projets en autodidacte.
              </p>
            </div>
            <div class="flex max-1000:flex-col max-1000:items-center max-1000:gap-y-10 justify-between mt-[10px] gap-x-5 w-full">
              <div class="flex flex-col gap-y-3 text-white">
                <div class="flex items-center gap-x-4"><i class="fa-regular fa-envelope"></i><p>Kanemouhamadoulamine50@gmail.com</p></div>
                <div class="flex items-center gap-x-4"><i class="fa-solid fa-phone"></i><p>+33 7 51 33 08 85</p></div>
                <div class="flex items-center gap-x-4"><i class="fa-solid fa-location-dot"></i><p>13003 Marseille, France</p></div>
              </div>
              <div class="max-1000:w-[310px]">
                <p id="msgState" class="text-center mb-1 text-green-500">
                  <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['envoyer'])) { 
                      $subject = recupereValeurChamps('subject'); 
                      $message = recupereValeurChamps('message');
                      recevoirEmail($_SESSION['email'],$username,$subject,$message);
                      header("location: accueil.php");
                    }
                    ob_end_flush()
                  ?>
                </p>
                <form method="post" action="accueil.php" class="flex flex-col w-full gap-y-4">
                  <input class="bg-transparent border p-3 rounded-md text-gray-300 border-warmGray-200" type="text" name="subject" 
                  placeholder="Entrer l'objet de votre message..." required>
                  <textarea class=" bg-transparent p-4 border rounded-md text-gray-300 border-warmGray-200 w-[310px] h-[170px]" name="message" id="" 
                  placeholder="Saisissez votre message..."></textarea>     
                  <button id="msgBtn" class="px-3 py-2 border border-warmGray-200 rounded-sm transition duration-300 ease-out p-2 hover:bg-gray-100
                   text-black-900 bg-gray-300" name="envoyer" type="submit">Envoyer</button>
                </form>
              </div>
            </div>
  
          </div>
        </div>
        <div id="results" class="w-full border-8 border-gray-900 bg-black-700 ecranA" style="display: none;">
          <div class="entete">
            <p id="search-key" class="mx-auto font-bold text-white text-md">...</p>
          </div>
          <div id="results-book-grids" class="grid grid-cols-5 max-750:grid-cols-3 max-850:grid-cols-4 max-1250:grid-cols-4 
          max-1000:grid-cols-3 max-450:gap-x-4 max-400:grid-cols-2 mt-8 border-8 
            border-gray-800 gap-y-2 gap-x-10 ecranB " style="display: none;">
            <!--Selection d'un categorie de livre-->
          </div>
          <div id="noResult" class="flex justify-center items-start ecranB">
            <p class="text-red-600 font-semibold mt-[100px]">No results found <i class="fa-solid text-red-600 fa-exclamation"></i></p>
          </div>
        </div>
        <div id="singleBookDisplay" class="w-full bg-black-600 ecranA" style="display: none;" >
          <div class="entete">
            <button id="back" class="back-btn">Retour</button>
            <p id="book-name" class="mx-auto font-bold text-white text-md"></p>
          </div>
          <div id="book-details" class="flex justify-between border-8 bg-gray-200 border-gray-800 gap-y-4 gap-x-10">
            <!--Les détails du livre-->
            <div class="flex max-1100:flex-col max-1100:items-center mx-auto max-1100:w-[95%] max-450:w-[100%]">
  
              <!-- Section de gauche -->
              <div class="flex flex-col max-1100:flex-row max-450:flex-col max-1100:items-center w-1/4 max-1100:w-[400px] p-4 bg-gray-300">
                <div id="single-book-cover" class="h-[230px] w-[162px] border-2 hover:scale-105 duration-200 mx-auto shadow-lg shadow-warmGray-800 mb-4 bg-center bg-cover rounded"></div>
                <div class="w-[150px] max-1100:w-[180px] mx-auto">
                  <div class="flex justify-between w-4/5 p-2 mx-auto">
                    <div class="relative group">
                      <p class="tooltip w-[50px] text-center">like</p>
                      <button id="like"><i class="transition duration-200 fa-regular fa-thumbs-up fa-2x hover:text-blue-800"></i></button>
                    </div>
                    <div class="relative group">
                      <p class="tooltip">favoris</p>
                      <button id="favoris"><i class="text-gray-700 transition duration-200 hover:text-red-700 fa-solid fa-2x fa-heart"></i></button>
                    </div>
                  </div>          
                  <button id="buy" class="flex items-center justify-evenly w-full py-2 mb-2 text-white rounded">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <p class="text-center font-semibold">acheter</p>
                  </button>
                  <button id="read" class="flex items-center justify-evenly w-full py-2 text-white rounded">
                    <i class="fa-regular fa-file-pdf"></i>
                    <p class="text-center flex-2 font-semibold">lire en pdf</p>
                  </button>
                </div>
              </div>
  
              <!-- Section de droite -->
              <div class="flex flex-col max-1100:w-full w-3/4 p-6 bg-gray-100">
                <h1 id="book-title" class="mb-2 text-3xl font-bold">...</h1>
                <h2 id="book-authors" class="mb-4 text-xl text-gray-700">...</h2>
                <p id="book-description" class="h-[250px] overflow-y-auto border-2 border-orange-600 p-2 mb-6 text-gray-600">
                  <!-- Description -->
                </p>
                <!-- Autres détails -->
                <div class="grid max-1100:text-xs max-600:grid-cols-2 max-400:grid-cols-1 justify-center w-full grid-cols-3 gap-3 mx-auto max-w-fit">
                  <div class="flex flex-col items-center px-2 text-white bg-gray-800 border border-orange-600 max-w-[200px] justify-evenly rounded-xl">
                    <span class="font-bold text-orange-400">categorie :</span>
                    <span id="category" class="font-light w-fit text-nowrap">Fiction</span>
                  </div>
                  <div class="flex flex-col items-center px-2  text-white bg-gray-800 border border-orange-600 justify-evenly rounded-xl">
                    <span class="font-bold text-orange-400">date de publication :</span>
                    <span id="pubDate" class="font-light">28-12-2024</span>
                  </div>
                  <div class="flex flex-col items-center px-2 text-white bg-gray-800 border border-orange-600 justify-evenly rounded-xl">
                    <span class="font-bold text-orange-400">pages :</span>
                    <span id="pageCount" class="font-light">700</span>
                  </div>
                </div>
                <!-- Infos d'accès -->
                <div class="flex flex-col my-5 max-400:hidden">
                  <p class="my-5 font-semibold  underline">Infos d'accès : </p>
                  <div class="flex gap-x-2">
                    <span class="font-semibold w-[190px]" style="color: brown;">Country :</span>
                    <p id="country" ></p>
                  </div>
                  <div class="flex gap-x-2">
                    <span class="font-semibold w-[190px]" style="color: brown;">Viewability :</span>
                    <p id="visibilite"></p>
                  </div>
                  <div class="flex gap-x-2">
                    <span class="font-semibold w-[190px]" style="color: brown;">TextToSpeechPermission :</span>
                    <p id="textToSpeechPermission" ></p>
                  </div>
                </div> 
                <!-- Autres oeuvres de l'auteur -->
                <div class="relative grid w-full h-[300px] grid-cols-1 px-auto mt-[10px] overflow-x-hidden bg-gray-900 border-2 border-orange-600">
                  <h3 id="other-books-title" class="mt-2 text-xl font-semibold text-center text-warmGray-200">...</h3>
                  <div class="absolute z-20 flex justify-between top-[50%] translate-y-[-50%]  w-full">
                    <button class="ml-2"><i id="prev" class="text-white hover:text-orange-500 fa-solid fa-2x fa-arrow-left"></i></button>
                    <button class="mr-2"><i id="next" class="text-white hover:text-orange-500 fa-solid fa-2x fa-arrow-right"></i></button>
                  </div>
                  <div id="slider" class="w-[90%] mx-auto overflow-x-hidden">
                    <div id="other-books" class="flex gap-x-3">
                      <!-- Oeuvres en slide -->
                    </div>
                  </div>
                </div>
              </div>
  
            </div>
  
          </div>
        </div>
      </div>
    </section>
    <footer class="max-850:mt-[300px] border-t text-white font-light bg-black-900 items-start border-gray-200 flex justify-between gap-x-3 p-8 mt-100">
      <div class="flex flex-col items-center gap-y-3">
        <h1 class="font-bold">Plateforme</h1>
        <div class="relative w-[100px] aspect-[1/1]">
          <img src="./img/white-rnl-logo.png" alt="" class="w-fit h-fit brightness-125">
        </div>
      </div>
      <div class="flex flex-col items-center gap-y-3 w-[700px] max-700:hidden">
        <h1 class="font-bold">A propos</h1>
        <p class="text-justify text-xs">
          Bienvenue sur <span class="font-bold text-orange-500">Read and Lead Library</span>, un site conçu pour les passionnés de lecture. Notre plateforme en est encore à ses débuts, 
          mais nous avons de grandes ambitions ! Très bientôt, vous pourrez profiter de nouvelles fonctionnalités, effectuer des recherches 
          plus rapides et accéder à une bibliothèque enrichie qui comblera toutes vos envies littéraires.
          <br>
          Le nom <span class="text-orange-400">"Read and Lead"</span> reflète notre vision : à travers la lecture, chacun peut non seulement s'enrichir personnellement, 
          mais aussi inspirer et guider les autres. Lire, c'est apprendre à diriger sa vie, à ouvrir son esprit à de nouveaux horizons 
          et à devenir un leader dans son domaine.
          <br>
          Nous croyons fermement que la lecture est une porte vers l'inspiration, la connaissance et le changement. Restez connectés pour découvrir les nombreuses surprises que nous vous réservons !
        </p>
      </div>
      <div class="flex flex-col items-center gap-y-3">
        <h1 class="font-bold  ">ml-Dev-k</h1>
        <p class="text-center">&copy; copy right 2025 by Lamine KANE.<br> Tous droits réservés.</p>
      </div>
    </footer>
  </div>
</body>

</html>