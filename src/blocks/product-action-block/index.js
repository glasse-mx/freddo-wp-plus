import { registerBlockType } from "@wordpress/blocks";
import { __ } from "@wordpress/i18n";
import block from "./block";
import edit from "./edit";
import "./main.css";
import icons from "../../icons";

registerBlockType(block.name, {
  icon: {
    src: icons.primary,
  },
  edit,
});
