import { registerBlockType } from "@wordpress/blocks";
import { __ } from "@wordpress/i18n";
import {
  InspectorControls,
  useBlockProps,
  InnerBlocks,
} from "@wordpress/block-editor";
import { PanelBody, SelectControl, RangeControl } from "@wordpress/components";
import block from "./block.json";
import icons from "../../icons";
import "./main.css";

registerBlockType(block.name, {
  icon: {
    src: icons.primary,
  },
  edit: ({ attributes, setAttributes }) => {
    const { cardType, columns } = attributes;
    const blockProps = useBlockProps({
      className: `columns-${columns}`,
    });

    return (
      <>
        <InspectorControls>
          <PanelBody title={__("Settings", "freddo-plus")}>
            <SelectControl
              label={__("Type", "freddo-plus")}
              value={cardType}
              options={[
                { label: __("Tarjeta 1", "freddo-plus"), value: "1" },
                { label: __("Tarjeta 2", "freddo-plus"), value: "2" },
                { label: __("Tarjeta 3", "freddo-plus"), value: "3" },
              ]}
              onChange={(value) => setAttributes({ cardType: value })}
            />
            <RangeControl
              label={__("Columns", "freddo-plus")}
              value={columns}
              onChange={(value) => setAttributes({ columns: value })}
              min={2}
              max={4}
            />
          </PanelBody>
        </InspectorControls>

        <div {...blockProps}>
          <InnerBlocks
            allowedBlocks={["freddo-plus/menu-card"]}
            orientation='horizontal'
            template={[["freddo-plus/menu-card"], ["freddo-plus/menu-card"]]}
          />
        </div>
      </>
    );
  },
  save: ({ attributes }) => {
    const { columns, cardType } = attributes;
    const blockProps = useBlockProps.save({
      className: `columns-${columns}`,
    });

    return (
      <div {...blockProps}>
        <InnerBlocks.Content />
      </div>
    );
  },
});
