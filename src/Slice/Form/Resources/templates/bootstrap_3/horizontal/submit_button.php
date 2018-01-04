<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button class="btn btn-default"
                type="<?= $input->getType(); ?>"
                name="<?= $formName; ?>[<?= $input->getName(); ?>]"
                value="<?= $input->getValue() ? $input->getValue() : '' ?>"
        ><?= $input->getLabel(); ?></button>
    </div>
</div>