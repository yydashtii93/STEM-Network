<?php
include "header.php";

// Pull data from the database
// based on the GET Request (URL Parameter)
// and fetch data into the page
if (isset($_GET['e'])) {
    global $db_connect;

    $article_id = $_GET['e'];

    // SQL Query to get article data
    $get_article_data = "SELECT * FROM articles WHERE article_id = '$article_id'";
    $res_article_data = mysqli_query($db_connect, $get_article_data);

    while ($row = mysqli_fetch_assoc($res_article_data)) {
        $article_title = $row['article_title'];
        $article_body = $row['article_body'];
        $category_id = $row['category_id'];
        $created_on = $row['created_on'];
        $article_image = $row['article_image'];

        // Pull category name from the categories table
        $get_category_name = "SELECT * FROM categories WHERE category_id = '$category_id'";
        $res_category_name = mysqli_query($db_connect, $get_category_name);
        while ($cat = mysqli_fetch_assoc($res_category_name)) {
            $category_name = $cat['category_name'];
        }
    }
}

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

// Article Update Function
if (isset($_POST['update_article'])) {
    global $db_connect;

    $new_category_id = $_POST['category'];
    $new_article_title = $_POST['article_title'];
    $new_article_body = $_POST['article_body'];
    $new_article_image = $_FILES['article_image']['name'];

    $new_article_title = htmlspecialchars($new_article_title);
    $new_article_body = htmlspecialchars($new_article_body);

    $new_article_title = mysqli_real_escape_string($db_connect, $new_article_title);
    $new_article_body = mysqli_real_escape_string($db_connect, $new_article_body);

    if (empty($new_article_image)) {
        $new_article_image = $article_image;
    } else {
        // MOVE IMAGE TO FOLDER
        $target = "assets/img/articles/" . basename($new_article_image);
        move_uploaded_file($_FILES['article_image']['tmp_name'], $target);
    }

    $update_article_data = "UPDATE articles SET ";
    $update_article_data .= "category_id = '$new_category_id', ";
    $update_article_data .= "article_title = '$new_article_title', ";
    $update_article_data .= "article_body = '$new_article_body', ";
    $update_article_data .= "article_image = '$new_article_image' ";
    $update_article_data .= "WHERE article_id = '$article_id' ";
    $result_article_update = mysqli_query($db_connect, $update_article_data);
    if (!$result_article_update) {
        die("Error: " . mysqli_error($db_connect));
    } else {
        header("Location: article.php?v=" . $article_id . "");
    }
}
?>

<div class="container" style="margin-top: 80px;">
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-12">
                    <form class="border rounded card-body" method="post" enctype="multipart/form-data">

                        <!-- Article Category -->
                        <div class="form-group">
                            <label class="font-weight-bold text-black fs-0" for="category">Category</label>
                            <select class="form-control" name="category" id="category" required>
                                <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                                <option value="">--</option>
                                <?php categories(); ?>
                            </select>
                        </div>

                        <!-- Article Titl -->
                        <div class="form-group">
                            <label class="font-weight-bold text-black fs-0" for="article_title">Article Title</label>
                            <input class="form-control" type="text" name="article_title" id="article_title" value="<?php echo $article_title; ?>" required>
                        </div>

                        <!-- Article Body -->
                        <div class="form-group">
                            <label class="font-weight-bold text-black fs-0" for="article_body">Article Body</label>
                            <textarea class="form-control" name="article_body" id="article_body" rows="10" required><?php echo $article_body; ?></textarea>
                        </div>

                        <!-- Article Image -->
                        <div class="row mb-3">
                            <div class="col-10">
                                <div class="form-group">
                                    <label class="font-weight-bold text-black fs-0" for="article_image">Article Cover Image</label>
                                    <div class="custom-file">
                                        <input class="custom-file-input" id="article_image" name="article_image" type="file">
                                        <label class="custom-file-label" for="article_image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <img class="img-fluid w-100 shadow border border-200 rounded" src="assets/img/articles/<?php echo $article_image; ?>">
                            </div>
                        </div>

                        <!-- Form Submit Buttons -->
                        <div class="card-body bg-black rounded">
                            <div class="row">
                                <div class="col-6 text-left">
                                    <a class="btn btn-light font-weight-bold" href="account.php">Cancel</a>
                                </div>
                                <div class="col-6 text-right">
                                    <button class="btn btn-primary font-weight-bold" type="submit" name="update_article">Submit</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>