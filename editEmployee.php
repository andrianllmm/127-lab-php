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

<?php include 'header.php'; ?>

<h1>Edit Employee</h1>

<form action="updateEmployee.php" method="post">
    <input type="hidden" name="EmpID" value="<?php echo $row['EmpID']; ?>">

    <div class="form-grid">

        <div class="form-row">
            <label class="tlabel">Name</label>
            <input type="text" name="name" value="<?php echo $row['EmpName']; ?>" required>
        </div>

        <div class="form-row">
            <label class="tlabel">Age</label>
            <input type="number" name="age" value="<?php echo $row['Age']; ?>" required>
        </div>

        <div class="form-row">
            <label class="tlabel">Salary</label>
            <input type="number" step="0.01" name="salary" value="<?php echo $row['Salary']; ?>" required>
        </div>

        <div class="form-row">
            <label class="tlabel">Percent Time</label>
            <input type="text" name="percent_time" value="<?php echo $row['Percent_Time']; ?>" required>
        </div>

        <div class="form-row">
            <label class="tlabel">Date Hired</label>
            <input type="date" name="date_hired" value="<?php echo $row['HireDate']; ?>" required>
        </div>

        <div class="form-row">
            <label class="tlabel">Department</label>
            <select name="department" required>
                <?php
                $deptResult = $conn->query("SELECT * FROM department");
                while ($dept = $deptResult->fetch_assoc()) {
                    $selected = ($dept['DeptID'] == $row['DeptID']) ? "selected" : "";
                    echo "<option value='{$dept['DeptID']}' $selected>{$dept['DeptName']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-row">
            <label class="tlabel">Designation</label>
            <div>
                <input type="radio" name="designation" value="1" <?php if ($designation == 1) echo "checked"; ?> required> Manager<br>
                <input type="radio" name="designation" value="2" <?php if ($designation == 2) echo "checked"; ?>> Employee<br>
            </div>
        </div>

        <div class="form-row">
            <label></label>
            <div>
                <button type="submit">Submit</button>
                <a href="index.php"><button type="button">Cancel</button></a>
            </div>
        </div>

    </div>
</form>

<?php include 'footer.php'; ?>

<?php

$conn->close();

?>
