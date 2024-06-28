/**
 * Formatea el precio a formato de moneda mexicana
 * @param {number} price
 * @returns {string}
 * @example
 * formatPrice(1000) // "MXN: 1,000.00"
 * formatPrice(1000.5) // "MXN: 1,000.50"
 *
 *
 */
const freddoFormatPrice = (price) => {
  const formatter = new Intl.NumberFormat("es-MX", {
    style: "currency",
    currency: "MXN",
  });
  return formatter.format(price);
};

const handleSetVariationSingle = () => {
  const card = document.querySelector(".single-product-details__container");
  const variation = card.querySelector(`input[name="sabor"]:checked`);

  const saborHolder = document.querySelector(".sabor__holder span");
  saborHolder.textContent = variation.getAttribute("data-sabor-name");

  const price = card.querySelector(".price__holder .price_tag");
  price.innerHTML = `<b>Precio Lista: </b>${freddoFormatPrice(
    variation.getAttribute("data-price")
  )} MXN`;

  const varID = variation.getAttribute("id");
  const inputID = card.querySelector('input[name="variation_id"]');
  const numSelect = card.querySelector(".shop__quantity input");
  inputID.setAttribute("value", varID);
  const btn = card.querySelector('button[type="submit"]');
  btn.disabled = false;
  numSelect.disabled = false;
};

const handleSetVariationOnCart = (id) => {
  console.log("Hola Gabo");
};
