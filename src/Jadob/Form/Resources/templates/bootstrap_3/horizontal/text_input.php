<?php
/**
 * @var  $formName string
 * @var  $input \Jadob\Form\Field\TextInput
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
                type="text"
                name="<?= $formName; ?>[<?= $input->getName(); ?>]"
                value="<?= $input->getValue() ?: '' ?>"
                class="form-control <?=$input->getClass(); ?>"
            <?= $input->getRequired() ? 'required' : '' ?>
                placeholder="<?= $input->getPlaceholder(); ?>">
        <?php if (!$input->isValid()) { ?>
                <?php
                $messages = $input->getErrors();
                foreach ($messages as $message) { ?>
                    <span class="help-block"><?= $translator->trans($message); ?></span>
                <?php } ?>
        <?php } ?>
    </div>
<?php unset($inputId);