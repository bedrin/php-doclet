<?php
include_once(ANNOTATIONS_LIBRARY_DIR . '/AbstractAnnotation.php');
include_once(ANNOTATIONS_LIBRARY_DIR . '/AnnotationTag.php');

/**
 * Parent for all annotations for language constructions: classes, methods, properties
 *
 * @author Dmitry Bedrin mailto:bedrin@msn.com
 */
abstract class AbstractLanguageAnnotation extends AbstractAnnotation {

    private $annotationTags;
    private $reflector;

    /**
     * Adds new {@link AnnotationTag} to the current language construction annotation
     *
     * @param AnnotationTag $annotationTag
     */
    public function addAnnotationTag(AnnotationTag $annotationTag) {
        $annotationTag->setLanguageConstructionAnnotation($this);
        $this->annotationTags->append($annotationTag);
    }

    /**
     * Returns an {@link Iterator} for {@link AnnotationTag} instances of current annotation
     *
     * @return ArrayIterator
     */
    public function getAnnotationTagsIterator() {
        return $this->annotationTags->getIterator();
    }

    /**
     * Initializes class collections
     */
    public function __construct() {
        $this->annotationTags = new ArrayObject();
    }

    /**
     * Returns an {@link Reflector} implementation for current language construction
     *
     * @return Reflector
     */
    public function getReflector() {
        if (null == $this->reflector) {
            $this->reflector = $this->createReflector();
        }
        return $this->reflector;
    }

    /**
     * Creates an {@link Reflector} implementation for current language construction
     *
     * @return Reflector
     */
    abstract protected function createReflector();

}
?>