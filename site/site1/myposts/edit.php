<?php
require_once('../config.php');
require_once(BASE_PATH . '/logic/posts.php');
require_once(BASE_PATH . '/logic/tags.php');
require_once(BASE_PATH . '/logic/categories.php');
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
$q = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';

function getUrl($page, $q)
{
    return "edit.php?page=$page&q=$q";
}
// function getPostID(){

// $url = 'http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
// $url_components = parse_url($url);
// parse_str($url_components['query'], $params);

// return $params['id'];


// }
$tags = getTags();
$showdata=displayDataToBeEdited($_REQUEST['id']);
$data = $showdata[0];
$categories = getCategories();
if (isset($_REQUEST['title'])) {
    $errors = validatePostCreate($_REQUEST);
    if (count($errors) == 0) {

        if (editMyPost($_REQUEST, $_REQUEST['id'], getUploadedImage($_FILES))) {
            header('Location:index.php');
            die();
        } else {
            $generic_error = "Error while adding the post";
        }
    }
}

require_once(BASE_PATH . '/layout/header.php');
var_export($data);
?>

<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="heading-page header-text">
    <section class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-content">
                        <h4>Edit Post</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Banner Ends Here -->
<section class="blog-posts">
    <div class="container">
<h1>
</h1>
        <div class="row">
            <div class="col-lg-12">
                <div class="all-blog-posts">
                    <div class="row">
                        <div class="col-sm-12">
                            <form method="POST" enctype="multipart/form-data">

                                <input name="title" placeholder="title" class="form-control" value =<?= $data['title'];?> />

                                <?= isset($errors['title']) ? "<span class='text-danger'>" . $errors['title'] . "</span>" : "" ?>

                                <textarea name="content" placeholder="content" class="form-control" ><?= $data['content'];?></textarea>
                                <?= isset($errors['content']) ? "<span class='text-danger'>" . $errors['content'] . "</span>" : "" ?>

                                <label>Upload Image<input type="file" name="image" /></label><br />
                                <?= isset($errors['image']) ? "<span class='text-danger'>" . $errors['image'] . "</span>" : "" ?>

                                <label>Publish date<input type="date" name="publish_date" class="form-control" value =<?= $data['publish_date'];?>></label>
                                <?= isset($errors['publish_date']) ? "<span class='text-danger'>" . $errors['publish_date'] . "</span>" : "" ?>

                                <select name="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    <?php
                                    foreach ($categories as $category) {
                                        echo "<option value='{$category['id']}'>{$category['name']}</option>";
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['category_id']) ? "<span class='text-danger'>" . $errors['category_id'] . "</span>" : "" ?> 
                                <select name="tags[]" multiple class="form-control">
                                    <?php
                                    foreach ($tags as $tag) {
                                        echo "<option value='{$tag['id']}'>{$tag['name']}</option>";
                                    }
                                    ?>
                                </select>
                                <?= isset($errors['tags']) ? "<span class='text-danger'>" . $errors['tags'] . "</span>" : "" ?>                           
                                <button class="btn btn-success">Save</button>
                                <a href="index.php" class="btn btn-danger">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once(BASE_PATH . '/layout/footer.php') ?>