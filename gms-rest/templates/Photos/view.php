<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Photo $photo
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Photo'), ['action' => 'edit', $photo->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Photo'), ['action' => 'delete', $photo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $photo->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Photos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Photo'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="photos view content">
            <h3><?= h($photo->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Author') ?></th>
                    <td><?= h($photo->author) ?></td>
                </tr>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($photo->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Caption') ?></th>
                    <td><?= h($photo->caption) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($photo->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($photo->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($photo->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Size') ?></th>
                    <td><?= $this->Number->format($photo->size) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($photo->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>