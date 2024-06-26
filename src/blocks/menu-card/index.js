import { registerBlockType } from "@wordpress/blocks";
import edit from "./edit";
import save from "./save";
import block from "./block.json";
import icons from "../../icons";
import "./main.css";

registerBlockType(block.name, {
  icon: {
    src: icons.primary,
  },
  edit,
  save,
});
