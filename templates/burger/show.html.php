<h1>The burger</h1>



<div class="border border-dark">
    <h3><?=  $burger->getTitle() ?></h3>
    <p><?=  $burger->getContent() ?></p>

    <a href="?type=burger&action=index" class="btn btn-secondary">Back</a>
    <a href="?type=burger&action=delete&id=<?= $burger->getId() ?>" class="btn btn-danger">Delete</a>
    <a href="?type=burger&action=update&id=<?= $burger->getId() ?>" class="btn btn-warning">Update</a>

</div>

<!--<div class="border-dark border p-5">-->
<!--    --><?php //foreach ($post->getComments() as $comment) : ?>
<!---->
<!--    <div class="border border-dark">-->
<!--        <p><strong>--><?php //= $comment->getContent() ?><!--</strong></p>-->
<!--        <a href="?type=comment&action=delete&id=--><?php //= $comment->getId() ?><!--" class="btn btn-danger" ><strong>X</strong></a>-->
<!--        <a href="?type=comment&action=update&id=--><?php //= $comment->getId() ?><!--" class="btn btn-warning" ><strong>Edit</strong></a>-->
<!---->
<!--    </div>-->
<!---->
<!---->
<!--    --><?php //endforeach ;?>
<!---->
<!--</div>-->
<!---->
<!---->
<!--<form method="post" action="?type=comment&action=add" class="form form-control">-->
<!--    <input class="form-control" type="text" name="content"  placeholder="comment">-->
<!--    <input type="hidden" name="postId" value="--><?php //= $post->getId() ?><!--">-->
<!--    <button class="btn btn-success" type="submit">Post</button>-->
<!--</form>-->
<!---->


