<?php
include_once(ANNOTATIONS_LIBRARY_DIR . '/AbstractAnnotation.php');

/**
 * Parent for all annotations for phpDoc constructions: annotation tags, and their attributes
 *
 * @author Dmitry Bedrin mailto:bedrin@msn.com
 */
abstract class AbstractDocAnnotation extends AbstractAnnotation {

    private $value;

    /**
     * Returns the value of the current annotaion
     *
     * @return string
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * Sets the value of the current annotation
     *
     * @param string $value
     */
    public function setValue($value) {
        $this->value = $value;
    }

}
?>