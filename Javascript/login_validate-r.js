document.getElementById("email_field").addEventListener("keyup", validateEmail, false);
document.getElementById("password_field").addEventListener("keyup", validatePassword, false);

document.getElementById("loginform").addEventListener("submit", validateLogin, false);