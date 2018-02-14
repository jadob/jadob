<?php
$inputId = $formName . '_' . $input->getName();
?>
<div class="radio-input <?= $input->isValid() ? '' : 'has-error' ?>">
    <label for="<?= $inputId; ?>"><?= $input->getLabel(); ?></label>:
    <input 
        id="<?= $inputId; ?>" 
        type="radio" 
        name="<?= $formName; ?>[<?= $input->getName(); ?>]"
        <?= $input->getRequired() ? 'required' : ''?>
        value="<?= $input->getValue() ? $input->getValue() : ''?>"
        >
    
    <?php if (!$input->isValid()) { ?>
    <ul>
        <?php
        $messages = $input->getErrors();
        foreach ($messages as $message) { ?>
        <li><?= $message; ?></li>
        <?php } ?>
    </ul>
    <?php } ?>
</div>
<?php unset($inputId); ?>
