<h1>The frites</h1>

<?php foreach ($frites as $frite): ?>

<div class="border border-dark">
    <h3><?=  $frite->getTitle() ?></h3>
    <p><?=  $frite->getContent() ?></p>
    <a href="?type=frite&action=show&id=<?= $frite->getId() ?>" class="btn btn-primary">Read</a>

</div>





<?php endforeach; ?>



