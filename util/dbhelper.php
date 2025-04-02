<?php

class DbHelper
{
    private $hostname = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $database = "med_deliveries";
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->database);
    }

    public function __destruct()
    {
        $this->conn->close();
    }

    # Fetch one or more records
    public function fetchRecords($table, $args = null)
    {
        if ($args != null) {
            $key = array_keys($args);
            $value = array_values($args);
            $condition = $this->condition($key, $value, "0", " AND ");
            $sql = "SELECT * FROM `$table` WHERE $condition";
        } else {
            $sql = "SELECT * FROM `$table`";
        }
        $query = $this->conn->query($sql);
        $rows = [];
        while ($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getRecord($table, $args)
    {
        $keys = array_keys($args);
        $values = array_values($args);
        $condition = [];
        for ($i = 0; $i < count($keys); $i++) {
            $condition[] = "`" . $keys[$i] . "` = '" . $values[$i] . "'";
        }
        $cond = implode(" AND ", $condition);
        $sql = "SELECT * FROM `$table` WHERE $cond";
        $query = $this->conn->query($sql);
        $row = $query->fetch_assoc();
        return $row;
    }

    #Delete record/s


    public function deleteRecord($table, $args)
    {
        $key = array_keys($args);
        $value = array_values($args);
        $condition = $this->condition($key, $value, "0", " AND ");
        $sql = "DELETE FROM `$table` WHERE $condition";
        $this->conn->query($sql);
        return $this->conn->affected_rows;
    }

    #Add record/s
    public function addRecord($table, $args)
    {
        $key = array_keys($args);
        $value = array_values($args);
        $keys = implode("`, `", $key);
        $values = implode("', '", $value);
        $sql = "INSERT INTO `$table` (`$keys`) VALUES ('$values')";
        $this->conn->query($sql);
        return $this->conn->affected_rows;
    }

    #Update record/s
    public function updateRecord($table, $args)
    {
        $key = array_keys($args);
        $value = array_values($args);
        $set = $this->condition($key, $value, "1", ", ");
        $sql = "UPDATE `$table` SET $set WHERE `$key[0]` = '$value[0]'";
        $this->conn->query($sql);
        return $this->conn->affected_rows;
    }

    public function getCurrentYear()
    {
        $sql = "SELECT CURRENT_DATE AS `currentDate`";
        $query = $this->conn->query($sql);
        $date = $query->fetch_assoc();
        $year = date("Y", strtotime($date["currentDate"]));
        return $year;
    }

    private function condition($key, $value, $index, $implode)
    {
        $condition = [];
        for ($i = $index; $i < count($key); $i++) {
            $condition[] = "`" . $key[$i] . "` = '" . $value[$i] . "'";
            $cond = implode($implode, $condition);
        }
        return $cond;
    }

    public function executeQuery($sql, $params)
    {
        if ($stmt = $this->conn->prepare($sql)) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);

            if ($stmt->execute()) {
                return true;
            } else {

                echo "Error executing query: " . $stmt->error;
                return false;
            }
        } else {
            echo "Error preparing query: " . $this->conn->error;
            return false;
        }
    }
    // This Query for the status
    public function fetchData($id)
    {
        $sql = "
    SELECT 
        barangay_inc.accountId,
        barangay_inc.fname,
        barangay_inc.lname,
        barangay_inc.address,
        barangay_inc.contactNo,
        barangay_inc.id_verification,
        med_availabilty.med_name,
        med_availabilty.med_description,
        med_availabilty.quantity,
        med_availabilty.expiry_date,
        med_availabilty.DosageForm,
        med_availabilty.DosageStrength,
        med_availabilty.category,
        med_availabilty.city_health_id,
        request_med.request_quantity,
        request_med.request_category,
        request_med.request_DosageForm,
        request_med.request_DosageStrength,
        request_med.id,
        request_med.requestStatus,
        request_med.delivery_date
    FROM 
        request_med
    LEFT JOIN 
        med_availabilty ON request_med.med_avail_Id = med_availabilty.id
    LEFT JOIN 
        barangay_inc ON request_med.barangay_inc_id = barangay_inc.accountId
    WHERE  
        request_med.city_health_id = ?
    ";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("SQL Error: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $records = [];

        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }

        $stmt->close(); // Close the statement after use
        return $records;
    }
    // Display Dashboard for requested in Barangay inc
    public function barangayRequested_med($id)
    {
        $sql = "
    SELECT 
        barangay_inc.accountId,
        barangay_inc.fname,
        barangay_inc.lname,
        barangay_inc.address,
        barangay_inc.contactNo,
        barangay_inc.id_verification,
        med_availabilty.med_name,
        med_availabilty.med_description,
        med_availabilty.quantity,
        med_availabilty.expiry_date,
        med_availabilty.DosageForm,
        med_availabilty.DosageStrength,
        med_availabilty.category,
        med_availabilty.city_health_id,
        request_med.request_quantity,
        request_med.request_category,
        request_med.request_DosageForm,
        request_med.request_DosageStrength,
        request_med.id,
        request_med.requestStatus,
        request_med.delivery_date
    FROM 
        request_med
    LEFT JOIN 
        med_availabilty ON request_med.med_avail_Id = med_availabilty.id
    LEFT JOIN 
        barangay_inc ON request_med.barangay_inc_id = barangay_inc.accountId
    WHERE  
        request_med.barangay_inc_id = ?
    ";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("SQL Error: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $records = [];

        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }

        $stmt->close(); // Close the statement after use
        return $records;
    }

    // count for pending

    public function countPending()
    {
        $sql = "
    SELECT COUNT(*) AS pending_requests
    FROM request_med
    WHERE requestStatus = 'pending';
    ";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("SQL Error: " . $this->conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc(); // Fetch the single row result

        $stmt->close(); // Close the statement after use

        return $row ? $row['pending_requests'] : 0; // Return the count directly
    }

    // count for Accempted 

    public function countAccempted()
    {
        $sql = "
    SELECT COUNT(*) AS Accepted_requests
    FROM request_med
    WHERE requestStatus = 'Accepted';
    ";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("SQL Error: " . $this->conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc(); // Fetch the single row result

        $stmt->close(); // Close the statement after use

        return $row ? $row['Accepted_requests'] : 0; // Return the count directly
    }

    // Count for cancelled

    public function countCancelled()
    {
        $sql = "
    SELECT COUNT(*) AS cancelled_requests
    FROM request_med
    WHERE requestStatus = 'Cancelled';
    ";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("SQL Error: " . $this->conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc(); // Fetch the single row result

        $stmt->close(); // Close the statement after use

        return $row ? $row['cancelled_requests'] : 0; // Return the count directly
    }

    public function fetchDeliveries()
    {
        $sql = "
    SELECT 
        deliveries.accountId,
        deliveries.fname,
        deliveries.lname
    FROM deliveries";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("SQL Error: " . $this->conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $records = $result->fetch_all(MYSQLI_ASSOC); // Fetch all records as an associative array

        $stmt->close(); // Close the statement after use
        return $records;
    }

    // Fetch Data for Deliveries

    public function DisplayMed_to_Delivery($id)
    {
        $sql = "
    SELECT 
request_med.id,
request_med.request_quantity,
request_med.request_category,
request_med.request_DosageForm,
request_med.request_DosageStrength,
barangay_inc.fname,
barangay_inc.lname,
barangay_inc.address,
barangay_inc.contactNo,
med_availabilty.med_name,
med_deliveries.date_of_supply

FROM med_deliveries

LEFT JOIN 
	request_med ON med_deliveries.request_med_id = request_med.id
 LEFT JOIN
	barangay_inc ON request_med.barangay_inc_id = request_med.barangay_inc_id
 LEFT JOIN 
 	med_availabilty ON med_availabilty.id = request_med.med_avail_Id
 
 
     WHERE med_deliveries.deliveries_accountId = ?;
    

    ";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("SQL Error: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $records = [];

        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }

        $stmt->close(); // Close the statement after use
        return $records;
    }

// display supply Date

public function Display_barangay_inc_req($id)
{
    $sql = "
    SELECT 
request_med.id,
request_med.request_quantity,
request_med.request_category,
request_med.request_DosageForm,
request_med.request_DosageStrength,
request_med.requestStatus,
barangay_inc.address,
barangay_inc.contactNo,
med_availabilty.med_name,
med_availabilty.med_description,
med_deliveries.date_of_supply,
city_health.contactNo,
city_health.fname,
city_health.lname

FROM med_deliveries

LEFT JOIN 
	request_med ON med_deliveries.request_med_id = request_med.id
 LEFT JOIN
	barangay_inc ON request_med.barangay_inc_id = request_med.barangay_inc_id
 LEFT JOIN 
 	med_availabilty ON med_availabilty.id = request_med.med_avail_Id
 LEFT JOIN 
 	city_health ON request_med.city_health_id = request_med.city_health_id
 
     WHERE barangay_inc.accountId = ?;
    
    ";

    $stmt = $this->conn->prepare($sql);
    if (!$stmt) {
        die("SQL Error: " . $this->conn->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $records = [];

    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }

    $stmt->close(); // Close the statement after use
    return $records;

}
}
