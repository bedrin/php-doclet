<?php
/**
 * Parent for all annotation entity classes
 *
 * @author Dmitry Bedrin mailto:bedrin@msn.com
 */
abstract class AbstractAnnotation {

    private $name;
    private $content;

    /**
     * Retrieves the name of the annotation target
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Sets the name of the annotation
     *
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Retrieves the content of the annotation
     *
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Sets the content of the annotation
     *
     * @param string $content
     */
    public function setContent($content) {
        $this->content = $content;
    }

}
?>