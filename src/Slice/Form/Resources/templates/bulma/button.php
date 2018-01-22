<div class="field">
    <p class="control">
        <button class="button is-primary"
            type="<?= $input->getType(); ?>"
            name="<?= $formName; ?>[<?= $input->getName(); ?>]"
            value="<?= $input->getValue() ? $input->getValue() : '' ?>"
        ><?= $input->getLabel(); ?></button>

    </p>
</div>