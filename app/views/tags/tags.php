<?php require_once APPROOT . '/views/inc/header.php'; ?>

    <h1>Tags1</h1>
<?php foreach ($data['tags'] as $tag) : ?>
    <div style=" margin-left:100px;width:200px; height:20px;background-color:<?php echo $tag->color; ?>;" class="card card-body mb-3">
    </div>
    </div>
<?php endforeach; ?>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>