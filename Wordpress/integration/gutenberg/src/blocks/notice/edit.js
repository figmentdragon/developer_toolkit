import { __ } from "@wordpress/i18n";
import {
	useBlockProps,
	BlockControls,
	InspectorControls,
	AlignmentToolbar,
	RichText,
} from "@wordpress/block-editor";
import { PanelBody, SelectControl } from "@wordpress/components";

import classnames from "classnames";

/**
 * Describes the structure of the block in the context of the editor.
 * This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
function NoticeEdit({ attributes, setAttributes, className }) {
	const { typeClassName, message, contentAlignment, id } = attributes;

	const defaultClassName = "block block-notice notice";
	let fullClassName = classnames(defaultClassName, typeClassName);

	const blockProps = useBlockProps({
		className: fullClassName,
	});

	return (
		<>
			<BlockControls>
				<AlignmentToolbar
					value={contentAlignment}
					onChange={(value) => setAttributes({ contentAlignment: value })}
				/>
			</BlockControls>

			<InspectorControls>
				<PanelBody title={__("Notice Settings", "THEMENAME")}>
					<SelectControl
						label="Notice Type"
						value={typeClassName}
						options={[
							{ label: __("Default", "THEMENAME"), value: "" },
							{
								label: __("Success", "THEMENAME"),
								value: "notice-success",
							},
							{
								label: __("Warning", "THEMENAME"),
								value: "notice-warning",
							},
							{
								label: __("Error", "THEMENAME"),
								value: "notice-error",
							},
							{
								label: __("Primary", "THEMENAME"),
								value: "notice-primary",
							},
						]}
						onChange={(value) => {
							setAttributes({ typeClassName: value });
							fullClassName = classnames(defaultClassName, value);
						}}
					/>
				</PanelBody>
			</InspectorControls>

			<RichText
				{...blockProps}
				placeholder={__("Add notice message...", "THEMENAME")}
				style={{ textAlign: contentAlignment }}
				onChange={(val) => setAttributes({ message: val })}
				value={message}
			/>
		</>
	);
}

export default NoticeEdit;
