<?php
$id = '';
if (isset($_GET['id'])) {
 $id = $_GET['id'];
}

$wsdl = "http://egov.danang.gov.vn/cmon-app-portlet/services/TraCuuHoSoImplPort?wsdl";

$client = new SoapClient($wsdl);

$result = $client->getHoSoTTHCCongByMaSoBienNhan(array(
 "arg0" => $id
));

header("Content-type: application/json");
header("access-control-allow-origin: *");
echo json_encode($result);
?>
