const addNasabah = document.querySelector(".btn-add-nasabah");
const closeModalNasabah = document.querySelector(".btn-close-nasabah");
const modalNasabah = document.querySelector(".modal-tambah-data-nasabah");

addNasabah.addEventListener("click", () => {
  modalNasabah.classList.remove("hidden");
});

closeModalNasabah.addEventListener("click", () => {
  modalNasabah.classList.add("hidden");
});
