document.querySelector("#customer").addEventListener("click", clicked);
document.querySelector("#vendor").addEventListener("click", clicked);
document.querySelector("#shipper").addEventListener("click", clicked);

// document.querySelector("input#submit-btn").addEventListener("click", testFomr);

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

function loadCustomer() {
  document.querySelector("div#address-div").classList.remove("d-none");
  document.querySelector("div#buss-name-div").classList.add("d-none");
  document.querySelector("div#buss-address-div").classList.add("d-none");
  document.querySelector("div#hub-div").classList.add("d-none");
}

function loadVendor() {
  document.querySelector("div#address-div").classList.add("d-none");
  document.querySelector("div#buss-name-div").classList.remove("d-none");
  document.querySelector("div#buss-address-div").classList.remove("d-none");
  document.querySelector("div#hub-div").classList.add("d-none");
}

function loadShipper() {
  document.querySelector("div#address-div").classList.add("d-none");
  document.querySelector("div#buss-name-div").classList.add("d-none");
  document.querySelector("div#buss-address-div").classList.add("d-none");
  document.querySelector("div#hub-div").classList.remove("d-none");
}

function loadFile(event) {
  var image = document.getElementById("output");
  image.src = URL.createObjectURL(event.target.files[0]);
}
