import { registerBlockType } from "@wordpress/blocks";
import icons from "../../icons";
import block from "./block";
import "./main.css";

registerBlockType(block.name, {
  icon: {
    src: icons.primary,
  },
  edit: () => {
    return (
      <div className='product-info-block on-editor'>
        <div className='row'></div>
        <div className='row-box'>
          <div className='box'></div>
          <div className='box'></div>
          <div className='box'></div>
          <div className='box'></div>
          <div className='box'></div>
          <div className='box'></div>
          <div className='box'></div>
          <div className='box'></div>
        </div>
        <div className='row'></div>
        <div className='row'></div>
        <div className='row'></div>
      </div>
    );
  },
});
