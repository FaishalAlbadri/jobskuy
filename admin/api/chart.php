<?php
require_once ("../../config/config.php");

$response = array();

$result = mysqli_query($con, "SELECT SUM(bid.bid_price) 'count', bid.bid_create 'date' FROM bid WHERE bid.bid_status = 'Finished' AND YEAR(bid.bid_create) = YEAR(CURRENT_DATE) GROUP BY MONTH(bid.bid_create)");
foreach ($result as $key){
    $data = array();
    $data['count'] = $key['count'];
    $data['date'] = $key['date'];
    array_push($response, $data);
}
echo json_encode($response);
?>
