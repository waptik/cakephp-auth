<?php
    /**
     * @var \App\View\AppView $this
     * @var \App\Model\Entity\User $user
     */
?>
<div class="row">
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user, ['url' => ['action'=> 'update_password']]) ?>
            <fieldset>
                <legend><?= __('Change your password') ?></legend>
                <?php
                    echo  $this->Form->label("old", "Your current password");
                    echo $this->Form->password('old', ['label' => 'Current Password']);
echo $this->Form->label("new", "Your new passowrd");
                    echo $this->Form->password('new', ['label' => 'New Password']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
