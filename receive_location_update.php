<?php
/**
 * receive_location_update.php
 * Created by PhpStorm.
 * User: jbyrne
 * Date: 02/03/2015
 * Time: 15:58
 */

/**
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['phone_id']) && isset($_POST['phone_lat']) && isset($_POST['phone_lng'])) {

    $phone_id = $_POST['phone_id'];
    $phone_lat = $_POST['phone_lat'];
    $phone_lng = $_POST['phone_lng'];

    // include db connect class
    //require_once __DIR__ . '/db_connect.php';
    require_once 'db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

    // mysql inserting a new row
    $result = mysql_query("INSERT INTO locations(phone_id, phone_lat, phone_lng) VALUES('$phone_id', '$phone_lat', '$phone_lng')");

    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Location successfully updated.";

        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";

        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>