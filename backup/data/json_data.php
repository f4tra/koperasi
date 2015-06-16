<?php

$parsing =  $_GET['type'];

switch($parsing){
	case 'blood_type':
		include 'blood_type.php';
	break;
	case 'language':
		include 'language.json';
	break;
	case 'traditional':
		include 'traditional.php';
	break;
	case 'marital_status':
		include 'marital_status.php';
	break;
	case 'country':
		include 'country.php';
	break;
	case 'education_type':
		include 'education_type.json';
	break;
	case 'currency':
		include 'currency.json';	
	break;
	case 'uom':
		include 'uom.php';	
	break;
	case 'province':
		include 'province.json';			
	break;
	case 'district':
		include 'district.json';			
	break;
	default:
		echo "Not Method";
	break;
}