<?php
include "admin_header.php";

// Articles List
function articles()
{
    global $db_connect;

    $get_articles = "SELECT * FROM articles";
    $res_articles = mysqli_query($db_connect, $get_articles);
    while ($row = mysqli_fetch_assoc($res_articles)) {
        $article_id = $row['article_id'];
        $user_id = $row['user_id'];
        $category_id = $row['category_id'];
        $article_title = $row['article_title'];
        $article_image = $row['article_image'];
        $created_on = $row['created_on'];

        $get_category_name = "SELECT * FROM categories WHERE category_id = '$category_id'";
        $res_category_name = mysqli_query($db_connect, $get_category_name);
        while ($cat = mysqli_fetch_assoc($res_category_name)) {
            $category_name = $cat['category_name'];
        }

        $get_user_name = "SELECT * FROM users WHERE user_id = '$user_id'";
        $res_user_name = mysqli_query($db_connect, $get_user_name);
        while ($user = mysqli_fetch_assoc($res_user_name)) {
            $user_name = $user['user_name'];
        }

        echo "
            <tr class='btn-reveal-trigger'>
                <td class='align-middle text-center text-black'><img class='img-fluid rounded' src='../assets/img/articles/" . $article_image . "' style='height:100px;'></td>
                <td class='align-middle text-center text-black'>" . $article_id . "</td>
                <td class='align-middle text-center text-black'>" . $article_title . "</td>
                <td class='align-middle text-center text-black'>" . $category_name . "</td>
                <td class='align-middle text-center text-black'>" . $user_name . "</td>
                <td class='align-middle text-center text-black'>" . $created_on . "</td>
            </tr>
        ";
    }
}
?>

<div class="card mb-3">
    <div class="card-header bg-dark mb-3">
        <div class="row align-items-center justify-content-between">
            <div class="col-12 col-sm-auto d-flex align-items-center pr-0">
                <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0 text-white">Articles</h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="dashboard-data-table">
            <table id="uni_list_table" class="table table-striped table-bordered table-sm table-hover fs--1 data-table border-bottom" data-options='{"responsive":false,"pagingType":"simple","lengthChange":false,"searching":false,"pageLength":7,"columnDefs":[{"targets":[0,5],"orderable":true}],"language":{"info":"_START_ to _END_ Items of _TOTAL_ "},"buttons":["copy","excel"]}'>
                <thead class="bg-dark text-white font-weight-bold">
                    <tr>
                        <th class="sort pr-1 align-middle text-center">Image</th>
                        <th class="sort pr-1 align-middle text-center">Article ID</th>
                        <th class="sort pr-1 align-middle text-center">Article Title</th>
                        <th class="sort pr-1 align-middle text-center">Category</th>
                        <th class="sort pr-1 align-middle text-center">Users Name</th>
                        <th class="sort pr-1 align-middle text-center">Created On</th>
                    </tr>
                </thead>
                <tbody id="purchases">
                    <?php
                    articles();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include "admin_footer.php"; ?>