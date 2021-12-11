<?php
include "header.php";

// FUNCTION - REGISTER
function register()
{
    if (isset($_POST['register'])) {
        global $db_connect;

        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        $confirm_password = $_POST['confirm_password'];

        $user_name = mysqli_escape_string($db_connect, $user_name);
        $user_email = mysqli_escape_string($db_connect, $user_email);
        $user_password = mysqli_escape_string($db_connect, $user_password);
        $confirm_password = mysqli_escape_string($db_connect, $confirm_password);

        if ($confirm_password !== $user_password) {
            echo "<span class='badge badge-soft-danger w-100 py-2 mt-2 fs-0'>Passwords do not match!</span>";
        } else {
            $check_users_table = "SELECT * FROM users WHERE user_email = '$user_email'";
            $check_users_results = mysqli_query($db_connect, $check_users_table);
            $count_of_results = mysqli_num_rows($check_users_results);
            if ($count_of_results > 0) {
                echo "<span class='badge badge-soft-danger w-100 py-2 mt-2 fs-0'>This email is already associated with an existing user!</span>";
            } else {
                $encrypted_password = md5($user_password);

                $insert_query = "INSERT INTO users(user_name, user_email, user_password, user_role)";
                $insert_query .= " VALUES ";
                $insert_query .= "('$user_name', '$user_email', '$encrypted_password', 'Normal User')";

                $insert_result = mysqli_query($db_connect, $insert_query);

                if (!$insert_result) {
                    die("Error: " . mysqli_error($db_connect));
                } else {
                    echo "<span class='badge badge-soft-success w-100 py-2 mt-2 fs-0'>Your account has been created successfully, you can login now!</span>";
                }
            }
        }
    }
}
?>

<div class="container" style="margin-top: 80px;">
    <div class="row">
        <div class="col-3 invisible"></div>

        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label class="font-weight-bold fs-0 text-black" for="user_name">Full Name</label>
                            <input class="form-control" type="text" name="user_name" id="user_name" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold fs-0 text-black" for="user_email">Email Address</label>
                            <input class="form-control" type="email" name="user_email" id="user_email" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold fs-0 text-black" for="user_password">Password</label>
                            <input class="form-control" type="password" name="user_password" id="user_password" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold fs-0 text-black" for="confirm_password">Confirm Password</label>
                            <input class="form-control" type="password" name="confirm_password" id="confirm_password" required>
                        </div>
                        <hr>
                        <button class="btn btn-primary btn-block font-weight-bold mb-3" type="submit" name="register">Get started</button>
                        <hr>
                        <h5 class="fs-0 text-secondary mb-2">Already have an account?</h5>
                        <a class="btn btn-falcon-default btn-block font-weight-bold" href="login.php">Login</a>
                        <?php register(); ?>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-3 invisible"></div>
    </div>
</div>

<?php
include "footer.php";
?>