<?php
/**
 * @var  $formName string
 * @var  $input \Jadob\Form\Field\TextInput
 */
$inputId = $formName . '_' . $input->getName();
?>
    <div class="field">
        <label  for="<?= $inputId; ?>" class="label"><?= $input->getLabel(); ?></label>
        <div class="control">
            <input
                id="<?= $inputId; ?>"
                name="<?= $formName; ?>[<?= $input->getName(); ?>]"
                value="<?= $input->getValue() ?: '' ?>"
                <?= $input->getRequired() ? 'required' : '' ?>
                class="input <?= $input->isValid() ? '' : 'is-danger' ?>"
                type="text"
                placeholder="<?= $input->getPlaceholder(); ?>">
        </div>

<?php if (!$input->isValid()) { ?>
        <?php
        $messages = $input->getErrors();
        foreach ($messages as $message) { ?>
            <p class="help is-danger"><?= $message; ?></p>
        <?php } ?>
<?php } ?>
    </div>
<?php unset($inputId);