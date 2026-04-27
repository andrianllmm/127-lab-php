<?php

include 'DBConnector.php';

if (!isset($_POST['EmpID'])) {
    header("Location: index.php");
    exit();
}

$empID = intval($_POST['EmpID']);

// get employee + work + department
$sql = "
    SELECT e.*, w.Percent_Time, d.DeptID, d.MgrEmpID
    FROM employee e
    JOIN work w ON e.EmpID = w.EmpID
    JOIN department d ON w.DeptID = d.DeptID
    WHERE e.EmpID = $empID
";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Determine designation
$designation = ($row['MgrEmpID'] == $row['EmpID']) ? 1 : 2;
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Calibri; }
        td.tlabel {
            width: 120px;
            text-align: right;
            padding-right: 10px;
        }
    </style>
</head>
<body>

<h1>Edit Employee</h1>

<form action="updateEmployee.php" method="post">
    <input type="hidden" name="EmpID" value="<?php echo $row['EmpID']; ?>">

    <table>

        <tr>
            <td class="tlabel">Name</td>
            <td><input type="text" name="name" value="<?php echo $row['EmpName']; ?>"></td>
        </tr>

        <tr>
            <td class="tlabel">Age</td>
            <td><input type="number" name="age" value="<?php echo $row['Age']; ?>"></td>
        </tr>

        <tr>
            <td class="tlabel">Salary</td>
            <td><input type="number" step="0.01" name="salary" value="<?php echo $row['Salary']; ?>"></td>
        </tr>

        <tr>
            <td class="tlabel">Percent Time</td>
            <td><input type="text" name="percent_time" value="<?php echo $row['Percent_Time']; ?>"></td>
        </tr>

        <tr>
            <td class="tlabel">Date Hired</td>
            <td><input type="date" name="date_hired" value="<?php echo $row['HireDate']; ?>"></td>
        </tr>

        <tr>
            <td class="tlabel">Department</td>
            <td>
                <select name="department">
                    <?php
                    $deptResult = $conn->query("SELECT * FROM department");
                    while ($dept = $deptResult->fetch_assoc()) {
                        $selected = ($dept['DeptID'] == $row['DeptID']) ? "selected" : "";
                        echo "<option value='{$dept['DeptID']}' $selected>{$dept['DeptName']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>

        <tr>
            <td class="tlabel">Designation</td>
            <td>
                <input type="radio" name="designation" value="1" <?php if ($designation == 1) echo "checked"; ?>> Manager<br>
                <input type="radio" name="designation" value="2" <?php if ($designation == 2) echo "checked"; ?>> Employee<br>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit">Submit</button>
                <a href="index.php"><button type="button">Cancel</button></a>
            </td>
        </tr>

    </table>
</form>

</body>
</html>

<?php

$conn->close();

?>
