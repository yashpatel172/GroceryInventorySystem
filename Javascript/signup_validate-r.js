document.getElementById("username_field").addEventListener("keyup", validateUsername, false);
document.getElementById("email_field").addEventListener("keyup", validateEmail, false);
document.getElementById("password_field").addEventListener("keyup", validatePassword, false);
document.getElementById("confirmpassword_field").addEventListener("keyup", validateConfirmPassword, false);
document.getElementById("dob_field").addEventListener("keyup", validateDOB, false);
document.getElementById("avatar_field").addEventListener("change", validateAvatar, false);

document.getElementById("signupform").addEventListener("submit", validateSignUp, false);