import { __ } from '@wordpress/i18n';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import {
	Button,
	PanelBody,
	TextControl,
	TextareaControl,
	ToggleControl,
} from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';
import metadata from './block.json';

/* ── Default shape for a new pricing card ── */
const DEFAULT_ITEM = {
	title:     'New Plan',
	desc:      '',
	price:     '$0',
	period:    'per month',
	features:  [ 'Feature one' ],
	cta_label: 'Get started',
	cta_url:   '/contact/',
	featured:  false,
};

/* ── Single card panel (collapsible PanelBody) ── */
function PricingCardPanel( { item, index, total, onChange, onRemove, onMove } ) {
	const set = ( key, value ) => onChange( { ...item, [ key ]: value } );

	const setFeature = ( fi, value ) => {
		const features = [ ...( item.features || [] ) ];
		features[ fi ] = value;
		set( 'features', features );
	};
	const addFeature    = () => set( 'features', [ ...( item.features || [] ), '' ] );
	const removeFeature = ( fi ) => set( 'features', ( item.features || [] ).filter( ( _, i ) => i !== fi ) );

	return (
		<PanelBody
			title={ item.title || __( 'Untitled Plan', 'grosharp' ) }
			initialOpen={ index === 0 }
		>
			{/* Reorder / remove controls */}
			<div style={ { display: 'flex', gap: '6px', marginBottom: '14px' } }>
				<Button
					variant="secondary"
					size="small"
					disabled={ index === 0 }
					onClick={ () => onMove( index, index - 1 ) }
					icon="arrow-up-alt2"
					label={ __( 'Move up', 'grosharp' ) }
				/>
				<Button
					variant="secondary"
					size="small"
					disabled={ index === total - 1 }
					onClick={ () => onMove( index, index + 1 ) }
					icon="arrow-down-alt2"
					label={ __( 'Move down', 'grosharp' ) }
				/>
				<Button
					variant="secondary"
					size="small"
					isDestructive
					onClick={ onRemove }
					style={ { marginLeft: 'auto' } }
				>
					{ __( 'Remove', 'grosharp' ) }
				</Button>
			</div>

			{/* Core fields */}
			<TextControl
				label={ __( 'Plan Title', 'grosharp' ) }
				value={ item.title || '' }
				onChange={ ( v ) => set( 'title', v ) }
			/>
			<TextareaControl
				label={ __( 'Short Description', 'grosharp' ) }
				value={ item.desc || '' }
				onChange={ ( v ) => set( 'desc', v ) }
				rows={ 2 }
			/>
			<div style={ { display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '8px' } }>
				<TextControl
					label={ __( 'Price', 'grosharp' ) }
					value={ item.price || '' }
					onChange={ ( v ) => set( 'price', v ) }
					placeholder="From $2,500"
				/>
				<TextControl
					label={ __( 'Period / Suffix', 'grosharp' ) }
					value={ item.period || '' }
					onChange={ ( v ) => set( 'period', v ) }
					placeholder="per month"
				/>
			</div>

			{/* Benefits / features list */}
			<div style={ { marginTop: '4px' } }>
				<p style={ { fontWeight: 600, fontSize: '11px', textTransform: 'uppercase', letterSpacing: '0.04em', marginBottom: '8px', color: '#1e1e1e' } }>
					{ __( 'Benefits List', 'grosharp' ) }
				</p>

				{ ( item.features || [] ).map( ( feature, fi ) => (
					<div key={ fi } style={ { display: 'flex', gap: '6px', alignItems: 'flex-start', marginBottom: '6px' } }>
						<div style={ { flex: 1, minWidth: 0 } }>
							<TextControl
								value={ feature }
								onChange={ ( v ) => setFeature( fi, v ) }
								placeholder={ __( 'Benefit description…', 'grosharp' ) }
								hideLabelFromVision
								label={ `Benefit ${ fi + 1 }` }
							/>
						</div>
						<Button
							variant="secondary"
							size="small"
							isDestructive
							onClick={ () => removeFeature( fi ) }
							icon="no-alt"
							label={ __( 'Remove benefit', 'grosharp' ) }
							style={ { marginTop: '2px', flexShrink: 0 } }
						/>
					</div>
				) ) }

				<Button
					variant="secondary"
					size="small"
					onClick={ addFeature }
					style={ { width: '100%', justifyContent: 'center', marginBottom: '12px' } }
				>
					{ __( '+ Add Benefit', 'grosharp' ) }
				</Button>
			</div>

			{/* CTA */}
			<div style={ { display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '8px' } }>
				<TextControl
					label={ __( 'Button Label', 'grosharp' ) }
					value={ item.cta_label || '' }
					onChange={ ( v ) => set( 'cta_label', v ) }
				/>
				<TextControl
					label={ __( 'Button URL', 'grosharp' ) }
					value={ item.cta_url || '' }
					onChange={ ( v ) => set( 'cta_url', v ) }
					type="url"
				/>
			</div>

			{/* Featured toggle */}
			<ToggleControl
				label={ __( 'Featured card', 'grosharp' ) }
				checked={ !! item.featured }
				onChange={ ( v ) => set( 'featured', v ) }
				help={ __( 'Highlights this card with a violet background.', 'grosharp' ) }
			/>
		</PanelBody>
	);
}

/* ── Block edit component ── */
export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps();
	const { eyebrow, heading, text, items = [] } = attributes;

	const updateItem = ( index, newItem ) => {
		const next = [ ...items ];
		next[ index ] = newItem;
		setAttributes( { items: next } );
	};

	const removeItem = ( index ) =>
		setAttributes( { items: items.filter( ( _, i ) => i !== index ) } );

	const moveItem = ( from, to ) => {
		const next = [ ...items ];
		const [ moved ] = next.splice( from, 1 );
		next.splice( to, 0, moved );
		setAttributes( { items: next } );
	};

	const addItem = () =>
		setAttributes( { items: [ ...items, { ...DEFAULT_ITEM } ] } );

	return (
		<div { ...blockProps }>
			<InspectorControls>

				{/* ── Section header ── */}
				<PanelBody title={ __( 'Section Header', 'grosharp' ) } initialOpen={ true }>
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
						onChange={ ( v ) => setAttributes( { text: v } ) }
						rows={ 2 }
					/>
				</PanelBody>

				{/* ── Pricing card repeater ── */}
				{ items.map( ( item, i ) => (
					<PricingCardPanel
						key={ i }
						item={ item }
						index={ i }
						total={ items.length }
						onChange={ ( newItem ) => updateItem( i, newItem ) }
						onRemove={ () => removeItem( i ) }
						onMove={ moveItem }
					/>
				) ) }

				{/* ── Add card button ── */}
				<div style={ { padding: '16px' } }>
					<Button
						variant="primary"
						onClick={ addItem }
						style={ { width: '100%', justifyContent: 'center' } }
					>
						{ __( '+ Add Pricing Plan', 'grosharp' ) }
					</Button>
				</div>

			</InspectorControls>

			{/* Live server-side preview */}
			<ServerSideRender block={ metadata.name } attributes={ attributes } />
		</div>
	);
}
