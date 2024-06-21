import { registerBlockType } from "@wordpress/blocks";
import apiFetch from "@wordpress/api-fetch";
import { addQueryArgs } from "@wordpress/url";
import { useState, useEffect } from "@wordpress/element";
import { InspectorControls, useBlockProps } from "@wordpress/block-editor";
import {
  PanelBody,
  ToggleControl,
  RangeControl,
  SelectControl,
  CheckboxControl,
  Button,
} from "@wordpress/components";
import { useSelect } from "@wordpress/data";
import { __ } from "@wordpress/i18n";
import block from "./block";
import icons from "../../icons";
import Logo from "./logo-initial.png";
import "./main.css";

registerBlockType(block.name, {
  icon: {
    src: icons.primary,
  },
  edit: ({ attributes, setAttributes }) => {
    const {
      columns,
      featured,
      showTitle,
      showPrice,
      showDesc,
      cats,
      order,
      orderBy,
    } = attributes;

    const [products, setProducts] = useState([]);
    const categories = useSelect((select) => {
      return select("core").getEntityRecords("taxonomy", "product_cat", {
        per_page: -1,
      });
    });

    const blockProps = useBlockProps({
      className: `products-group-block cols-${columns}`,
    });

    const handleGetProducts = () => {
      const queryParams = {
        per_page: 100,
        category: cats.join(","),
        orderby: orderBy,
        order: order,
      };

      apiFetch({
        path: addQueryArgs("/wc/v3/products", queryParams),
        method: "GET",
      })
        .then((products) => {
          setProducts(products);
        })
        .catch((error) => {
          console.error(error);
          console.log(typeof cats.join(","));
        });
    };

    useEffect(() => {
      handleGetProducts();
    }, [orderBy, order]);

    const priceFormat = (price) => {
      return price.toLocaleString("es-MX", {
        style: "currency",
        currency: "MXN",
        minimumFractionDigits: 2,
      });
    };

    const isNew = (date) => {
      const today = new Date();
      const productDate = new Date(date);
      const diffTime = Math.abs(today - productDate);
      const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
      return diffDays <= 30;
    };

    const isMachine = (product) => {
      return product.categories.some((cat) => cat.slug === "maquinas");
    };

    return (
      <>
        <InspectorControls>
          <PanelBody title={__("Categorias", "freddo-plus")}>
            <ul
              sx={{
                listStyleType: "none",
              }}
            >
              {(categories || []).map(
                (category) =>
                  category.parent === 0 && (
                    <li>
                      <CheckboxControl
                        label={category.name}
                        checked={cats.includes(category.id) || false}
                        onChange={(checked) => {
                          if (checked) {
                            setAttributes({ cats: [...cats, category.id] });
                          } else {
                            setAttributes({
                              cats: cats.filter((c) => c !== category.id),
                            });
                          }
                        }}
                      />
                      <ul
                        sx={{
                          listStyleType: "none",
                          marginLeft: "5px !important",
                        }}
                      >
                        {(categories || []).map(
                          (subCategory) =>
                            subCategory.parent === category.id && (
                              <li>
                                <CheckboxControl
                                  label={subCategory.name}
                                  checked={
                                    cats.includes(subCategory.id) || false
                                  }
                                  onChange={(checked) => {
                                    if (checked) {
                                      setAttributes({
                                        cats: [...cats, subCategory.id],
                                      });
                                    } else {
                                      setAttributes({
                                        cats: cats.filter(
                                          (c) => c !== subCategory.id
                                        ),
                                      });
                                    }
                                  }}
                                />
                                <ul>
                                  {(categories || []).map(
                                    (subSubCategory) =>
                                      subSubCategory.parent ===
                                        subCategory.id && (
                                        <li>
                                          <CheckboxControl
                                            label={subSubCategory.name}
                                            checked={
                                              cats.includes(
                                                subSubCategory.id
                                              ) || false
                                            }
                                            onChange={(checked) => {
                                              if (checked) {
                                                setAttributes({
                                                  cats: [
                                                    ...cats,
                                                    subSubCategory.id,
                                                  ],
                                                });
                                              } else {
                                                setAttributes({
                                                  cats: cats.filter(
                                                    (c) =>
                                                      c !== subSubCategory.id
                                                  ),
                                                });
                                              }
                                            }}
                                          />
                                        </li>
                                      )
                                  )}
                                </ul>
                              </li>
                            )
                        )}
                      </ul>
                    </li>
                  )
              )}
            </ul>
            <Button variant='primary' onClick={handleGetProducts}>
              {__("Filtrar", "glasse-wp-plugin")}
            </Button>
          </PanelBody>
          <PanelBody title={__("Contenido", "freddo-plus")}>
            <ToggleControl
              label={__("Mostrar título", "freddo-plus")}
              checked={showTitle}
              onChange={(showTitle) => setAttributes({ showTitle })}
            />
            <ToggleControl
              label={__("Mostrar precio", "freddo-plus")}
              checked={showPrice}
              onChange={(showPrice) => setAttributes({ showPrice })}
            />
            <ToggleControl
              label={__("Mostrar descripción", "freddo-plus")}
              checked={showDesc}
              onChange={(showDesc) => setAttributes({ showDesc })}
            />
          </PanelBody>
          <PanelBody title={__("Orden", "freddo-plus")}>
            <SelectControl
              label={__("Ordenar por", "freddo-plus")}
              value={orderBy}
              options={[
                { label: "Fecha", value: "date" },
                { label: "Precio", value: "price" },
                { label: "Título", value: "title" },
              ]}
              onChange={(orderBy) => setAttributes({ orderBy })}
            />
            <SelectControl
              label={__("Orden", "freddo-plus")}
              value={order}
              options={[
                { label: "Ascendente", value: "asc" },
                { label: "Descendente", value: "desc" },
              ]}
              onChange={(order) => setAttributes({ order })}
            />
          </PanelBody>
          <PanelBody title={__("Estructura", "freddo-plus")}>
            <RangeControl
              label={__("Columnas", "freddo-plus")}
              value={columns}
              onChange={(columns) => setAttributes({ columns })}
              min={1}
              max={4}
            />
          </PanelBody>
        </InspectorControls>

        <div {...blockProps}>
          {products.length > 0 ? (
            products.map((product) => (
              <div className='product__card'>
                <div className='card__header'>
                  {isNew(product.date_created) && (
                    <span className='new__badge'>Nuevo</span>
                  )}
                  {product.sale_price && (
                    <span className='sale__badge'>Oferta</span>
                  )}
                  <img
                    src={
                      product.images.length > 0 ? product.images[0].src : Logo
                    }
                    alt={product.name}
                  />
                </div>

                <div className='card__body'>
                  <div className='info'>
                    {showTitle && (
                      <h3 className='product__title'>{product.name}</h3>
                    )}
                    {showDesc && (
                      <p className='product__description'>
                        {product.short_description}
                      </p>
                    )}
                  </div>

                  {showPrice &&
                    (product.variations.length === 0 ? (
                      <div className='price__holder'>
                        {product.sale_price ? (
                          <>
                            <p className='price-scratched'>
                              <b>Precio de Lista:</b>{" "}
                              {priceFormat(parseFloat(product.price))}
                            </p>
                            <p className='price sale-price'>
                              <b>Precio de Oferta:</b>{" "}
                              {priceFormat(parseFloat(product.sale_price))}
                            </p>
                          </>
                        ) : (
                          <p className='price'>
                            <b>Precio de Lista:</b>{" "}
                            {priceFormat(parseFloat(product.price))}
                          </p>
                        )}
                        {isMachine(product) && (
                          <p className='short-description'>
                            Extiende tu garantía por un año a partes eléctricas
                            con la compra del regulador.
                          </p>
                        )}
                      </div>
                    ) : (
                      <div className='price__holder variation'>
                        <p>Sabor: Seleccione uno.</p>
                        <p className='variation__price'>Desde: XXX</p>
                      </div>
                    ))}

                  <div className='footer'>
                    <button>{__("Ver Detalles", "freddo-plus")}</button>
                  </div>
                </div>
              </div>
            ))
          ) : (
            <p>{__("No hay productos para mostrar", "freddo-plus")}</p>
          )}
        </div>
      </>
    );
  },
});
