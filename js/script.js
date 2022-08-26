window.addEventListener("scroll", function () {
  const header = document.querySelector("nav");
  header.classList.toggle("sticky", window.scrollY > 0);
});

let btn = document.querySelector("#btn1");
let side_bar = document.querySelector("#sidebar");
let content = document.querySelector("#content");
btn.addEventListener("click", function () {
  side_bar.classList.toggle("active");
  content.classList.toggle("active");
});
