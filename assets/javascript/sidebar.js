// Sidebar Display Active
const linkSidebars = document.querySelectorAll(".sidebar-link");
linkSidebars.forEach((linkSidebar) => {
  // const link = linkSidebar.querySelector(".link");

  linkSidebar.addEventListener("click", function (e) {
    // e.preventDefault();
    document
      .querySelector(".active-sidebar")
      .classList.remove("active-sidebar");

    linkSidebar.classList.add("active-sidebar");
  });
});

// Sidebar Mobile
const btnMobileSidebar = document.querySelector(".sidebar-phone");
const container = document.querySelector(".container");
const content = document.querySelector(".content");

btnMobileSidebar.addEventListener("mousemove", function () {
  container.classList.add("sidebar-open");
});

content.addEventListener("mousemove", function () {
  container.classList.remove("sidebar-open");
});
