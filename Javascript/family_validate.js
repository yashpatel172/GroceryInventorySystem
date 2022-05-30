function CreateFamily(event)
{
    //----------------Extra Variables----------------
    var isValid = true;

    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var createFamily_textbox = elements[0].value;

    //----------------Labels----------------
    var createFamily_label = document.getElementById("label_createFamily");
    
    //----------------Empty the label text----------------
    createFamily_label.innerHTML="";

    //----------------text----------------
    var textNode;
    var regex_family = /^[^\s\d!@£$%^&*()+=]+$/;

    //----------------Title Checker----------------
    if (createFamily_textbox == null || createFamily_textbox == "") 
    {
        textNode = document.createTextNode("Family Name can't be blank.");
        createFamily_label.style.color = "tomato";
        createFamily_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_family.test(createFamily_textbox) == false) {
        textNode = document.createTextNode("Invalid Family Name. Try Again without Digits/Specials/Spaces!");
        createFamily_label.style.color = "tomato";
        createFamily_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_family.test(createFamily_textbox) == true) {
        textNode = document.createTextNode("Valid Format!");
        createFamily_label.style.color = "mediumseagreen";
        createFamily_label.appendChild(textNode);
    }

    if(isValid == false)
    {
        console.log("isInvalid");
        event.preventDefault();
    }
}