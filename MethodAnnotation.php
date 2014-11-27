<?php
include_once(ANNOTATIONS_LIBRARY_DIR . '/AbstractClassMemberAnnotation.php');

/**
 * Represents an annotation for a class method
 *
 * @author Dmitry Bedrin mailto:bedrin@msn.com
 */
final class MethodAnnotation extends AbstractClassMemberAnnotation {

    /**
     * Returns true if annotatied method is abstract.
     * Otherwise returns false
     *
     * @return bool
     */
    public function isAbstract() {
        return $this->getReflector()->isAbstract();
    }

    /**
     * Returns true if annotatied method is final.
     * Otherwise returns false
     *
     * @return bool
     */
    public function isFinal() {
        return $this->getReflector()->isFinal();
    }

    /**
     * Returns true if annotatied method is constructor.
     * Otherwise returns false
     *
     * @return bool
     */
    public function isConstructor() {
        return $this->getReflector()->isConstructor();
    }

    /**
     * Returns true if annotatied method is destructor.
     * Otherwise returns false
     *
     * @return bool
     */
    public function isDestructor() {
        return $this->getReflector()->isDestructor();
    }

    /**
     * Returns a {@link ReflectionMethod} instance for the annotated method
     *
     * @return ReflectionMethod
     */
    public function getReflector() {
        return parent::getReflector();
    }

    /**
     * Creates a {@link ReflectionMethod} instance for the annotated method
     *
     * @return ReflectionMethod
     */
    protected  function createReflector() {
        return new ReflectionMethod($this->getClassAnnotation()->getName(),$this->getName());
    }

    /**
     * Class cast argument to MethodAnnotation class
     *
     * @param MethodAnnotation $methodAnnotation
     * @return MethodAnnotation
     */
    public final static function cast(MethodAnnotation $methodAnnotation) {
        return $methodAnnotation;
    }

}
?>