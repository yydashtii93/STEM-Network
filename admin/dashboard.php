<?php
include "admin_header.php";

// Count of Users
function users()
{
    global $db_connect;

    $get_count = "SELECT * FROM users WHERE user_role = 'Normal User'";
    $res_count = mysqli_query($db_connect, $get_count);
    $users_count = mysqli_num_rows($res_count);

    echo "<h5 class='text-black fs-3 font-weight-bold'>" . $users_count . "</h5>";
}

// Count of Categories
function categories()
{
    global $db_connect;

    $get_count = "SELECT * FROM categories";
    $res_count = mysqli_query($db_connect, $get_count);
    $categories_count = mysqli_num_rows($res_count);

    echo "<h5 class='text-black fs-3 font-weight-bold'>" . $categories_count . "</h5>";
}

// Count of Categories
function articles()
{
    global $db_connect;

    $get_count = "SELECT * FROM articles";
    $res_count = mysqli_query($db_connect, $get_count);
    $articles_count = mysqli_num_rows($res_count);

    echo "<h5 class='text-black fs-3 font-weight-bold'>" . $articles_count . "</h5>";
}
?>

<div class="card">
    <div class="card-body">
        <div class="row">

            <div class="col-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class='text-secondary fs-2 font-weight-bold mb-2'>Users</h5>
                        <span class="fas fa-users fs-5 mb-3"></span>
                        <hr>
                        <?php users(); ?>
                    </div>
                </div>
                <a href="users.php" class="stretched-link"></a>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class='text-secondary fs-2 font-weight-bold mb-2'>Categories</h5>
                        <span class="fas fa-stream fs-5 mb-3"></span>
                        <hr>
                        <?php categories(); ?>
                    </div>
                </div>
                <a href="categories.php" class="stretched-link"></a>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class='text-secondary fs-2 font-weight-bold mb-2'>Articles</h5>
                        <span class="fas fa-newspaper fs-5 mb-3"></span>
                        <hr>
                        <?php articles(); ?>
                    </div>
                </div>
                <a href="articles.php" class="stretched-link"></a>
            </div>

        </div>
    </div>
</div>

<?php
include "admin_footer.php";
?>