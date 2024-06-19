"use strict";

// CRUD Display
const tbody = document.querySelector(".tbody");

tbody.addEventListener("click", (e) => {
  // e.preventDefault();
  const el = e.target.closest(".option-crud");
  const crud = e.target.closest(".crud-btn")?.querySelector(".crud");
  const cancel = e.target
    .closest(".crud-btn")
    ?.querySelector(".crud")
    ?.querySelector(".cancel-btn");

  if (!el || !cancel || !crud) return;

  crud.classList.remove("hidden");

  cancel.addEventListener("click", function (e) {
    e.preventDefault();
    crud.classList.add("hidden");
  });
});

// CRUD Navigasi Display in Tabel
const btnTimes = document.querySelectorAll(".btn-time");
btnTimes.forEach((btn) => {
  btn.addEventListener("click", () => {
    document
      .querySelector(".btn-time-active")
      .classList.remove("btn-time-active");

    btn.classList.add("btn-time-active");
  });
});

// Navigation Mobile
const navigation = document.querySelector(".navigation");
const btnNavMobile = document.querySelector(".btn-mobile-nav");
const btnCloseNavMobile = document.querySelector(".btn-close-mobile-nav");

btnNavMobile.addEventListener("click", () => {
  navigation.classList.add("nav-open");
});

btnCloseNavMobile.addEventListener("click", () => {
  navigation.classList.remove("nav-open");
});

// Buttton Add Transaksi
const addTransaksi = document.querySelector(".btn-add-transaksi");
const closeModalTransaksi = document.querySelector(".btn-close-transaksi");
const modalTransaksi = document.querySelector(".modal-tambah-data-transaksi");

addTransaksi.addEventListener("click", () => {
  modalTransaksi.classList.remove("hidden");
});

closeModalTransaksi.addEventListener("click", () => {
  modalTransaksi.classList.add("hidden");
});
