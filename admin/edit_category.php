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
function edit_category()
{
    if (isset($_POST['submit'])) {
        global $db_connect;

        $the_category_id = $_GET['id'];
        $new_category_name = $_POST['category_name'];

        $query = "UPDATE categories SET ";
        $query .= "category_name = '$new_category_name' ";
        $query .= "WHERE category_id = '$the_category_id'";
        $query_result = mysqli_query($db_connect, $query);

        if (!$query_result) {
            die("QUERY FAILED" . mysqli_error($db_connect));
        } else {
            header("Location: categories.php");
        }
    }
}

// Calling functions
edit_category();
?>

<div class="card mb-3">
    <div class="card-header bg-dark">
        <h5 class="mb-0 text-white">Update Category Name</h5>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="card-body">

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <input class="form-control" id="category_name" name="category_name" type="text" value="<?php echo $category_name; ?>">
                    </div>
                </div>
            </div>

        </div>
        <div class="card-body bg-dark">
            <div class="row">
                <div class="col-6 text-left">
                    <button class="btn btn-primary" type="submit" name="submit">Update</button>
                </div>
                <div class="col-6 text-right">
                    <a class="btn btn-falcon-danger" href="categories.php">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include "admin_footer.php"; ?>