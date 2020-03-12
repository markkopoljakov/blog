<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
    <div class="card card-body bg-light mt-5">
    <?php print_r($data); ?>
        <h2>Edit Post</h2>
        <p>Create a post with this form</p>
        <form action="<?php echo URLROOT; ?>/tagposts/addtag" method="post">
            <div class="form-group">
                <label for="title">Post id: <sup>*</sup></label>
                <input type="number" name="post_id" class="form-control form-control-lg " value="<?php echo (!empty($data->post_id)) ? $data->post_id: ''?>">
                <span class="invalid-feedback"><?php echo $data['post_id_err']; ?></span>
            </div>
            <div class="form-group">
                <p><?php echo $data['post_id']; ?></p>
                <label for="content">Tag id: <sup>*</sup></label>
                <input type="number" name="tag_id" class="form-control form-control-lg <?php echo (!empty($data['tag_id_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data->tag_id; ?>">
                <span class="invalid-feedback"><?php echo $data['tag_id_err']; ?></span>
            </div>
            <input type="submit" class="btn btn-success" value="Submit">
        </form>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>