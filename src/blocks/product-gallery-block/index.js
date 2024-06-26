import { registerBlockType } from "@wordpress/scripts";
import block from "./block";
import edit from "./edit";
import icons from "../../icons";
import "./main.css";

registerBlockType(block.name, {
  edit: () => {
    return (
      <>
        <h3> Galeria de Producto aqui</h3>
      </>
    );
  },
});
