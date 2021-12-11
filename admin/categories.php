<?php
include "admin_header.php";

// Categories List
function categories()
{
    global $db_connect;

    $get_categories = "SELECT * FROM categories ORDER BY category_id ASC";
    $res_categories = mysqli_query($db_connect, $get_categories);
    while ($row = mysqli_fetch_assoc($res_categories)) {
        $category_id = $row['category_id'];
        $category_name = $row['category_name'];

        echo "
            <tr class='btn-reveal-trigger'>
                <td class='align-middle text-center text-black'>" . $category_id . "</td>
                <td class='align-middle text-center text-black'>" . $category_name . "</td>
                <td class='align-middle text-center'>
                    <a class='btn btn-secondary btn-sm mr-2' href='edit_category.php?id=" . $category_id . "'><span class='fas fa-edit'></span> Edit</a>
                    <a class='btn btn-danger btn-sm' href='delete_category.php?id=" . $category_id . "'><span class='fas fa-trash'></span> Delete</a>
                </td>
            </tr>
        ";
    }
}

// Create New Category
function new_category()
{
    if (isset($_POST['create_category'])) {
        global $db_connect;

        $category_name = $_POST['category_name'];

        $insert = "INSERT INTO categories(category_name) VALUES ('$category_name')";
        $result = mysqli_query($db_connect, $insert);
        if (!$result) {
            die("Error: " . mysqli_error($db_connect));
        } else {
            header("Location: categories.php");
        }
    }
}

// Calling functions
new_category();
?>

<div class="card mb-3">
    <div class="card-header bg-dark mb-3">
        <div class="row align-items-center justify-content-between">
            <div class="col-6 col-sm-auto d-flex align-items-center pr-0">
                <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0 text-white">Categories</h5>
            </div>
            <div class="col-6 col-sm-auto ml-auto text-right pl-0">
                <div id="dashboard-actions">
                    <button class="btn btn-falcon-primary btn-sm" type="button" data-toggle="modal" data-target="#newCategory">New</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="dashboard-data-table">
            <table id="uni_list_table" class="table table-striped table-bordered table-sm table-hover fs--1 data-table border-bottom" data-options='{"responsive":false,"pagingType":"simple","lengthChange":false,"searching":false,"pageLength":7,"columnDefs":[{"targets":[0,5],"orderable":true}],"language":{"info":"_START_ to _END_ Items of _TOTAL_ "},"buttons":["copy","excel"]}'>
                <thead class="bg-dark text-white font-weight-bold">
                    <tr>
                        <th class="sort pr-1 align-middle text-center" width="5%">ID</th>
                        <th class="sort pr-1 align-middle text-center" width="75%">Category Name</th>
                        <th class="sort pr-1 align-middle text-center" width="20%">Action</th>
                    </tr>
                </thead>
                <tbody id="purchases">
                    <?php
                    categories();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- New Article Modal -->
<div class="modal fade" id="newCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <input class="form-control" type="text" name="category_name" id="category_name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary btn-sm" type="submit" name="create_category">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "admin_footer.php"; ?>