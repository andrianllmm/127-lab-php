<?php include 'header.php'; ?>

<p>This page will display the content of each table in the <i>sample</i> database.</p>
<p>Typing tutorial 2.0</p>

<br />

<h2>Departments</h2>
<table>
    <tr>
        <th>Department ID</th>
        <th>Department Name</th>
        <th>Manager Name</th>
        <th>Budget</th>
        <th>City</th>
    </tr>
    <?php
        include 'department.php';
    ?>
</table>

<br />

<?php
    include 'employees_per_dept.php';
?>

<?php include 'footer.php'; ?>
