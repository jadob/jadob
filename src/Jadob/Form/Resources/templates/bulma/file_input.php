<?php
/**
 * @var  $formName string
 * @var  $input \Jadob\Form\Field\TextInput
 */
$inputId = $formName . '_' . $input->getName();
?>

<div class="file is-boxed">
    <label class="file-label">
        <input class="file-input" type="file" name="<?= $input->getName(); ?>">
        <span class="file-cta">
      <span class="file-icon">
        <i class="fas fa-upload"></i>
      </span>
      <span class="file-label">
        <?= $input->getLabel(); ?>
      </span>
    </span>
    </label>
</div>

