const swiper = new Swiper(".hero-swiper", {
  effect: "coverflow",
  coverflowEffect: {
    rotate: 10,
    stretch: 1,
    depth: 50,
    modifier: 0.1,
    slideShadows: true,
  },
  centeredSlides: true,
  spaceBetween: 100,
  autoplay: {
    delay: 3500,
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
  spaceBetween: 10,
  loop: true,
  pagination: {
    el: ".categorie-swiper-pagination",
  },
  navigation: {
    nextEl: '.categorie-swiper-button-prev',
    prevEl: '.categorie-swiper-button-prev',
  },
});
