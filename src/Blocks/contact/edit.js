import { __ } from '@wordpress/i18n';
import EditWithServerPreview from '../shared/EditWithServerPreview';
import metadata from './block.json';

const fields = [
	{ name: 'eyebrow',        label: __( 'Eyebrow',           'grosharp' ) },
	{ name: 'heading',        label: __( 'Heading',            'grosharp' ) },
	{ name: 'text',           label: __( 'Text',               'grosharp' ), type: 'textarea' },
	{ name: 'badge',          label: __( 'Response badge',     'grosharp' ) },
	{ name: 'whatsappLabel',  label: __( 'WhatsApp — label',   'grosharp' ) },
	{ name: 'whatsappUrl',    label: __( 'WhatsApp — URL',     'grosharp' ) },
	{ name: 'emailLabel',     label: __( 'Email — label',      'grosharp' ) },
	{ name: 'emailUrl',       label: __( 'Email — URL',        'grosharp' ) },
	{ name: 'linkedinLabel',  label: __( 'LinkedIn — label',   'grosharp' ) },
	{ name: 'linkedinUrl',    label: __( 'LinkedIn — URL',     'grosharp' ) },
	{ name: 'instagramLabel', label: __( 'Instagram — label',  'grosharp' ) },
	{ name: 'instagramUrl',   label: __( 'Instagram — URL',    'grosharp' ) },
	{ name: 'xLabel',         label: __( 'X — label',          'grosharp' ) },
	{ name: 'xUrl',           label: __( 'X — URL',            'grosharp' ) },
	{ name: 'dribbbleLabel',  label: __( 'Dribbble — label',   'grosharp' ) },
	{ name: 'dribbbleUrl',    label: __( 'Dribbble — URL',     'grosharp' ) },
];

export default function Edit( props ) {
	return <EditWithServerPreview { ...props } blockName={ metadata.name } fields={ fields } />;
}
