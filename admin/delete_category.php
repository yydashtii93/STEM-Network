<?php
include "admin_header.php";

// Read Category Name from DB Table Using GET Variable ['id']
if (isset($_GET['id'])) {
    $the_category_id = $_GET['id'];

    $select = "SELECT * FROM categories WHERE category_id = $the_category_id";
    $select_results = mysqli_query($db_connect, $select);

    while ($row = mysqli_fetch_assoc($select_results)) {
        $category_id = $row['category_id'];
        $category_name = $row['category_name'];
    }
}

// Edit Category Function
function delete_category()
{
    if (isset($_POST['submit'])) {
        global $db_connect;

        $the_category_id = $_GET['id'];

        $query = "DELETE FROM categories WHERE category_id = '$the_category_id'";
        $query_result = mysqli_query($db_connect, $query);

        if (!$query_result) {
            die("QUERY FAILED" . mysqli_error($db_connect));
        } else {
            header("Location: categories.php");
        }
    }
}

// Calling functions
delete_category();
?>

<div class="card mb-3">
    <div class="card-header bg-dark">
        <h5 class="mb-0 text-white">Delete Category</h5>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="card-body">

            <div class="row">
                <div class="col-12">
                    <h5 class="text-black fs-0">Are you sure you want to delete the <span class='text-primary font-weight-bold'><?php echo $category_name; ?></span> category ?</h5>
                </div>
            </div>

        </div>
        <div class="card-body bg-dark">
            <div class="row">
                <div class="col-6 text-left">
                    <button class="btn btn-primary" type="submit" name="submit">Yes</button>
                </div>
                <div class="col-6 text-right">
                    <a class="btn btn-falcon-danger" href="categories.php">No</a>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
include "admin_footer.php";
?>