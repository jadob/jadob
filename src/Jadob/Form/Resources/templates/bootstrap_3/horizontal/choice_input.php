<?php
/** @var \Jadob\Form\Field\ChoiceInput $input */
//@TODO: adding selected/checked values
$inputId = $formName . '_' . $input->getName();
$isRequiredDefined = false;
/** @var \Symfony\Component\Translation\Translator $translator */
?>
    <div class="choice-type form-group <?= $input->isValid() ? '' : 'has-error' ?>">
        <label class="text-muted control-label" for="<?= $inputId; ?>"><?= $input->getLabel(); ?></label>
        <?php /** okay, so at first we need to know what we need to render **/ ?>
        <?php if ($input->getExpanded()) { //render inputs ?>
            <?php foreach ($input->getValues() as $key => $value) { ?>
                <div class="<?= /** @noinspection DisconnectedForeachInstructionInspection */
                $input->getMultiple() ? 'checkbox' : 'radio' ?><?= /** @noinspection DisconnectedForeachInstructionInspection */
                $input->getOrientation() === 'vertical' ? '-inline' : '' ?>">
                    <label class="control-label text-muted"><input
                                name="<?= $formName; ?>[<?= $input->getName(); ?>]<?= /** @noinspection DisconnectedForeachInstructionInspection */
                                $input->getMultiple() ? '[]' : '' ?>"
                                type="<?= /** @noinspection DisconnectedForeachInstructionInspection */
                                $input->getMultiple() ? 'checkbox' : 'radio' ?>"
                                value="<?= $key ?>"
                        ><?= $value ?></label>
                </div>

            <?php } ?>
        <?php } else { // render select form ?>

            <select class="form-control <?= $input->getClass() ?>" <?= $input->getRequired() ? 'required' : '' ?> <?= $input->getMultiple() ? 'multiple' : '' ?>
                    id="<?= $inputId; ?>"
                    name="<?= $formName; ?>[<?= $input->getName(); ?>]<?= $input->getMultiple() ? '[]' : '' ?>">
                <?php foreach ($input->getValues() as $key => $value) { ?>

                    <?php if($input->getMultiple()) {
                        $checked = in_array($key, $input->getValue());
                    } else {
                        /** @noinspection TypeUnsafeComparisonInspection */
                        $checked = $key == $input->getValue();
                    } ?>
                    <option value="<?= $key; ?>" <?= $checked ? 'selected' : '' ?>><?= $translator->trans($value); ?></option>
                <?php } ?>
            </select>
        <?php } ?>
        <?php if (!$input->isValid()) { ?>
            <?php
            $messages = $input->getErrors();
            foreach ($messages as $message) { ?>
                <span class="help-block"><?= $message; ?></span>
            <?php } ?>
        <?php } ?>
    </div>
<?php unset($inputId, $isRequiredDefined); ?>