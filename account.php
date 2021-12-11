<?php
include "header.php";

// Categories Dropdown List Options
function categories()
{
    global $db_connect;

    $get_categories = "SELECT * FROM categories ORDER BY category_name ASC";
    $result_categories = mysqli_query($db_connect, $get_categories);
    while ($row = mysqli_fetch_assoc($result_categories)) {
        $category_id = $row['category_id'];
        $category_name = $row['category_name'];

        echo "<option value='" . $category_id . "'>" . $category_name . "</option>";
    }
}

// Article Creation Function
function create_article()
{
    if (isset($_POST['create_article'])) {
        global $db_connect;

        $category_id = $_POST['category'];
        $article_title = $_POST['article_title'];
        $article_body = $_POST['article_body'];
        $article_image = $_FILES['article_image']['name'];

        $article_title = htmlspecialchars($article_title);
        $article_body = htmlspecialchars($article_body);

        $article_title = mysqli_real_escape_string($db_connect, $article_title);
        $article_body = mysqli_real_escape_string($db_connect, $article_body);

        // MOVE IMAGE TO FOLDER
        $target = "assets/img/articles/" . basename($article_image);
        move_uploaded_file($_FILES['article_image']['tmp_name'], $target);

        $created_on = date("Y-m-d");
        $user_id = $_SESSION['user_id'];

        $insert = "INSERT INTO articles(category_id, user_id, article_title, article_body, article_image, created_on) ";
        $insert .= "VALUES ('$category_id', '$user_id', '$article_title', '$article_body', '$article_image', '$created_on')";
        $result = mysqli_query($db_connect, $insert);
        if (!$result) {
            die("Error: " . mysqli_error($db_connect));
        } else {
            header("Location: account.php?a=s");
        }
    }
}

// Article Creation Success Message
function success_message()
{
    if (isset($_GET['a'])) {
        if ($_GET['a'] == 's') {
            echo "<span class='badge badge-soft-success py-2 mb-3 w-100 fs-0'>Your article has been created successfully!</span>";
        }
    } elseif (isset($_GET['u'])) {
        if ($_GET['u'] == 's') {
            echo "<span class='badge badge-soft-success py-2 mb-3 w-100 fs-0'>Your profile name has been updated successfully!</span>";
        }
    } elseif (isset($_GET['d'])) {
        if ($_GET['d'] == 's') {
            echo "<span class='badge badge-soft-danger py-2 mb-3 w-100 fs-0'>Your article has been deleted successfully!</span>";
        }
    }
}

// User's Articles
function user_article()
{
    global $db_connect;

    // Get the User ID from Session Values
    $session_user_id = $_SESSION['user_id'];

    // Pull Articles that belongs to the user
    $get_articles = "SELECT * FROM articles WHERE user_id = '$session_user_id' ORDER BY article_id DESC";
    $res_articles = mysqli_query($db_connect, $get_articles);

    // Get the count of articles the user has
    $articles_count = mysqli_num_rows($res_articles);

    // Pull database fields for each article
    // in case he/she has at least 1 article
    if ($articles_count > 0) {
        while ($row = mysqli_fetch_assoc($res_articles)) {
            $article_id = $row['article_id'];
            $category_id = $row['category_id'];
            $article_title = $row['article_title'];
            $article_image = $row['article_image'];
            $created_on = strtotime($row['created_on']);
            $created_on = date("m-d-Y", $created_on);

            // Pull category name from the categories table
            $get_category_name = "SELECT * FROM categories WHERE category_id = '$category_id'";
            $res_category_name = mysqli_query($db_connect, $get_category_name);
            while ($cat = mysqli_fetch_assoc($res_category_name)) {
                $category_name = $cat['category_name'];
            }

            echo "
                <div class='col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4'>
                    <div class='card'>
                        <div class='card-body p-2'>
                            <div class='row mb-3'>
                                <div class='col-3 text-center border-right'>
                                    <img class='img-fluid fit-contain' src='assets/img/articles/" . $article_image . "' style='height: 160px;'>
                                </div>
                                <div class='col-9'>
                                    <h5 class='text-primary fs-0 font-weight-bold mb-2'>" . $article_title . "</h5>
                                    <h5 class='text-black fs-0 font-weight-bold mb-2'>" . $category_name . "</h5>
                                    <h5 class='text-700 font-weight-bold fs--1 mb-0'>Created on: " . $created_on . "</h5>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4 mb-2'>
                                    <a class='btn btn-block btn-danger' href='delete_article.php?d=" . $article_id . "'>Delete</a>
                                </div>
                                <div class='col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4 mb-2'>
                                    <a class='btn btn-block btn-secondary' href='edit_article.php?e=" . $article_id . "'>Edit</a>
                                </div>
                                <div class='col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4 mb-2'>
                                    <a class='btn btn-block btn-info' href='article.php?v=" . $article_id . "'>View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ";
        }
    }
}

