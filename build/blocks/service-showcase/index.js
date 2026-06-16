(function (blocks, element, blockEditor, components, i18n) {
	var el = element.createElement;
	var __ = i18n.__;
	var useBlockProps = blockEditor.useBlockProps;
	var InspectorControls = blockEditor.InspectorControls;
	var PanelBody = components.PanelBody;
	var RangeControl = components.RangeControl;

	blocks.registerBlockType('grosharp/service-showcase', {
		edit: function (props) {
			var attributes = props.attributes;
			var setAttributes = props.setAttributes;
			var blockProps = useBlockProps({ className: 'grosharp-service-showcase-editor' });

			return el(
				'div',
				blockProps,
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: __('Settings', 'grosharp'), initialOpen: true },
						el(RangeControl, {
							label: __('Max services to show (-1 = all)', 'grosharp'),
							value: attributes.count,
							onChange: function (val) { setAttributes({ count: val }); },
							min: -1,
							max: 20,
							step: 1,
						})
					)
				),
				el(
					'div',
					{
						style: {
							padding: '32px 24px',
							background: 'rgba(101,76,255,0.05)',
							border: '1.5px dashed rgba(101,76,255,0.25)',
							borderRadius: '12px',
							textAlign: 'center',
						},
					},
					el('p', { style: { margin: '0 0 6px', fontWeight: 700, fontSize: '15px', color: '#654cff' } },
						'✦ Service Showcase'
					),
					el('p', { style: { margin: 0, color: '#777', fontSize: '13px' } },
						'Alternating two-column rows — pulled from the Services post type. Manage services under Services → All Services.'
					)
				)
			);
		},

		save: function () {
			return null; // Server-side render via render.php
		},
	});
})(window.wp.blocks, window.wp.element, window.wp.blockEditor, window.wp.components, window.wp.i18n);
