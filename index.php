<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            font-family: Calibri
        }
        table, th, td {
            border: 1px solid silver;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 style="color: darkgrey;">This page will display the content of each table in the <i style="color: gold;">sample</i> database.</h1>
    <p style="color: grey;" > Typing tutorial 2.0 </p>
    <br>
    <h2 style="color: silver;">Department Table:</h2>
    <table style="width:100%">
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
    <?php
        include 'employees_per_dept.php';
    ?>
</body>
</html>
