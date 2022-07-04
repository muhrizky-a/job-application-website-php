const btn = document.querySelector(".nav-btn-section a");
const nav = document.querySelector("nav ul");
btn.addEventListener("click", () => {
    if (nav.className == "") {
        nav.className = "active"
    } else {
        nav.className = "";
    }
});