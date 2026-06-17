(function (blocks, element, blockEditor, components, i18n) {
	var el = element.createElement;
	var __ = i18n.__;
	var useBlockProps  = blockEditor.useBlockProps;
	var InspectorControls = blockEditor.InspectorControls;
	var PanelBody = components.PanelBody;
	var TextControl = components.TextControl;

	blocks.registerBlockType('grosharp/blog-related', {
		edit: function (props) {
			var attrs    = props.attributes;
			var setAttrs = props.setAttributes;
			var blockProps = useBlockProps({ className: 'grosharp-blog-related-editor' });
			return el('div', blockProps,
				el(InspectorControls, {},
					el(PanelBody, { title: __('Options', 'grosharp'), initialOpen: true },
						el(TextControl, {
							label:    __('Section heading', 'grosharp'),
							value:    attrs.heading || 'More Articles',
							onChange: function (v) { setAttrs({ heading: v }); },
						})
					)
				),
				el('div', {
					style: { padding: '16px 20px', background: 'rgba(101,76,255,0.04)', border: '1.5px dashed rgba(101,76,255,0.25)', borderRadius: '10px', textAlign: 'center' }
				},
					el('p', { style: { margin: 0, fontWeight: 700, fontSize: '13px', color: '#654cff' } }, '✦ Related Posts'),
					el('p', { style: { margin: '4px 0 0', color: '#777', fontSize: '12px' } }, 'Shows 3 posts from the same category as the current article.')
				)
			);
		},
		save: function () { return null; },
	});
})(window.wp.blocks, window.wp.element, window.wp.blockEditor, window.wp.components, window.wp.i18n);
