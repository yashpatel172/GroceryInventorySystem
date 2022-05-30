//------------------------------Username------------------------------
function validateUsername(event) {
    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var username_textbox = elements.value;

    //----------------Call the tester----------------
    checkUsername(username_textbox);
}
function checkUsername(username_textbox) {
    var isValid = true;

    //----------------Labels----------------
    var username_label = document.getElementById("label_username");

    //----------------Empty the label text----------------
    username_label.innerHTML = "";

    //----------------Formats----------------
    var textNode;
    var regex_username = /^[^\s\d!@£$%^&*()+=]+$/;

    //----------------Username Checker----------------
    if (username_textbox == null || username_textbox == "") {
        textNode = document.createTextNode("Username can't be blank.");
        username_label.style.color = "tomato";
        username_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_username.test(username_textbox) == false) {
        textNode = document.createTextNode("Invalid Username Format. Try Again without digits or spaces!");
        username_label.style.color = "tomato";
        username_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_username.test(username_textbox) == true) {
        textNode = document.createTextNode("Valid Format!");
        username_label.style.color = "mediumseagreen";
        username_label.appendChild(textNode);
    }

    //----------------Return the correctness----------------
    return isValid;
}

//------------------------------Email------------------------------
function validateEmail(event) {
    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var email_textbox = elements.value;

    //----------------Call the tester----------------
    checkEmail(email_textbox);
}
function checkEmail(email_textbox) {
    var isValid = true;

    //----------------Labels----------------
    var email_label = document.getElementById("label_email");

    //----------------Empty the label text----------------
    email_label.innerHTML = "";

    //----------------Formats----------------
    var textNode;
    var regex_email = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

    //----------------Email Checker----------------
    if (email_textbox == null || email_textbox == "") {
        textNode = document.createTextNode("Email can't be blank.");
        email_label.style.color = "tomato";
        email_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_email.test(email_textbox) == false) {
        textNode = document.createTextNode("Invalid Email Format. Try Again! Example: 'word@word.XYZ' with no spaces.");
        email_label.style.color = "tomato";
        email_label.appendChild(textNode);
        isValid = false;
    }
    else if (email_textbox.length > 60) {
        textNode = document.createTextNode("Your length exceeds 60 characters. Try Again!");
        email_label.style.color = "tomato";
        email_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_email.test(email_textbox) == true) {
        textNode = document.createTextNode("Valid Format!");
        email_label.style.color = "mediumseagreen";
        email_label.appendChild(textNode);
    }

    //----------------Return the correctness----------------
    return isValid;
}

//------------------------------Password------------------------------
function validatePassword(event) {
    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var password_textbox = elements.value;

    //----------------Call the tester----------------
    checkPassword(password_textbox);
}
function checkPassword(password_textbox) {
    //----------------Extra Variables----------------
    var isValid = true;

    //----------------Labels----------------
    var password_label = document.getElementById("label_password");

    //----------------Empty the label text----------------
    password_label.innerHTML = "";

    //----------------Formats----------------
    var textNode;
    var regex_password = /^(?=.*[^A-Za-z])[A-Za-z\S]{6,}$/;

    //----------------Password Checker----------------
    if (password_textbox == null || password_textbox == "") {
        textNode = document.createTextNode("Password can't be blank.");
        password_label.style.color = "tomato";
        password_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_password.test(password_textbox) == false) {
        textNode = document.createTextNode("Invalid Format. Format: No Spaces, 6 characters long & atleast one non-letter character.");
        password_label.style.color = "tomato";
        password_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_password.test(password_textbox) == true) {
        textNode = document.createTextNode("Valid Format!");
        password_label.style.color = "mediumseagreen";
        password_label.appendChild(textNode);
    }

    //----------------Return the correctness----------------
    return isValid;
}

