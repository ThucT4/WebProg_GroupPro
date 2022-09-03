function loadFile(event) {
  var image = document.getElementById("photo");
  image.src = URL.createObjectURL(event.target.files[0]);
}

function openForm() {
    document.getElementById("myForm").style.display = "block";
  }
  
function closeForm() {
  document.getElementById("myForm").style.display = "none";
} 

function refreshPage(){
  window.location.reload();
} 