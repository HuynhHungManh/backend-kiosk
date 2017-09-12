<?php
include('selector.inc');
$html = file_get_contents('http://cchc.danang.gov.vn/index.php?option=com_mucdohailong&controller=danhgiacongchuc&task=loadCanbo&format=raw&coquan=150945');
$arr = select_elements('#tasks .li_canbo img', $html);

$data = array();

foreach ($arr as $key => $value) {
    $to_encode = array('name' => select_elements('#tasks .li_canbo .lbl:nth-child(1)', $html)[$key]["text"],
      'dOB' => select_elements('#tasks .li_canbo .lbl:nth-child(2)', $html)[$key]["text"],
      'image' => $value["attributes"]["src"],
      'level' => select_elements('#tasks .li_canbo .lbl:nth-child(3)', $html)[$key]["text"],
      'position' => select_elements('#tasks .li_canbo .lbl:nth-child(4)', $html)[$key]["text"],
    );
    array_push($data,$to_encode);
}
echo json_encode($data);
?>
