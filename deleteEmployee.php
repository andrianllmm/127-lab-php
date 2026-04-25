<?php
include 'DBConnector.php';

if (isset($_POST['EmpID'])) {
    $empID = intval($_POST['EmpID']);

    // delete from work first (to avoid FK issues)
    $conn->query("DELETE FROM work WHERE EmpID = $empID");

    // if employee is a manager, remove manager reference
    $conn->query("UPDATE department SET MgrEmpID = 0 WHERE MgrEmpID = $empID");

    // delete employee
    $conn->query("DELETE FROM employee WHERE EmpID = $empID");
}

$conn->close();

// redirect back
header("Location: index.php");
exit();
?>
