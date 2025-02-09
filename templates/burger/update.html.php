<form action="?type=burger&action=update&id=<?= $burger->getId() ?>" method="post" class="form form-control">


    <input type="text" value="<?= $burger->getTitle() ?>" name="title"class="form-control" placeholder="title">

    <textarea  name="content" cols="30" rows="10" class="form-control"><?= $burger->getContent() ?></textarea>

    <button type="submit" class="btn btn-success">post</button>

</form>