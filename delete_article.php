<?php
include "header.php";

// Pull data from the database
// based on the GET Request (URL Parameter)
// and fetch data into the page
if (isset($_GET['d'])) {
    global $db_connect;

    $article_id = $_GET['d'];

    // SQL Query to get article data
    $get_article_data = "SELECT * FROM articles WHERE article_id = '$article_id'";
    $res_article_data = mysqli_query($db_connect, $get_article_data);

    while ($row = mysqli_fetch_assoc($res_article_data)) {
        $article_title = $row['article_title'];
    }
}

// Delete Article
if (isset($_POST['delete_article'])) {
    global $db_connect;

    $article_id = $_POST['article_id'];

    $delete = "DELETE FROM articles WHERE article_id = '$article_id'";
    $result = mysqli_query($db_connect, $delete);
    if (!$result) {
        die("Error: " . mysqli_error($db_connect));
    } else {
        header("Location: account.php?d=s");
    }
}
?>

<div class="container" style="margin-top: 80px;">
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-12">
                    <form class="border rounded card-body" method="post">

                        <h5 class="text-black fs-0 font-weight-bold mb-4">Are you sure you want to delete the article (<?php echo $article_title; ?>)?</h5>

                        <!-- Hidden Article ID -->
                        <input hidden type="text" name="article_id" value="<?php echo $article_id; ?>">

                        <!-- Form Submit Buttons -->
                        <div class="card-body bg-black rounded">
                            <div class="row">
                                <div class="col-6 text-left">
                                    <a class="btn btn-light font-weight-bold" href="account.php">No</a>
                                </div>
                                <div class="col-6 text-right">
                                    <button class="btn btn-danger font-weight-bold" type="submit" name="delete_article">Yes</button>
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