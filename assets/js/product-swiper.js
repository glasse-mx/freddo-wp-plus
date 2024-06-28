if (document.querySelector(".product-gallery-block")) {
  Fancybox.bind("[data-fancybox]");

  const productSwiper = new Swiper(".product-swiper", {
    loop: true,

    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
}
