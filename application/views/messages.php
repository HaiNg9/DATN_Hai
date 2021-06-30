<?php 
    $messages = $this->session->flashdata('messages');
?>
<?php if ($messages) : ?>
    <?php 
        $class = 'alert alert-';
        if ($messages['status'] === 'OK')
            $class = $class.'success';
        elseif ($messages['status'] === 'ERR')
            $class = $class.'danger';
        elseif ($messages['status'] === 'INFO')
            $class = $class.'info';
    ?>
    <div class="<?= $class ?>">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php foreach ($messages['messages'] as $error) : ?>
            <?= $error; break; ?>
        <?php endforeach ?>
    </div>
<?php endif ?>