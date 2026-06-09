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
			var payload = {};
			payload[optionName] = settings;
			setSaving(true);
			setNotice('');

			apiFetch({ path: '/wp/v2/settings', method: 'POST', data: payload })
				.then(function () {
					setNotice(__('Settings saved. Brand colors will update on the frontend through theme CSS variables.', 'grosharp'));
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
					{ name: 'cta', title: __('CTA/Footer', 'grosharp') }
				]
			}, function (tab) {
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
									{ label: 'Inter', value: 'Inter' }
								],
								onChange: field(settings, setSettings, 'heading_font')
							}),
							createElement(SelectControl, {
								label: __('Body font', 'grosharp'),
								value: settings.body_font,
								options: [
									{ label: 'Switzer', value: 'Switzer' },
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

				if ('company' === tab.name) {
					return createElement(Card, null,
						createElement(CardHeader, null, __('Company Info', 'grosharp')),
						createElement(CardBody, null,
							createElement(TextControl, { label: __('Company name', 'grosharp'), value: settings.company_name || '', onChange: field(settings, setSettings, 'company_name') }),
							createElement(TextControl, { label: __('Tagline', 'grosharp'), value: settings.tagline || '', onChange: field(settings, setSettings, 'tagline') }),
							createElement(TextControl, { label: __('Email', 'grosharp'), value: settings.email || '', onChange: field(settings, setSettings, 'email') }),
							createElement(TextControl, { label: __('Phone', 'grosharp'), value: settings.phone || '', onChange: field(settings, setSettings, 'phone') }),
							createElement(TextareaControl, { label: __('Address', 'grosharp'), value: settings.address || '', onChange: field(settings, setSettings, 'address') })
						)
					);
				}

				return createElement(Card, null,
					createElement(CardHeader, null, __('CTA and Footer', 'grosharp')),
					createElement(CardBody, null,
						createElement(TextControl, { label: __('Default CTA label', 'grosharp'), value: settings.cta_label || '', onChange: field(settings, setSettings, 'cta_label') }),
						createElement(TextControl, { label: __('Default CTA URL', 'grosharp'), value: settings.cta_url || '', onChange: field(settings, setSettings, 'cta_url') }),
						createElement(TextareaControl, { label: __('Footer text', 'grosharp'), value: settings.footer_text || '', onChange: field(settings, setSettings, 'footer_text') })
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
