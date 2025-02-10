<h1>The frite</h1>



<div class="border border-dark">
    <h3><?=  $frite->getTitle() ?></h3>
    <p><?=  $frite->getContent() ?></p>

    <a href="?type=frite&action=index" class="btn btn-secondary">Back</a>
    <a href="?type=frite&action=delete&id=<?= $frite->getId() ?>" class="btn btn-danger">Delete</a>
    <a href="?type=frite&action=update&id=<?= $frite->getId() ?>" class="btn btn-warning">Update</a>

</div>

<div class="border-dark border p-5">
    <?php foreach ($frite->getComments() as $comment) : ?>

    <div class="border border-dark">
        <p><strong><?= $comment->getContent() ?></strong></p>
        <a href="?type=comment&action=delete&id=<?= $comment->getId() ?>" class="btn btn-danger" ><strong>X</strong></a>
        <a href="?type=comment&action=update&id=<?= $comment->getId() ?>" class="btn btn-warning" ><strong>Edit</strong></a>

    </div>


    <?php endforeach ;?>

</div>


<form method="post" action="?type=comment&action=add" class="form form-control">
    <input class="form-control" type="text" name="content"  placeholder="comment">
    <input type="hidden" name="postId" value="<?= $frite->getId() ?>">
    <button class="btn btn-success" type="submit">Post</button>
</form>



