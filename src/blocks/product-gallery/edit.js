import apiFetch from "@wordpress/api-fetch";
import { useSelect } from "@wordpress/data";
import { Spinner } from "@wordpress/components";
import { useState, useEffect } from "@wordpress/element";
import { __ } from "@wordpress/i18n";

export default ({ attributes, setAttributes }) => {
  const { images } = attributes;
  const [isLoading, setIsLoading] = useState(true);
  const [isError, setIsError] = useState(false);
  const productID = useSelect(
    (select) => select("core/editor").getCurrentPostId(),
    []
  );

  const handleGetProductImages = () => {
    apiFetch({
      path: `/wc/v3/products/${productID}`,
      method: "GET",
    })
      .then((product) => {
        setAttributes({ images: product.images });
        setIsLoading(false);
      })
      .catch((error) => {
        console.error(error);
        setIsError(true);
      });
  };
};
