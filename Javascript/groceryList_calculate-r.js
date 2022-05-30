document.addEventListener('DOMContentLoaded', (event) => {
    var textbox = document.querySelectorAll('.myquantity');
    var button = document.querySelectorAll('.consume');

    for(var i=0; i<textbox.length; i++)
    {
       if(textbox[i].value == 0)
       {
        button[i].style.display = "none";
       }

       if(textbox[i].value != 0)
       {
        button[i].style.display = "inline-block";
       }
    }
  })