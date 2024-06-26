import {
  useBlockProps,
  InspectorControls,
  RichText,
  MediaPlaceholder,
  BlockControls,
  MediaReplaceFlow,
} from "@wordpress/block-editor";
import { __ } from "@wordpress/i18n";
import {
  PanelBody,
  TextControl,
  Spinner,
  ToolbarButton,
} from "@wordpress/components";
import { isBlobURL, revokeBlobURL } from "@wordpress/blob";
import { useState, useEffect } from "@wordpress/element";

export default ({ attributes, setAttributes, context, isSelected }) => {
  const { title, content, imgID, imgAlt, imgURL, ctaText, ctaLink, cardType } =
    attributes;

  const cardTypeValue = context["freddo-plus/card-type"];

  useEffect(() => {
    if (cardTypeValue !== cardType) {
      setAttributes({ cardType: cardTypeValue });
    }
  }, [cardTypeValue, cardType]);

  const blockProps = useBlockProps({
    className: `display__card__block card-type-${cardType}`,
  });

  const [imgPreview, setImgPreview] = useState(imgURL);

  const selectImg = (img) => {
    let newImgURL = null;

    if (isBlobURL(img.url)) {
      newImgURL = img.url;
    } else {
      newImgURL = img.sizes
        ? img.sizes.full.url
        : img.media_details.sizes.full.source_url;

      setAttributes({
        imgID: img.id,
        imgAlt: img.alt,
        imgURL: newImgURL,
      });

      revokeBlobURL(imgPreview);
    }

    setImgPreview(newImgURL);
  };

  const selectImgURL = (url) => {
    setAttributes({
      imgID: null,
      imgAlt: null,
      imgURL: url,
    });

    setImgPreview(url);
  };

  return (
    <>
      {imgPreview && (
        <BlockControls group='inline'>
          <MediaReplaceFlow
            name={__("Replace Image", "udemy-plus")}
            mediaId={imgID}
            mediaURL={imgURL}
            allowedTypes={["image"]}
            accept={"image/*"}
            onError={(error) => console.error(error)}
            onSelect={selectImg}
            onSelectURL={selectImgURL}
          />
          <ToolbarButton
            onClick={() => {
              setAttributes({
                imgID: 0,
                imgAlt: "",
                imgURL: "",
              });

              setImgPreview("");
            }}
          >
            {__("Remove Image", "freddo-plus")}
          </ToolbarButton>
        </BlockControls>
      )}

      <InspectorControls>
        <PanelBody title={__("Settings", "freddo-plus")}>
          <TextControl
            label={__("Titulo de Tarjeta", "freddo-plus")}
            value={title}
            onChange={(value) => setAttributes({ title: value })}
          />
          {cardType == 1 && (
            <TextControl
              label={__("Contenido de Tarjeta", "freddo-plus")}
              value={content}
              onChange={(value) => setAttributes({ content: value })}
            />
          )}
          <TextControl
            label={__("Texto del Boton", "freddo-plus")}
            value={ctaText}
            onChange={(value) => setAttributes({ ctaText: value })}
          />
          <TextControl
            label={__("Enlace de CTA", "freddo-plus")}
            value={ctaLink}
            onChange={(value) => setAttributes({ ctaLink: value })}
          />
        </PanelBody>
      </InspectorControls>

      <div {...blockProps}>
        <div className='card__img'>
          {imgPreview && <img src={imgPreview} alt={imgAlt} />}
          {isBlobURL(imgPreview) && <Spinner />}
          <MediaPlaceholder
            allowedTypes={["image"]}
            accept={"image/*"}
            icon='admin-users'
            onSelect={selectImg}
            onError={(error) => console.error(error)}
            disableMediaButtons={imgPreview}
            onSelectURL={selectImgURL}
          />
        </div>
        <div className='card__content'>
          <div className='content__info'>
            <RichText
              tagName='h3'
              value={title}
              onChange={(title) => setAttributes({ title })}
              placeholder={__("Title")}
            />

            {cardType == 1 && (
              <RichText
                tagName='p'
                value={content}
                onChange={(content) => setAttributes({ content })}
                placeholder={__("Content")}
              />
            )}
          </div>
          <div className='content__footer'>
            <button>{ctaText}</button>
          </div>
        </div>
      </div>
    </>
  );
};
