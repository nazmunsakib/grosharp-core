import { InspectorControls, MediaUpload, MediaUploadCheck, useBlockProps } from '@wordpress/block-editor';
import { Button, PanelBody, RangeControl, TextControl } from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';

const createLogo = () => ( {
	label: '',
	imageId: 0,
	imageUrl: '',
	imageAlt: '',
	url: '',
} );

const normalizeLogo = ( item ) => {
	if ( typeof item === 'string' ) {
		return {
			...createLogo(),
			label: item,
			imageAlt: item,
		};
	}

	return {
		...createLogo(),
		...( item || {} ),
	};
};

function updateItem( items, index, nextItem ) {
	return items.map( ( item, itemIndex ) => ( itemIndex === index ? { ...item, ...nextItem } : item ) );
}

export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps();
	const items = Array.isArray( attributes.items ) ? attributes.items.map( normalizeLogo ) : [];

	return (
		<div { ...blockProps }>
			<InspectorControls>
				<PanelBody title={ __( 'Partner Logos', 'grosharp' ) } initialOpen={ true }>
					<TextControl
						label={ __( 'Intro text', 'grosharp' ) }
						value={ attributes.eyebrow || '' }
						onChange={ ( eyebrow ) => setAttributes( { eyebrow } ) }
					/>
					<RangeControl
						label={ __( 'Scroll speed', 'grosharp' ) }
						value={ attributes.speed || 42 }
						min={ 20 }
						max={ 90 }
						onChange={ ( speed ) => setAttributes( { speed } ) }
					/>
					{ items.map( ( item, index ) => (
						<div
							key={ index }
							style={ {
								borderTop: '1px solid #e0e0e0',
								marginTop: '16px',
								paddingTop: '16px',
							} }
						>
							<TextControl
								label={ __( 'Logo name', 'grosharp' ) }
								value={ item.label || '' }
								onChange={ ( label ) => setAttributes( { items: updateItem( items, index, { label } ) } ) }
							/>
							<TextControl
								label={ __( 'Logo link', 'grosharp' ) }
								value={ item.url || '' }
								onChange={ ( url ) => setAttributes( { items: updateItem( items, index, { url } ) } ) }
							/>
							<MediaUploadCheck>
								<MediaUpload
									allowedTypes={ [ 'image' ] }
									value={ item.imageId || 0 }
									onSelect={ ( media ) =>
										setAttributes( {
											items: updateItem( items, index, {
												imageId: media?.id || 0,
												imageUrl: media?.url || '',
												imageAlt: media?.alt || media?.title || item.label || '',
											} ),
										} )
									}
									render={ ( { open } ) => (
										<Button variant="secondary" onClick={ open }>
											{ item.imageUrl ? __( 'Replace logo', 'grosharp' ) : __( 'Select logo', 'grosharp' ) }
										</Button>
									) }
								/>
							</MediaUploadCheck>
							{ item.imageUrl ? (
								<>
									<img
										src={ item.imageUrl }
										alt=""
										style={ { display: 'block', marginTop: '12px', maxHeight: '42px', maxWidth: '180px' } }
									/>
									<Button
										isDestructive
										variant="link"
										onClick={ () =>
											setAttributes( {
												items: updateItem( items, index, {
													imageId: 0,
													imageUrl: '',
												} ),
											} )
										}
									>
										{ __( 'Remove logo image', 'grosharp' ) }
									</Button>
								</>
							) : null }
							<Button
								isDestructive
								variant="link"
								onClick={ () => setAttributes( { items: items.filter( ( _item, itemIndex ) => itemIndex !== index ) } ) }
							>
								{ __( 'Remove logo', 'grosharp' ) }
							</Button>
						</div>
					) ) }
					<Button variant="primary" onClick={ () => setAttributes( { items: [ ...items, createLogo() ] } ) }>
						{ __( 'Add logo', 'grosharp' ) }
					</Button>
				</PanelBody>
			</InspectorControls>
			<ServerSideRender block={ metadata.name } attributes={ attributes } />
		</div>
	);
}
