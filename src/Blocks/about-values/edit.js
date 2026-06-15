import { __ } from '@wordpress/i18n';
import EditWithServerPreview from '../shared/EditWithServerPreview';
import metadata from './block.json';

const fields = [
	{ name: 'eyebrow', label: __( 'Eyebrow label', 'grosharp' ) },
	{ name: 'heading', label: __( 'Heading', 'grosharp' ) },
	{ name: 'text',    label: __( 'Subtext', 'grosharp' ), type: 'textarea' },
	{ name: 'value1Title', label: __( 'Card 1 — Title', 'grosharp' ) },
	{ name: 'value1Desc',  label: __( 'Card 1 — Description', 'grosharp' ), type: 'textarea' },
	{ name: 'value2Title', label: __( 'Card 2 — Title', 'grosharp' ) },
	{ name: 'value2Desc',  label: __( 'Card 2 — Description', 'grosharp' ), type: 'textarea' },
	{ name: 'value3Title', label: __( 'Card 3 — Title', 'grosharp' ) },
	{ name: 'value3Desc',  label: __( 'Card 3 — Description', 'grosharp' ), type: 'textarea' },
];

export default function Edit( props ) {
	return <EditWithServerPreview { ...props } blockName={ metadata.name } fields={ fields } />;
}
