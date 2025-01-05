<?php
function inscription(int $etat): string {
    if ($etat == 0) { // etat initial
        return "";
    }
    if ($etat == 1) { // inscription réussie.
        return 
        "<p class='p-4 mt-2 bg-green-300 shadow-sm border-black-500'> Inscription Réussie !</p>";
    }
    if ($etat == 2) { // non correspondance des deux mots de passe.
        return 
        "<p class='p-4 mt-2 bg-red-300 shadow-sm border-black-500'> Le mot de passe saisi et celui confirmé ne correspondent pas !</p>";
    }
    if ($etat == 3) { // nom d'utilisateur existe déjà.
        return 
        "<p class='p-4 mt-2 bg-red-300 shadow-sm border-black-500'> 
            Un compte est déjà associé à cet email, connectez-vous !
        </p>";
    }
    if ($etat == 4) { // erreur inattendue !
        return "<p class='p-4 mt-2 bg-red-300 shadow-sm border-black-500'> Erreur inattendue !</p>";
    }
}
function connexion(int $etat): string{
    if ($etat == 0) { // etat initial
        return "";
    }
    if ($etat == 1) { // nom d'utilisateur ou mot de passe incorrete !
        return "<p class='p-4 mt-2 bg-red-300 shadow-sm border-black-500'> nom d'utilisateur ou mot de passe incorrete !</p>";
    }
}
function recupereValeurChamps($champ, $methode = "POST"){
  $src = strtoupper($methode) === "POST" ? $_POST : $_GET;
  
  if (isset($src[$champ]) && !empty(trim($src[$champ]))) {
      $value = $src[$champ];
      return $value;
  }
};

?>