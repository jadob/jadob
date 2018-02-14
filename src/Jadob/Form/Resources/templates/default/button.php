<button
    type="<?= $input->getType(); ?>"
    name="<?= $formName; ?>[<?= $input->getName(); ?>]"
    value="<?= $input->getValue() ? $input->getValue() : '' ?>"
    ><?= $input->getLabel(); ?></button>
