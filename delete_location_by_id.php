<?php
/**
 * delete_location_by_id.php
 * Created by PhpStorm.
 * User: jbyrne
 * Date: 02/03/2015
 * Time: 16:28
 */

/*
 * Following code will delete a location from table
 * A location is identified by its 'id'
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // include db connect class
    //require_once __DIR__ . '/db_connect.php';
    require_once 'db_connect.php';
    // connecting to db
    $db = new DB_CONNECT();

    // mysql update row with matched pid
    $result = mysql_query("DELETE FROM locations WHERE id = $id");

    // check if row deleted or not
    if (mysql_affected_rows() > 0) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Location successfully deleted";

        // echoing JSON response
        echo json_encode($response);
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No location found";

        // echo no users JSON
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