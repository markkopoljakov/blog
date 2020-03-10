<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <h1>Posts</h1>
<?php foreach ($data['posts'] as $post) : ?>
    <div class="card card-body mb-3">
        <h3 class="card-title"><?php echo $post->post_title; ?></h3>
        <div class="bg-light p-2 mb-3">Created by <?php echo $post->user_id; ?> at <?php echo $post->post_created; ?></div>
        <p class="card-text"><?php echo $post->post_content; ?></p>
        <?php foreach ($post->tags as $tag) : ?>
        <div><?php echo $tag->tagInfo; ?></div>
<?php endforeach; ?>

    </div>
    <a href=" <?php URLROOT;?>/posts/show/ <?php echo $post->postId; ?>">Edit</a>
<?php endforeach; ?>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>