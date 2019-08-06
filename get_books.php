<?php
	// require "/api/simple_html_dom.php";
	
	// $values = array();
	// $status = 0;
	// $ret = array();

	// $html = file_get_html('http://readfreenovelsonline.com'. urldecode($_GET['genre']));

	// //echo 'https://www.calculator.net/currency-calculator.html?eamount='. $amount .'&efrom='. $from .'&eto='. $to .'&ccmajorccsettingbox=1&type=1&x=1&y=1';

	// while(true){

	// 	if(empty($html->find('div h2 a'))){
	// 		break;
	// 	}

	// 	// Scrape and send a JSON reply
	// 	foreach($html->find('div h2 a') as $element) 
	//     {
 //    		$arr = array();
 //    	    $arr['name'] = $element->plaintext;
 //       		$arr['link'] = urlencode($element->href);
	// 		$values[]=  $arr;
 //    	}
	
 //    	$html = file_get_html('http://readfreenovelsonline.com'. urldecode($_GET['genre']) .'_'. count($values));
		
	// }

	// if (sizeof($values)==0) {
	// 	$status = 501;
	// 	$msg = "Could not fetch data";
	// } else {
	// 	$status = 200;
	// 	$msg = "Ok";
	// }

	// if ($status==200) {
	// 	$ret['books'] = $values;
	// }
	// $ret['status'] = $msg;

	require_once "api/simple_html_dom.php";
	
	$values = array();
	$status = 0;
	$ret = array();

	$html = file_get_html('http://readfreenovelsonline.com'. urldecode($genre));

	//echo 'https://www.calculator.net/currency-calculator.html?eamount='. $amount .'&efrom='. $from .'&eto='. $to .'&ccmajorccsettingbox=1&type=1&x=1&y=1';

	while(true){

		if(empty($html->find('div h2 a'))){
			break;
		}

		// Scrape and send a JSON reply
		foreach($html->find('div h2 a') as $element) 
	    {
    		$arr = array();
    	    $arr['name'] = $element->plaintext;
       		$arr['link'] = urlencode($element->href);
			$values[]=$arr;
    	}
	
    	$html = file_get_html('http://readfreenovelsonline.com'. urldecode($genre) .'_'. count($values));
		
	}

	if (sizeof($values)==0) {
		$status = 501;
		$msg = "Could not fetch data";
	} else {
		$status = 200;
		$msg = "Ok";
	}

	if ($status==200) {
		$ret['books'] = $values;
	}
	$ret['status'] = $msg;

?>
