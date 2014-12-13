php-doclet
==========

php-doclet provides annotations support to PHP 5.1+ similar to Java 1.5

Lets define some annotations on Person class
```php
/**
 * This class represents person instance in the system
 *
 * @author Dmitry Bedrin mailto:Bedrin@msn.com
 */
class Person extends AnnotatedClass {

    /**
     * First name
     *
     * @var string
     * @validator.required
     * @validator.maxlength 20
     */
    public $firstName;

    /**
     * Last name
     *
     * @var string
     * @validator.required
     * @validator.maxlength 20
     */
    public $lastName;

    /**
     * Description of the person
     *
     * @var string
     * @validator.maxlength 50
     */
    public $description;

}
```

Now we can write a simple validator which will use these annotations
```php
/**
 * Validator class enables validate {@link AnnotatedClass} ancestors
 * by given annotations.
 *
 * Currently  implemented @validator.required and @validator.maxlength
 *
 * @author Dmitry Bedrin mailto:Bedrin@msn.com
 */
class Validator {

    /**
     * Validates {@link AnnotatedClass} ancestor
     *
     * @param AnnotatedClass $object
     * @return array
     */
    public function validate(AnnotatedClass $object) {
        $errorFields = array();
        $annotation = $object->getAnnotation();
        foreach ($annotation->getPropertyAnnotationsIterator() as $propertyAnnotation) {
            foreach ($propertyAnnotation->getAnnotationTagsIterator() as $annotationTag) {

                if ('validator.required' == $annotationTag->getName()) {
                    if (!$this->validateRequired($object,$propertyAnnotation->getName())) {
                        $errorFields[] = array($propertyAnnotation->getName(),'is required');
                    }
                }

                elseif ('validator.maxlength' == $annotationTag->getName()) {
                    if (!$this->validateMaxLength($object,$propertyAnnotation->getName(),$annotationTag->getValue())) {
                        $errorFields[] = array($propertyAnnotation->getName(),'maxlength exceeded');
                    }
                }

            }
        }

        return $errorFields;
    }

    /**
     * Required validation
     *
     * @param AnnotatedClass $object
     * @param string $propertyName
     * @return bool
     */
    private function validateRequired(AnnotatedClass $object,$propertyName) {
        if (empty($object->$propertyName)) {
            return false;
        }
        return true;
    }

    /**
     * Max length validation
     *
     * @param AnnotatedClass $object
     * @param string $propertyName
     * @param int $maxLength
     * @return boolean
     */
    private function validateMaxLength(AnnotatedClass $object,$propertyName,$maxLength) {
        if (!empty($object->$propertyName)) {
            $value = $object->$propertyName;
            return (strlen($value) <= $maxLength);
        }
        return true;
    }

}

// This Person instance should fail on lastName and description fields assertion
$person = new Person();
$person->firstName = 'Vasya';
$person->description = 'Hi! I am Vasya Pupkin and I forgot to fill in my last name. Suppose it will raise an error in Validator';

$validator = new Validator();
$person1ValidationErrors = $validator->validate($person);

// This person should pass validation successfully
$person = new Person();
$person->firstName = 'Vasya';
$person->lastName = 'Pupkin';

$validator = new Validator();
$person2ValidationErrors = $validator->validate($person);

// Outputing results
echo '<h1>Person 1 validation results:</h1>';
if (empty($person1ValidationErrors)) {
    echo 'OK';
}
else {
    foreach ($person1ValidationErrors as $error) {
        echo join(' ', $error) . '<br/>';
    }
}

echo '<h1>Person 2 validation results:</h1>';
if (empty($person2ValidationErrors)) {
    echo 'OK';
}
else {
    foreach ($person2ValidationErrors as $error) {
        echo join(' ', $error) . '<br/>';
    }
}
```
