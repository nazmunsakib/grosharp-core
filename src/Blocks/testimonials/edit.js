import { __ } from '@wordpress/i18n';
import EditWithServerPreview from '../shared/EditWithServerPreview';
import metadata from './block.json';

const fields = [
	{ name: 'heading', label: __( 'Heading', 'grosharp' ) },
	{ name: 'text', label: __( 'Text', 'grosharp' ), type: 'textarea' },
	{ name: 'count', label: __( 'Number of testimonials', 'grosharp' ), type: 'range', min: 1, max: 12, defaultValue: 3 },
];

export default function Edit( props ) {
	return <EditWithServerPreview { ...props } blockName={ metadata.name } fields={ fields } />;
}

