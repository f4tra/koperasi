<select>
<?php
	$uri = file_get_contents("http://localhost/auf_pmt/json_data.php?type=traditional");
		$data = json_decode($uri);
		
		foreach($data as $key => $value){
			echo "<option value='".$value->id."'>".$value->name."</option>";
		}?>
</select>