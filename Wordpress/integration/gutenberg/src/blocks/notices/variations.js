/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";

const variations = [
	{
		name: "notices-horizontal",
		isDefault: true,
		title: __("Horizontal", "THEMENAME"),
		description: __("Notices shown in a row.", "THEMENAME"),
		attributes: { orientation: "horizontal" },
		scope: ["transform"],
	},
	{
		name: "notices-vertical",
		title: __("Vertical", "THEMENAME"),
		description: __("Notices shown in a column.", "THEMENAME"),
		attributes: { orientation: "vertical" },
		scope: ["transform"],
	},
];

export default variations;
