<?php require_once APPROOT . '/views/inc/header.php'; ?>

<?php foreach ($data['tag'] as $tags) : ?>
    <div style=" margin-top: 10px; margin-left:10px;width:200px; height:20px;background-color:<?php echo $tag->color; ?>;" class="card card-body mb-3">
        <p><?php echo $tags->info; ?></p>
    </div>
<?php endforeach; ?>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>