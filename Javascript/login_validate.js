//------------------------------Email------------------------------
function validateEmail(event)
{
    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var email_textbox = elements.value;

    //----------------Call the tester----------------
    checkEmail(email_textbox);
}
function checkEmail(email_textbox)
{
    var isValid = true;

    //----------------Labels----------------
    var email_label = document.getElementById("label_email");
    
    //----------------Empty the label text----------------
    email_label.innerHTML="";

    //----------------Formats----------------
    var textNode; 
    var regex_email = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

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
        textNode = document.createTextNode("Invalid Email Format. Try Again! Example: 'word@word.XYZ' with no spaces.");
        email_label.style.color = "tomato";
        email_label.appendChild(textNode);
        isValid = false;
    }
    else if (email_textbox.length > 60) 
    {
        textNode = document.createTextNode("Your length exceeds 60 characters. Try Again!");
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

    return isValid;
}

//------------------------------Password------------------------------
function validatePassword(event)
{
    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var password_textbox = elements.value;

    //----------------Call the tester----------------
    checkPassword(password_textbox);
}
function checkPassword(password_textbox) 
{
    //----------------Extra Variables----------------
    var isValid = true;

    //----------------Labels----------------
    var password_label = document.getElementById("label_password");
    
    //----------------Empty the label text----------------
    password_label.innerHTML="";

    //----------------Formats----------------
    var textNode; 
    var regex_password = /^(?=.*[^A-Za-z])[A-Za-z\S]{6,}$/;

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

    //----------------Return the correctness----------------
    return isValid;
}

//------------------------------Login_Button------------------------------
function validateLogin(event)
{
    var valid1, valid2;
    var elements = event.currentTarget;

    var email_textbox = elements[1].value; 
    var password_textbox = elements[2].value;

    //----------------Access----------------
    if(checkEmail(email_textbox))
    {
        valid1 = checkEmail(email_textbox);
    }
    if(checkPassword(password_textbox))
    {
        valid2 = checkPassword(password_textbox);
    }
    if(!valid1 || !valid2)
    {
        console.log("Login Form is invalid");
        event.preventDefault();
    }
}

/*function LoginCheck(event) 
{
    //----------------Extra Variables----------------
    var isValid = true;

    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var email_textbox = elements[0].value;
    var password_textbox = elements[1].value;

    //----------------Labels----------------
    var email_label = document.getElementById("label_email");
    var password_label = document.getElementById("label_password");
    
    //----------------Empty the label text----------------
    email_label.innerHTML="";
    password_label.innerHTML="";

    //----------------Formats----------------
    var textNode; 
    var regex_email = /^[a-zA-Z0-9.~!@#$%^&*{|}`*+=/?_-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-_]+)*$/;
    var regex_password = /^(?=.*[^A-Za-z])[A-Za-z\S]{6,}$/;

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

    //----------------Prevent page from reloading if invalid----------------
    if(isValid == false)
    {
        event.preventDefault();
    }
}*/