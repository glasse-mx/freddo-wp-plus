import { registerBlockType } from "@wordpress/blocks";
import block from "./block";
import "./main.css";
import icons from "../../icons";

registerBlockType(block.name, {
  icon: {
    src: icons.primary,
  },
  edit: () => {
    return (
      <div className='product-gallery-block editor'>
        <h2>Product Gallery Block</h2>
      </div>
    );
  },
});
