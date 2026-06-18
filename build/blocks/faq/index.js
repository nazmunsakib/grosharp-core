(function () {
	'use strict';

	var el               = window.wp.element.createElement;
	var useState         = window.wp.element.useState;
	var __               = window.wp.i18n.__;
	var registerBlockType = window.wp.blocks.registerBlockType;
	var InspectorControls = window.wp.blockEditor.InspectorControls;
	var useBlockProps    = window.wp.blockEditor.useBlockProps;
	var PanelBody        = window.wp.components.PanelBody;
	var TextControl      = window.wp.components.TextControl;
	var TextareaControl  = window.wp.components.TextareaControl;
	var Button           = window.wp.components.Button;
	var SSR              = window.wp.serverSideRender;
	var ServerSideRender = ( SSR && SSR.default ) ? SSR.default : SSR;

	registerBlockType( 'grosharp/faq', {
		edit: function ( props ) {
			var attributes    = props.attributes;
			var setAttributes = props.setAttributes;
			var blockProps    = useBlockProps();
			var items         = Array.isArray( attributes.items ) ? attributes.items : [];

			// Track which items are expanded. Default: all collapsed.
			var expandedState = useState( {} );
			var expanded      = expandedState[ 0 ];
			var setExpanded   = expandedState[ 1 ];

			function toggleExpanded( index ) {
				setExpanded( Object.assign( {}, expanded, { [ index ]: ! expanded[ index ] } ) );
			}

			function updateItem( index, key, value ) {
				var next = items.map( function ( item, i ) {
					return i === index ? Object.assign( {}, item, { [ key ]: value } ) : item;
				} );
				setAttributes( { items: next } );
			}

			function addItem() {
				setAttributes( { items: items.concat( [ { question: '', answer: '' } ] ) } );
			}

			function removeItem( index ) {
				setAttributes( { items: items.filter( function ( _, i ) { return i !== index; } ) } );
			}

			function moveItem( index, direction ) {
				var next   = items.slice();
				var target = index + direction;
				if ( target < 0 || target >= next.length ) return;
				var tmp        = next[ index ];
				next[ index ]  = next[ target ];
				next[ target ] = tmp;
				setAttributes( { items: next } );
			}

			var cardStyle = {
				border: '1px solid #e2e2e2',
				borderRadius: '8px',
				padding: '12px 14px',
				marginBottom: '10px',
				background: '#fff',
				boxShadow: '0 1px 3px rgba(0,0,0,0.06)',
			};

			return el(
				'div',
				blockProps,

				// ── Sidebar ───────────────────────────────────────────────
				el(
					InspectorControls,
					null,

					// Section settings
					el(
						PanelBody,
						{ title: __( 'Section', 'grosharp' ), initialOpen: false },
						el( TextControl, {
							label: __( 'Heading', 'grosharp' ),
							value: attributes.heading || '',
							onChange: function ( v ) { setAttributes( { heading: v } ); },
						} ),
						el( TextareaControl, {
							label: __( 'Subtext', 'grosharp' ),
							value: attributes.text || '',
							onChange: function ( v ) { setAttributes( { text: v } ); },
						} )
					),

					// Repeater panel
					el(
						PanelBody,
						{ title: __( 'FAQ Items', 'grosharp' ) + ' (' + items.length + ')', initialOpen: true },

						items.map( function ( item, index ) {
							var isOpen    = !! expanded[ index ];
							var preview   = item.question ? item.question : __( '(no question yet)', 'grosharp' );

							return el(
								'div',
								{ key: String( index ), style: cardStyle },

								// ── Clickable header row ──────────────────────────
								el(
									'div',
									{
										style: {
											display: 'flex',
											justifyContent: 'space-between',
											alignItems: 'center',
											cursor: 'pointer',
											userSelect: 'none',
											gap: '8px',
										},
										onClick: function () { toggleExpanded( index ); },
									},

									// Left: chevron + question preview
									el(
										'div',
										{ style: { display: 'flex', alignItems: 'center', gap: '6px', minWidth: 0 } },
										el(
											'span',
											{ style: { fontSize: '11px', color: 'var(--grosharp-primary)', transition: 'transform 0.2s', transform: isOpen ? 'rotate(90deg)' : 'rotate(0deg)', flexShrink: 0 } },
											'▶'
										),
										el(
											'span',
											{ style: { fontSize: '12px', fontWeight: '600', color: '#1e1e1e', overflow: 'hidden', textOverflow: 'ellipsis', whiteSpace: 'nowrap' } },
											preview
										)
									),

									// Right: reorder + remove (stop propagation so they don't toggle)
									el(
										'div',
										{ style: { display: 'flex', gap: '2px', alignItems: 'center', flexShrink: 0 }, onClick: function ( e ) { e.stopPropagation(); } },
										el( Button, { variant: 'tertiary', isSmall: true, disabled: index === 0, onClick: function () { moveItem( index, -1 ); }, title: __( 'Move up', 'grosharp' ) }, '↑' ),
										el( Button, { variant: 'tertiary', isSmall: true, disabled: index === items.length - 1, onClick: function () { moveItem( index, 1 ); }, title: __( 'Move down', 'grosharp' ) }, '↓' ),
										el( Button, { isDestructive: true, variant: 'tertiary', isSmall: true, onClick: function () { removeItem( index ); }, title: __( 'Remove', 'grosharp' ) }, '✕' )
									)
								),

								// ── Expandable body ───────────────────────────────
								isOpen && el(
									'div',
									{ style: { marginTop: '10px', paddingTop: '10px', borderTop: '1px solid #f0f0f0' } },
									el( TextControl, {
										label: __( 'Question', 'grosharp' ),
										value: item.question || '',
										placeholder: __( 'e.g. How long does a project take?', 'grosharp' ),
										onChange: function ( v ) { updateItem( index, 'question', v ); },
									} ),
									el( TextareaControl, {
										label: __( 'Answer', 'grosharp' ),
										value: item.answer || '',
										rows: 3,
										placeholder: __( 'Write a clear, concise answer…', 'grosharp' ),
										onChange: function ( v ) { updateItem( index, 'answer', v ); },
									} )
								)
							);
						} ),

						el(
							Button,
							{
								variant: 'secondary',
								onClick: addItem,
								style: { width: '100%', justifyContent: 'center', marginTop: '6px' },
							},
							'+ ' + __( 'Add FAQ', 'grosharp' )
						)
					)
				),

				// ── Front-end preview ─────────────────────────────────────
				el( ServerSideRender, { block: 'grosharp/faq', attributes: attributes } )
			);
		},
	} );
} )();
