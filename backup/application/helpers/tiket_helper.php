<?php
function getTicket($min=100,$max=999,$count=20,$margin=0) 
	{
    $range = range(0,$max-$min);
    $return = array();
    for( $i=0; $i<$count; $i++) 
		{
        if( !$range) 
		{
            trigger_error("Not enough numbers to pick from!",E_USER_WARNING);
            return $return;
        }
        $next = rand(0,count($range)-1);
        $return[] = $range[$next]+$min;
        array_splice($range,max(0,$next-$margin),$margin*2+1);
    }
    return $return;
}
function tiketone(){
	$min = 100;
	$max = 999;
	$margin = 0;
	$range = range(0,$max-$min);
    $return = array();
    //for( $i=0; $i<$count; $i++) 
		/* {
        if( !$range) 
		{
            trigger_error("Not enough numbers to pick from!",E_USER_WARNING);
            return $return;
        } */
        $next = rand(0,count($range)-1);
        $return[] = $range[$next]+$min;
        array_splice($range,max(0,$next-$margin),$margin*2+1);
    //}
    return $return;
}
?>