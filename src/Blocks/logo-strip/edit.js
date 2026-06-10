import { InspectorControls, MediaUpload, MediaUploadCheck, useBlockProps } from '@wordpress/block-editor';
import { Button, PanelBody, RangeControl } from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';

const createLogo = () => ( { imageId: 0, imageUrl: '', imageAlt: '' } );

function updateItem( logos, index, next ) {
	return logos.map( ( item, i ) => ( i === index ? { ...item, ...next } : item ) );
}

export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps();
	const logos = Array.isArray( attributes.logos ) ? attributes.logos : [];

	return (
		<div { ...blockProps }>
			<InspectorControls>
				<PanelBody title={ __( 'Brand Logos', 'grosharp' ) } initialOpen={ true }>
					<RangeControl
						label={ __( 'Scroll speed', 'grosharp' ) }
						value={ attributes.speed || 42 }
						min={ 20 }
						max={ 90 }
						onChange={ ( speed ) => setAttributes( { speed } ) }
					/>

					{ logos.map( ( logo, index ) => (
						<div
							key={ index }
							style={ {
								borderTop: '1px solid #e0e0e0',
								marginTop: '16px',
								paddingTop: '16px',
							} }
						>
							<p style={ { margin: '0 0 8px', fontWeight: 600, fontSize: '12px', textTransform: 'uppercase', color: '#666' } }>
								{ __( 'Logo', 'grosharp' ) } { index + 1 }
							</p>

							{ logo.imageUrl ? (
								<div style={ { marginBottom: '8px' } }>
									<img
										src={ logo.imageUrl }
										alt={ logo.imageAlt || '' }
										style={ { display: 'block', maxHeight: '44px', maxWidth: '180px', objectFit: 'contain' } }
									/>
								</div>
							) : null }

							<MediaUploadCheck>
								<MediaUpload
									allowedTypes={ [ 'image' ] }
									value={ logo.imageId || 0 }
									onSelect={ ( media ) =>
										setAttributes( {
											logos: updateItem( logos, index, {
												imageId: media?.id || 0,
												imageUrl: media?.url || '',
												imageAlt: media?.alt || media?.title || '',
											} ),
										} )
									}
									render={ ( { open } ) => (
										<Button variant="secondary" onClick={ open } style={ { marginRight: '8px' } }>
											{ logo.imageUrl
												? __( 'Replace image', 'grosharp' )
												: __( 'Upload logo', 'grosharp' ) }
										</Button>
									) }
								/>
							</MediaUploadCheck>

							{ logo.imageUrl ? (
								<Button
									variant="link"
									onClick={ () =>
										setAttributes( {
											logos: updateItem( logos, index, { imageId: 0, imageUrl: '', imageAlt: '' } ),
										} )
									}
									style={ { marginRight: '8px' } }
								>
									{ __( 'Clear', 'grosharp' ) }
								</Button>
							) : null }

							<Button
								isDestructive
								variant="link"
								onClick={ () =>
									setAttributes( { logos: logos.filter( ( _, i ) => i !== index ) } )
								}
							>
								{ __( 'Remove', 'grosharp' ) }
							</Button>
						</div>
					) ) }

					<div style={ { borderTop: logos.length ? '1px solid #e0e0e0' : 'none', marginTop: logos.length ? '16px' : '0', paddingTop: logos.length ? '16px' : '0' } }>
						<Button
							variant="primary"
							onClick={ () => setAttributes( { logos: [ ...logos, createLogo() ] } ) }
						>
							{ __( '+ Add logo', 'grosharp' ) }
						</Button>
					</div>
				</PanelBody>
			</InspectorControls>
			<ServerSideRender block={ metadata.name } attributes={ attributes } />
		</div>
	);
}
