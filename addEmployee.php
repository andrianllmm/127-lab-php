<?php

include 'DBConnector.php';

$name = $conn->real_escape_string($_GET["name"]);
$age = intval($_GET["age"]);
$salary = floatval($_GET["salary"]);
$HireDate = $_GET["date_hired"];
$DeptID = intval($_GET["department"]);
$Percent_Time = floatval($_GET["percent_time"]);
$designation = intval($_GET["designation"]); // 1 = Manager, 2 = Employee

$conn->begin_transaction();

try {

    // insert employee
    $sql = "
        INSERT INTO employee (EmpName, Age, Salary, HireDate)
        VALUES ('$name', $age, $salary, '$HireDate')
    ";
    $conn->query($sql);

    $empID = $conn->insert_id;

    // insert work relation
    $conn->query("
        INSERT INTO work (EmpID, DeptID, Percent_Time)
        VALUES ($empID, $DeptID, $Percent_Time)
    ");

    // ensure employee is not set as manager anywhere else
    $conn->query("UPDATE department SET MgrEmpID = 0 WHERE MgrEmpID = $empID");

    // if manager, assign to department
    if ($designation == 1) {
        $conn->query("
            UPDATE department
            SET MgrEmpID = $empID
            WHERE DeptID = $DeptID
        ");
    }

    $conn->commit();

    header("Location: employees.php");
    exit();

} catch (Exception $e) {
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

$conn->close();

?>
