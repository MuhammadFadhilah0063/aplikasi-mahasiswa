let div_tambah = document.querySelector(".tambah");
let button_tambah = document.querySelector("#tambah");
let button_home = document.querySelector("#home");

button_tambah.addEventListener('click', function() {
    button_home.classList.remove("active");
    button_tambah.classList.add("active");
    div_tambah.style.display = "inherit";
})

button_home.addEventListener('click', function() {
    button_tambah.classList.remove("active");
    button_home.classList.add("active");
    div_tambah.style.display = "none";
})