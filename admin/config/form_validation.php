<?php
$config = array(
	'user' => array(
		array(
			'field' => 'name',
			'label' => 'name',
			'rules' => 'trim|required|max_length[50]|xss_clean'
		),
		array(
			'field' => 'email',
			'label' => 'email',
			'rules' => 'trim|required|max_length[100]|valid_email|xss_clean'
		),
		array(
			'field' => 'username',
			'label' => 'username',
			'rules' => 'trim|required|max_length[50]|xss_clean'
		),
		array(
			'field' => 'password',
			'label' => 'password',
			'rules' => 'trim|required|min_length[8]|max_length[50]|md5|xss_clean'
		)
	)
);