document.querySelector("#customer").addEventListener("click", clicked);
document.querySelector("#vendor").addEventListener("click", clicked);
document.querySelector("#shipper").addEventListener("click", clicked);

document.querySelector("#register-form").addEventListener("submit", validateInput);

var regBox = document.querySelector("#register-box");
var inputBoxs = document.querySelectorAll("div[name=\"inputbox\"");

console.log(inputBoxs);

var res1 = window.matchMedia("(max-width: 768px)");
responsive1(res1);
res1.addListener(responsive1);

var res2 = window.matchMedia("(max-width: 1024px)");
responsive2(res2);
res2.addListener(responsive2);

function clicked(e) {
  console.log(e.target.value);

  if (e.target.checked && e.target.id == "customer") {
    loadCustomer();
  }
  if (e.target.checked && e.target.id == "vendor") {
    loadVendor();
  } else if (e.target.checked && e.target.id == "shipper") {
    loadShipper();
  }
}

function validateInput(e) {
  const userName = document.querySelector("input#username");

  if (!checkUserName(userName.value.trim())) {
    e.preventDefault();
    alert("User name can only contain letters and digits, has length from 8-15 characters!");
    return;
  }

  const pwd = document.querySelector("input#password");

  if (!checkPwd(pwd.value)) {
    e.preventDefault();
    alert("Invalid Password! Password must contain contains at least" + 
    "one upper case letter, at least one lower case letter, at least" +
    " one digit, at least one special letter in the set !@#$%^&*," +
    " has a length from 8 to 20 characters");
    return;
  }

  const re_pwd = document.querySelector("input#re-password");

  if (re_pwd.value.trim().localeCompare(pwd.value.trim()) != 0) {
    e.preventDefault();
    alert('Password and Re-type Password are not the same!');
  }
}

function loadCustomer() {
  document.querySelector("div#address-div").classList.remove("d-none");
  document.querySelector("div#buss-name-div").classList.add("d-none");
  document.querySelector("div#buss-address-div").classList.add("d-none");
  document.querySelector("div#hub-div").classList.add("d-none");

  document.querySelector("input#address").required = true;
  document.querySelector("input#buss-name").required = false;
  document.querySelector("input#buss-address").required = false;
}

function loadVendor() {
  document.querySelector("div#address-div").classList.add("d-none");
  document.querySelector("div#buss-name-div").classList.remove("d-none");
  document.querySelector("div#buss-address-div").classList.remove("d-none");
  document.querySelector("div#hub-div").classList.add("d-none");

  document.querySelector("input#address").required = false;
  document.querySelector("input#buss-name").required = true;
  document.querySelector("input#buss-address").required = true;
}

function loadShipper() {
  document.querySelector("div#address-div").classList.add("d-none");
  document.querySelector("div#buss-name-div").classList.add("d-none");
  document.querySelector("div#buss-address-div").classList.add("d-none");
  document.querySelector("div#hub-div").classList.remove("d-none");

  document.querySelector("input#address").required = false;
  document.querySelector("input#buss-name").required = false;
  document.querySelector("input#buss-address").required = false;
}

function loadFile(event) {
  var image = document.getElementById("output");
  image.src = URL.createObjectURL(event.target.files[0]);
}

function checkUserName(input) {
  if (input.length < 8 || input.length > 15) {
    return false;
  }

  let pat = /^[a-zA-Z0-9]+$/;
  if (!pat.test(input)) {
    return false;
  }

  return true;
}

function checkPwd(input) {
  pat = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,16}$/

  return pat.test(input);
}

function responsive1(param) {
  if (param.matches) { // If media query matches
    for (let i = 0; i < inputBoxs.length; i++) {
      let childs = inputBoxs[i].children;

      inputBoxs[i].classList.remove("flex-row");
      inputBoxs[i].classList.add("flex-column");

      regBox.classList.remove("text-center");

      console.log(childs.length);
      for (let i = 0; i < childs.length; i++) {
        childs[i].className = "row-8";
      }
    }
  }
  else {
    for (let i = 0; i < inputBoxs.length; i++) {
      let childs = inputBoxs[i].children;

      inputBoxs[i].classList.remove("flex-column");
      inputBoxs[i].classList.add("flex-row");

      regBox.classList.add("text-center");

      console.log(childs.length);
      for (let i = 0; i < childs.length; i++) {
        childs[0].className = "col-2";
        childs[1].className = "col-8";
      }
    }
  }
} 

function responsive2(param) {
  if (param.matches) { // If media query matches
    /*for (let i = 0; i < inputBoxs.length; i++) {
      let childs = inputBoxs[i].children;
      inputBoxs[i].classList.remove("flex-col");
      inputBoxs[i].classList.add("flex-row");
      console.log(childs.length);
      for (let i = 0; i < childs.length; i++) {
        childs[1].className = "col-2";
        childs[0].className = "col-8";
      }
    }*/
  } else {
    //document.body.style.backgroundColor = "red";
  }
} 