<?php
include_once(ANNOTATIONS_LIBRARY_DIR . '/AbstractClassMemberAnnotation.php');

/**
 * Represents an annotation for a class property
 *
 * @author Dmitry Bedrin mailto:bedrin@msn.com
 */
final class PropertyAnnotation extends AbstractClassMemberAnnotation {

    /**
     * Returns true if annotatied property was initialized on creation
     * Otherwise returns false
     *
     * @return bool
     */
    public function isDefault() {
        return $this->getReflector()->isDefault();
    }

    /**
     * Returns a {@link ReflectionProperty} instance for the annotated property
     *
     * @return ReflectionProperty
     */
    public function getReflector() {
        return parent::getReflector();
    }

    /**
     * Creates a {@link ReflectionProperty} instance for the annotated property
     *
     * @return ReflectionProperty
     */
    protected  function createReflector() {
        return new ReflectionProperty($this->getClassAnnotation()->getName(),$this->getName());
    }

    /**
     * Class cast argument to PropertyAnnotation class
     *
     * @param PropertyAnnotation $propertyAnnotation
     * @return PropertyAnnotation
     */
    public final static function cast(PropertyAnnotation $propertyAnnotation) {
        return $propertyAnnotation;
    }


}
?>