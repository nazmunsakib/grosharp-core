import { __ } from '@wordpress/i18n';
import EditWithServerPreview from '../shared/EditWithServerPreview';
import metadata from './block.json';

const fields = [
	{ name: 'eyebrow', label: __( 'Eyebrow label', 'grosharp' ) },
	{ name: 'quote',   label: __( 'Pulled quote', 'grosharp' ), type: 'textarea' },
	{ name: 'p1',      label: __( 'Paragraph 1', 'grosharp' ), type: 'textarea' },
	{ name: 'p2',      label: __( 'Paragraph 2', 'grosharp' ), type: 'textarea' },
	{ name: 'p3',      label: __( 'Paragraph 3', 'grosharp' ), type: 'textarea' },
];

export default function Edit( props ) {
	return <EditWithServerPreview { ...props } blockName={ metadata.name } fields={ fields } />;
}
