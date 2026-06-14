import { __, sprintf } from '@wordpress/i18n';
import { useSelect } from '@wordpress/data';
import {
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
	useBlockProps,
} from '@wordpress/block-editor';
import {
	Button,
	PanelBody,
	SelectControl,
	TextControl,
	TextareaControl,
} from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';

/* ── Single service item editor ───────────────────────────────────────────── */
function ServiceItemEditor( { item, index, onChange, onRemove, servicePosts } ) {
	const postOptions = [
		{ label: __( '— Use custom URL below —', 'grosharp' ), value: 0 },
		...( servicePosts || [] ).map( ( p ) => ( {
			label: p.title?.rendered || `Post #${ p.id }`,
			value: p.id,
		} ) ),
	];

	function handlePostSelect( rawVal ) {
		const id = parseInt( rawVal, 10 );
		if ( id > 0 ) {
			const post = ( servicePosts || [] ).find( ( p ) => p.id === id );
			onChange( { ...item, linkPostId: id, url: post?.link || item.url || '' } );
		} else {
			onChange( { ...item, linkPostId: 0 } );
		}
	}

	return (
		<div
			style={ {
				border: '1px solid #e2e4e7',
				borderRadius: '4px',
				padding: '12px',
				marginBottom: '12px',
				background: '#f9f9f9',
			} }
		>
			{/* Header row */}
			<div
				style={ {
					display: 'flex',
					justifyContent: 'space-between',
					alignItems: 'center',
					marginBottom: '10px',
				} }
			>
				<strong style={ { fontSize: '11px', textTransform: 'uppercase', letterSpacing: '0.06em', color: '#444' } }>
					{ sprintf( /* translators: %d = item number */ __( 'Service %d', 'grosharp' ), index + 1 ) }
				</strong>
				<Button
					isDestructive
					size="small"
					variant="tertiary"
					onClick={ onRemove }
					style={ { minHeight: 'unset', padding: '2px 6px', fontSize: '11px' } }
				>
					{ __( 'Remove', 'grosharp' ) }
				</Button>
			</div>

			{/* Icon upload */}
			<p style={ { fontSize: '11px', fontWeight: 600, marginBottom: '6px', color: '#444' } }>
				{ __( 'Icon (upload white SVG/PNG on transparent bg)', 'grosharp' ) }
			</p>
			<MediaUploadCheck>
				<MediaUpload
					allowedTypes={ [ 'image' ] }
					value={ item.iconId || 0 }
					onSelect={ ( media ) =>
						onChange( { ...item, iconUrl: media.url, iconId: media.id } )
					}
					render={ ( { open } ) => (
						<Button size="small" variant="secondary" onClick={ open }>
							{ item.iconUrl
								? __( 'Replace icon', 'grosharp' )
								: __( 'Upload icon', 'grosharp' ) }
						</Button>
					) }
				/>
			</MediaUploadCheck>
			{ item.iconUrl && (
				<div
					style={ {
						display: 'flex',
						alignItems: 'center',
						gap: '8px',
						marginTop: '8px',
						background: '#0d0d12',
						padding: '8px 12px',
						borderRadius: '4px',
					} }
				>
					<img
						src={ item.iconUrl }
						alt=""
						style={ {
							width: '32px',
							height: '32px',
							objectFit: 'contain',
							filter: 'brightness(0) invert(1)',
						} }
					/>
					<Button
						isDestructive
						size="small"
						variant="link"
						onClick={ () => onChange( { ...item, iconUrl: '', iconId: 0 } ) }
						style={ { color: '#ff6b6b', fontSize: '11px' } }
					>
						{ __( 'Remove', 'grosharp' ) }
					</Button>
				</div>
			) }

			{/* Number badge */}
			<TextControl
				label={ __( 'Badge number', 'grosharp' ) }
				help={ __( 'Shown large at card bottom, e.g. "01"', 'grosharp' ) }
				value={ item.number || '' }
				placeholder="01"
				onChange={ ( v ) => onChange( { ...item, number: v } ) }
				style={ { marginTop: '12px' } }
			/>

			{/* Title */}
			<TextControl
				label={ __( 'Service title', 'grosharp' ) }
				value={ item.title || '' }
				placeholder={ __( 'e.g. Brand & UI Design', 'grosharp' ) }
				onChange={ ( v ) => onChange( { ...item, title: v } ) }
			/>

			{/* Description */}
			<TextareaControl
				label={ __( 'Short description', 'grosharp' ) }
				value={ item.description || '' }
				rows={ 2 }
				placeholder={ __( 'One-liner about the service…', 'grosharp' ) }
				onChange={ ( v ) => onChange( { ...item, description: v } ) }
			/>

			{/* Link: service post OR custom URL */}
			{ postOptions.length > 1 && (
				<SelectControl
					label={ __( 'Link to service post', 'grosharp' ) }
					value={ item.linkPostId || 0 }
					options={ postOptions }
					onChange={ handlePostSelect }
				/>
			) }
			<TextControl
				label={ item.linkPostId > 0
					? __( 'Link URL (auto-filled from post, override if needed)', 'grosharp' )
					: __( 'Link URL', 'grosharp' ) }
				value={ item.url || '' }
				placeholder="/services/branding/"
				onChange={ ( v ) => onChange( { ...item, url: v } ) }
			/>
		</div>
	);
}

