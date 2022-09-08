function getBase64(file) {
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function () {
      console.log(reader.result);
    };
    reader.onerror = function (error) {
      console.log('Error: ', error);
    };
 }
 
 var file = document.querySelector('#files > input[type="file"]').files[0];
 getBase64(file); // prints the base64 string