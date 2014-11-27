<?php
include_once(ANNOTATIONS_LIBRARY_DIR . '/AbstractAnnotation.php');
include_once(ANNOTATIONS_LIBRARY_DIR . '/MethodAnnotation.php');
include_once(ANNOTATIONS_LIBRARY_DIR . '/PropertyAnnotation.php');

/**
 * Represents an annotation for a class
 *
 * @author Dmitry Bedrin mailto:bedrin@msn.com
 */
final class ClassAnnotation extends AbstractLanguageAnnotation {

    private $methodAnnotations;
    private $propertyAnnotations;

    /**
     * Returns true if annotation refers to interface.
     * Otherwise returns false
     *
     * @return bool
     */
    public function isInterface() {
        return $this->getReflector()->isInterface();
    }

    /**
     * Returns true if annotatied class is abstract.
     * Otherwise returns false
     *
     * @return bool
     */
    public function isAbstract() {
        return $this->getReflector()->isAbstract();
    }

    /**
     * Returns true if annotatied class is final.
     * Otherwise returns false
     *
     * @return bool
     */
    public function isFinal() {
        return $this->getReflector()->isFinal();
    }

    /**
     * Adds new {@link MethodAnnotation} to the current class annotation
     *
     * @param MethodAnnotation $methodAnnotation
     */
    public function addMethodAnnotation(MethodAnnotation $methodAnnotation) {
        $methodAnnotation->setClassAnnotation($this);
        $this->methodAnnotations->append($methodAnnotation);
    }

    /**
     * Returns an {@link Iterator} for {@link MethodAnnotation} instances of current annotation
     *
     * @return ArrayIterator
     */
    public function getMethodAnnotationsIterator() {
        return $this->methodAnnotations->getIterator();
    }

    /**
     * Adds new {@link PropertyAnnotation} to the current class annotation
     *
     * @param PropertyAnnotation $propertyAnnotation
     */
    public function addPropertyAnnotation(PropertyAnnotation $propertyAnnotation) {
        $propertyAnnotation->setClassAnnotation($this);
        $this->propertyAnnotations->append($propertyAnnotation);
    }

    /**
     * Returns an {@link Iterator} for {@link PropertyAnnotation} instances of current annotation
     *
     * @return ArrayIterator
     */
    public function getPropertyAnnotationsIterator() {
        return $this->propertyAnnotations->getIterator();
    }

    /**
     * Returns a {@link ReflectionClass} instance for the annotated class
     *
     * @return ReflectionClass
     */
    public function getReflector() {
        return parent::getReflector();
    }

    /**
     * Creates a {@link ReflectionClass} instance for the annotated class
     *
     * @return ReflectionClass
     */
    protected  function createReflector() {
        return new ReflectionClass($this->getName());
    }

    /**
     * Creates a new ClassAnnotation instance.
     * Initializes class collections
     *
     * @return ClassAnnotation
     */
    public function __construct() {
        parent::__construct();
        $this->methodAnnotations = new ArrayObject();
        $this->propertyAnnotations = new ArrayObject();
    }

}
?>