// Get User's Name from the database
if (isset($_SESSION['user_id'])) {
    global $db_connect;

    $session_user_id = $_SESSION['user_id'];

    $get_name = "SELECT * FROM users WHERE user_id = '$session_user_id'";
    $res_name = mysqli_query($db_connect, $get_name);
    while ($row = mysqli_fetch_assoc($res_name)) {
        $db_user_name = $row['user_name'];
    }
}

// Update the User's Name in the database
if (isset($_POST['update_name'])) {
    global $db_user_name;

    $session_user_id = $_SESSION['user_id'];

    $new_user_name = $_POST['user_name'];

    $new_user_name = htmlspecialchars($new_user_name);

    $new_user_name = mysqli_real_escape_string($db_connect, $new_user_name);

    $update_name = "UPDATE users SET user_name = '$new_user_name' WHERE user_id = '$session_user_id'";
    $result_update = mysqli_query($db_connect, $update_name);
    if (!$result_update) {
        die("Error: " . mysqli_error($db_connect));
    } else {
        header("Location: account.php?u=s");
    }
}

// Calling Functions
create_article();
?>

<div class="container" style="margin-top: 80px;">
    <div class="card">
        <div class="card-body">
            <?php success_message(); ?>
            <ul class="nav nav-pills" id="pill-myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link fs-2 active" id="pill-profile-tab" data-toggle="tab" href="#pill-tab-profile" role="tab" aria-controls="pill-tab-profile" aria-selected="true">
                        Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-2" id="pill-articles-tab" data-toggle="tab" href="#pill-tab-articles" role="tab" aria-controls="pill-tab-articles" aria-selected="false">
                        My Articles
                    </a>
                </li>
            </ul>
            <div class="tab-content border p-3 mt-3" id="pill-myTabContent">

                <div class="tab-pane fade show active" id="pill-tab-profile" role="tabpanel" aria-labelledby="profile-tab">
                    <h5 class="text-black fs-2 mb-3">Profile Information</h5>
                    <form method="post">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="font-weight-bold fs-0 text-black" for="user_name">Name</label>
                                    <input class="form-control" type="text" name="user_name" id="user_name" value="<?php echo $db_user_name; ?>" required>
                                </div>
                            </div>
                            <div class="col-6 invisible"></div>
                            <div class="col-3">
                                <button class="btn btn-primary font-weight-bold" type="submit" name="update_name">Update</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="pill-tab-articles" role="tabpanel" aria-labelledby="articles-tab">
                    <div class="row">
                        <div class="col-6 text-left">
                            <h5 class="text-black fs-2">Profile Information</h5>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-info font-weight-bold" type="button" data-toggle="modal" data-target="#newArticle">New Article</button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">

                        <?php user_article(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Article Modal -->
<div class="modal fade" id="newArticle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Article</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" name="category" id="category" required>
                            <option value="">--</option>
                            <?php categories(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="article_title">Article Title</label>
                        <input class="form-control" type="text" name="article_title" id="article_title" required>
                    </div>
                    <div class="form-group">
                        <label for="article_body">Article Body</label>
                        <textarea class="form-control" name="article_body" id="article_body" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="article_image">Article Cover Image</label>
                        <div class="custom-file">
                            <input class="custom-file-input" id="article_image" name="article_image" type="file" required>
                            <label class="custom-file-label" for="article_image">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary btn-sm" type="submit" name="create_article">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>