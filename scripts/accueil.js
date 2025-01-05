import { fetchBooks, fetchUserBooks , categories , authors } from "./api.js";

$(document).ready(()=>{
  main();
})

function main(){
  $("#msgBtn").on('click', function(){
    setTimeout(() => {
      $("#msgState").empty();
    }, 5000);
  })
  //gestion des barres de recherche
  console.log(userBase)
  if (userBase == "gusers") {
    console.log("ok") // Si l'utilisateur s'est authentifié avec google ?
    $("#userPicture")
    .removeAttr("style")
    .attr("style", `background-image: url(${userPicture});`)
    .addClass("border border-gray-500")
  }

  //recherche general
  $('#main-search-field').on('input', function () {
    $("html, body").animate({ scrollTop: 0 }, 1000);
    let key = $(this).val().trim();  
    if (key) {
      $(".ecranA").hide()
      $('#results').show();
      $("#search-key").html(`résultat pour : <span class="text-orange-500">${key}</span>`)
      $('#noResult').hide();
      $('#results-book-grids').show();
      fetchBooks(key, "results-book-grids");
      setTimeout(function(){
        if ($('#results-book-grids').html().trim() === "") {
          $('#results-book-grids').hide();
          $('#noResult').show();
        }
      },1000)
    } else {
      $("#search-key").empty()
      $("#" + actuel_ecran).show()
      $("#results").hide()
      //$('#results-book-grids').hide();
      //$('#noResult').show();
    }
  });

  //recherche categorie
  $('#category-search-field').on('input', function () {
    $("html, body").animate({ scrollTop: 0 }, 1000);
    let key = $(this).val().trim().toLowerCase();  
    if (key) {
      let filteredCategories = categories.filter(([index,category])=>index.includes(key) || category.includes(key));
      $("#category-name").html(`résultat pour : <span class="text-orange-500">${key}</span>`)
      renderCategories(filteredCategories)
      if (filteredCategories.length === 0) {
        $("#category-grids").html(`          
          <div id="category-noResult" class="flex justify-center items-start absolute w-full" >
            <p class="text-red-600 font-semibold mt-[50px]">No results found <i class="fa-solid text-red-600 fa-exclamation"></i></p>
          </div>
        `)
      }
    } else {
      $("#category-name").empty()
      renderCategories(categories)
      $("#category-grids").show();
      //$('#categorie-noResult').show();
    }
  });

  //recherche auteur
  $('#author-search-field').on('input', function () {
    $("html, body").animate({ scrollTop: 0 }, 1000);
    let key = $(this).val().trim().toLowerCase();  
    if (key) {
      $("#author-name").html(`résultat pour : <span class="text-orange-500">${key}</span>`)
      let filteredAuthors = authors.filter(author=>author.includes(key));
      console.log(filteredAuthors)
      renderAuthors(filteredAuthors)
      if (filteredAuthors.length === 0) {
        $("#author-grids").html(`          
          <div id="category-noResult" class="flex justify-center items-start absolute w-full" >
            <p class="text-red-600 font-semibold mt-[50px]">No results found <i class="fa-solid text-red-600 fa-exclamation"></i></p>
          </div>
        `)
      }
    } else {
      $("#author-name").empty()
      renderAuthors(authors)
      $("#author-grids").show();
    }
  });

  //gestion du sideBar
  $("#sidebar-toggler").on("click", function(){
    $("#sidebar").toggle()
  })

  $(window).on("resize", function () {
    if ($(window).width() > 834) {
      $("#sidebar").show(500);
    }else{
      $("#sidebar").hide();
    }
  });

  $(window).on("resize", function () {
    if ($(window).width()< 442 && actuel_ecran == "home") {
      actuel_ecran = "categories"
      $(".nav-li").removeClass("active")
      $(".categ").addClass("active")
      $(".ecranA").hide()
      $("#categories").show()
      $("#category-grids").show()
    }
  })
  
  if ($(window).width() > 834) {
    $("#sidebar").show(500);
  }else{
    $("#sidebar").hide();
  }

  // gestion des user books
  $("#fav-usrBooks-btn").addClass("active-usrBooks-btn")
    fetchUserBooks(`${pseudo} favorite books`)
  $("#user-book-title").html(`<i class="fa-regular text-red-600 fa-heart"></i>`)
  
  $("#fav-usrBooks-btn").on('click', function(){
    $("#like-usrBooks-btn").removeClass("active-usrBooks-btn")
    $("#fav-usrBooks-btn").addClass("active-usrBooks-btn")
    $("#user-book-title").html(`<i class="fa-regular text-red-600 fa-heart"></i>`)
    fetchUserBooks(`${pseudo} favorite books`)
  })
  $("#like-usrBooks-btn").on('click', function(){
    $("#fav-usrBooks-btn").removeClass("active-usrBooks-btn")
    $("#like-usrBooks-btn").addClass("active-usrBooks-btn")
    $("#user-book-title").html(`<i class="fa-regular text-blue-800 fa-thumbs-up"></i>`)
    fetchUserBooks(`${pseudo} liked books`)

  })

    //Gestion de la navigation
    let actuel_ecran;
    if ($(window).width()> 442) {
      actuel_ecran = "home"
    }else{
      actuel_ecran = "categories"
      $(".categ").addClass("active")
      $(".nav-li").removeClass("active")
      $(".ecranA").hide()
      $("#categories").show()
    }

    $("nav ul").on("click", "li", function(){
      $("#results").hide()
      $("html, body").animate({ scrollTop: 0 }, 0);
      $(".nav-li").removeClass("active");
      $(this).addClass("active");
      $(".ecranA").hide()
      $(".ecranB").hide()
      console.log($(this))
      const destinationA = $(this).data("ecranA")
      actuel_ecran = destinationA
      const destinationB = $(this).data("ecranB")
      console.log("ecran A :", destinationA, " ecran B :", destinationB)
      $("#" + destinationA).show()
      $("#" + destinationB).show()
      //
      $("#author-name").text("Recherchez un auteur")
      $("#category-name").text("Recherchez un catégorie")
    })


    $("#user-book-grids").on("click", "div", function(){ 
      if ($(window).width() < 834) {
        $("#sidebar").hide()
      }
      $("#results").hide()
      $("html, body").animate({ scrollTop: 0 }, 500);
      $("#back").data("destination","#" + actuel_ecran).show()
      let bookDetails = ($(this).data("bookdetails"))
      let key = bookDetails.authors
      init_SinglePage(bookDetails)
      $("#other-books-title").text("Autres œuvres de l'auteur")
      $("#other-books").text("")
      fetchBooks("inauthor:"+key,"other-books")
      
      $("#info-livre").hide()
      $("#back").on("click", function(){
        const destination = $(this).data("destination")
        $(".ecranA").hide()
        //$("#categories").show()
        $(destination).show()
      })
      $("#" + actuel_ecran).hide()
      $("#singleBookDisplay").show()
    })
  

  //gestion des slides
  let intervalID;
  if (intervalID) {
    clearInterval(intervalID);
  }
  let slideId = 2;
  intervalID = setInterval(()=>{
    moveToSlide(slideId);
    slideId = slideId < 3 ? slideId + 1 : 1;
  },8000)
  function moveToSlide(id){
    $(".slide").stop(true,true).hide();
    $("#slide"+id).fadeIn(10);
  }

  //gestion des categories
  renderCategories(categories)
  function renderCategories(categories){
    $("#category-grids").empty()
    $(categories).each(function(key,val){
      $("<div>", {
        "class": `w-[200px] h-[150px] max-500:w-[150px] max-500:h-[125px] max-400:w-[125px] 
        max-400:h-[100px] max-350:w-[100px] max-350:h-[80px] max-300:w-[80px] max-400:text-xs 
        mx-auto aspect-square overflow-hidden bg-cover bg-center`,
        "id":val[0],
      })
      .attr("style", `background-image: url('/img/categories/${val[0]}.jpg');`)
      .html(`<div class="category-overlay" id="${val[0]}"> ${val[1]} </div>`)
      .appendTo($("#category-grids"));
    })
  }

  $("#category-grids").on("click", "div", function(){
    $("#category-search-bar").hide()
    $("html, body").animate({ scrollTop: 0 }, 100);
    const key = $(this).attr("id")
    $("#info-categories").hide()
    $("#back-to-categories").show()
    $("#category-grids").hide()
    $("#category-book-grids").show()
    $("#category-book-grids").text("")
    $("#category-name").html(`catégorie : <span class="text-orange-500">${key}</span>`)
    fetchBooks("subject:" + key ,"category-book-grids")
  })

  $("#back-to-categories").on("click", function(){
    $("#category-search-bar").show()
    $("html, body").animate({ scrollTop: 0 }, 100);
    $("#info-categories").show()
    $("#back-to-categories").hide()
    $("#category-grids").show()
    $("#category-book-grids").hide()
    $("#category-name").text("Recherchez un catégorie")    
  })

  $("#category-book-grids").on("click", "div", function(){ 
    $("html, body").animate({ scrollTop: 0 }, 100);
    $("#back").data("destination","#category-book-grids").show()
    let bookDetails = ($(this).data("bookdetails"))
    let key = bookDetails.authors
    init_SinglePage(bookDetails)
    $("#other-books-title").text("Autres œuvres de l'auteur")
    $("#other-books").text("")
    fetchBooks("inauthor:"+key,"other-books")
    
    $("#info-book").hide()
    $("#back").on("click", function(){
      const destination = $(this).data("destination")
      $(".ecranA").hide()
      $("#categories").show()
      $(destination).show()
    })
    $("#categories").hide()
    $("#singleBookDisplay").show()
  })

  /*Gestion des auteurs*/

  renderAuthors(authors)
  function renderAuthors(authors){
    $("#author-grids").empty()
    $(authors).each(function(key,val){
      //console.log(val)
      $("<div>").addClass(`w-[180px] h-[80px] max-450:w-[120px] max-450:h-[60px] max-450:text-xs mx-auto bg-white hover:border-2 
        hover:text-orange-400 author-overlay`)
      .attr("id",val)
      .css("background-color", "black")
      .text(val)
      .appendTo($("#author-grids"));
    })
  }

  $("#author-grids").on("click", "div", function(){
    $("#author-search-bar").hide()
    $("html, body").animate({ scrollTop: 0 }, 100);
    const key = $(this).attr("id")
    $("#info-authors").hide()
    $("#back-to-authors").show()
    $("#author-grids").hide()
    $("#author-book-grids").text("").show()
    $("#author-name").html(`auteur : <span class="text-orange-500">${key}</span>`)
    fetchBooks("inauthor:"+key,"author-book-grids")
  })
  
  $("#author-book-grids").on("click", "div", function(){
    $("html, body").animate({ scrollTop: 0 }, 100);
    $("#back").data("destination","#author-book-grids").show()
    let bookDetails = ($(this).data("bookdetails"))
    let key = bookDetails["categorie"][0]
    init_SinglePage(bookDetails)
    
    if (bookDetails.categorie != "non defini") {
      $("#other-books-title").text(bookDetails.categorie)
      $("#other-books").text("")
      fetchBooks("subject:"+key,"other-books")
    }else{
      $("#other-books").hide()
    }
    
    $("#info-book").hide()
    $("#back").on("click", function(){
      const destination = $(this).data("destination")
      console.log(destination)
      $(".ecranA").hide()
      $("#authors").show()
      $(destination).show()
    })
    $("#authors").hide()
    $("#singleBookDisplay").show()
  })
  
  $("#back-to-authors").on("click", function(){
    $("#author-search-bar").show()
    $("html, body").animate({ scrollTop: 0 }, 500);
    $("#info-authors").show()
    $("#back-to-authors").hide()
    $("#author-grids").show()
    $("#author-book-grids").hide()
    $("#author-name").text("Recherchez un auteur")    
  })
  //Gestion des resultats de recherches

  $("#results-book-grids").on("click", "div", function(){
    $("html, body").animate({ scrollTop: 0 }, 100);
    $("#back").data("destination","#results").show()
    let bookDetails = ($(this).data("bookdetails"))
    let key = bookDetails["authors"][0]
    init_SinglePage(bookDetails)
    
    $("#other-books-title").text("D'autres oeuvres de : " + key)
    $("#other-books").text("")
    fetchBooks("inauthor:"+key,"other-books")
    
    $("#back").on("click", function(){
      const destination = $(this).data("destination")
      console.log(destination)
      $(".ecranA").hide()
      $(destination).show()
    })
    $("#results").hide()
    $("#singleBookDisplay").show()
  })



  /*Gestion du single page*/

  $("#prev").on("click", function() {
    $("#slider")[0].scrollBy({
      left: -110,
      behavior: 'smooth' 
    });
  });
  
  $("#next").on("click", function() {
    $("#slider")[0].scrollBy({
      left: 110, 
      behavior: 'smooth'
    });
  });

  $("#other-books").on("click", "div", function(){ 
    window.scrollTo({ top: 0, behavior: "smooth" });
    let bookDetails = ($(this).data("bookdetails"))
    let key = bookDetails.authors
    init_SinglePage(bookDetails)
    $("#other-books-title").text("Autres œuvres de l'auteur")
    $("#other-books").text("")
    fetchBooks("inauthor:"+key,"other-books")
  })

  
}

