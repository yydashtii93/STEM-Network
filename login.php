<?php
include "header.php";

// FUNCTION - LOGIN
function login()
{
    if (isset($_POST['login'])) {
        global $db_connect;

        $login_email = $_POST['login_email'];
        $login_password = $_POST['login_password'];

        $check_if_email_exists = "SELECT * FROM users WHERE user_email = '$login_email'";
        $check_result = mysqli_query($db_connect, $check_if_email_exists);
        $count_of_results = mysqli_num_rows($check_result);

        if ($count_of_results == 0) {
            echo "<span class='badge badge-soft-danger w-100 py-2 fs-0 mt-2'>There is not user associated with this Email Address!</span>";
        } elseif ($count_of_results == 1) {
            $encrypted_password = md5($login_password);

            while ($record = mysqli_fetch_assoc($check_result)) {
                $db_user_id = $record['user_id'];
                $db_user_name = $record['user_name'];
                $db_user_password = $record['user_password'];
                $db_user_role = $record['user_role'];

                if ($encrypted_password !== $db_user_password) {
                    echo "<span class='badge badge-soft-danger w-100 py-2 fs-0 mt-2'>Password is incorrect!</span>";
                } else {
                    setcookie("user_id", $db_user_id, time() + 2628000);
                    setcookie("user_name", $db_user_name, time() + 2628000);
                    setcookie("user_email", $login_email, time() + 2628000);
                    setcookie("user_role", $db_user_role, time() + 2628000);

                    $_COOKIE['user_id'] = $db_user_id;
                    $_COOKIE['user_name'] = $db_user_name;
                    $_COOKIE['user_email'] = $login_email;
                    $_COOKIE['user_role'] = $db_user_role;

                    $_SESSION['user_id'] = $_COOKIE['user_id'];
                    $_SESSION['user_name'] = $_COOKIE['user_name'];
                    $_SESSION['user_email'] = $_COOKIE['user_email'];
                    $_SESSION['user_role'] = $_COOKIE['user_role'];

                    if ($db_user_role == 'Admin') {
                        header("Location: admin/dashboard.php");
                    } else {
                        header("Location: account.php");
                    }
                }
            }
        }
    }
}
?>

<div class="container" style="margin-top: 80px;">
    <div class="row">
        <div class="col-4 invisible"></div>

        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label class="font-weight-bold fs-0 text-black" for="login_email">Email Address</label>
                            <input class="form-control" type="email" name="login_email" id="login_email" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold fs-0 text-black" for="login_password">Password</label>
                            <input class="form-control" type="password" name="login_password" id="login_password" required>
                        </div>
                        <button class="btn btn-primary btn-block font-weight-bold mb-3" type="submit" name="login">Login</button>
                        <hr>
                        <h5 class="fs-0 text-secondary mb-2">Don't have an account?</h5>
                        <a class="btn btn-falcon-default btn-block font-weight-bold" href="register.php">Create an account</a>
                        <?php login(); ?>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-4 invisible"></div>
    </div>
</div>

<?php
include "footer.php";
?>