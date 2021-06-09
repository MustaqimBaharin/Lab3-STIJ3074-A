function previewFile() {
    const preview = document.querySelector('.imgselection-pr');
    const file = document.querySelector('input[type=file]').files[0];
    const reader = new FileReader();
    reader.addEventListener("load", function () {
        // convert image file to base64 string
        preview.src = reader.result;
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
}

function validateLoginForm() {
    var username = document.forms["loginForm"]["idemail"].value;
    var pass = document.forms["loginForm"]["idpass"].value;
    if ((username == "") || (pass == "")) {
        alert("Please fill out your username/password");
        return false;
    }
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!re.test(String(username))) {
        alert("Please correct your email");
        return false;
    }
}
function validateRegForm() {
    var username = document.forms["registerForm"]["idemail"].value;
    var pass = document.forms["registerForm"]["idpass"].value;
    if ((username == "") || (pass == "")) {
        alert("Please fill out your username/password");
        return false;
    }
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!re.test(String(username))) {
        alert("Please correct your email");
        return false;
    }
}

function setCookies(email, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = "email=" + email + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function loadCookies() {
    var email = getCookie("email");
    if (email == null || email == "") {
        email = prompt("Please enter your email", "");
        setCookies(email, 30);
        alert('Email stored');
    } else {
        return;
    }
}
function cookiesdialog(){
    email = prompt("Please enter your email", "");
    setCookies(email, 30);
    alert('Email stored');
}

function cartDialog() {
    var r = confirm("Insert into cart?");
    if (r == true) {
        return true;
    } else {
        return false;
    }
}

function deleteDialog() {
    var r = confirm("Delete this item?");
    if (r == true) {
        return true;
    } else {
        return false;
    }
}

