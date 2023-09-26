var modal = document.getElementById("myModal");

function FirstTime() {
  document.getElementById("myModal").style.display = "block";

  document.getElementById("InputFirstTime").addEventListener("keypress", function(event){
    if (event.key === "Enter") {
      event.preventDefault();
      document.getElementById("myModal").style.display = "none";
      setValConnection(true);
      location.reload();
    }
  })
}

function getNewPass() {
  let newPass = document.getElementById('InputFirstTime');
  return newPass.value;
}

var temp = false;

function setValConnection(value){
  temp = value;
  return temp;
}

function getValConnection(){
  return temp;
}