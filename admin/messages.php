<?php
include "admin_header.php";

// Messages List
function messages()
{
    global $db_connect;

    $get_messages = "SELECT * FROM contact";
    $res_messages = mysqli_query($db_connect, $get_messages);
    while ($row = mysqli_fetch_assoc($res_messages)) {
        $contact_id = $row['contact_id'];
        $contact_name = $row['contact_name'];
        $contact_email = $row['contact_email'];
        $sent_on = $row['sent_on'];

        echo "
            <tr class='btn-reveal-trigger'>
                <td class='align-middle text-center text-black'>" . $contact_id . "</td>
                <td class='align-middle text-center text-black'>" . $contact_name . "</td>
                <td class='align-middle text-center text-black'>" . $contact_email . "</td>
                <td class='align-middle text-center text-black'>" . $sent_on . "</td>
                <td class='align-middle text-center'>
                    <a class='btn btn-secondary btn-sm' href='message.php?id=" . $contact_id . "'><span class='fas fa-eye'></span> View</a>
                </td>
            </tr>
        ";
    }
}
?>

<div class="card mb-3">
    <div class="card-header bg-dark mb-3">
        <div class="row align-items-center justify-content-between">
            <div class="col-12 col-sm-auto d-flex align-items-center pr-0">
                <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0 text-white">Messages</h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="dashboard-data-table">
            <table id="uni_list_table" class="table table-striped table-bordered table-sm table-hover fs--1 data-table border-bottom" data-options='{"responsive":false,"pagingType":"simple","lengthChange":false,"searching":false,"pageLength":7,"columnDefs":[{"targets":[0,5],"orderable":true}],"language":{"info":"_START_ to _END_ Items of _TOTAL_ "},"buttons":["copy","excel"]}'>
                <thead class="bg-dark text-white font-weight-bold">
                    <tr>
                        <th class="sort pr-1 align-middle text-center" width="5%">Message ID</th>
                        <th class="sort pr-1 align-middle text-center">Sender Name</th>
                        <th class="sort pr-1 align-middle text-center">Sender Email</th>
                        <th class="sort pr-1 align-middle text-center">Sent On</th>
                        <th class="sort pr-1 align-middle text-center" width="20%">Action</th>
                    </tr>
                </thead>
                <tbody id="purchases">
                    <?php
                    messages();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include "admin_footer.php"; ?>