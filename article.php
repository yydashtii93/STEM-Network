<?php
include "header.php";

// Pull data from the database
// based on the GET Request (URL Parameter)
// and fetch data into the page
if (isset($_GET['v'])) {
    global $db_connect;

    $article_id = $_GET['v'];

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
?>



<div class="container" style="margin-top: 80px;">
    <div class="card">
        <div class="card-body">
            <div class="row">

                <!-- Article Image -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4 mb-3">
                    <img class="img-fluid w-100 border border-200 shadow rounded" src="assets/img/articles/<?php echo $article_image; ?>">
                </div>

                <!-- Article Details -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8">

                    <!-- Article Title -->
                    <h5 class="fs-5 text-primary font-weight-bold mb-2"><?php echo $article_title; ?></h5>

                    <!-- Article Category Name -->
                    <a class="fs-1 text-700 font-weight-bold mb-2" href="category.php?c=<?php echo $category_id; ?>"><?php echo $category_name; ?></a>

                    <!-- Article Creation Date -->
                    <h5 class="fs--1 text-700 font-weight-bold mb-2">Posted on: <?php echo $created_on; ?></h5>

                    <hr>

                    <!-- Article Body -->
                    <p class="text-black fs-0 font-weight-bold"><?php echo nl2br($article_body); ?></p>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>