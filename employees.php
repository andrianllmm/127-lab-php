<?php include 'header.php'; ?>

<h1>Employee Management</h1>
<br>

<h3>New Employee</h3>

<form action="addEmployee.php" method="get">
    <div class="form-grid">

        <div class="form-row">
            <label class="tlabel">Name</label>
            <input type="text" name="name">
        </div>

        <div class="form-row">
            <label class="tlabel">Age</label>
            <input type="number" name="age">
        </div>

        <div class="form-row">
            <label class="tlabel">Salary</label>
            <input type="number" step="0.01" name="salary">
        </div>

        <div class="form-row">
            <label class="tlabel">Percent Time</label>
            <input type="text" name="percent_time">
        </div>

        <div class="form-row">
            <label class="tlabel">Date Hired</label>
            <input class="expand" type="date" name="date_hired">
        </div>

        <div class="form-row">
            <label class="tlabel">Department</label>
            <select class="expand" name="department">
                <option value="" disabled selected>Select Department</option>
                <?php include 'allDepartment.php'; ?>
            </select>
        </div>

        <div class="form-row">
            <label class="tlabel">Designation</label>
            <div>
                <input type="radio" name="designation" value="1"> Manager<br>
                <input type="radio" name="designation" value="2"> Employee<br>
            </div>
        </div>

        <div class="form-row">
            <label></label>
            <button type="submit">Submit</button>
        </div>

    </div>
</form>

<br />

<?php
    include 'employees_per_dept.php';
?>

<?php include 'footer.php'; ?>
