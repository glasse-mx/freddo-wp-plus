/**
 * Formatea el precio a formato MXN
 * @param {number} price
 * @returns {string}
 */
const formatPrice = (price) => {
  const formatter = new Intl.NumberFormat("es-MX", {
    style: "currency",
    currency: "MXN",
  });
  return formatter.format(price);
};

/**
 * funcion Asincrona que cambia la tarjeta del producto variable en front
 * @param {int} id
 */
const handleSetVariation = (id) => {
  const card = document.getElementById(`product-${id}`);
  const variation = card.querySelector(`input[name="sabor"]:checked`);
  const varName = card.querySelector(".var__name");
  const varPrice = card.querySelector(".price__var span");
  varName.textContent = variation.getAttribute("data-sabor-name");
  varPrice.textContent = `MXN: ${formatPrice(
    variation.getAttribute("data-price")
  )}`;
};
