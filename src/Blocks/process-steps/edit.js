import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';
import metadata from './block.json';

const MAX_STEPS = 4;

export default function Edit( { attributes, setAttributes } ) {
	const { eyebrow, heading, text, steps } = attributes;
	const blockProps = useBlockProps();

	const updateStep = ( index, field, value ) => {
		const updated = steps.map( ( step, i ) =>
			i === index ? { ...step, [ field ]: value } : step
		);
		setAttributes( { steps: updated } );
	};

	const addStep = () => {
		if ( steps.length >= MAX_STEPS ) return;
		setAttributes( { steps: [ ...steps, { title: '', text: '' } ] } );
	};

	const removeStep = ( index ) => {
		if ( steps.length <= 1 ) return;
		setAttributes( { steps: steps.filter( ( _, i ) => i !== index ) } );
	};

	return (
		<div { ...blockProps }>
			<InspectorControls>

				{ /* ── Section header ── */ }
				<PanelBody title={ __( 'Section Header', 'grosharp' ) } initialOpen={ true }>
					<TextControl
						label={ __( 'Eyebrow', 'grosharp' ) }
						value={ eyebrow }
						onChange={ ( val ) => setAttributes( { eyebrow: val } ) }
					/>
					<TextControl
						label={ __( 'Heading', 'grosharp' ) }
						value={ heading }
						onChange={ ( val ) => setAttributes( { heading: val } ) }
					/>
					<TextareaControl
						label={ __( 'Subtext', 'grosharp' ) }
						value={ text }
						onChange={ ( val ) => setAttributes( { text: val } ) }
					/>
				</PanelBody>

				{ /* ── Steps repeater ── */ }
				<PanelBody
					title={ `${ __( 'Steps', 'grosharp' ) } (${ steps.length }/${ MAX_STEPS })` }
					initialOpen={ true }
				>
					{ steps.map( ( step, index ) => (
						<div
							key={ index }
							style={ {
								borderLeft: '3px solid #654cff',
								paddingLeft: '12px',
								marginBottom: '20px',
								paddingBottom: '12px',
								borderBottom: index < steps.length - 1 ? '1px solid #e8e8e8' : 'none',
							} }
						>
							<div style={ { display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '8px' } }>
								<strong style={ { color: '#654cff', fontSize: '12px', textTransform: 'uppercase', letterSpacing: '0.05em' } }>
									{ __( 'Step', 'grosharp' ) } { index + 1 }
								</strong>
								{ steps.length > 1 && (
									<Button
										isDestructive
										variant="link"
										style={ { fontSize: '12px' } }
										onClick={ () => removeStep( index ) }
									>
										{ __( 'Remove', 'grosharp' ) }
									</Button>
								) }
							</div>
							<TextControl
								label={ __( 'Title', 'grosharp' ) }
								value={ step.title }
								onChange={ ( val ) => updateStep( index, 'title', val ) }
							/>
							<TextareaControl
								label={ __( 'Description', 'grosharp' ) }
								value={ step.text }
								onChange={ ( val ) => updateStep( index, 'text', val ) }
								rows={ 3 }
							/>
						</div>
					) ) }

					<Button
						variant="secondary"
						onClick={ addStep }
						disabled={ steps.length >= MAX_STEPS }
						style={ { width: '100%', justifyContent: 'center' } }
					>
						{ steps.length >= MAX_STEPS
							? __( 'Maximum 4 steps reached', 'grosharp' )
							: __( '+ Add Step', 'grosharp' ) }
					</Button>
				</PanelBody>

			</InspectorControls>

			<ServerSideRender block={ metadata.name } attributes={ attributes } />
		</div>
	);
}