//------------------------------Confirm_Password------------------------------
function validateConfirmPassword(event) {
    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var confirmpassword_textbox = elements.value;
    var temp_password_textbox = document.getElementById("password_field").value;

    //----------------Call the tester----------------
    checkConfirmPassword(confirmpassword_textbox, temp_password_textbox);
}
function checkConfirmPassword(confirmpassword_textbox, temp_password_textbox) {
    //----------------Extra Variables----------------
    var isValid = true;

    //----------------Labels----------------
    var confirmpassword_label = document.getElementById("label_confirmpassword");

    //----------------Empty the label text----------------
    confirmpassword_label.innerHTML = "";

    //----------------Formats----------------
    var textNode;
    var regex_password = /^(?=.*[^A-Za-z])[A-Za-z\S]{6,}$/;

    //----------------Confirm Password Checker----------------
    if (confirmpassword_textbox == null || confirmpassword_textbox == "") {
        textNode = document.createTextNode("Confirm Password can't be blank.");
        confirmpassword_label.style.color = "tomato";
        confirmpassword_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_password.test(confirmpassword_textbox) == false) {
        textNode = document.createTextNode("Invalid Format. Format: No Spaces, Atleast 6 characters.");
        confirmpassword_label.style.color = "tomato";
        confirmpassword_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_password.test(confirmpassword_textbox) == true && confirmpassword_textbox != temp_password_textbox) {
        textNode = document.createTextNode("Valid format but doesnt match the Password!");
        confirmpassword_label.style.color = "tomato";
        confirmpassword_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_password.test(confirmpassword_textbox) == true && confirmpassword_textbox == temp_password_textbox) {
        textNode = document.createTextNode("Valid format & matches the Password!");
        confirmpassword_label.style.color = "mediumseagreen";
        confirmpassword_label.appendChild(textNode);
    }
    
    //----------------Return the correctness----------------
    return isValid;
}

//------------------------------Date_of_Birth------------------------------
function validateDOB(event) {
    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var dob_textbox = elements.value;

    //----------------Call the tester----------------
    checkDOB(dob_textbox);
}
function checkDOB(dob_textbox) {
    //----------------Extra Variables----------------
    var isValid = true;

    //----------------Labels----------------
    var dob_label = document.getElementById("label_dob");

    //----------------Empty the label text----------------
    dob_label.innerHTML = "";

    //----------------Formats----------------
    var textNode;
    var regex_date = /^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/;

    //----------------DOB Checker----------------
    if (dob_textbox == null || dob_textbox == "") {
        textNode = document.createTextNode("Date Of Birth can't be blank.");
        dob_label.style.color = "tomato";
        dob_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_date.test(dob_textbox) == false) {
        textNode = document.createTextNode("Invalid Date of Birth.");
        dob_label.style.color = "tomato";
        dob_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_date.test(dob_textbox) == true) {
        textNode = document.createTextNode("Valid Date Of Birth!");
        dob_label.style.color = "mediumseagreen";
        dob_label.appendChild(textNode);
    }

    //----------------Return the correctness----------------
    return isValid;
}

//------------------------------Avatar------------------------------
function validateAvatar(event) {
    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var avatar_box = elements.value;

    //----------------Call the tester----------------
    checkAvatar(avatar_box);
}
function checkAvatar(avatar_box) {
    //----------------Extra Variables----------------
    var isValid = true;

    //----------------Labels----------------
    var avatar_label = document.getElementById("label_avatar");

    //----------------Empty the label text----------------
    avatar_label.innerHTML = "";

    //----------------Avatar Checker----------------
    if (avatar_box == "" || avatar_box == null) {
        textNode = document.createTextNode("Please upload an avatar.");
        avatar_label.style.color = "tomato";
        avatar_label.appendChild(textNode);
        isValid = false;
    }
    else if (avatar_box != "") {
        avatar_label.innerHTML = '<i class="fas fa-check-square"></i>';
        textNode = document.createTextNode("Successfully uploaded!");
        avatar_label.style.color = "mediumseagreen";
        avatar_label.appendChild(textNode);
    }

    //----------------Return the correctness----------------
    return isValid;
}

//------------------------------Signup_Button------------------------------
function validateSignUp(event) {
    //----------------Extra Variables----------------
    var valid1, valid2, valid3, valid4, valid5, valid6;

    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var username_textbox = elements[1].value;
    var email_textbox = elements[2].value;
    var password_textbox = elements[3].value;
    var confirmpassword_textbox = elements[4].value;
    var dob_textbox = elements[5].value;
    var avatar_box = elements[6].value;

    //----------------Access----------------
    if (checkUsername(username_textbox)) {
        valid6 = checkUsername(username_textbox);
    }
    if (checkEmail(email_textbox)) {
        valid1 = checkEmail(email_textbox);
    }
    if (checkPassword(password_textbox)) {
        valid2 = checkPassword(password_textbox);
    }
    if (checkConfirmPassword(confirmpassword_textbox, password_textbox)) {
        valid3 = checkConfirmPassword(confirmpassword_textbox, password_textbox);
    }
    if (checkDOB(dob_textbox)) {
        valid4 = checkDOB(dob_textbox);
    }
    if (checkAvatar(avatar_box)) {
        valid5 = checkAvatar(avatar_box);
    }

    if (!valid1 || !valid2 || !valid3 || !valid4 || !valid5 || !valid6) {
        console.log("SignUp Form is invalid");
        event.preventDefault();
    }
}

