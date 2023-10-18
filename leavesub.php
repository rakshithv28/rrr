<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeName = $_POST["employeeName"];
    $leaveType = $_POST["leaveType"];
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];

    $leaveRequestData = "Employee Name: $employeeName\nLeave Type: $leaveType\nStart Date: $startDate\nEnd Date: $endDate\n\n";

    $filePath = "leave_requests.txt";

    if ($file = fopen($filePath, "a")) {
        fwrite($file, $leaveRequestData);
        fclose($file);
        echo "Leave request submitted successfully!";
    } else {
        echo "Failed to submit leave request. Please try again.";
    }
} else {
    header("Location: leave_form.html");
    exit();
}
?>