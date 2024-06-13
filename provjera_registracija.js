document.getElementById("submit").onclick = function (event) {
    var provjera = true;

    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var passwordCheck = document.getElementById("passwordCheck").value;

    var errorUsername = document.getElementById("errorUsername");
    var errorPassword = document.getElementById("errorPassword");
    var errorPasswordCheck = document.getElementById("errorPasswordCheck");

    if (username.length < 4 || username.length > 10) {
        document.getElementById("username").style.border = "1px solid red";
        errorUsername.innerHTML = "Korisničko ime mora imati između 4 i 10 znakova.<br>";
        errorUsername.style.color = "red";

        provjera = false;
    } else {
        errorUsername.style.border = "";
    }

    if (password.length < 4 || password.length > 10) {
        document.getElementById("password").style.border = "1px solid red";
        errorPassword.innerHTML = "Šifra mora imati između 4 i 10 znakova.<br>";
        errorPassword.style.color = "red";

        provjera = false;
    } else {
        errorPassword.style.border = "";
    }


    if (password != passwordCheck) {
        document.getElementById("passwordCheck").style.border = "1px solid red";
        errorPasswordCheck.innerHTML = "Šifra i ponovljena šifra se ne podudaraju.<br>";
        errorPasswordCheck.style.color = "red";

        provjera = false;
    } else {
        errorPasswordCheck.style.border = "";
    }


    if (provjera != true) {
        event.preventDefault();
    }
}