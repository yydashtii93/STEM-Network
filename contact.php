<?php
include "header.php";

// Function - Send Contact Message
function send_message()
{
    if (isset($_POST['send'])) {
        global $db_connect;

        $contact_name = $_POST['contact_name'];
        $contact_email = $_POST['contact_email'];
        $contact_body = $_POST['contact_body'];

        $contact_name = htmlspecialchars($contact_name);
        $contact_email = htmlspecialchars($contact_email);
        $contact_body = htmlspecialchars($contact_body);

        $contact_name = mysqli_real_escape_string($db_connect, $contact_name);
        $contact_email = mysqli_real_escape_string($db_connect, $contact_email);
        $contact_body = mysqli_real_escape_string($db_connect, $contact_body);

        $sent_on = date("Y-m-d");

        $insert = "INSERT INTO contact(contact_name, contact_email, contact_body, sent_on) VALUES ('$contact_name', '$contact_email', '$contact_body', '$sent_on')";
        $result = mysqli_query($db_connect, $insert);
        if (!$result) {
            die("Error: " . mysqli_error($db_connect));
        } else {
            echo "<span class='badge badge-soft-success w-100 py-2 fs-0 mt-2'>Your message has been sent successfully!</span>";
        }
    }
}
?>

<div class="container" style="margin-top: 80px;">
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form method="post">

                        <div class="form-group">
                            <label class="font-weight-bold fs-0 text-black" for="contact_name">Full Name</label>
                            <input class="form-control" type="text" name="contact_name" id="contact_name" required>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold fs-0 text-black" for="contact_email">Email address</label>
                            <input class="form-control" type="email" name="contact_email" id="contact_email" required>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold fs-0 text-black" for="contact_body">Message</label>
                            <textarea class="form-control" name="contact_body" id="contact_body" cols="30" rows="10" required></textarea>
                        </div>

                        <button class="btn btn-primary btn-block font-weight-bold mb-3" type="submit" name="send">Send</button>

                        <?php send_message(); ?>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>