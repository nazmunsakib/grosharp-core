import { __ } from '@wordpress/i18n';
import EditWithServerPreview from '../shared/EditWithServerPreview';
import metadata from './block.json';

const fields = [
	{ name: 'eyebrow',       label: __( 'Eyebrow label', 'grosharp' ) },
	{ name: 'heading',       label: __( 'Heading (dark part)', 'grosharp' ) },
	{ name: 'headingAccent', label: __( 'Heading accent (muted part)', 'grosharp' ) },
	{ name: 'text',          label: __( 'Subtext', 'grosharp' ), type: 'textarea' },
	{
		name:    'image1Url',
		label:   __( 'Image 1 (or single full-width image)', 'grosharp' ),
		type:    'media',
		idName:  'image1Id',
		altName: 'image1Alt',
	},
	{
		name:    'image2Url',
		label:   __( 'Image 2 (leave empty for single full-width)', 'grosharp' ),
		type:    'media',
		idName:  'image2Id',
		altName: 'image2Alt',
	},
];

export default function Edit( props ) {
	return <EditWithServerPreview { ...props } blockName={ metadata.name } fields={ fields } />;
}
