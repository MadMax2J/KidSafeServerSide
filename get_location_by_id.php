<?php
/**
 * get_location_by_id.php
 * Created by PhpStorm.
 * User: jbyrne
 * Date: 02/03/2015
 * Time: 16:07
 */

/**
 * Following code will get single location
 * A location is identified by its 'id'
 */

// array for JSON response
$response = array();

// include db connect class
//require_once __DIR__ . '/db_connect.php';
require_once 'db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// check for post data
if (isset($_GET["id"])) {
    $id = $_GET['id'];

    // get a location from locations table
    $result = mysql_query("SELECT * FROM locations WHERE id = $id");

    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {

            $result = mysql_fetch_assoc($result);
            //just changed this from mysql_fetch_array($result)


            $location = array();
            $location["id"] = $result["id"];
            $location["phone_id"] = $result["phone_id"];
            $location["phone_lat"] = $result["phone_lat"];
            $location["phone_lng"] = $result["phone_lng"];
            $location["received_at"] = $result["received_at"];
            // success
            $response["success"] = 1;

            // user node
            $response["location"] = array();

            array_push($response["location"], $location);

            // echoing JSON response
            echo json_encode($response);
        } else {
            // no location found
            $response["success"] = 0;
            $response["message"] = "No location data found";

            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no location found
        $response["success"] = 0;
        $response["message"] = "No location data found";

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
<html>
<body>
<br>
<br>
<a href="http://www.000webhost.com/" target="_blank"><img src="http://www.000webhost.com/images/120x60_powered.gif" alt="Web Hosting" width="120" height="60" border="0" /></a>
</body>

</html>