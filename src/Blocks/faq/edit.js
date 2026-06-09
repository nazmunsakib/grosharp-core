import { __ } from '@wordpress/i18n';
import EditWithServerPreview from '../shared/EditWithServerPreview';
import metadata from './block.json';

const fields = [
	{ name: 'heading', label: __( 'Heading', 'grosharp' ) },
	{ name: 'text', label: __( 'Text', 'grosharp' ), type: 'textarea' },
	{ name: 'items', label: __( 'FAQ items', 'grosharp' ), type: 'json' },
];

export default function Edit( props ) {
	return <EditWithServerPreview { ...props } blockName={ metadata.name } fields={ fields } />;
}

