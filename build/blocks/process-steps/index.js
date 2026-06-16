(()=>{
"use strict";

const { registerBlockType }           = window.wp.blocks;
const { __ }                          = window.wp.i18n;
const { useBlockProps, InspectorControls } = window.wp.blockEditor;
const { PanelBody, TextControl, TextareaControl, Button } = window.wp.components;
const el         = window.wp.element.createElement;
const SSR        = window.wp.serverSideRender && window.wp.serverSideRender.default
                     ? window.wp.serverSideRender.default
                     : window.wp.serverSideRender;

const BLOCK_NAME = 'grosharp/process-steps';
const MAX_STEPS  = 4;

function Edit({ attributes, setAttributes }) {
	const { eyebrow, heading, text, steps } = attributes;
	const blockProps = useBlockProps();

	const updateStep = (index, field, value) => {
		const updated = steps.map((step, i) =>
			i === index ? { ...step, [field]: value } : step
		);
		setAttributes({ steps: updated });
	};

	const addStep = () => {
		if (steps.length >= MAX_STEPS) return;
		setAttributes({ steps: [...steps, { title: '', text: '' }] });
	};

	const removeStep = (index) => {
		if (steps.length <= 1) return;
		setAttributes({ steps: steps.filter((_, i) => i !== index) });
	};

	return el('div', blockProps,

		// ── Inspector sidebar ──────────────────────────────────────────────
		el(InspectorControls, null,

			// Section header panel
			el(PanelBody, { title: __('Section Header', 'grosharp'), initialOpen: true },
				el(TextControl, {
					label:    __('Eyebrow', 'grosharp'),
					value:    eyebrow || '',
					onChange: (val) => setAttributes({ eyebrow: val }),
				}),
				el(TextControl, {
					label:    __('Heading', 'grosharp'),
					value:    heading || '',
					onChange: (val) => setAttributes({ heading: val }),
				}),
				el(TextareaControl, {
					label:    __('Subtext', 'grosharp'),
					value:    text || '',
					onChange: (val) => setAttributes({ text: val }),
				})
			),

			// Steps repeater panel
			el(PanelBody, { title: `${__('Steps', 'grosharp')} (${steps.length}/${MAX_STEPS})`, initialOpen: true },

				...steps.map((step, index) =>
					el('div', {
						key: index,
						style: {
							borderLeft:   '3px solid #654cff',
							paddingLeft:  '12px',
							marginBottom: '20px',
							paddingBottom: '12px',
							borderBottom: index < steps.length - 1 ? '1px solid #e8e8e8' : 'none',
						},
					},
						// Step label + remove button row
						el('div', { style: { display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '8px' } },
							el('strong', { style: { color: '#654cff', fontSize: '12px', textTransform: 'uppercase', letterSpacing: '0.05em' } },
								`${__('Step', 'grosharp')} ${index + 1}`
							),
							steps.length > 1
								? el(Button, {
										isDestructive: true,
										variant: 'link',
										style: { fontSize: '12px' },
										onClick: () => removeStep(index),
									},
									__('Remove', 'grosharp')
								  )
								: null
						),
						el(TextControl, {
							label:    __('Title', 'grosharp'),
							value:    step.title || '',
							onChange: (val) => updateStep(index, 'title', val),
						}),
						el(TextareaControl, {
							label:    __('Description', 'grosharp'),
							value:    step.text || '',
							onChange: (val) => updateStep(index, 'text', val),
							rows:     3,
						})
					)
				),

				// Add step button
				el(Button, {
					variant:  'secondary',
					onClick:  addStep,
					disabled: steps.length >= MAX_STEPS,
					style:    { width: '100%', justifyContent: 'center' },
				},
					steps.length >= MAX_STEPS
						? __('Maximum 4 steps reached', 'grosharp')
						: __('+ Add Step', 'grosharp')
				)
			)
		),

		// ── Live preview ───────────────────────────────────────────────────
		el(SSR, { block: BLOCK_NAME, attributes: attributes })
	);
}

registerBlockType(BLOCK_NAME, { edit: Edit });

})();
