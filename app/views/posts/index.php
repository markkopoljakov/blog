<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <h1>Posts</h1>
    <a href="<?php URLROOT;?>posts/add/">Add</a>
    <a href="<?php URLROOT;?>tags">Make tag</a>
<?php foreach ($data['posts'] as $post) : ?>
    <div class="card card-body mb-3">
        <a href=" <?php URLROOT;?>Tagposts/addtag/<?php echo $data->postId; ?>">Edit tag</a>
        <h3 class="card-title"><?php echo $post->post_title; ?></h3>
        <p>Post id:<?php echo $post->postId ?></p>
        <div class="bg-light p-2 mb-3">Created by <?php echo $post->user_id; ?> at <?php echo $post->post_created; ?></div>
        <p class="card-text"><?php echo $post->post_content; ?></p>
        tags:
        <a href=" <?php URLROOT;?>posts/show/<?php echo $post->postId; ?>">Edit</a>

    <?php foreach ($post->tags as $tag) : ?>
    <div style="width: 100px;background-color:<?php echo $tag->color;?> "><?php echo $tag->info;?></div>
    <?php endforeach; ?>
    </div>


<?php endforeach; ?>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>