const swiper = new Swiper(".hero-swiper", {
  centeredSlides: true,
  spaceBetween: 30,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
  // Optional parameters
  loop: true,

  // If we need pagination
  pagination: {
    el: ".hero-swiper-pagination",
  },
});
const swiper2 = new Swiper(".categorie-swiper", {
  centeredSlides: true,
  spaceBetween: 30,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
  loop: true,
  pagination: {
    el: ".categorie-swiper-pagination",
  },
  navigation: {
    nextEl: '.categorie-swiper-button-next',
    prevEl: '.categorie-swiper-button-prev',
  },
});
