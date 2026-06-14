(function () {
	'use strict';

	var el               = window.wp.element.createElement;
	var Fragment         = window.wp.element.Fragment;
	var __              = window.wp.i18n.__;
	var sprintf         = window.wp.i18n.sprintf;
	var registerBlockType = window.wp.blocks.registerBlockType;
	var InspectorControls = window.wp.blockEditor.InspectorControls;
	var MediaUpload      = window.wp.blockEditor.MediaUpload;
	var MediaUploadCheck = window.wp.blockEditor.MediaUploadCheck;
	var useBlockProps    = window.wp.blockEditor.useBlockProps;
	var useSelect        = window.wp.data.useSelect;
	var ServerSideRender = window.wp.serverSideRender ? (window.wp.serverSideRender.default || window.wp.serverSideRender) : null;
	var PanelBody        = window.wp.components.PanelBody;
	var Button           = window.wp.components.Button;
	var TextControl      = window.wp.components.TextControl;
	var TextareaControl  = window.wp.components.TextareaControl;
	var SelectControl    = window.wp.components.SelectControl;

	/* ── Single service item editor ──────────────────────────────────────── */
	function ServiceItemEditor(props) {
		var item         = props.item;
		var index        = props.index;
		var onChange     = props.onChange;
		var onRemove     = props.onRemove;
		var servicePosts = props.servicePosts || [];

		var postOptions = [
			{ label: __('— Use custom URL below —', 'grosharp'), value: 0 }
		].concat(servicePosts.map(function (p) {
			return {
				label: (p.title && p.title.rendered) ? p.title.rendered : ('Post #' + p.id),
				value: p.id
			};
		}));

		function handlePostSelect(rawVal) {
			var id = parseInt(rawVal, 10);
			if (id > 0) {
				var post = servicePosts.find(function (p) { return p.id === id; });
				onChange(Object.assign({}, item, { linkPostId: id, url: (post && post.link) ? post.link : (item.url || '') }));
			} else {
				onChange(Object.assign({}, item, { linkPostId: 0 }));
			}
		}

		return el('div', {
			style: {
				border: '1px solid #e2e4e7',
				borderRadius: '4px',
				padding: '12px',
				marginBottom: '12px',
				background: '#f9f9f9'
			}
		},
			/* Header row */
			el('div', { style: { display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '10px' } },
				el('strong', { style: { fontSize: '11px', textTransform: 'uppercase', letterSpacing: '0.06em', color: '#444' } },
					sprintf(/* translators: %d = item number */ __('Service %d', 'grosharp'), index + 1)
				),
				el(Button, {
					isDestructive: true,
					size: 'small',
					variant: 'tertiary',
					onClick: onRemove,
					style: { minHeight: 'unset', padding: '2px 6px', fontSize: '11px' }
				}, __('Remove', 'grosharp'))
			),

			/* Icon upload */
			el('p', { style: { fontSize: '11px', fontWeight: 600, marginBottom: '6px', color: '#444' } },
				__('Icon (white SVG/PNG on transparent bg)', 'grosharp')
			),
			el(MediaUploadCheck, {},
				el(MediaUpload, {
					allowedTypes: ['image'],
					value: item.iconId || 0,
					onSelect: function (media) {
						onChange(Object.assign({}, item, { iconUrl: media.url, iconId: media.id }));
					},
					render: function (ref) {
						return el(Button, { size: 'small', variant: 'secondary', onClick: ref.open },
							item.iconUrl ? __('Replace icon', 'grosharp') : __('Upload icon', 'grosharp')
						);
					}
				})
			),
			item.iconUrl ? el('div', {
				style: { display: 'flex', alignItems: 'center', gap: '8px', marginTop: '8px', background: '#0d0d12', padding: '8px 12px', borderRadius: '4px' }
			},
				el('img', { src: item.iconUrl, alt: '', style: { width: '32px', height: '32px', objectFit: 'contain', filter: 'brightness(0) invert(1)' } }),
				el(Button, {
					isDestructive: true,
					size: 'small',
					variant: 'link',
					onClick: function () { onChange(Object.assign({}, item, { iconUrl: '', iconId: 0 })); },
					style: { color: '#ff6b6b', fontSize: '11px' }
				}, __('Remove', 'grosharp'))
			) : null,

			/* Number badge */
			el(TextControl, {
				label: __('Badge number', 'grosharp'),
				help: __('Shown large at card bottom, e.g. "01"', 'grosharp'),
				value: item.number || '',
				placeholder: '01',
				onChange: function (v) { onChange(Object.assign({}, item, { number: v })); },
				style: { marginTop: '12px' }
			}),

			/* Title */
			el(TextControl, {
				label: __('Service title', 'grosharp'),
				value: item.title || '',
				placeholder: __('e.g. Brand & UI Design', 'grosharp'),
				onChange: function (v) { onChange(Object.assign({}, item, { title: v })); }
			}),

			/* Description */
			el(TextareaControl, {
				label: __('Short description', 'grosharp'),
				value: item.description || '',
				rows: 2,
				placeholder: __('One-liner about the service…', 'grosharp'),
				onChange: function (v) { onChange(Object.assign({}, item, { description: v })); }
			}),

			/* Service post link selector */
			postOptions.length > 1 ? el(SelectControl, {
				label: __('Link to service post', 'grosharp'),
				value: item.linkPostId || 0,
				options: postOptions,
				onChange: handlePostSelect
			}) : null,

			/* Custom URL */
			el(TextControl, {
				label: (item.linkPostId > 0)
					? __('Link URL (auto-filled, override if needed)', 'grosharp')
					: __('Link URL', 'grosharp'),
				value: item.url || '',
				placeholder: '/services/branding/',
				onChange: function (v) { onChange(Object.assign({}, item, { url: v })); }
			})
		);
	}

	/* ── Main Edit component ─────────────────────────────────────────────── */
	function Edit(props) {
		var attributes    = props.attributes;
		var setAttributes = props.setAttributes;
		var blockProps    = useBlockProps();

		var eyebrow   = attributes.eyebrow   || '';
		var heading   = attributes.heading   || '';
		var text      = attributes.text      || '';
		var ctaUrl    = attributes.ctaUrl    || '';
		var ctaLabel  = attributes.ctaLabel  || '';
		var services  = Array.isArray(attributes.services) ? attributes.services : [];

		/* Fetch published service posts for link selector */
		var servicePosts = useSelect(function (select) {
			return select('core').getEntityRecords('postType', 'grosharp_service', {
				per_page: 50,
				status: 'publish',
				_fields: ['id', 'title', 'link']
			});
		}, []);

		function updateItem(index, updated) {
			var next = services.slice();
			next[index] = updated;
			setAttributes({ services: next });
		}

		function removeItem(index) {
			var next = services.slice();
			next.splice(index, 1);
			setAttributes({ services: next });
		}

		function addItem() {
			var num = String(services.length + 1).padStart(2, '0');
			setAttributes({
				services: services.concat([{
					title: '', description: '', number: num,
					iconUrl: '', iconId: 0, url: '/services/', linkPostId: 0
				}])
			});
		}

		return el('div', blockProps,
			el(InspectorControls, {},

				/* ── Section settings panel ── */
				el(PanelBody, { title: __('Section Content', 'grosharp'), initialOpen: false },
					el(TextControl, { label: __('Eyebrow', 'grosharp'),  value: eyebrow,  onChange: function (v) { setAttributes({ eyebrow: v }); } }),
					el(TextControl, { label: __('Heading', 'grosharp'),  value: heading,  onChange: function (v) { setAttributes({ heading: v }); } }),
					el(TextareaControl, { label: __('Subtext', 'grosharp'),  value: text,  rows: 2, onChange: function (v) { setAttributes({ text: v }); } }),
					el(TextControl, { label: __('CTA Label', 'grosharp'), value: ctaLabel, onChange: function (v) { setAttributes({ ctaLabel: v }); } }),
					el(TextControl, { label: __('CTA URL', 'grosharp'),   value: ctaUrl,   onChange: function (v) { setAttributes({ ctaUrl: v }); } })
				),

				/* ── Services (repeatable) panel ── */
				el(PanelBody, { title: __('Services', 'grosharp'), initialOpen: true },
					el('p', { style: { fontSize: '12px', color: '#666', marginBottom: '12px', lineHeight: 1.5 } },
						__('Add services manually. Leave empty to auto-load from the Services post type.', 'grosharp')
					),
					services.map(function (item, i) {
						return el(ServiceItemEditor, {
							key: i,
							item: item,
							index: i,
							onChange: function (updated) { updateItem(i, updated); },
							onRemove: function () { removeItem(i); },
							servicePosts: servicePosts || []
						});
					}),
					el(Button, {
						variant: 'secondary',
						onClick: addItem,
						style: { width: '100%', justifyContent: 'center', marginTop: '4px' }
					}, __('+ Add Service', 'grosharp'))
				)
			),

			/* Live preview */
			ServerSideRender ? el(ServerSideRender, { block: 'grosharp/services-grid', attributes: attributes }) : null
		);
	}

	/* ── Register ────────────────────────────────────────────────────────── */
	var metadata = { name: 'grosharp/services-grid' };
	registerBlockType(metadata.name, { edit: Edit });

})();
