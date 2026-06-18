(function (blocks, element, blockEditor, i18n) {
	var el = element.createElement;
	var __ = i18n.__;
	var useBlockProps = blockEditor.useBlockProps;

	blocks.registerBlockType('grosharp/service-detail', {
		edit: function () {
			var blockProps = useBlockProps({ className: 'grosharp-service-detail-editor' });
			return el(
				'div',
				blockProps,
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
					el('p', { style: { margin: '0 0 6px', fontWeight: 700, fontSize: '15px', color: 'var(--grosharp-primary)' } },
						'✦ Service Detail Block'
					),
					el('p', { style: { margin: 0, color: '#777', fontSize: '13px' } },
						'Renders the full service content: post body, key features, stats, detail text, and featured image. Only visible on single Service pages.'
					)
				)
			);
		},
		save: function () { return null; },
	});
})(window.wp.blocks, window.wp.element, window.wp.blockEditor, window.wp.i18n);
