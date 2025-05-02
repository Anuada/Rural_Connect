<?php

class DbHelper
{
    private $hostname = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $database = "rural_connect";
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

    public function fetchDeliveries($delivery_id = '')
    {
        $sql = "
            SELECT 
                deliveries.accountId,
                CONCAT_WS(' ', deliveries.fname, deliveries.lname) AS courier
            FROM deliveries
            INNER JOIN account ON account.accountId = deliveries.accountId
            WHERE account.account_status = 'Approved' AND deliveries.availability_status = 'Available'
        ";

        if (!empty(trim($delivery_id))) {
            $sql .= " AND deliveries.accountId = '$delivery_id'";
        }

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

    #region Delivery Feedback Related

    public function fetchStandardRequestDeliveryFeedback(string $delivery_id)
    {
        $sql = "SELECT
                med_deliveries_feedback.*,
                CONCAT_WS(' ', barangay_inc.fname, barangay_inc.lname) AS received_by
                FROM med_deliveries_feedback
                INNER JOIN med_deliveries ON med_deliveries_feedback.med_delivery_id = med_deliveries.id
                INNER JOIN request_med ON med_deliveries.request_med_id = request_med.id
                INNER JOIN barangay_inc ON request_med.barangay_inc_id = barangay_inc.accountId
                WHERE med_deliveries_feedback.med_delivery_id = '$delivery_id'";
        $query = $this->conn->query($sql);
        return $query->fetch_assoc();
    }

    public function fetchCustomizedRequestDeliveryFeedback(string $delivery_id)
    {
        $sql = "SELECT
                custom_med_deliveries_feedback.*,
                CONCAT_WS(' ', barangay_inc.fname, barangay_inc.lname) AS received_by

                FROM custom_med_deliveries_feedback

                INNER JOIN custom_med_deliveries ON custom_med_deliveries_feedback.med_delivery_id = custom_med_deliveries.id
                INNER JOIN custom_med_request ON custom_med_deliveries.custom_med_request_id = custom_med_request.id
                INNER JOIN barangay_inc ON custom_med_request.barangay_inc_id = barangay_inc.accountId

                WHERE custom_med_deliveries_feedback.med_delivery_id = '$delivery_id'";
        $query = $this->conn->query($sql);
        return $query->fetch_assoc();
    }

    #endregion

    public function isBarangayRegisteredAlready(string $barangay)
    {
        $sql = "SELECT barangay_inc.* FROM barangay_inc
            INNER JOIN account ON account.accountId = barangay_inc.accountId
            WHERE barangay_inc.barangay = '$barangay' AND account.account_status = 'Approved'";
        $query = $this->conn->query($sql);
        $result = $query->fetch_assoc();
        return !empty($result);
    }

    #region Delivery Related
    public function display_medicine_requests_to_deliver($id, $delivery_id)
    {
        $sql = "SELECT 
            med_deliveries.id,
            med_deliveries.request_med_id,
            med_deliveries.delivery_status,
            med_deliveries.date_of_supply,
            request_med.request_quantity AS requested_quantity,
            barangay_inc.barangay,
            CONCAT(barangay_inc.fname, ' ', barangay_inc.lname) AS barangay_incharge,
            barangay_inc.address,
            barangay_inc.contactNo,
            med_availability.med_image,
            med_availability.med_name,
            med_availability.category,
            med_availability.unit,
            med_availability.dosage_strength
        FROM med_deliveries
        INNER JOIN request_med ON med_deliveries.request_med_id = request_med.id
        INNER JOIN barangay_inc ON request_med.barangay_inc_id = barangay_inc.accountId
        INNER JOIN med_availability ON request_med.med_avail_Id = med_availability.id
        WHERE med_deliveries.deliveries_accountId = ?
          AND med_deliveries.id = ?
        ORDER BY med_deliveries.date_of_supply";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("SQL Error: " . $this->conn->error);
        }

        $stmt->bind_param("ss", $id, $delivery_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $record = $result->fetch_assoc();

        $stmt->close();

        return $record;
    }

    public function display_customized_medicine_requests_to_deliver($id, $delivery_id)
    {
        $sql = "SELECT 
            custom_med_deliveries.id,
            custom_med_deliveries.custom_med_request_id AS request_med_id,
            custom_med_deliveries.delivery_status,
            custom_med_deliveries.date_of_supply,
            barangay_inc.barangay,
            CONCAT(barangay_inc.fname, ' ', barangay_inc.lname) AS barangay_incharge,
            barangay_inc.address,
            barangay_inc.contactNo,
            custom_med_request.requested_quantity,
            custom_med_request.requested_medicine AS med_name,
            custom_med_request.category,
            custom_med_request.unit,
            custom_med_request.dosage_strength
        FROM custom_med_deliveries
        INNER JOIN custom_med_request ON custom_med_deliveries.custom_med_request_id = custom_med_request.id
        INNER JOIN barangay_inc ON custom_med_request.barangay_inc_id = barangay_inc.accountId
        WHERE custom_med_deliveries.delivery_account_id = ?
          AND custom_med_deliveries.id = ?
        ORDER BY custom_med_deliveries.date_of_supply";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("SQL Error: " . $this->conn->error);
        }

        $stmt->bind_param("ss", $id, $delivery_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $record = $result->fetch_assoc();

        $stmt->close();

        return $record;
    }

    public function display_all_medicine_requests_to_deliver($id, $limit, $offset, $isExluded = true)
    {
        $isNot = $isExluded ? "NOT" : "";
        $sql = "SELECT * FROM (
                    SELECT 
                        med_deliveries.id,
                        med_deliveries.request_med_id,
                        med_deliveries.delivery_status,
                        med_deliveries.date_of_supply,
                        med_deliveries.deliveries_accountId AS delivery_id,
                        request_med.request_quantity AS requested_quantity,
                        barangay_inc.barangay,
                        CONCAT(barangay_inc.fname, ' ', barangay_inc.lname) AS barangay_incharge,
                        barangay_inc.address,
                        barangay_inc.contactNo,
                        med_availability.med_image,
                        med_availability.med_name,
                        med_availability.category,
                        med_availability.unit,
                        med_availability.dosage_strength
                    FROM med_deliveries
                    INNER JOIN request_med ON med_deliveries.request_med_id = request_med.id
                    INNER JOIN barangay_inc ON request_med.barangay_inc_id = barangay_inc.accountId
                    INNER JOIN med_availability ON request_med.med_avail_Id = med_availability.id

                    UNION ALL

                    SELECT 
                        custom_med_deliveries.id,
                        custom_med_deliveries.custom_med_request_id AS request_med_id,
                        custom_med_deliveries.delivery_status,
                        custom_med_deliveries.date_of_supply,
                        custom_med_deliveries.delivery_account_id AS delivery_id,
                        custom_med_request.requested_quantity,
                        barangay_inc.barangay,
                        CONCAT(barangay_inc.fname, ' ', barangay_inc.lname) AS barangay_incharge,
                        barangay_inc.address,
                        barangay_inc.contactNo,
                        NULL AS med_image,
                        custom_med_request.requested_medicine AS med_name,
                        custom_med_request.category,
                        custom_med_request.unit,
                        custom_med_request.dosage_strength
                    FROM custom_med_deliveries
                    INNER JOIN custom_med_request ON custom_med_deliveries.custom_med_request_id = custom_med_request.id
                    INNER JOIN barangay_inc ON custom_med_request.barangay_inc_id = barangay_inc.accountId
                ) AS combined_results
                WHERE 
                    delivery_id = '$id' AND
                    delivery_status $isNot IN ('Returned', 'Claimed')
                LIMIT $limit OFFSET $offset
                ";
        $query = $this->conn->query($sql);
        $rows = [];
        while ($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    #endregion


    #region Track Delivery Status History Related

    public function display_track_delivery_details_on_barangay($delivery_id, $account_id = '')
    {
        $sql = "SELECT 
            med_deliveries.id,
            med_deliveries.request_med_id,
            med_deliveries.delivery_status,
            med_deliveries.date_of_supply,
            request_med.request_quantity AS requested_quantity,
            CONCAT(deliveries.fname, ' ', deliveries.lname) AS delivery,
            med_availability.med_image,
            med_availability.med_name,
            med_availability.category,
            med_availability.unit,
            med_availability.dosage_strength

            FROM med_deliveries

            INNER JOIN request_med ON med_deliveries.request_med_id = request_med.id
            INNER JOIN deliveries ON med_deliveries.deliveries_accountId = deliveries.accountId
            INNER JOIN barangay_inc ON request_med.barangay_inc_id = barangay_inc.accountId
            INNER JOIN med_availability ON request_med.med_avail_Id = med_availability.id

            WHERE med_deliveries.id = '$delivery_id'";

        if (!empty(trim($account_id))) {
            $sql .= " AND barangay_inc.accountId = '$account_id'";
        }

        $query = $this->conn->query($sql);
        return $query->fetch_assoc();
    }

    public function display_track_delivery_details_on_barangay_custom($delivery_id, $account_id = '')
    {
        $sql = "SELECT 
            custom_med_deliveries.id,
            custom_med_deliveries.custom_med_request_id AS request_med_id,
            custom_med_deliveries.delivery_status,
            custom_med_deliveries.date_of_supply,
            CONCAT(deliveries.fname, ' ', deliveries.lname) AS delivery,
            custom_med_request.requested_quantity,
            custom_med_request.requested_medicine AS med_name,
            custom_med_request.category,
            custom_med_request.unit,
            custom_med_request.dosage_strength

            FROM custom_med_deliveries

            INNER JOIN custom_med_request ON custom_med_deliveries.custom_med_request_id = custom_med_request.id
            INNER JOIN deliveries ON custom_med_deliveries.delivery_account_id = deliveries.accountId
            INNER JOIN barangay_inc ON custom_med_request.barangay_inc_id = barangay_inc.accountId

            WHERE custom_med_deliveries.id = '$delivery_id'";

        if (!empty(trim($account_id))) {
            $sql .= " AND barangay_inc.accountId = '$account_id'";
        }

        $query = $this->conn->query($sql);
        return $query->fetch_assoc();
    }

    public function display_track_delivery_status_on_barangay($delivery_id, $account_id)
    {
        $sql = "SELECT delivery_status_history.* FROM delivery_status_history
            INNER JOIN med_deliveries ON med_deliveries.id = delivery_status_history.delivery_id
            INNER JOIN request_med ON med_deliveries.request_med_id = request_med.id
            INNER JOIN barangay_inc ON request_med.barangay_inc_id = barangay_inc.accountId

            WHERE delivery_status_history.delivery_id = '$delivery_id' 
            AND barangay_inc.accountId = '$account_id'";

        $query = $this->conn->query($sql);
        $rows = [];
        while ($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function display_track_delivery_status_on_barangay_custom($delivery_id, $account_id)
    {
        $sql = "SELECT custom_med_delivery_status_history.* FROM custom_med_delivery_status_history
            INNER JOIN custom_med_deliveries ON custom_med_deliveries.id = custom_med_delivery_status_history.delivery_id
            INNER JOIN custom_med_request ON custom_med_deliveries.custom_med_request_id = custom_med_request.id
            INNER JOIN barangay_inc ON custom_med_request.barangay_inc_id = barangay_inc.accountId

            WHERE custom_med_delivery_status_history.delivery_id = '$delivery_id' 
            AND barangay_inc.accountId = '$account_id'";

        $query = $this->conn->query($sql);
        $rows = [];
        while ($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    #endregion

    // display supply Date
    public function display_barangay_inc_request_med($id, $limit, $offset)
    {
        $sql = " SELECT 
        request_med.id,
        request_med.request_quantity,
        request_med.requestStatus,
        request_med.document,
        med_availability.med_name,
        med_availability.brand_name,
        med_availability.category,
        med_availability.unit,
        med_availability.dosage_strength,
        med_availability.med_image,
        med_deliveries.id AS med_delivery_id,
        med_deliveries.date_of_supply,
        med_deliveries.delivery_status

        FROM request_med

        INNER JOIN barangay_inc ON request_med.barangay_inc_id = barangay_inc.accountId
        INNER JOIN med_availability ON request_med.med_avail_Id = med_availability.id
        LEFT JOIN med_deliveries ON request_med.id = med_deliveries.request_med_id

        WHERE barangay_inc.accountId = ?

        LIMIT ? OFFSET ?
        ";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("SQL Error: " . $this->conn->error);
        }

        $stmt->bind_param("sii", $id, $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        $records = [];

        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }

        $stmt->close();
        return $records;

    }

    public function display_barangay_inc_customized_med_request($id, $limit, $offset)
    {
        $sql = " SELECT        
        custom_med_request.id,
        custom_med_request.requested_quantity AS request_quantity,
        custom_med_request.request_status AS requestStatus,
        custom_med_request.requested_medicine AS med_name,
        custom_med_request.category,
        custom_med_request.unit,
        custom_med_request.dosage_strength,
        custom_med_request.document,
        custom_med_deliveries.id AS med_delivery_id,
        custom_med_deliveries.date_of_supply,
        custom_med_deliveries.delivery_status

        FROM custom_med_request

        INNER JOIN barangay_inc ON custom_med_request.barangay_inc_id = barangay_inc.accountId
        LEFT JOIN custom_med_deliveries ON custom_med_deliveries.custom_med_request_id = custom_med_request.id

        WHERE barangay_inc.accountId = ?

        LIMIT ? OFFSET ?
        ";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("SQL Error: " . $this->conn->error);
        }

        $stmt->bind_param("sii", $id, $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        $records = [];

        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }

        $stmt->close();
        return $records;

    }

    public function countRatings($num)
    {
        $sql = "SELECT COUNT(*) AS total_ratings FROM rate_and_feedback WHERE `rating` = $num";
        $query = $this->conn->query($sql);
        $total_rating = $query->fetch_assoc();
        return $total_rating["total_ratings"];
    }

    public function displayAllFeedbacks($rating = null)
    {
        $where = "";
        if ($rating !== null) {
            // Use prepared statements to prevent SQL injection
            $where = " WHERE rate_and_feedback.rating = " . intval($rating);
        }

        $sql = "SELECT account.username,
                rate_and_feedback.rating,
                rate_and_feedback.feedback
            FROM rate_and_feedback
            INNER JOIN account 
            ON rate_and_feedback.accountId = account.accountId"
            . $where .
            " ORDER BY rate_and_feedback.rating DESC";

        $query = $this->conn->query($sql);
        $rows = [];
        while ($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }


    // Display for Data Barangay Requested
    public function display_barangay_inc_requested($limit, $offset)
    {
        $sql = "SELECT 
            request_med.id,
            request_med.request_quantity,
            request_med.requestStatus AS status,
            request_med.document,
            med_availability.med_name,
            med_availability.brand_name,
            med_availability.med_image,
            med_availability.category,
            med_availability.unit,
            med_availability.dosage_strength,
            med_deliveries.id AS delivery_id,
            med_deliveries.date_of_supply,
            med_deliveries.delivery_status,
            barangay_inc.contactNo,
            barangay_inc.fname,
            barangay_inc.lname,
            barangay_inc.barangay,
            barangay_inc.address

            FROM request_med

            INNER JOIN barangay_inc ON request_med.barangay_inc_id = barangay_inc.accountId
            INNER JOIN med_availability ON request_med.med_avail_Id = med_availability.id
            LEFT JOIN med_deliveries ON med_deliveries.request_med_id = request_med.id

            ORDER BY 
            CASE 
                WHEN request_med.requestStatus = 'Pending' THEN 0 
                ELSE 1 
            END

            LIMIT $limit OFFSET $offset
        ";
        $query = $this->conn->query($sql);
        $rows = [];
        while ($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function display_barangay_inc_customized_requests($limit, $offset)
    {
        $sql = "SELECT 
            custom_med_request.id,
            custom_med_request.requested_quantity AS request_quantity,
            custom_med_request.request_status AS status,
            custom_med_request.document,
            custom_med_request.requested_medicine AS med_name,
            custom_med_request.category,
            custom_med_request.unit,
            custom_med_request.dosage_strength,
            custom_med_deliveries.id AS delivery_id,
            custom_med_deliveries.date_of_supply,
            custom_med_deliveries.delivery_status,
            barangay_inc.contactNo,
            barangay_inc.fname,
            barangay_inc.lname,
            barangay_inc.barangay,
            barangay_inc.address

            FROM custom_med_request

            INNER JOIN barangay_inc ON custom_med_request.barangay_inc_id = barangay_inc.accountId
            LEFT JOIN custom_med_deliveries ON custom_med_request.id = custom_med_deliveries.custom_med_request_id

            ORDER BY 
            CASE 
                WHEN custom_med_request.request_status = 'Pending' THEN 0 
                ELSE 1 
            END

            LIMIT $limit OFFSET $offset
        ";

        $query = $this->conn->query($sql);
        $rows = [];
        while ($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function display_details_for_receipt($id)
    {
        $sql = " SELECT subscription.id,
            barangay_inc.fname,
            barangay_inc.lname,
            account.email,
            barangay_inc.barangay,
            subscription.created_at,
            subscription.plan,
            subscription.start_date,
            subscription.end_date,
            subscription.amount
            FROM
            subscription
            JOIN barangay_inc ON barangay_inc.accountId = subscription.barangay_id
            JOIN account ON account.accountId = barangay_inc.accountId
            WHERE subscription.id = '$id'
        ";
        $query = $this->conn->query($sql);
        return $query->fetch_assoc();
    }

    public function display_all_subscriptions($limit, $offset)
    {

        $sql = "SELECT
                    subscription.id,
                    barangay_inc.barangay,
                    barangay_inc.fname,
                    barangay_inc.lname,
                    subscription.plan,
                    subscription.receipt,
                    subscription.approve_status,
                    subscription.cancel_note
                FROM subscription
                JOIN barangay_inc ON barangay_inc.accountId = subscription.barangay_id
                ORDER BY
                    CASE
                        WHEN subscription.approve_status = 'Pending' THEN 0
                        ELSE 1
                    END,
                    subscription.created_at DESC
                LIMIT ? OFFSET ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function display_all_accounts($table, $args, $limit, $offset)
    {
        $key_value_pair = [];
        foreach ($args as $key => $value) {
            $key_value_pair[] = "`$key` = '$value'";
        }
        $condition = implode(" AND ", $key_value_pair);
        $sql = "SELECT $table.*, account.email, account.username, account.created_at
            FROM $table
            JOIN account ON $table.accountId = account.accountId
            WHERE $condition
            ORDER BY account.created_at ASC
            LIMIT $limit OFFSET $offset";
        $query = $this->conn->query($sql);
        $rows = [];
        while ($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function count_all_records($table, $args = [], $special_arg = '')
    {
        $key_value_pair = [];
        if (!empty($args)) {
            foreach ($args as $key => $value) {
                $key_value_pair[] = "`$key` = '$value'";
            }
            $condition = implode(" AND ", $key_value_pair) . $special_arg;
        }

        $sql = !empty($args) ? "SELECT COUNT(*) as total FROM `$table` WHERE $condition"
            : "SELECT COUNT(*) as total FROM `$table`";
        $query = $this->conn->query($sql);
        $result = $query->fetch_assoc();
        return (int) $result['total'];
    }

    public function count_all_subscribers_per_plan($plan)
    {
        $sql = "SELECT COUNT(*) AS total FROM subscription 
                WHERE plan = '$plan' 
                AND approve_status = 'Approved'
                AND CURRENT_DATE() >= start_date AND CURRENT_DATE() <= end_date";
        $query = $this->conn->query($sql);
        $result = $query->fetch_assoc();
        return $result['total'];
    }

    public function total_earnings_this_month()
    {
        $sql = "SELECT DATE_FORMAT(CURRENT_DATE(), '%b %Y') AS month_year, COALESCE(SUM(amount),0) AS total_earnings
                FROM subscription 
                WHERE DATE_FORMAT(created_at,'%Y-%m') = DATE_FORMAT(CURRENT_DATE(), '%Y-%m')
                AND approve_status = 'Approved'";
        $query = $this->conn->query($sql);
        return $query->fetch_assoc();
    }

    public function total_rating()
    {
        $sql = "SELECT AVG(rating) AS total_rating FROM rate_and_feedback";
        $query = $this->conn->query($sql);
        $result = $query->fetch_assoc();
        return number_format($result['total_rating'], 2);
    }

    public function get_month_year()
    {
        $sql = "SELECT DATE_FORMAT(CURRENT_DATE(), '%b %Y') AS month_year";
        $query = $this->conn->query($sql);
        $result = $query->fetch_assoc();
        return $result['month_year'];
    }
}