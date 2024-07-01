import { registerBlockType } from "@wordpress/blocks";
import block from "./block";
import icons from "../../icons";
import "./main.css";

registerBlockType(block.name, {
  icon: {
    src: icons.primary,
  },
  edit: () => {
    return (
      <div className='related-products-block'>
        <h2>Related Products Block</h2>
      </div>
    );
  },
});
