const swiper = new Swiper(".swiper", {
  centeredSlides: true,
  autoHeight: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
  // Optional parameters
  loop: true,

  // If we need pagination
  pagination: {
    el: ".swiper-pagination",
  },
});
