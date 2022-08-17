const imgDiv = document.querySelector('.profile-img-div');
const img = document.querySelector('#photo');
const file = document.querySelector('#file');
const uploadBtn = document.querySelector('#uploadBtn');

file.addEventListener('change', function(){
    const chosenFile = this.file[0];
    const reader = new FileReader();
    reader.addEventListener('load', function(){
        img.setAttribute('src', reader.result);
    })
    reader.readAsDataURL(chosenFile);
})