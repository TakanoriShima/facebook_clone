<?php if($errors !== null): ?>
<div class="row mt-2 text-danger">
    <ul class="offset-sm-2 col-sm-8">
    <?php foreach($errors as $error): ?>
        <li><?= $error ?></li>
    <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>