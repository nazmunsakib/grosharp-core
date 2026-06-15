(function (element, components, apiFetch, i18n) {
	'use strict';

	var createElement = element.createElement;
	var useState = element.useState;
	var render = element.render;
	var __ = i18n.__;
	var Button = components.Button;
	var Card = components.Card;
	var CardBody = components.CardBody;
	var CardHeader = components.CardHeader;
	var ColorPicker = components.ColorPicker;
	var Notice = components.Notice;
	var SelectControl = components.SelectControl;
	var TabPanel = components.TabPanel;
	var TextControl = components.TextControl;
	var TextareaControl = components.TextareaControl;

	var config = window.grosharpSettingsApp || {};
	var optionName = config.optionName || 'grosharp_settings';
	var defaults = config.defaults || {};

	function field(settings, setSettings, key) {
		return function (value) {
			var next = Object.assign({}, settings);
			next[key] = value;
			setSettings(next);
		};
	}

	function colorField(settings, setSettings, key, label) {
		return createElement(
			'div',
			{ className: 'grosharp-setting-color' },
			createElement('strong', null, label),
			createElement(ColorPicker, {
				color: settings[key] || defaults[key],
				enableAlpha: false,
				onChange: field(settings, setSettings, key)
			})
		);
	}

	/** Open WP media frame and call onSelect({id, url}) */
	function openMediaPicker(onSelect) {
		if (typeof wp === 'undefined' || !wp.media) return;
		var frame = wp.media({
			title: __('Select Logo', 'grosharp'),
			button: { text: __('Use this image', 'grosharp') },
			multiple: false,
			library: { type: 'image' }
		});
		frame.on('select', function () {
			var attachment = frame.state().get('selection').first().toJSON();
			onSelect({ id: attachment.id, url: attachment.url });
		});
		frame.open();
	}

	/** Logo picker UI */
	function LogoPicker(props) {
		var settings = props.settings;
		var setSettings = props.setSettings;
		var logoId = settings.logo_id || 0;
		var logoUrl = settings._logo_preview_url || '';

		function handleSelect(att) {
			var next = Object.assign({}, settings);
			next.logo_id = att.id;
			next._logo_preview_url = att.url;
			setSettings(next);
		}

		function handleRemove() {
			var next = Object.assign({}, settings);
			next.logo_id = 0;
			next._logo_preview_url = '';
			setSettings(next);
		}

		return createElement(
			'div',
			{ className: 'grosharp-logo-picker' },
			createElement('p', { className: 'grosharp-field-label' }, __('Site Logo', 'grosharp')),
			logoId
				? createElement(
					'div',
					{ className: 'grosharp-logo-preview' },
					logoUrl
						? createElement('img', { src: logoUrl, alt: 'Logo', style: { maxHeight: '60px', display: 'block', marginBottom: '8px', borderRadius: '6px', border: '1px solid #e0e0e0', padding: '4px', background: '#fff' } })
						: createElement('p', { style: { color: '#666', fontSize: '13px' } }, __('Logo ID: ', 'grosharp') + logoId),
					createElement(
						'div',
						{ style: { display: 'flex', gap: '8px' } },
						createElement(Button, { variant: 'secondary', isSmall: true, onClick: function () { openMediaPicker(handleSelect); } }, __('Change Logo', 'grosharp')),
						createElement(Button, { variant: 'tertiary', isSmall: true, isDestructive: true, onClick: handleRemove }, __('Remove', 'grosharp'))
					)
				)
				: createElement(Button, { variant: 'secondary', onClick: function () { openMediaPicker(handleSelect); } }, __('Upload / Select Logo', 'grosharp'))
		);
	}

	/** Social URL row */
	function socialField(settings, setSettings, key, label, placeholder) {
		return createElement(TextControl, {
			label: label,
			value: settings[key] || '',
			placeholder: placeholder || '',
			type: 'url',
			onChange: field(settings, setSettings, key)
		});
	}

	function App() {
		var state = useState(Object.assign({}, defaults, config.settings || {}));
		var settings = state[0];
		var setSettings = state[1];
		var savingState = useState(false);
		var saving = savingState[0];
		var setSaving = savingState[1];
		var noticeState = useState('');
		var notice = noticeState[0];
		var setNotice = noticeState[1];

		function save() {
			// Strip internal preview keys before saving
			var payload = {};
			var clean = Object.assign({}, settings);
			delete clean._logo_preview_url;
			payload[optionName] = clean;
			setSaving(true);
			setNotice('');

			apiFetch({ path: '/wp/v2/settings', method: 'POST', data: payload })
				.then(function () {
					setNotice(__('Settings saved. Changes will appear on the frontend immediately.', 'grosharp'));
				})
				.catch(function () {
					setNotice(__('Settings could not be saved. Please check your permissions and try again.', 'grosharp'));
				})
				.finally(function () {
					setSaving(false);
				});
		}

		return createElement(
			'div',
			{ className: 'grosharp-settings-app' },
			createElement(
				'div',
				{ className: 'grosharp-settings-hero' },
				createElement('div', null, createElement('p', null, __('Grosharp Control Center', 'grosharp')), createElement('h1', null, __('Brand and Theme Settings', 'grosharp'))),
				createElement(Button, { variant: 'primary', isBusy: saving, disabled: saving, onClick: save }, saving ? __('Saving...', 'grosharp') : __('Save Settings', 'grosharp'))
			),
			notice ? createElement(Notice, { status: 'success', isDismissible: true, onRemove: function () { setNotice(''); } }, notice) : null,
			createElement(TabPanel, {
				className: 'grosharp-settings-tabs',
				activeClass: 'is-active',
				tabs: [
					{ name: 'brand', title: __('Brand', 'grosharp') },
					{ name: 'typography', title: __('Typography', 'grosharp') },
					{ name: 'company', title: __('Company', 'grosharp') },
					{ name: 'social', title: __('Social Media', 'grosharp') },
					{ name: 'cta', title: __('CTA/Footer', 'grosharp') }
				]
			}, function (tab) {

				// ── Brand ──────────────────────────────────────────────────────
				if ('brand' === tab.name) {
					return createElement(Card, null,
						createElement(CardHeader, null, __('Brand Colors', 'grosharp')),
						createElement(CardBody, { className: 'grosharp-settings-grid' },
							colorField(settings, setSettings, 'primary_color', __('Primary', 'grosharp')),
							colorField(settings, setSettings, 'accent_color', __('Accent', 'grosharp')),
							colorField(settings, setSettings, 'dark_color', __('Dark', 'grosharp')),
							colorField(settings, setSettings, 'ink_color', __('Ink', 'grosharp')),
							colorField(settings, setSettings, 'muted_color', __('Muted', 'grosharp')),
							colorField(settings, setSettings, 'soft_color', __('Soft Surface', 'grosharp'))
						)
					);
				}

				// ── Typography ─────────────────────────────────────────────────
				if ('typography' === tab.name) {
					return createElement(Card, null,
						createElement(CardHeader, null, __('Typography', 'grosharp')),
						createElement(CardBody, null,
							createElement(SelectControl, {
								label: __('Heading font', 'grosharp'),
								value: settings.heading_font,
								options: [
									{ label: 'Inter Display', value: 'Inter Display' },
									{ label: 'Space Grotesk', value: 'Space Grotesk' },
									{ label: 'Sora', value: 'Sora' },
									{ label: 'Manrope', value: 'Manrope' },
									{ label: 'Plus Jakarta Sans', value: 'Plus Jakarta Sans' },
									{ label: 'Inter', value: 'Inter' }
								],
								onChange: field(settings, setSettings, 'heading_font')
							}),
							createElement(SelectControl, {
								label: __('Body font', 'grosharp'),
								value: settings.body_font,
								options: [
									{ label: 'Switzer', value: 'Switzer' },
									{ label: 'DM Sans', value: 'DM Sans' },
									{ label: 'Inter', value: 'Inter' },
									{ label: 'Manrope', value: 'Manrope' },
									{ label: 'Plus Jakarta Sans', value: 'Plus Jakarta Sans' },
									{ label: 'Sora', value: 'Sora' }
								],
								onChange: field(settings, setSettings, 'body_font')
							})
						)
					);
				}

				// ── Company ────────────────────────────────────────────────────
				if ('company' === tab.name) {
					return createElement(
						'div',
						null,
						// Logo card
						createElement(Card, { style: { marginBottom: '16px' } },
							createElement(CardHeader, null, __('Logo', 'grosharp')),
							createElement(CardBody, null,
								createElement(LogoPicker, { settings: settings, setSettings: setSettings }),
								createElement('p', { style: { marginTop: '10px', color: '#666', fontSize: '12px' } },
									__('This logo is also used as the site logo in the header. Recommended: PNG or SVG, transparent background.', 'grosharp')
								)
							)
						),
						// Company info card
						createElement(Card, null,
							createElement(CardHeader, null, __('Company Info', 'grosharp')),
							createElement(CardBody, null,
								createElement(TextControl, { label: __('Company name', 'grosharp'), value: settings.company_name || '', onChange: field(settings, setSettings, 'company_name') }),
								createElement(TextControl, { label: __('Tagline', 'grosharp'), value: settings.tagline || '', onChange: field(settings, setSettings, 'tagline') }),
								createElement(TextControl, { label: __('Email', 'grosharp'), value: settings.email || '', type: 'email', onChange: field(settings, setSettings, 'email') }),
								createElement(TextControl, { label: __('Phone', 'grosharp'), value: settings.phone || '', type: 'tel', onChange: field(settings, setSettings, 'phone') }),
								createElement(TextareaControl, { label: __('Address', 'grosharp'), value: settings.address || '', onChange: field(settings, setSettings, 'address') })
							)
						)
					);
				}

				// ── Social Media ───────────────────────────────────────────────
				if ('social' === tab.name) {
					return createElement(Card, null,
						createElement(CardHeader, null, __('Social Media URLs', 'grosharp')),
						createElement(CardBody, null,
							createElement('p', { style: { color: '#666', fontSize: '13px', marginBottom: '16px' } },
								__('These URLs are used in the Contact section and footer social icons automatically.', 'grosharp')
							),
							socialField(settings, setSettings, 'social_whatsapp', __('WhatsApp URL', 'grosharp'), 'https://wa.me/8801234567890'),
							socialField(settings, setSettings, 'social_linkedin', __('LinkedIn URL', 'grosharp'), 'https://linkedin.com/company/grosharp'),
							socialField(settings, setSettings, 'social_instagram', __('Instagram URL', 'grosharp'), 'https://instagram.com/grosharp'),
							socialField(settings, setSettings, 'social_x', __('X (Twitter) URL', 'grosharp'), 'https://x.com/grosharp'),
							socialField(settings, setSettings, 'social_dribbble', __('Dribbble URL', 'grosharp'), 'https://dribbble.com/grosharp')
						)
					);
				}

				// ── CTA / Footer ───────────────────────────────────────────────
				return createElement(Card, null,
					createElement(CardHeader, null, __('CTA and Footer', 'grosharp')),
					createElement(CardBody, null,
						createElement(TextControl, { label: __('Default CTA label', 'grosharp'), value: settings.cta_label || '', onChange: field(settings, setSettings, 'cta_label') }),
						createElement(TextControl, { label: __('Default CTA URL', 'grosharp'), value: settings.cta_url || '', onChange: field(settings, setSettings, 'cta_url') }),
						createElement(TextareaControl, { label: __('Footer tagline text', 'grosharp'), value: settings.footer_text || '', onChange: field(settings, setSettings, 'footer_text') })
					)
				);
			})
		);
	}

	var root = document.getElementById('grosharp-settings-root');
	if (root) {
		render(createElement(App), root);
	}
})(window.wp.element, window.wp.components, window.wp.apiFetch, window.wp.i18n);
