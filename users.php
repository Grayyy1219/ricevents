<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account Management</title>
    <link rel="icon" href="Image/logo.ico">
</head>
<?php
include("connect.php");
include("query.php");

$query = "SELECT UserID, FName, username, admin FROM users WHERE username != 'admin'";

$result = mysqli_query($con, $query);
?>

<body>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">User Account Management</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                    <th>Select</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $userId  = $row['UserID'];
                                        $FName = $row['FName'];
                                        $username  = $row['username'];
                                        $admin  = $row['admin'];
                                        if ($admin == 1) {
                                            $role = "Admin";
                                        } else {
                                            $role = "User";
                                        }
                                        echo "<tr id='user-row-$userId'>";
                                        echo "<td class='td'>$userId</td>";
                                        echo "<td class='td'>$FName</td>";
                                        echo "<td class='td'>$username</td>";
                                        echo "<td class='td'>$role</td>"; ?>

                                <?php
                                        echo "<td class='td'><a href='admin2.php?edit_customer&UserID=$userId' style='color: #337ab7; text-decoration: none; margin-right: 10px;'>Edit</a></td>";
                                        echo "<td class='td'><input type='checkbox' class='delete-checkbox' data-userid='$userId'></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>Error: " . mysqli_error($con) . "</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <div id="delete">
                            <a href="admin2.php?signup"><button class="Signup">Add</button></a>
                            <button class="delete" onclick="deleteSelectedRows()">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteSelectedRows() {
            var selectedCheckboxes = document.querySelectorAll('.delete-checkbox:checked');
            var selectedUserIds = Array.from(selectedCheckboxes).map(function(checkbox) {
                return checkbox.getAttribute('data-userid');
            });

            if (selectedUserIds.length > 0) {
                var confirmed = confirm("Are you sure you want to delete the selected users?");
                if (confirmed) {
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4) {
                            if (this.status == 200) {
                                location.reload();
                            } else {
                                console.error('Error:', this.status, this.statusText);
                            }
                        }
                    };

                    var requestData = "user_ids=" + encodeURIComponent(selectedUserIds.join(','));

                    xhttp.open("POST", "delete_users.php");
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send(requestData);
                }
            } else {
                alert("Please select at least one user to delete.");
            }
        }
    </script>
</body>