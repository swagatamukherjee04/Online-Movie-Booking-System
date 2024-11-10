console.log("login.js loaded successfully");

document.getElementById("sign-in-btn").addEventListener("click", function () {
    document.getElementById("signInForm").style.display = "block";
    document.getElementById("loginForm").style.display = "none";
});

document.getElementById("login-btn").addEventListener("click", function () {
    document.getElementById("loginForm").style.display = "block";
    document.getElementById("signInForm").style.display = "none";
});

document.getElementById("signInForm").addEventListener("click", function (event) {
    if (event.target.classList.contains("popup")) {
        document.getElementById("signInForm").style.display = "none";
    }
});

// Event listener to close the Login popup
document.getElementById("loginForm").addEventListener("click", function (event) {
    if (event.target.classList.contains("popup")) {
        document.getElementById("loginForm").style.display = "none";
    }
});

function closePopup(popupId) {
    document.getElementById(popupId).style.display = "none";
}

// Hide forms on successful login
document.getElementById("logout-btn")?.addEventListener("click", function () {
    window.location.href = "auth/logout.php"; // Redirects to logout script
});

