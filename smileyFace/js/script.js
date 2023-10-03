/*
document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        var errorElement = document.getElementById('eventErrorMessage');
        if (errorElement) {
            errorElement.style.display = 'none';
        }
    }, 2500);
});
*/
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
};