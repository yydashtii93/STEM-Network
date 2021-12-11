<?php
include "header.php";

// Pull data from the database
// based on the GET Request (URL Parameter)
// and fetch data into the page
function articles()
{
    if (isset($_POST['search_text'])) {
        global $db_connect;

        $search_text = $_POST['search_text'];



        // SQL Query to get articles
        $get_articles = "SELECT * FROM articles WHERE article_title LIKE '%$search_text%' OR article_body LIKE '%$search_text%'";
        $res_articles = mysqli_query($db_connect, $get_articles);

        while ($row = mysqli_fetch_assoc($res_articles)) {
            $article_id = $row['article_id'];
            $article_title = $row['article_title'];
            $article_body = $row['article_body'];
            $created_on = $row['created_on'];
            $article_image = $row['article_image'];

            echo "
            <div class='col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 mb-3'>
                <div class='card'>
                    <div class='card-body p-2'>
                        <div class='row mb-2'>
                            <div class='col-3 text-center border-right'>
                                <img class='img-fluid fit-contain' src='assets/img/articles/" . $article_image . "' style='height: 160px;'>
                            </div>
                            <div class='col-9'>
                                <h5 class='text-primary fs-0 font-weight-bold mb-2'>" . $article_title . "</h5>
                                <h5 class='text-700 font-weight-bold fs--1 mb-0'>Created on: " . $created_on . "</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <a class='stretched-link' href='article.php?v=" . $article_id . "'></a>
            </div>
        ";
        }
    }
}

?>



<div class="container" style="margin-top: 80px;">
    <div class="card">

        <div class="card-header">
            <h5 class="fs-3 text-black font-weight-bold">Search Results:</h5>
        </div>

        <div class="card-body">
            <div class="row">

                <!-- Articles -->
                <?php articles(); ?>

            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>