import { registerBlockType } from "@wordpress/blocks";
import { useBlockProps } from "@wordpress/block-editor";
import block from "./block";
import icons from "../../icons";
import "./main.css";

registerBlockType("freddo-plus/social-block", {
  icon: {
    src: icons.primary,
  },
  edit: () => {
    const blockProps = useBlockProps({
      className: "social-block",
    });
    return (
      <div {...blockProps}>
        <a href='#' target='_blank' class='socialLink color-instagram'>
          <i class='fab fa-instagram'></i>
        </a>
        <a href='#' class='socialLink color-facebook'>
          <i class='fab fa-facebook'></i>
        </a>
        <a href='#' class='socialLink color-x-twitter'>
          <i class='fab fa-x-twitter'></i>
        </a>
        <a href="<?= $options['tiktok'] ?>" class='socialLink color-tiktok'>
          <i class='fab fa-tiktok'></i>
        </a>
        <a href='#' class='socialLink color-youtube'>
          <i class='fab fa-youtube'></i>
        </a>
        <a href='#' class='socialLink color-whatsapp'>
          <i class='fab fa-whatsapp'></i>
        </a>
      </div>
    );
  },
});
