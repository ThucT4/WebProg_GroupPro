var bigLogo = document.querySelector("#big-logo")

var res1 = window.matchMedia("(max-width: 768px)");
responsive1(res1);
res1.addListener(responsive1);

function responsive1(param) {
    if (param.matches) { // If media query matches
      bigLogo.classList.add("d-none");
    }
    else {
        bigLogo.classList.remove("d-none");
    }
} 