<?php
include_once(ANNOTATIONS_LIBRARY_DIR . '/AbstractDocAnnotation.php');
include_once(ANNOTATIONS_LIBRARY_DIR . '/AbstractLanguageAnnotation.php');
include_once(ANNOTATIONS_LIBRARY_DIR . '/AnnotationAttribute.php');

/**
 * Represents an annotation tag for any language construction annotation
 *
 * @author Dmitry Bedrin mailto:bedrin@msn.com
 */
final class AnnotationTag extends AbstractDocAnnotation {

    private $languageConstructionAnnotation;
    private $annotationAttributes;

    /**
     * Sets the language construction annotation, this tag belongs to
     *
     * @param AbstractLanguageAnnotation $languageConstructionAnnotation
     */
    public function setLanguageConstructionAnnotation(AbstractLanguageAnnotation $languageConstructionAnnotation) {
        $this->languageConstructionAnnotation = $languageConstructionAnnotation;
    }

    /**
     * Returns the language construction annotation, this tag belongs to
     *
     * @return AbstractLanguageAnnotation
     */
    public function getLanguageConstructionAnnotation() {
        return $this->languageConstructionAnnotation;
    }

    /**
     * Adds new {@link AnnotationAttribute} to the current annotation tag
     *
     * @param  AnnotationAttribute $annotationAttribute
     */
    public function addAnnotationAttribute(AnnotationAttribute $annotationAttribute) {
        $annotationAttribute->setAnnotationTag($this);
        $this->annotationAttributes->append($annotationAttribute);
    }

    /**
     * Returns an {@link Iterator} for {@link AnnotationAttribute} instances of current annotation tag
     *
     * @return ArrayIterator
     */
    public function getAnnotationAttributesIterator() {
        return $this->annotationAttributes->getIterator();
    }

    /**
     * Creates a new AnnotationTag instance.
     * Initializes class collections
     *
     * @return AnnotationTag
     */
    public function __construct() {
        $this->annotationAttributes = new ArrayObject();
    }

    /**
     * Class cast argument to AnnotationTag class
     *
     * @param AnnotationTag $annotationTag
     * @return AnnotationTag
     */
    public final static function cast(AnnotationTag $annotationTag) {
        return $annotationTag;
    }

}
?>