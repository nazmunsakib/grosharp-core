/******/ (() => { // webpackBootstrap
/******/ "use strict";
var __webpack_exports__ = {};

// src/Blocks/pricing/index.js
const { registerBlockType } = wp.blocks;
const { __ } = wp.i18n;
const { InspectorControls, useBlockProps } = wp.blockEditor;
const { Button, PanelBody, TextControl, TextareaControl, ToggleControl } = wp.components;
const ServerSideRender = wp.serverSideRender;

const metadata = {"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":3,"name":"grosharp/pricing","version":"0.2.0","title":"Grosharp Pricing","category":"grosharp","description":"Pricing table with repeatable plan cards — title, description, price, period, benefits list, CTA, and featured toggle.","example":{},"textdomain":"grosharp","attributes":{"eyebrow":{"type":"string","default":"Engagement Models"},"heading":{"type":"string","default":"The right model for your growth stage."},"text":{"type":"string","default":"Whether you need a one-time launch or a long-term growth partner, we have a model that fits. All engagements include direct access to our senior team."},"items":{"type":"array","default":[{"title":"Discovery Sprint","desc":"A focused project to launch or refresh your digital presence fast. Ideal for new brands and funded startups ready to ship.","price":"From $2,500","period":"one-time","features":["Brand audit & positioning","Up to 7-page website","Mobile-first responsive build","On-page SEO setup","30-day post-launch support"],"cta_label":"Get started","cta_url":"/contact/","featured":false},{"title":"Growth Partner","desc":"An ongoing design, development, and marketing retainer. We become your in-house digital team without the overhead.","price":"From $2,500","period":"per month","features":["Unlimited design requests","20 hrs dev per month","Monthly SEO & content","Analytics & reporting dashboard","Priority Slack access","Quarterly strategy session"],"cta_label":"Start growing","cta_url":"/contact/","featured":true},{"title":"Scale Package","desc":"A fully scoped engagement for established brands undergoing a complete digital transformation or platform rebuild.","price":"Custom","period":"scoped per project","features":["Full brand identity system","Custom web platform","Full-funnel marketing build","Dedicated team pod","Ongoing growth retainer option"],"cta_label":"Talk to us","cta_url":"/contact/","featured":false}]}},"supports":{"align":["wide","full"],"html":false},"editorScript":"file:./index.js","render":"file:./render.php"};

const DEFAULT_ITEM = {
	title: 'New Plan',
	desc: '',
	price: '$0',
	period: 'per month',
	features: ['Feature one'],
	cta_label: 'Get started',
	cta_url: '/contact/',
	featured: false,
};

function PricingCardPanel({ item, index, total, onChange, onRemove, onMove }) {
	const set = (key, value) => onChange({ ...item, [key]: value });

	const setFeature = (fi, value) => {
		const features = [...(item.features || [])];
		features[fi] = value;
		set('features', features);
	};
	const addFeature    = () => set('features', [...(item.features || []), '']);
	const removeFeature = (fi) => set('features', (item.features || []).filter((_, i) => i !== fi));

	return wp.element.createElement(PanelBody, {
		title: item.title || __('Untitled Plan', 'grosharp'),
		initialOpen: index === 0
	},
		/* Reorder / remove */
		wp.element.createElement('div', { style: { display: 'flex', gap: '6px', marginBottom: '14px' } },
			wp.element.createElement(Button, { variant: 'secondary', size: 'small', disabled: index === 0, onClick: () => onMove(index, index - 1), icon: 'arrow-up-alt2', label: __('Move up', 'grosharp') }),
			wp.element.createElement(Button, { variant: 'secondary', size: 'small', disabled: index === total - 1, onClick: () => onMove(index, index + 1), icon: 'arrow-down-alt2', label: __('Move down', 'grosharp') }),
			wp.element.createElement(Button, { variant: 'secondary', size: 'small', isDestructive: true, onClick: onRemove, style: { marginLeft: 'auto' } }, __('Remove', 'grosharp'))
		),

		/* Title */
		wp.element.createElement(TextControl, { label: __('Plan Title', 'grosharp'), value: item.title || '', onChange: (v) => set('title', v) }),

		/* Description */
		wp.element.createElement(TextareaControl, { label: __('Short Description', 'grosharp'), value: item.desc || '', onChange: (v) => set('desc', v), rows: 2 }),

		/* Price + period */
		wp.element.createElement('div', { style: { display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '8px' } },
			wp.element.createElement(TextControl, { label: __('Price', 'grosharp'), value: item.price || '', onChange: (v) => set('price', v), placeholder: 'From $2,500' }),
			wp.element.createElement(TextControl, { label: __('Period / Suffix', 'grosharp'), value: item.period || '', onChange: (v) => set('period', v), placeholder: 'per month' })
		),

		/* Benefits */
		wp.element.createElement('div', { style: { marginTop: '4px' } },
			wp.element.createElement('p', { style: { fontWeight: 600, fontSize: '11px', textTransform: 'uppercase', letterSpacing: '0.04em', marginBottom: '8px', color: '#1e1e1e' } },
				__('Benefits List', 'grosharp')
			),
			...(item.features || []).map((feature, fi) =>
				wp.element.createElement('div', { key: fi, style: { display: 'flex', gap: '6px', alignItems: 'flex-start', marginBottom: '6px' } },
					wp.element.createElement('div', { style: { flex: 1, minWidth: 0 } },
						wp.element.createElement(TextControl, { value: feature, onChange: (v) => setFeature(fi, v), placeholder: __('Benefit description…', 'grosharp'), hideLabelFromVision: true, label: `Benefit ${fi + 1}` })
					),
					wp.element.createElement(Button, { variant: 'secondary', size: 'small', isDestructive: true, onClick: () => removeFeature(fi), icon: 'no-alt', label: __('Remove benefit', 'grosharp'), style: { marginTop: '2px', flexShrink: 0 } })
				)
			),
			wp.element.createElement(Button, { variant: 'secondary', size: 'small', onClick: addFeature, style: { width: '100%', justifyContent: 'center', marginBottom: '12px' } },
				__('+ Add Benefit', 'grosharp')
			)
		),

		/* CTA */
		wp.element.createElement('div', { style: { display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '8px' } },
			wp.element.createElement(TextControl, { label: __('Button Label', 'grosharp'), value: item.cta_label || '', onChange: (v) => set('cta_label', v) }),
			wp.element.createElement(TextControl, { label: __('Button URL', 'grosharp'), value: item.cta_url || '', onChange: (v) => set('cta_url', v), type: 'url' })
		),

		/* Featured */
		wp.element.createElement(ToggleControl, {
			label: __('Featured card', 'grosharp'),
			checked: !!item.featured,
			onChange: (v) => set('featured', v),
			help: __('Highlights this card with a violet background.', 'grosharp')
		})
	);
}

function Edit({ attributes, setAttributes }) {
	const blockProps = useBlockProps();
	const { eyebrow, heading, text, items = [] } = attributes;

	const updateItem = (index, newItem) => {
		const next = [...items];
		next[index] = newItem;
		setAttributes({ items: next });
	};
	const removeItem = (index) => setAttributes({ items: items.filter((_, i) => i !== index) });
	const moveItem = (from, to) => {
		const next = [...items];
		const [moved] = next.splice(from, 1);
		next.splice(to, 0, moved);
		setAttributes({ items: next });
	};
	const addItem = () => setAttributes({ items: [...items, { ...DEFAULT_ITEM }] });

	return wp.element.createElement('div', { ...blockProps },
		wp.element.createElement(InspectorControls, null,

			/* Section header */
			wp.element.createElement(PanelBody, { title: __('Section Header', 'grosharp'), initialOpen: true },
				wp.element.createElement(TextControl, { label: __('Eyebrow', 'grosharp'), value: eyebrow || '', onChange: (v) => setAttributes({ eyebrow: v }) }),
				wp.element.createElement(TextControl, { label: __('Heading', 'grosharp'), value: heading || '', onChange: (v) => setAttributes({ heading: v }) }),
				wp.element.createElement(TextareaControl, { label: __('Subtext', 'grosharp'), value: text || '', onChange: (v) => setAttributes({ text: v }), rows: 2 })
			),

			/* Card repeater */
			...items.map((item, i) =>
				wp.element.createElement(PricingCardPanel, {
					key: i,
					item,
					index: i,
					total: items.length,
					onChange: (newItem) => updateItem(i, newItem),
					onRemove: () => removeItem(i),
					onMove: moveItem,
				})
			),

			/* Add card */
			wp.element.createElement('div', { style: { padding: '16px' } },
				wp.element.createElement(Button, { variant: 'primary', onClick: addItem, style: { width: '100%', justifyContent: 'center' } },
					__('+ Add Pricing Plan', 'grosharp')
				)
			)
		),

		/* Live preview */
		wp.element.createElement(ServerSideRender, { block: metadata.name, attributes })
	);
}

registerBlockType(metadata.name, { edit: Edit });

/******/ })();
