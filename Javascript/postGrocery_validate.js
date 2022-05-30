function PostGroceryCheck(event)
{
    //----------------Extra Variables----------------
    var isValid = true;

    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var titleGrocery_textbox = elements[1].value;
    var descriptionGrocery_textbox = elements[2].value;
    var quantityGrocery_textbox = elements[3].value;

    var regex_title = /^[^\d!@£$%^&*()+=]+$/;

    //----------------Labels----------------
    var title_label = document.getElementById("label_title");
    var description_label = document.getElementById("label_description");
    var quantity_label = document.getElementById("label_quantity");
    
    //----------------Empty the label text----------------
    title_label.innerHTML="";
    description_label.innerHTML="";
    quantity_label.innerHTML="";

    //----------------text----------------
    var textNode;

    //----------------Title Checker----------------
    if (titleGrocery_textbox == null || titleGrocery_textbox == "") 
    {
        textNode = document.createTextNode("Grocery Title can't be blank.");
        title_label.style.color = "tomato";
        title_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_title.test(titleGrocery_textbox) == false) {
        textNode = document.createTextNode("Invalid Title Format. TryAgain without digits/Spaces/Specials!");
        title_label.style.color = "tomato";
        title_label.appendChild(textNode);
        isValid = false;
    }
    else
    {
        textNode = document.createTextNode("Valid Format!");
        title_label.style.color = "mediumseagreen";
        title_label.appendChild(textNode);
    }

    //----------------Description Checker----------------
    if (descriptionGrocery_textbox == null || descriptionGrocery_textbox == "") 
    {
        textNode = document.createTextNode("Grocery Description can't be blank.");
        description_label.style.color = "tomato";
        description_label.appendChild(textNode);
        isValid = false;
    }
    else
    {
        textNode = document.createTextNode("Valid Format!");
        description_label.style.color = "mediumseagreen";
        description_label.appendChild(textNode);
    }

    //----------------Quantity Checker----------------
    if (quantityGrocery_textbox == null || quantityGrocery_textbox == "") 
    {
        textNode = document.createTextNode("Grocery Description can't be blank.");
        quantity_label.style.color = "tomato";
        quantity_label.appendChild(textNode);
        isValid = false;
    }
    else
    {
        textNode = document.createTextNode("Valid Format!");
        quantity_label.style.color = "mediumseagreen";
        quantity_label.appendChild(textNode);
    }

    //----------------Prevent page from reloading if invalid----------------
    if(isValid == false)
    {
        event.preventDefault();
    }
}