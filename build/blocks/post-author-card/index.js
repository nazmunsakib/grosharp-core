(function (blocks, element, blockEditor, i18n) {
	var el = element.createElement;
	var __ = i18n.__;
	var useBlockProps = blockEditor.useBlockProps;

	blocks.registerBlockType('grosharp/post-author-card', {
		edit: function () {
			var blockProps = useBlockProps({ className: 'grosharp-post-author-card-editor' });
			return el('div', blockProps,
				el('div', {
					style: { padding: '16px 20px', background: 'rgba(101,76,255,0.04)', border: '1.5px dashed rgba(101,76,255,0.25)', borderRadius: '10px', textAlign: 'center' }
				},
					el('p', { style: { margin: 0, fontWeight: 700, fontSize: '13px', color: 'var(--grosharp-primary)' } }, '✦ Post Author Card'),
					el('p', { style: { margin: '4px 0 0', color: '#777', fontSize: '12px' } }, 'Auto-populates from the post author\'s WP profile — avatar, name, bio.')
				)
			);
		},
		save: function () { return null; },
	});
})(window.wp.blocks, window.wp.element, window.wp.blockEditor, window.wp.i18n);
