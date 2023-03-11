function navFunction() {
    var x = document.getElementById("idnavbar");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}

function rememberMe() {
    var rememberme = document.forms["loginForm"]["idremember"].checked;
    var email = document.forms["loginForm"]["idemail"].value;
    var password = document.forms["loginForm"]["idpass"].value;
    console.log("Form data:" + rememberme + "," + email + "," + password);
    if(!rememberme) {
        setCookies("cemail", "", 0);
        setCookies("cpass", "", 0);
        setCookies("crem", false, 30);
        document.forms["loginForm"]["idemail"].value = "";
        document.forms["loginForm"]["idpass"].value = "";
        document.forms["loginForm"]["idremember"].checked = false;
        alert("Credentials Removed");
    }else {
        if (email == "" && password == ""){
            document.forms["loginForm"]["idremember"].checked = false;
            alert("Please enter your credentials");
            return false;
        } else {
            setCookies("cemail", email, 30);
            setCookies("cpass", password, 30);
            setCookies("crem", rememberme, 30);
            alert("Credentials Stored Success");
        }
    }
}

function setCookies(cookiename, cookiedata, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 *60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cookiename + "=" + cookiedata + ";" + expires + ";path=/";
}

function loadCookies() {
    var email = getCookie("cemail");
    var password = getCookie("cpass");
    var rememberme = getCookie("crem");
    console.log("COOKIES:" + email, password, rememberme);
    document.forms["loginForm"]["idemail"].value = email;
    document.forms["loginForm"]["idpass"].value = password;
    if (rememberme) {
        document.forms["loginForm"]["idremember"].checked = true;
    } else {
        document.forms["loginForm"]["idremember"].checked = false;
    }
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
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

function logout() {
    var r = confirm("Logout?");
    if (r == true) {
        alert('Log out success');
        return true;
    } else {
        return false;
    }
}

function previewFile() {
    const preview = document.querySelector('.w3-image');
    const file = document.querySelector('input[type=file]').files[0];
    const reader = new FileReader();
    reader.addEventListener("load", function() {
        preview.src = reader.result;
    }, false);

    if (file){
        reader.readAsDataURL(file);
    }
}

function confirmDialog() {
    var r = confirm("Register this staff?");
    if (r == true) {
        return true;
    }else{
        return false;
    }
}
