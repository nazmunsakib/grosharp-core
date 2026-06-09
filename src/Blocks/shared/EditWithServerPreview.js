import { InspectorControls, MediaUpload, MediaUploadCheck, useBlockProps } from '@wordpress/block-editor';
import { Button, PanelBody, RangeControl, TextareaControl, TextControl } from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';
import { __ } from '@wordpress/i18n';

function parseJsonList( value, fallback ) {
	try {
		const parsed = JSON.parse( value );
		return Array.isArray( parsed ) ? parsed : fallback;
	} catch ( error ) {
		return fallback;
	}
}

function renderField( field, attributes, setAttributes ) {
	const value = attributes[ field.name ];

	if ( field.type === 'media' ) {
		const mediaId = field.idName ? attributes[ field.idName ] : undefined;

		return (
			<div key={ field.name } className="grosharp-editor-media-field">
				<p className="components-base-control__label">{ field.label }</p>
				<MediaUploadCheck>
					<MediaUpload
						allowedTypes={ field.allowedTypes || [ 'image' ] }
						value={ mediaId || 0 }
						onSelect={ ( media ) => {
							setAttributes( {
								[ field.name ]: media?.url || '',
								...( field.idName ? { [ field.idName ]: media?.id || 0 } : {} ),
								...( field.altName ? { [ field.altName ]: media?.alt || media?.title || '' } : {} ),
							} );
						} }
						render={ ( { open } ) => (
							<Button variant="secondary" onClick={ open }>
								{ value ? __( 'Replace image', 'grosharp' ) : __( 'Select image', 'grosharp' ) }
							</Button>
						) }
					/>
				</MediaUploadCheck>
				{ value ? (
					<>
						<img src={ value } alt="" style={ { display: 'block', marginTop: '12px', maxWidth: '100%' } } />
						<Button
							isDestructive
							variant="link"
							onClick={ () =>
								setAttributes( {
									[ field.name ]: '',
									...( field.idName ? { [ field.idName ]: 0 } : {} ),
								} )
							}
						>
							{ __( 'Remove image', 'grosharp' ) }
						</Button>
					</>
				) : null }
			</div>
		);
	}

	if ( field.type === 'textarea' ) {
		return (
			<TextareaControl
				key={ field.name }
				label={ field.label }
				value={ value || '' }
				onChange={ ( nextValue ) => setAttributes( { [ field.name ]: nextValue } ) }
			/>
		);
	}

	if ( field.type === 'range' ) {
		return (
			<RangeControl
				key={ field.name }
				label={ field.label }
				value={ value || field.defaultValue || 1 }
				min={ field.min || 1 }
				max={ field.max || 12 }
				onChange={ ( nextValue ) => setAttributes( { [ field.name ]: nextValue } ) }
			/>
		);
	}

	if ( field.type === 'json' ) {
		return (
			<TextareaControl
				key={ field.name }
				label={ field.label }
				help={ __( 'Enter JSON array data. Styling is controlled globally by the theme.', 'grosharp' ) }
				value={ JSON.stringify( value || field.defaultValue || [], null, 2 ) }
				onChange={ ( nextValue ) =>
					setAttributes( {
						[ field.name ]: parseJsonList( nextValue, value || field.defaultValue || [] ),
					} )
				}
			/>
		);
	}

	return (
		<TextControl
			key={ field.name }
			label={ field.label }
			value={ value || '' }
			onChange={ ( nextValue ) => setAttributes( { [ field.name ]: nextValue } ) }
		/>
	);
}

export default function EditWithServerPreview( { attributes, blockName, fields, setAttributes } ) {
	const blockProps = useBlockProps();

	return (
		<div { ...blockProps }>
			<InspectorControls>
				<PanelBody title={ __( 'Content', 'grosharp' ) } initialOpen={ true }>
					{ fields.map( ( field ) => renderField( field, attributes, setAttributes ) ) }
				</PanelBody>
			</InspectorControls>
			<ServerSideRender block={ blockName } attributes={ attributes } />
		</div>
	);
}
