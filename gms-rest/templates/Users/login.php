<?php

use App\View\AppView;

?>
<div class="users form">
    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your email and password') ?></legend>
        <?= /** @var AppView $this */
        $this->Form->control('usr') ?>
        <?= $this->Form->control('pwd') ?>
    </fieldset>
    <?= $this->Form->button(__('Login')); ?>
    <?= $this->Form->end() ?>
</div>
