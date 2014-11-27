<?php
include_once(ANNOTATIONS_LIBRARY_DIR . '/ClassAnnotation.php');
include_once(ANNOTATIONS_LIBRARY_DIR . '/AnnotationFactory.php');

/**
 * This class serves as a parent for all annotated classes.
 * Lets retrieve {@link ClassAnnotation} instance by calling getAnnotation() method
 *
 * @author Dmitry Bedrin mailto:bedrin@msn.com
 */
abstract class AnnotatedClass {

    /**
     * returns {@link ClassAnnotation} instance for current class
     *
     * @return ClassAnnotation
     */
    public function getAnnotation() {
        return AnnotationFactory::getAnnotation(get_class($this));
    }


}
?>