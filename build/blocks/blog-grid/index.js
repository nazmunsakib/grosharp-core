(function (blocks, element, blockEditor, components, i18n) {
	var el             = element.createElement;
	var __             = i18n.__;
	var useBlockProps  = blockEditor.useBlockProps;
	var InspectorControls = blockEditor.InspectorControls;
	var PanelBody      = components.PanelBody;
	var RangeControl   = components.RangeControl;
	var ToggleControl  = components.ToggleControl;

	blocks.registerBlockType('grosharp/blog-grid', {
		edit: function (props) {
			var attrs      = props.attributes;
			var setAttrs   = props.setAttributes;
			var blockProps = useBlockProps({ className: 'grosharp-blog-grid-editor' });

			return el('div', blockProps,
				el(InspectorControls, {},
					el(PanelBody, { title: __('Grid Options', 'grosharp'), initialOpen: true },
						el(RangeControl, {
							label:    __('Posts per page', 'grosharp'),
							value:    attrs.postsPerPage || 9,
							min:      3,
							max:      18,
							step:     3,
							onChange: function (v) { setAttrs({ postsPerPage: v }); },
						}),
						el(ToggleControl, {
							label:    __('Show category filters', 'grosharp'),
							checked:  attrs.showFilters !== false,
							onChange: function (v) { setAttrs({ showFilters: v }); },
						})
					)
				),
				el('div', {
					style: {
						padding: '32px 24px',
						background: 'rgba(101,76,255,0.04)',
						border: '1.5px dashed rgba(101,76,255,0.25)',
						borderRadius: '12px',
						textAlign: 'center',
					}
				},
					el('p', { style: { margin: '0 0 6px', fontWeight: 700, fontSize: '15px', color: '#654cff' } }, '✦ Blog Grid'),
					el('p', { style: { margin: 0, color: '#777', fontSize: '13px' } },
						(attrs.postsPerPage || 9) + ' posts · ' + (attrs.showFilters !== false ? 'Category filters on' : 'No filters')
					)
				)
			);
		},
		save: function () { return null; },
	});
})(window.wp.blocks, window.wp.element, window.wp.blockEditor, window.wp.components, window.wp.i18n);
