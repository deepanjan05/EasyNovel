<?php
	require_once "api/simple_html_dom.php";
	
	$values1 = array();
	$status1 = 0;
	$res = array();

	$html1 = file_get_html('http://readfreenovelsonline.com/');

	//echo 'https://www.calculator.net/currency-calculator.html?eamount='. $amount .'&efrom='. $from .'&eto='. $to .'&ccmajorccsettingbox=1&type=1&x=1&y=1';

	// Scrape and send a JSON reply
	foreach($html1->find('div.block') as $big1){ 
		foreach($big1->find('li a') as $element1) 
    	{
    		$arr1 = array();
        	$arr1['name'] = $element1->plaintext;
        	$arr1['link'] = urlencode($element1->href);
			$values1[]=  $arr1;
    	}
	}

	if (sizeof($values1)==0) {
		$status1 = 501;
		$msg1 = "Could not fetch data";
	} else {
		$status1 = 200;
		$msg1 = "Ok";
	}

	if ($status1==200) {
		$res['genres'] = $values1;
	}
	$res['status1'] = $msg1;
	
?>
