const menuBtn = document.querySelector(".menu-icon-container");
const mobileMenu = document.querySelector(".mobile-menu");
const closeMobileMenuButton = document.querySelector(".close-mobile-menu");

menuBtn.addEventListener("click", () => {
  if (mobileMenu.style.display === "none") {
    mobileMenu.style.display = "flex";
  } else {
    mobileMenu.style.display = "none";
  }
});

closeMobileMenuButton.addEventListener("click", () => {
  mobileMenu.style.display = "none";
});
