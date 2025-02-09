<form action="?type=comment&action=update&id=<?= $comment->getId() ?>" class="form form-control" method="post">

    <textarea name="content" cols="30" rows="10" class="form form-control"><?= $comment->getContent() ?></textarea>

    <button type="submit" class="btn btn-success">update</button>

</form>