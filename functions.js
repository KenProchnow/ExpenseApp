


document.onkeydown = checkKey;

function checkKey(e) {

    e = e || window.event;

    if (e.keyCode == '38') {
        // up arrow
        // alert("you clicked up");
    }
    else if (e.keyCode == '40') {
        // down arrow
        // alert("you clicked down");
    }
    else if (e.keyCode == '37') {
       // left arrow
       // alert("you clicked left");
    }
    else if (e.keyCode == '39') {
       // right arrow
       // alert("you clicked right");
    }

}




