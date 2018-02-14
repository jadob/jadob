<?php

namespace Jadob\Form\Field;

/**
 * Description of Fieldset
 *
 * @author pizzaminded <miki@appvende.net>
 */
class Fieldset extends InputCollection {
    
    protected $legend;
    
    public function getLegend() {
        return $this->legend;
    }

    public function setLegend($legend) {
        $this->legend = $legend;
        return $this;
    }

}
