/**
 * WordPress dependencies.
 */
import { __ } from "@wordpress/i18n";
import { registerBlockType } from "@wordpress/blocks";
import { info as icon } from "@wordpress/icons";

/**
 * Internal dependencies.
 */
import metadata from "../../../blocks/notices/block.json";
import transforms from "./transforms";
import edit from "./edit";
import save from "./save";
import variations from "./variations";

const { name } = metadata;

export { metadata, name };

/**
 * Every block starts by registering a new block type definition.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/#registering-a-block
 */
registerBlockType("themename/notices", {
	icon,

	example: {
		innerBlocks: [
			{
				name: "themename/notice",
				attributes: {
					message: __("Sample of notice message", "THEMENAME"),
				},
			},
			{
				name: "themename/notice",
				attributes: {
					message: __("Sample of success message", "THEMENAME"),
					typeClassName: "notice-success",
				},
			},
			{
				name: "themename/notice",
				attributes: {
					message: __("Sample of warning message", "THEMENAME"),
					typeClassName: "notice-warning",
				},
			},
			{
				name: "themename/notice",
				attributes: {
					message: __("Sample of error message", "THEMENAME"),
					typeClassName: "notice-error",
				},
			},
		],
	},

	/**
	 * @see ./transforms.js
	 */
	transforms,

	/**
	 * @see ./edit.js
	 */
	edit,

	/**
	 * @see ./save.js
	 */
	save,

	/**
	 * @see ./variations.js
	 */
	variations,
});
