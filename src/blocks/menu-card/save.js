import { useBlockProps, RichText } from "@wordpress/block-editor";
import { __ } from "@wordpress/i18n";

export default ({ attributes }) => {
  const { title, content, imgID, imgAlt, imgURL, ctaText, ctaLink, cardType } =
    attributes;

  const blockProps = useBlockProps.save({
    className: `display__card__block card-type-${cardType}`,
  });

  return (
    <div {...blockProps}>
      <div className='card__img'>
        {imgURL && <img id={`img-${imgID}`} src={imgURL} alt={imgAlt} />}
      </div>
      <div className='card__content'>
        <div className='content__info'>
          <RichText.Content tagName='h3' value={title} />

          {cardType === "1" && <RichText.Content tagName='p' value={content} />}
        </div>
        <div className='content__footer'>
          <a href={ctaLink}>
            <button>{ctaText}</button>
          </a>
        </div>
      </div>
    </div>
  );
};
