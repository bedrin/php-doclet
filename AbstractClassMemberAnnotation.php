<?php
include_once(ANNOTATIONS_LIBRARY_DIR . '/AbstractLanguageAnnotation.php');
include_once(ANNOTATIONS_LIBRARY_DIR . '/ClassAnnotation.php');

/**
 * Parent for all class members annotations: methods and properties
 *
 * @author Dmitry Bedrin mailto:bedrin@msn.com
 */
abstract class AbstractClassMemberAnnotation extends AbstractLanguageAnnotation {

    private $classAnnotation;

    /**
     * Returns {@link ClassAnnotation} of the object current member belongs to
     *
     * @return ClassAnnotation
     */
    public function getClassAnnotation(){
       return $this->classAnnotation;
    }

    /**
     * Sets {@link ClassAnnotation} of the object current member belongs to
     *
     * @param ClassAnnotation $classAnnotation
     */
    public function setClassAnnotation(ClassAnnotation $classAnnotation) {
        $this->classAnnotation = $classAnnotation;
    }

    /**
     * Returns true if annotated class member is static
     * Otherwise returns false
     *
     * @return bool
     */
    public function isStatic() {
        return $this->getReflector()->isStatic();
    }

    /**
     * Returns true if annotated class member access is public
     * Otherwise returns false
     *
     * @return bool
     */
    public function isPublic() {
        return $this->getReflector()->isPublic();
    }

    /**
     * Returns true if annotated class member access is protected
     * Otherwise returns false
     *
     * @return bool
     */
    public function isProtected() {
        return $this->getReflector()->isProtected();
    }

    /**
     * Returns true if annotated class member access is private
     * Otherwise returns false
     *
     * @return bool
     */
    public function isPrivate() {
        return $this->getReflector()->isPrivate();
    }

}
?>