/* ── Main Edit component ──────────────────────────────────────────────────── */
export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps();
	const { eyebrow, heading, text, ctaUrl, ctaLabel, services } = attributes;
	const items = Array.isArray( services ) ? services : [];

	/* Fetch published service posts for the link selector */
	const servicePosts = useSelect( ( select ) => {
		return select( 'core' ).getEntityRecords( 'postType', 'grosharp_service', {
			per_page: 50,
			status: 'publish',
			_fields: [ 'id', 'title', 'link' ],
		} );
	}, [] );

	function updateItem( index, updated ) {
		const next = [ ...items ];
		next[ index ] = updated;
		setAttributes( { services: next } );
	}

	function removeItem( index ) {
		const next = [ ...items ];
		next.splice( index, 1 );
		setAttributes( { services: next } );
	}

	function addItem() {
		const num = String( items.length + 1 ).padStart( 2, '0' );
		setAttributes( {
			services: [
				...items,
				{ title: '', description: '', number: num, iconUrl: '', iconId: 0, url: '/services/', linkPostId: 0 },
			],
		} );
	}

	return (
		<div { ...blockProps }>
			<InspectorControls>
				{/* ── Section settings ── */}
				<PanelBody title={ __( 'Section Content', 'grosharp' ) } initialOpen={ false }>
					<TextControl
						label={ __( 'Eyebrow', 'grosharp' ) }
						value={ eyebrow || '' }
						onChange={ ( v ) => setAttributes( { eyebrow: v } ) }
					/>
					<TextControl
						label={ __( 'Heading', 'grosharp' ) }
						value={ heading || '' }
						onChange={ ( v ) => setAttributes( { heading: v } ) }
					/>
					<TextareaControl
						label={ __( 'Subtext', 'grosharp' ) }
						value={ text || '' }
						rows={ 2 }
						onChange={ ( v ) => setAttributes( { text: v } ) }
					/>
					<TextControl
						label={ __( 'CTA Label', 'grosharp' ) }
						value={ ctaLabel || '' }
						onChange={ ( v ) => setAttributes( { ctaLabel: v } ) }
					/>
					<TextControl
						label={ __( 'CTA URL', 'grosharp' ) }
						value={ ctaUrl || '' }
						onChange={ ( v ) => setAttributes( { ctaUrl: v } ) }
					/>
				</PanelBody>

				{/* ── Services (repeatable) ── */}
				<PanelBody title={ __( 'Services', 'grosharp' ) } initialOpen={ true }>
					<p style={ { fontSize: '12px', color: '#666', marginBottom: '12px', lineHeight: 1.5 } }>
						{ __(
							'Add services manually here. Leave empty to auto-load from the Services post type.',
							'grosharp'
						) }
					</p>

					{ items.map( ( item, i ) => (
						<ServiceItemEditor
							key={ i }
							item={ item }
							index={ i }
							onChange={ ( updated ) => updateItem( i, updated ) }
							onRemove={ () => removeItem( i ) }
							servicePosts={ servicePosts || [] }
						/>
					) ) }

					<Button
						variant="secondary"
						onClick={ addItem }
						style={ { width: '100%', justifyContent: 'center', marginTop: '4px' } }
					>
						{ __( '+ Add Service', 'grosharp' ) }
					</Button>
				</PanelBody>
			</InspectorControls>

			<ServerSideRender block="grosharp/services-grid" attributes={ attributes } />
		</div>
	);
}
