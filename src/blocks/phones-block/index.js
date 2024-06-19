import { registerBlockType } from "@wordpress/blocks";
import "./main.css";
import block from "./block";
import icons from "../../icons";

registerBlockType(block.name, {
  icon: {
    src: icons.primary,
  },
  edit: () => {
    return (
      <div className='phones-block'>
        <p>Telefonos Freddo</p>
      </div>
    );
  },
});
