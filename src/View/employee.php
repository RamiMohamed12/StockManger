<html> 
    <head> 
        <meta charset="UTF-8">
        <title>Employees</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <style>
            .back-link {
                position: absolute;
                top: 20px;
                left: 20px;
            }
        </style>
    </head>
    <body> 
    <a href="../View/dashboard.php" style="text-decoration: none; font-size: 20px;" class="back-link"> 
            <i class="fa-solid fa-arrow-left"></i> 
        </a>
        <table id='sortable'> 
            <thead> 
                <tr> 
                    <th>ID</th> 
                    <th>Name <i class="fa-solid fa-sort" onclick="sortBy(1, false)"></i></th> 
                    <th>Address <i class="fa-solid fa-sort" onclick="sortBy(2, false)"></i></th> 
                    <th>Email <i class="fa-solid fa-sort" onclick="sortBy(3, false)"></i></th>
                    <th>Salary <i class="fa-solid fa-sort" onclick="sortBy(4, true)"></i></th>
                    <th>Profession <i class="fa-solid fa-sort" onclick="sortBy(5, false)"></i></th>
                    <th>Actions</th>
                </tr> 
            </thead>
            <tbody>
            <?php 
                include '../../config/config.php';
                include '../Model/employee.php';
                
                $employee = new Employee($conn);
                $result = $employee->getAll();

                if ($result) {
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['salary'] . "</td>";
                        echo "<td>" . $row['profession'] . "</td>";
                        echo "<td> <a href='#' onclick='confirmDelete(" . htmlspecialchars($row['id']) . ")'> Delete </a> <a href='../Controller/edit_employee.php?id=" . htmlspecialchars($row['id']) ."' style='margin-left: 10px;'> Edit </a> </td>";
                        echo "</tr>";
                    }
                    mysqli_free_result($result);
                } else {
                    echo "Error retrieving employees.";
                }
                mysqli_close($conn);
            ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7" style="text-align: right;">
                        <a href="../Controller/add_employee.php" style="text-decoration: none; font-size: 20px;">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </td>
                </tr>
            </tfoot>
        </table>
       
        <div id="confirmModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>Are you sure you want to delete this employee?</p>
                <button id="confirmBtn">Yes</button>
                <button id="cancelBtn">No</button>
            </div>
        </div>

    </body>
    <script src="visable.js"></script>
    <script src="sortTable.js"></script>
    <script src="confirmDelete.js"></script>
</html>
