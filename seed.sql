START TRANSACTION;

INSERT INTO department (DeptID, DeptName, MgrEmpID, Budget, DeptCity) VALUES
(1, 'DPSM', 1, 100000, 'Wellington'),
(2, 'Dummy Department', 2, 200000, 'Auckland'),
(3, 'Ghost Department', 5, 0, 'Iloilo');

INSERT INTO employee (EmpID, EmpName, Age, Salary, HireDate) VALUES
(2, 'River Dale', 35, 20000.0000, '2019-06-01'),
(3, 'Anthony Peterson', 38, 21000.5000, '2019-07-01'),
(4, 'Robert Brickson', 40, 19000.7500, '2019-10-01'),
(5, 'Ghost Employee', 100, 0.0000, '1990-11-01'),
(6, 'Robert Winson', 0, 40000.2500, '0000-00-00'),
(7, 'Robert Winson', 30, 40000.2500, '2018-11-01');

INSERT INTO work (EmpID, DeptID, Percent_Time) VALUES
(1, 1, 100.0000),
(2, 2, 100.0000),
(3, 1, 50.0000),
(4, 2, 100.0000),
(36, 3, 100.0000),
(37, 3, 50.0000),
(38, 3, 100.0000);

COMMIT;
