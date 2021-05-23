<?php
if ( function_exists( 'acf_add_local_field_group' ) ):

	acf_add_local_field_group( array(
		'key'                   => 'group_60a5b52b5fe1d',
		'title'                 => 'Gitpress Configuration',
		'fields'                => array(
			array(
				'key'               => 'field_60a5b540cc9ae',
				'label'             => 'Github / Gitlab username',
				'name'              => 'git_username',
				'type'              => 'text',
				'instructions'      => 'The username for github / gitlab',
				'required'          => 1,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'default_value'     => '',
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			),
			array(
				'key'               => 'field_60a5b564cc9af',
				'label'             => 'Github / Gitlab password ( use accesstoken if you enabled 2FA)',
				'name'              => 'git_password',
				'type'              => 'password',
				'instructions'      => 'Password for github or gitlab ( dont worry, this data is stored locally, no one can access it except you )',
				'required'          => 1,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
			),
			array(
				'key'               => 'field_60a5b5a1cc9b0',
				'label'             => 'Hosting Site',
				'name'              => 'hosting_site',
				'type'              => 'select',
				'instructions'      => 'The site where you want to host your site',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'choices'           => array(
					'github' => 'github',
					'gitlab' => 'gitlab',
				),
				'default_value'     => 'github',
				'allow_null'        => 0,
				'multiple'          => 0,
				'ui'                => 0,
				'return_format'     => 'value',
				'ajax'              => 0,
				'placeholder'       => '',
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'user_role',
					'operator' => '==',
					'value'    => 'administrator',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'high',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen'        => '',
		'active'                => true,
		'description'           => '',
	) );

endif;