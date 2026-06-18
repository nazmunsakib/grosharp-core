(function (blocks, element, blockEditor, components, i18n) {
	var el          = element.createElement;
	var __          = i18n.__;
	var useBlockProps      = blockEditor.useBlockProps;
	var InspectorControls  = blockEditor.InspectorControls;
	var PanelBody          = components.PanelBody;
	var TextControl        = components.TextControl;
	var ToggleControl      = components.ToggleControl;

	blocks.registerBlockType('grosharp/post-hero', {

		edit: function (props) {
			var attrs      = props.attributes;
			var setAttrs   = props.setAttributes;
			var blockProps = useBlockProps({ className: 'grosharp-post-hero-editor' });

			return el(
				'div',
				blockProps,

				/* ── Sidebar controls ── */
				el(InspectorControls, {},
					el(PanelBody, { title: __('Hero Options', 'grosharp'), initialOpen: true },

						el(TextControl, {
							label:   __('Eyebrow taxonomy slug', 'grosharp'),
							help:    __('e.g. grosharp_project_type — leave empty to auto-detect.', 'grosharp'),
							value:   attrs.eyebrowTaxonomy || '',
							onChange: function (v) { setAttrs({ eyebrowTaxonomy: v }); },
						}),

						el(TextControl, {
							label:   __('Eyebrow fallback label', 'grosharp'),
							help:    __('Shown when no taxonomy term is found.', 'grosharp'),
							value:   attrs.eyebrowFallback || '',
							onChange: function (v) { setAttrs({ eyebrowFallback: v }); },
						}),

						el(TextControl, {
							label:   __('Short brief meta key', 'grosharp'),
							help:    __('ACF field key for the short brief below the title. e.g. project_short_brief. Falls back to excerpt if empty.', 'grosharp'),
							value:   attrs.briefMetaKey || '',
							onChange: function (v) { setAttrs({ briefMetaKey: v }); },
						}),

						el(TextControl, {
							label:   __('Tech stack meta key', 'grosharp'),
							help:    __('ACF field key for comma-separated tech tags. e.g. project_tech_stack.', 'grosharp'),
							value:   attrs.techStackMetaKey || '',
							onChange: function (v) { setAttrs({ techStackMetaKey: v }); },
						}),

						el(ToggleControl, {
							label:   __('Show featured image', 'grosharp'),
							checked: attrs.showImage !== false,
							onChange: function (v) { setAttrs({ showImage: v }); },
						})
					)
				),

				/* ── Canvas placeholder ── */
				el(
					'div',
					{
						style: {
							padding:      '32px 24px',
							background:   'rgba(101,76,255,0.04)',
							border:       '1.5px dashed rgba(101,76,255,0.25)',
							borderRadius: '12px',
							textAlign:    'center',
						},
					},
					el('p', { style: { margin: '0 0 6px', fontWeight: 700, fontSize: '15px', color: 'var(--grosharp-primary)' } },
						'✦ Post Hero'
					),
					el('p', { style: { margin: 0, color: '#777', fontSize: '13px' } },
						'Auto-populates: Post Title · Short Brief · Featured Image. Works on any CPT single page.'
					),
					attrs.briefMetaKey
						? el('p', { style: { margin: '8px 0 0', color: 'var(--grosharp-primary)', fontSize: '12px' } },
							'Brief key: ' + attrs.briefMetaKey)
						: null,
					attrs.eyebrowTaxonomy
						? el('p', { style: { margin: '4px 0 0', color: '#9a9ab0', fontSize: '12px' } },
							'Eyebrow: ' + attrs.eyebrowTaxonomy)
						: null
				)
			);
		},

		save: function () { return null; },
	});

})(window.wp.blocks, window.wp.element, window.wp.blockEditor, window.wp.components, window.wp.i18n);
