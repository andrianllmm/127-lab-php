<?php

include 'DBConnector.php';

$sql = "
    SELECT *
    FROM employee AS e
    CROSS JOIN work AS w
    USING(EmpID)
    CROSS JOIN department AS d
    USING(DeptID)
    ORDER BY d.DeptID, e.EmpID
";

$result = $conn->query($sql);

$currentDept = null;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($currentDept !== $row["DeptID"]) {
            if ($currentDept !== null) {
                echo "</table>";
                echo "<br />";
            }

            $currentDept = $row["DeptID"];

            echo "<h2>" . $row["DeptName"] . "</h2>";
            echo "<table>
                <tr>
                    <th>EmpID</th>
                    <th>EmpName</th>
                    <th>Age</th>
                    <th>Salary</th>
                    <th>HireDate</th>
                    <th>Designation</th>
                    <th></th>
                </tr>";
        }

        echo "<tr>
            <td align='center'>" . $row["EmpID"] . "</td>
            <td align='center'>" . $row["EmpName"] . "</td>
            <td align='center'>" . $row["Age"] . "</td>
            <td align='center'>" . $row["Salary"] . "</td>
            <td align='center'>" . $row["HireDate"] . "</td>";

        if ($row["MgrEmpID"] == $row["EmpID"]) {
            echo "<td align='center'>Manager</td>";
        } else {
            echo "<td align='center'>Employee</td>";
        }

        echo "<td style='display: flex; gap: 0.5rem; justify-content: center; align-items: center;'>
            <form action='deleteEmployee.php' method='post' style='margin:0;'>
                <input type='hidden' name='EmpID' value='" . $row["EmpID"] . "'>
                <button type='submit'>Delete</button>
            </form>

            <form action='editEmployee.php' method='post' style='margin:0;'>
                <input type='hidden' name='EmpID' value='" . $row["EmpID"] . "'>
                <button type='submit'>Edit</button>
            </form>
        </td>";

        echo "</tr>";
    }

    echo "</table>";

} else {
    echo "0 results";
}

$conn->close();

?>
