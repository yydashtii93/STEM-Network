<?php
include "admin_header.php";

// Get Messages Details
if (isset($_GET['id'])) {
    global $db_connect;

    $message_id = $_GET['id'];

    $get_message = "SELECT * FROM contact WHERE contact_id = '$message_id'";
    $res_message = mysqli_query($db_connect, $get_message);
    while ($row = mysqli_fetch_assoc($res_message)) {
        $contact_id = $row['contact_id'];
        $contact_name = $row['contact_name'];
        $contact_email = $row['contact_email'];
        $contact_body = nl2br($row['contact_body']);
        $sent_on = $row['sent_on'];
    }
}
?>

<div class="card mb-3">
    <div class="card-header bg-dark mb-3">
        <div class="row align-items-center justify-content-between">
            <div class="col-12 col-sm-auto d-flex align-items-center pr-0">
                <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0 text-white">Message Details</h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <h5 class="text-primary font-weight-bold fs-0 mb-2">Message ID: <span class="text-black"><?php echo $contact_id; ?></span></h5>
        <h5 class="text-primary font-weight-bold fs-0 mb-2">Sender Name: <span class="text-black"><?php echo $contact_name; ?></span></h5>
        <h5 class="text-primary font-weight-bold fs-0 mb-2">Sender Email: <span class="text-black"><?php echo $contact_email; ?></span></h5>
        <h5 class="text-primary font-weight-bold fs-0 mb-2">Sent On: <span class="text-black"><?php echo $sent_on; ?></span></h5>
        <h5 class="text-primary font-weight-bold fs-0">Message: <br><span class="text-black"><?php echo $contact_body; ?></span></h5>
    </div>
</div>

<?php include "admin_footer.php"; ?>