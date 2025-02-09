<h1>The posts</h1>

<?php foreach ($posts as $post): ?>

<div class="border border-dark">
    <h3><?=  $post->getTitle() ?></h3>
    <p><?=  $post->getContent() ?></p>
    <a href="?type=post&action=show&id=<?= $post->getId() ?>" class="btn btn-primary">Read</a>

</div>





<?php endforeach; ?>



