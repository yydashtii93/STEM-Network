<?php
include "admin_header.php";

// Users List
function users()
{
    global $db_connect;

    $get_users = "SELECT * FROM users";
    $res_users = mysqli_query($db_connect, $get_users);
    while ($row = mysqli_fetch_assoc($res_users)) {
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];

        echo "
            <tr class='btn-reveal-trigger'>
                <td class='align-middle text-center text-black'>" . $user_id . "</td>
                <td class='align-middle text-center text-black'>" . $user_name . "</td>
                <td class='align-middle text-center text-black'>" . $user_email . "</td>
                <td class='align-middle text-center text-black'>" . $user_role . "</td>
            </tr>
        ";
    }
}
?>

<div class="card mb-3">
    <div class="card-header bg-dark mb-3">
        <div class="row align-items-center justify-content-between">
            <div class="col-12 col-sm-auto d-flex align-items-center pr-0">
                <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0 text-white">Users</h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="dashboard-data-table">
            <table id="uni_list_table" class="table table-striped table-bordered table-sm table-hover fs--1 data-table border-bottom" data-options='{"responsive":false,"pagingType":"simple","lengthChange":false,"searching":false,"pageLength":7,"columnDefs":[{"targets":[0,5],"orderable":true}],"language":{"info":"_START_ to _END_ Items of _TOTAL_ "},"buttons":["copy","excel"]}'>
                <thead class="bg-dark text-white font-weight-bold">
                    <tr>
                        <th class="sort pr-1 align-middle text-center" width="5%">Users ID</th>
                        <th class="sort pr-1 align-middle text-center">User Name</th>
                        <th class="sort pr-1 align-middle text-center">User Email</th>
                        <th class="sort pr-1 align-middle text-center">User Role</th>
                    </tr>
                </thead>
                <tbody id="purchases">
                    <?php
                    users();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include "admin_footer.php"; ?>