var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];

document.addEventListener("DOMContentLoaded",doSomething);
function FirstTime() {
    modal.style.display = "block";
   }

   function PassEnter(){
    modal.style.display = "none";
   }


span.onclick = function() {
  modal.style.display = "none";
}
