
const categ = {
  "history": "histoire",
  "drama": "drame", 
  "business": "business",
  "mystery": "mystere",
  "political": "politique",
  "office": "policier",
  "sports": "sport",
  "psychology": "psychologie",
  "self-help": "dev-personnel",
  "cooking": "cuisine",
  "science-fiction": "science-fiction",
  "fantasy": "fantastique",
  "romance": "romance",
  "thrillers": "thriller",
  "horror": "horreur",
  "adventure": "aventure",
  "children": "enfants",
  "educations": "éducation",
  "arts": "arts",
  "philosophy": "philosophie",
  "religion": "religion",
  "travel": "voyage",
  "biography": "biographie",
  "health": "santé",
  "poetry": "poésie",
  "comics": "bande-dessinée",
  "music": "musique",
  "technology": "technologie",
  "economics": "économie",
  "law": "droit"
  }
export const categories = Object.entries(categ)

export const authors = [
  "adam grant", "agatha christie", "alain-fournier", "albert camus", "aldous huxley",
  "alexandre dumas", "amélie nothomb", "andré gide", "ann patchett", "anne rice",
  "annie ernaux", "antoine de saint-exupéry", "arthur rimbaud",
  "barack obama", "beatrix potter", "bernard werber", "bill gates",
  "sékou touré", "willy mutunga", "frantz fanon",
  "chinua achebe", "ngũgĩ wa thiong'o", "wole soyinka", "nawal el saadawi",
  "amina mama", "miriam tlali", "tsitsi dangarembga",
  "thiongo ngugi wa", "lupita nyong'o", "grace ogot", "zakes mda",
  "leila aboulela", "abu bakarr bah", "binyavanga wainaina", "leila slimani",
  "boris vian", "brené brown", "c.s. lewis", "celeste ng", "charles baudelaire",
  "charles dickens", "chimamanda ngozi adichie", "chitra banerjee divakaruni",
  "christian bobin", "colette", "colleen hoover", "dale carnegie", "dan brown",
  "daniel pennac", "dante alighieri", "deepak chopra", "delphine de vigan",
  "denis diderot", "diana gabaldon", "donna tartt", "douglas adams", "dr. seuss",
  "e.l. james", "eckhart tolle", "emily brontë", "erik orsenna", "ernest hemingway",
  "f. scott fitzgerald", "franz kafka", "françoise sagan", "frédéric beigbeder",
  "fyodor dostoevsky", "gabriel garcía márquez", "george orwell", "guillaume musso",
  "gustave flaubert", "haruki murakami", "herman melville", "honoré de balzac",
  "ian fleming", "isabel allende", "j.d. salinger", "j.k. rowling", "j.m.g. le clézio",
  "j.r.r. tolkien", "james clear", "james joyce", "jane austen", "jean-paul sartre",
  "khaled hosseini", "kurt vonnegut", "leo tolstoy", "louisa may alcott", "marcel proust",
  "mark twain", "michel houellebecq", "michelle obama", "molière", "oscar wilde",
  "paulo coelho", "ray bradbury", "rené barjavel", "roald dahl", "robin sharma",
  "romain gary", "simone de beauvoir", "stendhal", "stephen king", "suzanne collins",
  "chimamanda ngozi adichie", "buchi emecheta", "nuruddin farah", "ben okri",
  "mohamed mbougar sarr", "mariama ba", "henri lopez", "assyata shakur",
  "camara laye", "tahar ben jelloun", "ahmadou kourouma", "andré brink",
  "coetzee j.m.", "alain mabanckou", "doris lessing", "adebayo ayobami",
  "fatou diome", "mohamed choukri", "yambo ouologuem", "cheikh anta diop",
  "alioune diop", "ken bugul", "naguib mahfouz", "lydia umulisa",
  "bessie head", "abdellatif laabi", "peter abrahams", "keorapetse kgositsile",
  "maria nsue angüe", "david diop", "joseph ki-zerbo", "assia djebar",
  "malidoma patrice some", "atiq rahimi", "elizabeth tshele",
  "ewa idowu akinsola", "amina wadud", "benedicte savoy", "kofi awoonor",
  "victor hugo", "virginia woolf", "yuval noah harari", "école 42", "paul bocuse",
  "joël robuchon", "alain ducasse", "gordon ramsay", "jamie oliver", "thomas keller",
  "julia child", "nigella lawson", "rick stein", "david chang", "anthony bourdain",
  "toyin falola", "nana asma'u", "sheriff ibrahim", "aida boudjedra",
  "okey ndibe", "teju cole", "naomi chinua",
  "marie kondo", "tim ferriss", "tony robbins", "brian tracy", "robin sharma",
  "stephen covey", "napoleon hill", "james clear", "cal newport", "gary vaynerchuk",
  "simon sinek", "ryan holiday", "eckhart tolle", "deepak chopra", "marcus aurelius",
  "seneca", "epictetus", "plato", "aristotle", "socrates", "confucius", "lao tzu",
  "friedrich nietzsche", "karl marx", "jean-jacques rousseau", "rené descartes",
  "immanuel kant", "john locke", "baruch spinoza", "alain de botton", "slavoj žižek",
  "noam chomsky", "bertrand russell", "alan watts", "jordan peterson", "sam harris",
  "daniel kahneman", "steve jobs", "bill gates", "elon musk", "mark zuckerberg",
  "jeff bezos", "larry page", "sergey brin", "tim berners-lee", "linus torvalds",
  "richard stallman", "donald knuth", "bjarne stroustrup", "james gosling",
  "guido van rossum", "dennis ritchie", "ken thompson", "grace hopper", "ada lovelace",
  "margaret hamilton", "katherine johnson", "barbara liskov", "marissa mayer",
  "sheryl sandberg", "susan wojcicki", "meg whitman", "ginni rometty", "ursula burns",
  "indira nooyi", "safra catz", "mary barra", "diane greene", "padmasree warrior",
  "marc benioff", "satya nadella", "sundar pichai", "shantanu narayen", "arvind krishna",
  "thomas kurian", "dara khosrowshahi", "reed hastings", "daniel ek", "patrick collison",
  "john collison", "brian chesky", "joe gebbia", "nathan blecharczyk", "drew houston",
  "arash ferdowsi", "evan spiegel", "bobby murphy", "kevin systrom", "mike krieger",
  "jack dorsey", "biz stone", "ev williams", "noah glass", "peter thiel", "max levchin",
  "reid hoffman", "jeff weiner", "dick costolo", "marc andreessen", "ben horowitz",
  "fred wilson", "paul graham", "jessica livingston", "sam altman", "patrick o'shaughnessy",
  "howard marks", "ray dalio", "warren buffett", "charlie munger", "bill ackman",
  "carl icahn", "george soros", "peter lynch", "john bogle", "jack bogle", "david swensen",
  "jim simons", "ken griffin", "steve schwarzman", "henry kravis", "leon black",
  "stephen schwarzman", "david rubenstein", "daniel loeb", "paul singer", "bill gross",
  "jeffrey gundlach", "mohamed el-erian",
  
];

  

