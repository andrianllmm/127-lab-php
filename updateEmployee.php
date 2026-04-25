<?php
include 'DBConnector.php';

if (!isset($_POST['EmpID'])) {
    header("Location: index.php");
    exit();
}

// Collect inputs
$empID = intval($_POST['EmpID']);
$name = $conn->real_escape_string($_POST['name']);
$age = intval($_POST['age']);
$salary = floatval($_POST['salary']);
$percent_time = floatval($_POST['percent_time']);
$date_hired = $_POST['date_hired'];
$deptID = intval($_POST['department']);
$designation = intval($_POST['designation']); // 1 = Manager, 2 = Employee

// transaction for safety
$conn->begin_transaction();

try {

    // update employee table
    $sql1 = "
        UPDATE employee
        SET EmpName = '$name',
            Age = $age,
            Salary = $salary,
            HireDate = '$date_hired'
        WHERE EmpID = $empID
    ";
    $conn->query($sql1);

    // update work table (department + percent time)
    $sql2 = "
        UPDATE work
        SET DeptID = $deptID,
            Percent_Time = $percent_time
        WHERE EmpID = $empID
    ";
    $conn->query($sql2);

    // handle manager logic

    // remove this employee as manager from ANY department first
    $conn->query("UPDATE department SET MgrEmpID = 0 WHERE MgrEmpID = $empID");

    if ($designation == 1) {
        // set as manager of selected department
        $conn->query("
            UPDATE department
            SET MgrEmpID = $empID
            WHERE DeptID = $deptID
        ");
    }

    // commit all changes
    $conn->commit();

} catch (Exception $e) {
    $conn->rollback();
}

// close
$conn->close();

// redirect
header("Location: index.php");
exit();
?>
