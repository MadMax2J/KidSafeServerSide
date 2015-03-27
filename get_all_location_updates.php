<?php
/**
 * get_all_location_updates.php
 * Created by PhpStorm.
 * User: jbyrne
 * Date: 02/03/2015
 * Time: 16:07
 */

/**
 * Following code will list all the locations
 */

// array for JSON response
$response = array();

// include db connect class
//require_once __DIR__ . '/db_connect.php';
require_once 'db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// get all products from locations table
$result = mysql_query("SELECT * FROM locations") or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    $response["locations"] = array();

    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $location = array();
        $location["id"] = $row["id"];
        $location["phone_id"] = $row["phone_id"];
        $location["phone_lat"] = $row["phone_lat"];
        $location["phone_lng"] = $row["phone_lng"];
        $location["received_at"] = $row["received_at"];

        // push single location into final response array
        array_push($response["locations"], $location);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no location found
    $response["success"] = 0;
    $response["message"] = "No locations found";

    // echo no users JSON
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
