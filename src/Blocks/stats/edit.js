import { __ } from '@wordpress/i18n';
import EditWithServerPreview from '../shared/EditWithServerPreview';
import metadata from './block.json';

const fields = [
	{ name: 'items', label: __( 'Stats', 'grosharp' ), type: 'json' },
];

export default function Edit( props ) {
	return <EditWithServerPreview { ...props } blockName={ metadata.name } fields={ fields } />;
}

