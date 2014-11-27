<?php
include_once(ANNOTATIONS_LIBRARY_DIR . '/AbstractDocAnnotation.php');
include_once(ANNOTATIONS_LIBRARY_DIR . '/AnnotationTag.php');

/**
 * Represents an annotation attribute for an annotation tag
 *
 * @author Dmitry Bedrin mailto:bedrin@msn.com
 */
final class AnnotationAttribute extends AbstractDocAnnotation {

    private $annotationTag;

    /**
     * Gets the {@link AnnotationTag} this attribute belongs to
     *
     * @return AnnotationTag
     */
    public function getAnnotationTag() {
        return $this->annotationTag;
    }

    /**
     * Sets the {@link AnnotationTag} this attribute belongs to
     *
     * @param AnnotationTag $annotationTag
     */
    public function setAnnotationTag(AnnotationTag $annotationTag) {
        $this->annotationTag = $annotationTag;
    }

}
?>