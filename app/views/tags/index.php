<?php require_once APPROOT . '/views/inc/header.php'; ?>

    <h1>Tags</h1>
<?php foreach ($data['tags'] as $tag) : ?>
    <div style=" margin-left:100px;width:200px; height:20px;background-color:<?php echo $tag->color; ?>;" class="card card-body mb-3">
    </div>
    </div>
<?php endforeach; ?>
    <form action="<?php echo URLROOT; ?>/tags/index" method="post" >
        <div class="form-group">
            <label>Tag-Name: </label>
            <input value="<?php echo (!empty($data['info'])) ? $data ['info']: ''?>" type="text" class="form-control" placeholder="Enter tag name!">
        </div>
        <div class="form-group">
            <label>Color: </label>
            <input value="<?php echo (!empty($data['color'])) ? $data ['color']: ''?>" type="text" class="form-control" placeholder="Add color name in lowercase">
        </div>
        <button type="submit" class="btn btn-primary">Make Tag</button>
    </form>


<?php require_once APPROOT . '/views/inc/footer.php'; ?>