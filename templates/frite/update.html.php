<form action="?type=frite&action=update&id=<?= $frite->getId() ?>" method="post" class="form form-control">


    <input type="text" value="<?= $frite->getTitle() ?>" name="title"class="form-control" placeholder="title">

    <textarea  name="content" cols="30" rows="10" class="form-control"><?= $frite->getContent() ?></textarea>

    <button type="submit" class="btn btn-success">post</button>

</form>