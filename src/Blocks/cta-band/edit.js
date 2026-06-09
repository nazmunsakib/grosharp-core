import { __ } from '@wordpress/i18n';
import EditWithServerPreview from '../shared/EditWithServerPreview';
import metadata from './block.json';

const fields = [
	{ name: 'heading', label: __( 'Heading', 'grosharp' ) },
	{ name: 'text', label: __( 'Text', 'grosharp' ), type: 'textarea' },
	{ name: 'buttonLabel', label: __( 'Button label', 'grosharp' ) },
	{ name: 'buttonUrl', label: __( 'Button URL', 'grosharp' ) },
];

export default function Edit( props ) {
	return <EditWithServerPreview { ...props } blockName={ metadata.name } fields={ fields } />;
}

