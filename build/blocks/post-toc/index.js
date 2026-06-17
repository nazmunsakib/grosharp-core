(function (blocks, element, blockEditor, i18n) {
	var el = element.createElement;
	var __ = i18n.__;
	var useBlockProps = blockEditor.useBlockProps;

	blocks.registerBlockType('grosharp/post-toc', {
		edit: function () {
			var blockProps = useBlockProps({ className: 'grosharp-post-toc-editor' });
			return el('div', blockProps,
				el('div', {
					style: { padding: '14px 18px', background: 'rgba(101,76,255,0.04)', border: '1.5px dashed rgba(101,76,255,0.25)', borderRadius: '10px', textAlign: 'center' }
				},
					el('p', { style: { margin: 0, fontWeight: 700, fontSize: '13px', color: '#654cff' } }, '✦ Table of Contents'),
					el('p', { style: { margin: '4px 0 0', color: '#777', fontSize: '12px' } }, 'Auto-generated from post headings — renders as sticky sidebar on desktop.')
				)
			);
		},
		save: function () { return null; },
	});
})(window.wp.blocks, window.wp.element, window.wp.blockEditor, window.wp.i18n);