export async function fetchBooks(key, container){
  const cleAPI = 'AIzaSyAQXxGelVC0WCRYG54O9to_fHLMD5uOZbE'
  const url = `https://www.googleapis.com/books/v1/volumes?q=${key}&maxResults=40`
  

  try {
    
    const response = await fetch(url, { /*signal*/ });
    if (!response.ok) {
      throw new Error(`HTTP error ! status: ${response.status}`);
    }else{
      const data = await response.json();
      const books = data.items
      console.log(books);

      $("#" + container).text("")
      $(books).each(function(index,book){
      const summary = book.volumeInfo.description;
      if (summary) {
      const bookId = book.id
      const title = book.volumeInfo.title;
      const categorie = book.volumeInfo.categories || "non defini";
      const accessInfo = book.accessInfo;
      const pdf = accessInfo.pdf ? accessInfo.pdf.acsTokenLink : null;
      const buyLink = book.saleInfo["buyLink"];
      const description = book.volumeInfo.description;
      const pageCount = book.volumeInfo.pageCount;
      const pubDate = book.volumeInfo.publishedDate.split("T")[0];
      const cover = book.volumeInfo.imageLinks.thumbnail;
      const authors = book.volumeInfo.authors;
      const bookDetails = JSON.stringify({
        "bookId":bookId,
        "title": title,
        "categorie": categorie || "non spécifié",
        "accessInfo": accessInfo,
        "pdf": pdf,
        "buyLink": buyLink,
        "pageCount": pageCount,
        "pubDate": pubDate,
        "cover": cover,
        "authors": authors,
        "description": description
      });
      let text = "";
      text += bookDetails
      //console.log(JSON.parse(text))
      
        $("<div>", {
          "class": "mx-auto max-600:w-[110px] max-600:h-[195px] max-1100:w-[130px] max-1100:h-[205px] shrink-0 w-[140px] h-[220px]",
          "data-bookdetails": bookDetails
        })    
        /*.html(`
          <div class="w-full livre-info bg-black-900">
            <div class="flex flex-col items-center justify-center h-[120px]" style="display:none;">
              <p class="w-full text-center text-xs p-1 font-light text-orange-400 opacity-100 text-wrap">${title}</p>
            </div>
          </div>
          `)*/.append(
            $("<div>", {
              "class": "bg-cover bg-gray-300 rounded book-overlay",
              "style": `background-image: url('${cover}')`,
              "data-bookdetails": bookDetails
            })
            //url('./img/categories/histoire.jpg')
          ).appendTo("#" + container)
        }
          
      })
    }
        
  } catch (error) {
    console.error("Error fetching data", error.message);
  }
}

/*setTimeout(function(){
  abortCtrl.abort()
},5000)*/

export async function fetchUserBooks(choice){   
  $("#user-book-grids").text("")
  let books = JSON.parse(localStorage.getItem(choice)) || [] 
 
  $(books).each(function(key,val){ 
    $("<div>", {
      "class": "w-[100px] h-[170px] max-850:w-[95px]",
      "data-bookdetails": JSON.stringify(val)
    }).append(
      $("<div>", {
        "class": "bg-cover bg-gray-300 rounded book-overlay",
        "style": `background-image: url('${val.cover}')`,
        "data-bookdetails": JSON.stringify(val)
      })
      ).appendTo("#user-book-grids")
    }       
  )

}




