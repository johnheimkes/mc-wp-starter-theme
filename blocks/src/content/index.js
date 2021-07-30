/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";
import { Fragment } from "@wordpress/element";
import { InnerBlocks } from "@wordpress/block-editor";

const name = "jbh-blocks/content";

const settings = {
  title: __("Content", "jbh-starter"),
  category: "jbh_blocks",
  description: __("Standard content display", "jbh-starter"),
  icon: "format-aside",
  edit: () => {
    const ALLOWED_BLOCKS = ['core/classic'];
    const TEMPLATE = [
      ['core/freeform']
    ];

    return (
      <Fragment>
        <div className="jbh-block__content jbh-content">
          <InnerBlocks
            allowedBlocks={ALLOWED_BLOCKS}
            template={TEMPLATE}
            templateLock={true}
          />
        </div>
      </Fragment>
    );
  },
  save: () => {
    return (
      <Fragment>
        <div className="jbh-block__content jbh-content">
          <InnerBlocks.Content />
        </div>
      </Fragment>
    );
  },
};

export { settings, name };