/*function SignUpCheck(event)
{
    //----------------Extra Variables----------------
    var isValid = true;

    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var email_textbox = elements[0].value;
    var password_textbox = elements[1].value;
    var confirmpassword_textbox = elements[2].value;
    var dob_textbox = elements[3].value;
    var avatar_box = elements[4].value;

    //----------------Labels----------------
    var email_label = document.getElementById("label_email");
    var password_label = document.getElementById("label_password");
    var confirmpassword_label = document.getElementById("label_confirmpassword");
    var dob_label = document.getElementById("label_dob");
    var avatar_label = document.getElementById("label_avatar");

    //----------------Empty the label text----------------
    email_label.innerHTML="";
    password_label.innerHTML="";
    confirmpassword_label.innerHTML="";
    dob_label.innerHTML="";
    avatar_label.innerHTML="";

    //----------------Formats----------------
    var textNode;
    var regex_email = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]+$/;
    var regex_password = /^(?=.*[^A-Za-z])[A-Za-z\S]{6,}$/;
    var regex_date = /^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/;

    //----------------Email Checker----------------
    if (email_textbox == null || email_textbox == "")
    {
        textNode = document.createTextNode("Email can't be blank.");
        email_label.style.color = "tomato";
        email_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_email.test(email_textbox) == false)
    {
        textNode = document.createTextNode("Invalid Format. Format: No Space, XYZ is MAX: 2-3 (word@word.XYZ)");
        email_label.style.color = "tomato";
        email_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_email.test(email_textbox) == true)
    {
        textNode = document.createTextNode("Valid Format!");
        email_label.style.color = "mediumseagreen";
        email_label.appendChild(textNode);
    }

    //----------------Password Checker----------------
    if (password_textbox == null || password_textbox == "")
    {
        textNode = document.createTextNode("Password can't be blank.");
        password_label.style.color = "tomato";
        password_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_password.test(password_textbox) == false)
    {
        textNode = document.createTextNode("Invalid Format. Format: No Spaces, 6 characters long & atleast one non-letter character.");
        password_label.style.color = "tomato";
        password_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_password.test(password_textbox) == true)
    {
        textNode = document.createTextNode("Valid Format!");
        password_label.style.color = "mediumseagreen";
        password_label.appendChild(textNode);
    }

    //----------------Confirm Password Checker----------------
    if (confirmpassword_textbox == null || confirmpassword_textbox == "")
    {
        textNode = document.createTextNode("Confirm Password can't be blank.");
        confirmpassword_label.style.color = "tomato";
        confirmpassword_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_password.test(confirmpassword_textbox) == false)
    {
        textNode = document.createTextNode("Invalid Format. Format: No Spaces, Atleast 6 characters.");
        confirmpassword_label.style.color = "tomato";
        confirmpassword_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_password.test(confirmpassword_textbox) == true && confirmpassword_textbox != password_textbox)
    {
        textNode = document.createTextNode("Valid format but doesnt match the Password!");
        confirmpassword_label.style.color = "tomato";
        confirmpassword_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_password.test(confirmpassword_textbox) == true && confirmpassword_textbox == password_textbox)
    {
        textNode = document.createTextNode("Valid format & matches the Password!");
        confirmpassword_label.style.color = "mediumseagreen";
        confirmpassword_label.appendChild(textNode);
    }

    //----------------DOB Checker----------------
    if(dob_textbox==null || dob_textbox=="")
    {
        textNode = document.createTextNode("Date Of Birth can't be blank.");
        dob_label.style.color = "tomato";
        dob_label.appendChild(textNode);
        isValid = false;
    }
    else if(regex_date.test(dob_textbox)==false)
    {
        textNode = document.createTextNode("Invalid Date of Birth.");
        dob_label.style.color = "tomato";
        dob_label.appendChild(textNode);
        isValid = false;
    }
    else if(regex_date.test(dob_textbox)==true)
    {
        textNode = document.createTextNode("Valid Date Of Birth!");
        dob_label.style.color = "mediumseagreen";
        dob_label.appendChild(textNode);
    }

    //----------------DOB Checker----------------
    if(avatar_box == "")
    {
        textNode = document.createTextNode("Please upload an avatar.");
        avatar_label.style.color = "tomato";
        avatar_label.appendChild(textNode);
        isValid = false;
    }
    else if(avatar_box != "")
    {
        avatar_label.innerHTML = '<i class="fas fa-check-square"></i>';
        textNode = document.createTextNode("Successfully uploaded!");
        avatar_label.style.color = "mediumseagreen";
        avatar_label.appendChild(textNode);
    }


    //----------------Prevent page from reloading if invalid----------------
    if(isValid == false)
    {
        event.preventDefault();
    }
}*/