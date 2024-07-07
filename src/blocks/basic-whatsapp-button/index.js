import { registerBlockType } from "@wordpress/blocks";
import { __ } from "@wordpress/i18n";
import block from "./block";
import icons from "../../icons";
import "./main.css";

registerBlockType(block.name, {
  icon: {
    src: icons.primary,
  },
  edit: () => {
    return <div className='basic-whatsapp-button'>Habla con Nosotros</div>;
  },
});
