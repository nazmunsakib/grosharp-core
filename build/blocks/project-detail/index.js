(function (blocks, element, blockEditor, i18n) {
	var el = element.createElement;
	var __ = i18n.__;
	var useBlockProps = blockEditor.useBlockProps;

	blocks.registerBlockType('grosharp/project-detail', {
		edit: function () {
			var blockProps = useBlockProps({ className: 'grosharp-project-detail-editor' });
			return el(
				'div',
				blockProps,
				el(
					'div',
					{
						style: {
							padding: '28px 24px',
							background: 'rgba(101,76,255,0.04)',
							border: '1.5px dashed rgba(101,76,255,0.25)',
							borderRadius: '12px',
							textAlign: 'center',
						},
					},
					el('p', { style: { margin: '0 0 6px', fontWeight: 700, fontSize: '15px', color: 'var(--grosharp-primary)' } },
						'✦ Project Detail'
					),
					el('p', { style: { margin: 0, color: '#777', fontSize: '13px' } },
						'Renders: The Challenge + Our Approach. Edit via ACF fields below.'
					)
				)
			);
		},
		save: function () { return null; },
	});
})(window.wp.blocks, window.wp.element, window.wp.blockEditor, window.wp.i18n);
