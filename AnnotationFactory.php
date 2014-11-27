<?php
include_once(ANNOTATIONS_LIBRARY_DIR . '/AbstractLanguageAnnotation.php');
include_once(ANNOTATIONS_LIBRARY_DIR . '/ClassAnnotation.php');
include_once(ANNOTATIONS_LIBRARY_DIR . '/MethodAnnotation.php');
include_once(ANNOTATIONS_LIBRARY_DIR . '/PropertyAnnotation.php');
include_once(ANNOTATIONS_LIBRARY_DIR . '/AnnotationTag.php');
include_once(ANNOTATIONS_LIBRARY_DIR . '/AnnotationAttribute.php');

/**
 * Factory for creating{@link ClassAnnotation} objects
 *
 * @author Dmitry Bedrin mailto:bedrin@msn.com
 */
class AnnotationFactory {

    private static $annotationInstances;

    /**
     * Creates a new {@link ClassAnnotation} instance, or takes it from object pool
     *
     * @param string $className
     */
    public static function getAnnotation($className) {
        if (null == self::$annotationInstances[$className]) {
            self::$annotationInstances[$className] = self::createAnnotation($className);
        }
        return self::$annotationInstances[$className];
    }

    /**
     * Creates a new {@link ClassAnnotation} instance
     *
     * @param string $className
     */
    public static function createAnnotation($className) {
        return self::createClassAnnotation($className);
    }

    /**
     * Builds {@link ClassAnnotation} object
     *
     * @param string $className
     * @return ClassAnnotation
     */
    protected static function createClassAnnotation($className) {
        $classAnnotation = new ClassAnnotation();
        $classAnnotation->setName($className);

        $class = new ReflectionClass($className);

        $methods = $class->getMethods();
        foreach ($methods as $method) {
            $classAnnotation->addMethodAnnotation(self::createMethodAnnotation($method));
        }

        $properties = $class->getProperties();
        foreach ($properties as $property) {
            $classAnnotation->addPropertyAnnotation(self::createPropertyAnnotation($property));
        }

        self::createAnnotationTags($classAnnotation);

        return $classAnnotation;
    }

    /**
     * Builds {@link MethodAnnotation} object
     *
     * @param ReflectionMethod $method
     * @return MethodAnnotation
     */
    protected static function createMethodAnnotation(ReflectionMethod $method) {
        $methodAnnotation = new MethodAnnotation();

        $methodAnnotation->setName($method->getName());
        $methodAnnotation->setContent($method->getDocComment());

        self::createAnnotationTags($methodAnnotation);

        return $methodAnnotation;
    }

    /**
     * Builds {@link PropertyAnnotation} object
     *
     * @param ReflectionProperty $property
     * @return PropertyAnnotation
     */
    protected static function createPropertyAnnotation(ReflectionProperty $property) {
        $propertyAnnotation = new PropertyAnnotation();

        $propertyAnnotation->setName($property->getName());
        $propertyAnnotation->setContent($property->getDocComment());

        self::createAnnotationTags($propertyAnnotation);

        return $propertyAnnotation;
    }

    /**
     * Builds {@link AnnotationTag} collection for given {@link AbstractLanguageAnnotation}
     *
     * @param AbstractLanguageAnnotation $languageConstructionAnnotation
     */
    protected static function createAnnotationTags(AbstractLanguageAnnotation $languageConstructionAnnotation) {
        preg_match_all('/^[^\*]*\*\s*@([^\s]+)\s+(.*)$/m',$languageConstructionAnnotation->getContent(),$tags);
        for ($i = 0; $i < sizeof($tags[1]); $i++) {
            $annotationTag = new AnnotationTag();
            $annotationTag->setContent($tags[0][$i]);
            $annotationTag->setName($tags[1][$i]);
            $annotationTag->setValue($tags[2][$i]);
            self::createAnnotationAttributes($annotationTag);
            $languageConstructionAnnotation->addAnnotationTag($annotationTag);
        }
    }

    /**
     * Builds {@link AnnotationAttribute} collection for given {@link AnnotationTag}
     *
     * @param AnnotationTag $annotationTag
     */
    protected static function createAnnotationAttributes(AnnotationTag $annotationTag) {
        if (strpos($annotationTag->getValue(),'="') > -1) {
            preg_match_all('/\s*([^\s]+)="([^"]+)"/',$annotationTag->getValue(),$attributes);
            for ($i = 0; $i < sizeof($attributes[1]); $i++) {
                $annotationAttribute = new AnnotationAttribute();
                $annotationAttribute->setContent($attributes[0][$i]);
                $annotationAttribute->setName($attributes[0][$i]);
                $annotationAttribute->setValue($attributes[0][$i]);
                $annotationTag->addAnnotationAttribute($annotationAttribute);
            }
        }
    }



}
?>