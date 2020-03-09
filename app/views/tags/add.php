<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <h1>Tags</h1>
    <form action="<?php echo URLROOT; ?>/tags/add" method="post" >
        <div class="form-group">
            <label>Tag-Name: </label>
            <input name="info" value="<?php echo (!empty($data['info'])) ? $data ['info']: ''?>" type="text" class="form-control" placeholder="Enter tag name!">
        </div>
        <div class="form-group">
            <label>Color: </label>
            <input name="color" value="<?php echo (!empty($data['color'])) ? $data ['color']: ''?>" type="text" class="form-control" placeholder="Add color name in lowercase">
        </div>
        <button type="submit" class="btn btn-primary">Make Tag</button>
    </form>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>