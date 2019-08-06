<?php
	require "api/simple_html_dom.php";
	require "fpdf/WriteHTML.php";
	
	function convert($str)
	{
		$str = str_replace("&ldquo;","\"",$str);
		$str = str_replace("&rdquo;","\"",$str);
		$str = str_replace("&lsquo;","'",$str);
		$str = str_replace("&rsquo;","'",$str);

		return $str;
	}

	$values = array();
	$status = 0;
	$ret = array();

	$html = file_get_html('http://readfreenovelsonline.com'. urldecode($_GET['link']));

	//echo 'http://readfreenovelsonline.com'. urldecode($_GET['link']);

	//echo 'https://www.calculator.net/currency-calculator.html?eamount='. $amount .'&efrom='. $from .'&eto='. $to .'&ccmajorccsettingbox=1&type=1&x=1&y=1';

	$pdf = new PDF_HTML();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->WriteHTML("<center>". $_GET['name'] ."</center>");

	$book_data = "";
	// Scrape and send a JSON reply
	foreach($html->find('div.detail ul') as $big) 
	{
		foreach ($big->find('li a') as $element) {
    		$html2 = file_get_html('http://readfreenovelsonline.com'. $element->href);
    		//echo 'http://readfreenovelsonline.com'. $element->href . "<br>";
			foreach ($html2->find('p') as $para) {
				$book_data.="<br>".html_entity_decode($para->plaintext);
			}
		}
    }

	$book_data = convert($book_data);

	if ($book_data=="") {
		$status = 501;
		$msg = "Could not fetch data";
	} else {
		$pdf->AddPage();
		$pdf->SetFont('');
		$pdf->SetFont('Arial','',12);
		$pdf->WriteHTML($book_data);
		$pdf->Output();
		$status = 200;
		$msg = "Ok";
	}

	if ($status==200) {
		$ret['book'] = $book_data;
	}
	$ret['status'] = $msg;

	echo json_encode($ret);
?>
