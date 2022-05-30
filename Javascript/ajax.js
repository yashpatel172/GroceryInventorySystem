setInterval(checkPosts, 90000);

function checkPosts()
{
    var req = new XMLHttpRequest();

    req.onreadystatechange = function()
    {
        if(req.readyState == 4 && req.status == 200)
        {
            createPosts(req.responseText);
        }
    }

    req.open("GET", "ajax_backend.php", true);
    req.send();
}

var postID;

//============================== BUY/CONSUME BUTTON UPDATE LOGIC ==============================
function updateTextBoxData(response)
{
    var jsondata = JSON.parse(response);

    for(var i = 0; i<jsondata.length; i++)
    {
        if(jsondata[i].pid == postID)
        {
            var textCountElement = document.getElementById("textbox-"+jsondata[i].pid);
            var consumeButton = document.getElementById("consume-"+jsondata[i].pid);

            if(textCountElement)
            {
                textCountElement.value = jsondata[i].quantity;

                if(textCountElement.value <=0)
                {
                    consumeButton.style.visibility = "hidden";
                }
                else
                {
                    consumeButton.style.visibility = "visible";
                }
            }
        }
    }
}

function deletePost(response)
{
    var jsondata = JSON.parse(response);

    for(var i = 0; i<jsondata.length; i++)
    {
        if(jsondata[i].pid != postID)
        {
            document.getElementById("box-"+postID).remove();
        }
    }
}

function buyButtonClick(e)
{
    postID = e.currentTarget.id.split("-")[1];

    var req = new XMLHttpRequest();

    req.onreadystatechange = function()
    {
        if(req.readyState == 4 && req.status == 200)
        {
            updateTextBoxData(req.responseText);
        }
    }

    req.open("GET", "ajax_backend.php?buypid=" + postID, true);
    req.send();
}

function consumeButtonClick(e)
{
    postID = e.currentTarget.id.split("-")[1];

    var req = new XMLHttpRequest();

    req.onreadystatechange = function()
    {
        if(req.readyState == 4 && req.status == 200)
        {
            updateTextBoxData(req.responseText);
        }
    }

    req.open("GET", "ajax_backend.php?consumepid=" + postID, true);
    req.send();
}

function deleteButtonClick(e)
{
    postID = e.currentTarget.id.split("-")[1];

    var req = new XMLHttpRequest();

    req.onreadystatechange = function()
    {
        if(req.readyState == 4 && req.status == 200)
        {
            deletePost(req.responseText);
        }
    }

    req.open("GET", "ajax_backend.php?deletepid=" + postID, true);
    req.send();
}

//Adding Event Listener to BUY buttons
var allBuyButtons = document.getElementsByClassName("buy");
for (var i = 0; i < allBuyButtons.length; i++)
{
    allBuyButtons[i].addEventListener("click", buyButtonClick, false);
}

//Adding Event Listener to CONSUME buttons
var allConsumeButtons = document.getElementsByClassName("consume");
for (var i = 0; i < allConsumeButtons.length; i++)
{
    allConsumeButtons[i].addEventListener("click", consumeButtonClick, false);
}

//Adding Event Listener to DELETE buttons
var allDeleteButtons = document.getElementsByClassName("delete");
for (var i = 0; i < allDeleteButtons.length; i++)
{
    allDeleteButtons[i].addEventListener("click", deleteButtonClick, false);
}

//This was really tough for me i tried doing the dynamic grocery and i was having some issues
//This is the basic logic i had in my mind
function createPosts(response) 
{
//     var jsondata = JSON.parse(response);
//     var node; var postBlock;
    
//     for (var i = 0; i < jsondata.length; i++) 
//     {
//         node = document.getElementById("main");
//         var temp = document.getElementById("box-"+ jsondata[i].pid);
//         if(temp)
//         {
//             console.log("User "+ jsondata[i].pid+" Already exists");
//         }
//         else
//         {
//             console.log("User "+ jsondata[i].pid+" DOESNT exists");
//             postBlock = 
//             `<div class="box" id="box-`+ jsondata[i].pid +`">
//                 <h1>`+jsondata[i].title +`</h1>
//                 <p class="description">`+ jsondata[i].description +`</p>
//                 <p class="unitcount">- Quantity - <input type="text" id="textbox-`+ jsondata[i].pid +`" value="`+ jsondata[i].quantity +`"/></p>
//                 <p><img src="`+ jsondata[i].avatar +`" alt="Avatar" style="width:5%"> <i>User: `+ jsondata[i].username +` / Posted on: `+ jsondata[i].pdate +`</i></p>
//                 <p>
//                     <button class="buy" id="buy-`+ jsondata[i].pid +`">Buy</button>  
//                     <button class="consume" id="consume-`+ jsondata[i].pid +`">Consume</button>  
//                 </p>
//             </div>`;
//             node.innerHTML += postBlock;
//         }
//     }
}