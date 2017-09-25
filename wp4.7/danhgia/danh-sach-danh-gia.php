<?php
include('selector.inc');
$html = file_get_contents('http://tthc.danang.gov.vn/index.php?option=com_thutuchanhchinh&task=thutucdetailfromdb&view=thutuc&id_hethong=21460');
$arr = select_elements('#div_thutuc', $html);

// $data = array();
// $html = preg_replace(
//     '(<h([1-6])>(.*?)</h\1>)e',
//     '"<h$1>" . strtoupper("$2") . "</h$1>"',
//     $html
// );
var_dump($arr[0]["text"]); //Match!
// var_dump($arr);
?>
