<?php 

$data = array(
	array(
		'id' 	=> 1,
		'code'	=> 'A',
		'name'	=> 'A',
		'descr' => '',
	),
	array(
		'id' 	=> 2,
		'code'	=> 'B',
		'name'	=> 'B',
		'descr' => '',
	),
	array(
		'id' 	=> 3,
		'code'	=> 'AB',
		'name'	=> 'AB',
		'descr' => '',
	),
	array(
		'id' 	=> 4,
		'code'	=> 'O',
		'name'	=> 'O',
		'descr' => '',
	)
);
echo json_encode($data);