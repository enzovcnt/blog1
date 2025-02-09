<form action="?type=post&action=update&id=<?= $post->getId() ?>" method="post" class="form form-control">


    <input type="text" value="<?= $post->getTitle() ?>" name="title"class="form-control" placeholder="title">

    <textarea  name="content" cols="30" rows="10" class="form-control"><?= $post->getContent() ?></textarea>

    <button type="submit" class="btn btn-success">post</button>

</form>