import { registerBlockType } from "@wordpress/scripts";
import block from "./block";
import edit from "./edit";
import icons from "../../icons";
import "./main.css";

registerBlockType(block.name, {
  icon: {
    src: icons.primary,
  },
  edit,
});
