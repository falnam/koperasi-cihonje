// Sticky Navigation
const header = document.querySelector(".header");
const alasanSection = document.querySelector(".alasan-section");
const navLandingpage = document.querySelector(".nav-landingpage");
const heighNav = navLandingpage.getBoundingClientRect().height;

const obsCallback = function (entry) {
  const ent = entry[0];

  if (!ent.isIntersecting) navLandingpage.classList.add("sticky");
  if (ent.isIntersecting) navLandingpage.classList.remove("sticky");
};

const obsOptions = {
  root: null,
  threshold: 0,
  rootMargin: `-${heighNav}px`,
};

const observer = new IntersectionObserver(obsCallback, obsOptions);
observer.observe(header);

// Slider
const slider = function () {
  const slides = document.querySelectorAll(".slide");
  const dotContainer = document.querySelector(".dots");

  // 0. Variable Pengkondisian
  let curSlide = 0;
  const maxSlide = slides.length; // Length berbasis 1 bukan 0

  // 1. Function for crating dots slide
  const createDots = function () {
    // Looping each slide
    slides.forEach(function (_, i) {
      // Create and Add element
      dotContainer.insertAdjacentHTML(
        "beforeend",
        `
    <button class="dots__dot" data-slide="${i}"></button>
    `
      );
    });
  };

  // 1. Function go to slide
  const goToSlide = function (slide) {
    slides.forEach(function (s, i) {
      s.style.transform = `translateX(${100 * (i - slide)}%) `;
    });
  };

  // 2. Kondisi awal program
  goToSlide(0); // Output : 0% 100% 200% 300%. Menambahkan property transform ke setiap slide
  createDots(); // Membuat element dots
  activeDot(0); // Dot active di kondisi awal

  // 3. Function activeDot
  function activeDot(slide) {
    // Menghapus class dulu pada semua element dots
    document
      .querySelectorAll(".dots__dot")
      .forEach((dot) => dot.classList.remove("dots__dot--active"));

    // Menambahkan class sesuai dengan data atribut
    document
      .querySelector(`.dots__dot[data-slide="${slide}"]`)
      .classList.add("dots__dot--active");
  }

  // 4. Function next slide
  const nextSlide = function () {
    // Pengkondisian slide maksimal
    if (curSlide === maxSlide - 1) {
      // - Jika sudah max slide maka akan kembali ke slide awal
      curSlide = 0;
    } else {
      // - Setiap Clik akan menambah 1
      curSlide++;
    }

    goToSlide(curSlide); // Output : -100% 0% 100% 200%
    activeDot(curSlide);
  };

  // 5. Function previous slide
  const prevSlide = function () {
    // Pengkondisian slide minimal
    if (curSlide === 0) {
      // - Jika sudah min slide maka akan kembali ke slide akhir
      curSlide = maxSlide - 1;
    } else {
      // - Setiap Clik akan mengurangi 1
      curSlide--;
    }

    goToSlide(curSlide);
    activeDot(curSlide);
  };

  // 7. Event di Keyboard
  document.addEventListener("keydown", function (e) {
    if (e.key === "ArrowLeft") prevSlide();
    if (e.key === "ArrowRight") nextSlide();
  });

  // 8. Event di dots
  dotContainer.addEventListener("click", function (e) {
    if (e.target.classList.contains("dots__dot")) {
      const slideSet = e.target.dataset.slide;
      goToSlide(slideSet);
      activeDot(slideSet);
    }
  });
};
slider();

// Reveal Section
const allSection = document.querySelectorAll(".section");

const revealSection = function (entries, observer) {
  const entry = entries[0];
  if (!entry.isIntersecting) return;
  entry.target.classList.remove("section--hidden");
  observer.unobserve(entry.target);
};

const sectionObserver = new IntersectionObserver(revealSection, {
  root: null,
  threshold: 0.2,
});

allSection.forEach(function (section) {
  sectionObserver.observe(section);
  section.classList.add("section--hidden");
});

// Navigation Mobile Mode
const navNavigationLandingpage = document.querySelector(
  ".header-nav-landingpage"
);
const btnNavMobileLandingpage = document.querySelector(
  ".btn-open-nav-landingpage"
);
const btnCloseNavMobilelandingpage = document.querySelector(
  ".btn-close-nav-landingpage"
);

btnNavMobileLandingpage.addEventListener("click", () => {
  navNavigationLandingpage.classList.add("nav-landingpage-open");
});

btnCloseNavMobilelandingpage.addEventListener("click", () => {
  navNavigationLandingpage.classList.remove("nav-landingpage-open");
});
