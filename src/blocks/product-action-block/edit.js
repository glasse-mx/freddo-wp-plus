export default () => {
  return (
    <>
      <div className='single-product-details__container'>
        <div className='topbar'>
          <span className='sale__badge'>Oferta</span>
          <span className='new__badge'>Nuevo</span>
        </div>

        <h3 className='product-title'>Titulo de producto</h3>

        <p className='product__description'>
          Máquina para preparar helado suave de 2 sabores y 1 combinado. Con
          capacidad de producción de 25 litros por hora. Ideal si lo que estas
          buscando es una máquina de mediana producción. Las máquinas de helado
          de mesa se recomiendan para mantener en un espacio fijo.
        </p>

        <div className='price__selector'>Precio</div>

        <div className='add-to-cart__container'>
          <input type='number' value='1' />
          <button>Añadir al carrito</button>
          <button>Hablar con un agente</button>
        </div>
      </div>
    </>
  );
};
