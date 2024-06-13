
document.getElementById("submit").onclick = function (event) {
    var provjera = true;

    var title = document.getElementById("title").value;
    var summary = document.getElementById("summary").value;
    var text = document.getElementById("text").value;
    var picture = document.getElementById("picture").value;
    var date = document.getElementById("date").value;
    var category = document.getElementById("category").value;

    var errorTitle = document.getElementById("errorTitle");
    var errorSummary = document.getElementById("errorSummary");
    var errorText = document.getElementById("errorText");
    var errorPicture = document.getElementById("errorPicture");
    var errorDate = document.getElementById("errorDate");
    var errorCategory = document.getElementById("errorCategory");

    if (title.length < 5 || title.length > 30) {
      document.getElementById("title").style.border = "1px solid red";
      errorTitle.innerHTML = "Naslov mora imati između 5 i 30 znakova.<br>";
      errorTitle.style.color = "red";

      provjera = false;
    } else {
      errorTitle.style.border = "";
    }

    if (summary.length < 10 || summary.length > 100) {
      document.getElementById("summary").style.border = "1px solid red";
      errorSummary.innerHTML = "Kratak sadržaj mora imati između 10 i 100 znakova.<br>";
      errorSummary.style.color = "red";

      provjera = false;
    } else {
      document.getElementById("summary").style.border = "";
    }

    if (text === "") {
      document.getElementById("text").style.border = "1px solid red";
      errorText.innerHTML = "Tekst ne smije biti prazan.<br>";
      errorText.style.color = "red";

      provjera = false;
    } else {
      document.getElementById("text").style.border = "";
    }

    if (picture === "") {
      document.getElementById("picture").style.border = "1px solid red";
      errorPicture.innerHTML = "Slika ne smije biti prazna.<br>";
      errorPicture.style.color = "red";

      provjera = false;
    } else {
      document.getElementById("picture").style.border = "";
    }

    if (date === "") {
      document.getElementById("date").style.border = "1px solid red";
      errorDate.innerHTML = "Datum ne smije biti prazan.<br>";
      errorDate.style.color = "red";

      provjera = false;
    } else {
      document.getElementById("date").style.border = "";
    }

    if (category === "") {
      document.getElementById("category").style.border = "1px solid red";
      errorCategory.innerHTML = "Kategorija ne smije biti prazna.<br>";
      errorCategory.style.color = "red";

      provjera = false;
    } else {
      document.getElementById("category").style.border = "";
    }

    if (provjera != true) {
      event.preventDefault();
    }
  }

