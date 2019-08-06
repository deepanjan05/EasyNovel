<?php
	header('Content-Type: application/json');
	require "simple_html_dom.php";
	
	$values = array();
	$status = 0;
	$ret = array();

	$html = file_get_html('http://readfreenovelsonline.com/');

	//echo 'https://www.calculator.net/currency-calculator.html?eamount='. $amount .'&efrom='. $from .'&eto='. $to .'&ccmajorccsettingbox=1&type=1&x=1&y=1';

	// Scrape and send a JSON reply
	foreach($html->find('div.block') as $big){ 
		foreach($big->find('li a') as $element) 
    	{
    		$arr = array();
        	$arr['name'] = $element->plaintext;
        	$arr['link'] = urlencode($element->href);
			$values[]=  $arr;
    	}
	}

	if (sizeof($values)==0) {
		$status = 501;
		$msg = "Could not fetch data";
	} else {
		$status = 200;
		$msg = "Ok";
	}

	if ($status==200) {
		$ret['genres'] = $values;
	}
	$ret['status'] = $msg;
	
	echo json_encode($ret, JSON_PRETTY_PRINT);
?>