function init_SinglePage(bookDetails){

  $("#single-book-cover").css("background-image", `url(${bookDetails.cover})`)     
  //Gestion du boutons favoris❤
  $("#favoris i").removeAttr("style")
  let favoris = JSON.parse(localStorage.getItem(`${pseudo} favorite books`)) || []
  if (favoris.find((val)=>val.bookId == bookDetails.bookId)) {
    $("#favoris i").attr("style","color: red;")
  }
  $("#favoris").off("click").on("click", function(){
    let favoris = JSON.parse(localStorage.getItem(`${pseudo} favorite books`)) || []         
    if (favoris.find((val)=> val.bookId == bookDetails.bookId)) {
      $("#favoris i").removeAttr("style")
      favoris = favoris.filter((val)=>val.bookId != bookDetails.bookId)
      }else{
        $("#favoris i").attr("style","color: red;")
        favoris.unshift(bookDetails)
      }
    localStorage.setItem(`${pseudo} favorite books`, JSON.stringify(favoris))
    fetchUserBooks(`${pseudo} favorite books`)
    // sideBarre update
    $("#like-usrBooks-btn").removeClass("active-usrBooks-btn")
    $("#fav-usrBooks-btn").addClass("active-usrBooks-btn")
    $("#user-book-title").html(`<i class="fa-regular text-red-600 fa-heart"></i>`)
  })

  //Gestion du bouton like👍
  $("#like i").removeAttr("style")
  let likes = JSON.parse(localStorage.getItem(`${pseudo} liked books`)) || []
  if (likes.find((val)=>val.bookId == bookDetails.bookId)) {
    $("#like i").attr("style","color: blue;")
  }
  $("#like").off("click").on("click", function(){
    let likes = JSON.parse(localStorage.getItem(`${pseudo} liked books`)) || []         
    if (likes.find((val)=> val.bookId == bookDetails.bookId)) {
      $("#like i").removeAttr("style")
      likes = likes.filter((val)=>val.bookId != bookDetails.bookId)
      }else{
        $("#like i").attr("style","color: blue;")
      likes.unshift(bookDetails)
      }
    localStorage.setItem(`${pseudo} liked books`, JSON.stringify(likes))
    fetchUserBooks(`${pseudo} liked books`)
    //sideBarre update
    $("#fav-usrBooks-btn").removeClass("active-usrBooks-btn")
    $("#like-usrBooks-btn").addClass("active-usrBooks-btn")
    $("#user-book-title").html(`<i class="fa-regular text-blue-800 fa-thumbs-up"></i>`)
  })

  //Gestion du bouton BUY: acheter
  if (!bookDetails.buyLink) {
    $("#buy").css("background-color","black")
    $("#buy p").text("pas à vendre !").css("color","red")
  }else{
    $("#buy").css("background-color","blue")
    $("#buy p").text("acheter").css("color", "white")
  }
  $("#buy").off("click").on("click", function(){
    if (bookDetails.buyLink) {
      window.open(bookDetails.buyLink, '_blank');
    }
  })
  //Gestion du bouton READ: lire
  if (!bookDetails.pdf) {
    $("#read").css("background-color","black")
    $("#read p").text("indisponible !").css("color", "red")
  }else{
    $("#read").css("background-color","#8B0000")
    $("#read p").text("telecharger pdf").css("color","white")
  }
  $("#read").off("click").on("click", function(){
    if (bookDetails.pdf) {
      window.open(bookDetails.pdf, '_blank');
    }
  })

  //Gestion des infos du livres
  $("#book-title").text(bookDetails.title)
  $("#book-authors").text(bookDetails.authors)
  $("#book-description").text(bookDetails.description);
  $("#category").text(bookDetails.categorie)
  $("#pubDate").text(bookDetails.pubDate)
  $("#pageCount").text(bookDetails.pageCount)
  $("#country").text(bookDetails["accessInfo"].country)
  $("#visibilite").text(bookDetails["accessInfo"].viewability)
  $("#textToSpeechPermission").text(bookDetails["accessInfo"].textToSpeechPermission)
}


