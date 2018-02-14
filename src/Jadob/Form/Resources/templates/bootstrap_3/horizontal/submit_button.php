<div class="form-group">
    <button class="btn btn-default"
            type="<?= $input->getType(); ?>"
            name="<?= $formName; ?>[<?= $input->getName(); ?>]"
            value="<?= $input->getValue() ? $input->getValue() : '' ?>"
    ><?= $input->getLabel(); ?></button>
</div>