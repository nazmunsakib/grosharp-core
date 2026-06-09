import { __ } from '@wordpress/i18n';
import EditWithServerPreview from '../shared/EditWithServerPreview';
import metadata from './block.json';

const fields = [
	{ name: 'badge', label: __( 'Badge', 'grosharp' ) },
	{ name: 'eyebrow', label: __( 'Badge text', 'grosharp' ) },
	{ name: 'heading', label: __( 'Heading', 'grosharp' ) },
	{ name: 'text', label: __( 'Text', 'grosharp' ), type: 'textarea' },
	{ name: 'primaryLabel', label: __( 'Primary button label', 'grosharp' ) },
	{ name: 'primaryUrl', label: __( 'Primary button URL', 'grosharp' ) },
	{ name: 'secondaryLabel', label: __( 'Secondary button label', 'grosharp' ) },
	{ name: 'secondaryUrl', label: __( 'Secondary button URL', 'grosharp' ) },
	{
		name: 'imageUrl',
		label: __( 'Dashboard image', 'grosharp' ),
		type: 'media',
		idName: 'imageId',
		altName: 'imageAlt',
	},
	{ name: 'imageAlt', label: __( 'Dashboard image alt text', 'grosharp' ) },
];

export default function Edit( props ) {
	return <EditWithServerPreview { ...props } blockName={ metadata.name } fields={ fields } />;
}
