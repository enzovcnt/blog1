<h1>The burgers</h1>

<?php foreach ($burgers as $burger): ?>

<div class="border border-dark">
    <h3><?=  $burger->getTitle() ?></h3>
    <p><?=  $burger->getContent() ?></p>
    <a href="?type=burger&action=show&id=<?= $burger->getId() ?>" class="btn btn-primary">Read</a>

</div>





<?php endforeach; ?>



