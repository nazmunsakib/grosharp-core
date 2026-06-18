(function (blocks, element, blockEditor, i18n) {
	var el = element.createElement;
	var __ = i18n.__;
	var useBlockProps = blockEditor.useBlockProps;

	blocks.registerBlockType('grosharp/project-next', {
		edit: function () {
			var blockProps = useBlockProps({ className: 'grosharp-project-next-editor' });
			return el(
				'div',
				blockProps,
				el(
					'div',
					{
						style: {
							padding: '28px 24px',
							background: '#0d0d12',
							border: '1.5px dashed rgba(101,76,255,0.4)',
							borderRadius: '12px',
							textAlign: 'center',
						},
					},
					el('p', { style: { margin: '0 0 6px', fontWeight: 700, fontSize: '15px', color: 'var(--grosharp-primary)' } },
						'✦ Next Project'
					),
					el('p', { style: { margin: 0, color: '#9a9ab0', fontSize: '13px' } },
						'Dark CTA auto-linking to the next published case study. No configuration needed.'
					)
				)
			);
		},
		save: function () { return null; },
	});
})(window.wp.blocks, window.wp.element, window.wp.blockEditor, window.wp.i18n);
