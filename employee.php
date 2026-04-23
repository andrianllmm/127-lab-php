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
    while($row = $result->fetch_assoc()) {
        if ($currentDept !== $row["DeptID"]) {
            if ($currentDept !== null) {
                echo "</table>";
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
                </tr>";
        }

        echo "<tr>
            <td align='center'>" . $row["EmpID"] . "</td>
            <td align='center'>" . $row["EmpName"] . "</td>
            <td align='center'>" . $row["Age"] . "</td>
            <td align='center'>" . $row["Salary"] . "</td>
            <td align='center'>" . $row["HireDate"] . "</td>
        </tr>";
    }
} else {
    echo "0 results";
}
?>
