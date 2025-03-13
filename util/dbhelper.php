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

    public function executeQuery($sql, $params) {
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

    public function fetchData()
{
    $sql = "
        SELECT 
            students.accountId,
            students.fname,
            students.lname,
            students.profileImage,
            GROUP_CONCAT(uploads.file_path SEPARATOR ', ') AS file_paths,
            GROUP_CONCAT(uploads.name SEPARATOR ', ') AS file_names
        FROM 
            uploads
        JOIN 
            students ON uploads.students_Id = students.accountId
        GROUP BY 
            students.accountId, students.fname, students.lname, students.profileImage
    ";

    $query = $this->conn->query($sql);
    $records = array();

    while ($row = $query->fetch_assoc()) { // Use fetch_assoc to return associative arrays
        $records[] = $row;
    }

    return $records;
}


}   