(function () {
	'use strict';

	var el               = window.wp.element.createElement;
	var __               = window.wp.i18n.__;
	var registerBlockType = window.wp.blocks.registerBlockType;
	var InspectorControls = window.wp.blockEditor.InspectorControls;
	var useBlockProps    = window.wp.blockEditor.useBlockProps;
	var PanelBody        = window.wp.components.PanelBody;
	var TextControl      = window.wp.components.TextControl;
	var SSR              = window.wp.serverSideRender;
	var ServerSideRender = ( SSR && SSR.default ) ? SSR.default : SSR;

	var channels = [
		{ key: 'whatsapp',  name: 'WhatsApp'   },
		{ key: 'email',     name: 'Email'       },
		{ key: 'linkedin',  name: 'LinkedIn'    },
		{ key: 'instagram', name: 'Instagram'   },
		{ key: 'x',         name: 'X (Twitter)' },
		{ key: 'dribbble',  name: 'Dribbble'    },
	];

	registerBlockType( 'grosharp/contact', {
		edit: function ( props ) {
			var attributes    = props.attributes;
			var setAttributes = props.setAttributes;
			var blockProps    = useBlockProps();

			function field( name, label ) {
				return el( TextControl, {
					key: name,
					label: label,
					value: attributes[ name ] || '',
					onChange: function ( v ) { setAttributes( { [ name ]: v } ); },
				} );
			}

			return el(
				'div',
				blockProps,

				el(
					InspectorControls,
					null,

					// Section copy
					el(
						PanelBody,
						{ title: __( 'Section', 'grosharp' ), initialOpen: true },
						field( 'eyebrow', __( 'Eyebrow', 'grosharp' ) ),
						field( 'heading', __( 'Heading', 'grosharp' ) ),
						el( window.wp.components.TextareaControl, {
							label: __( 'Text', 'grosharp' ),
							value: attributes.text || '',
							onChange: function ( v ) { setAttributes( { text: v } ); },
						} ),
						field( 'badge', __( 'Response badge', 'grosharp' ) )
					),

					// Each channel in its own collapsible panel
					channels.map( function ( ch ) {
						return el(
							PanelBody,
							{ key: ch.key, title: ch.name, initialOpen: false },
							field( ch.key + 'Label', __( 'Label / handle', 'grosharp' ) ),
							field( ch.key + 'Url',   __( 'URL', 'grosharp' ) )
						);
					} )
				),

				el( ServerSideRender, { block: 'grosharp/contact', attributes: attributes } )
			);
		},
	} );
} )();
