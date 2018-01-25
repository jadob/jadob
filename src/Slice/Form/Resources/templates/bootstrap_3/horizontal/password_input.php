<?php
/**
 * @var  $formName string
 * @var  $input \Slice\Form\Field\TextInput
 */
$inputId = $formName . '_' . $input->getName();
?>
    <div class="form-group <?= $input->isValid() ? '' : 'has-error' ?>">
        <label for="<?= $inputId; ?>"
               class="text-muted control-label">
            <?= $input->getLabel(); ?>
        </label>
        <input
                id="<?= $inputId; ?>"
                type="password"
                name="<?= $formName; ?>[<?= $input->getName(); ?>]"
                value=""
                class="form-control"
            <?= $input->getRequired() ? 'required' : '' ?>
                placeholder="<?= $input->getPlaceholder(); ?>">
        <?php if (!$input->isValid()) { ?>
            <?php
            $messages = $input->getErrors();
            foreach ($messages as $message) { ?>
                <span class="help-block"><?= $message; ?></span>
            <?php } ?>
        <?php } ?>
    </div>
<?php unset($inputId);