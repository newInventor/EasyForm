<?php
/**
 * User: Ionov George
 * Date: 18.02.2016
 * Time: 17:00
 */

namespace NewInventor\EasyForm\Validator;

use NewInventor\EasyForm\Abstraction\Object;
use NewInventor\EasyForm\Abstraction\TypeChecker;
use NewInventor\EasyForm\Exception\ArgumentTypeException;
use NewInventor\EasyForm\Helper\SimpleTypes;
use NewInventor\EasyForm\Interfaces\FieldInterface;
use NewInventor\EasyForm\Settings;

class AbstractValidator extends Object implements ValidatorInterface
{
    /** @var mixed */
    public $lastValidated;
    /** @var string */
    public $message;
    /** @var \Closure */
    protected $customValidateMethod;
    /** @var FieldInterface */
    protected $field;

    /** @var bool */
    protected static $settingsInitialised = false;

    /**
     * AbstractValidator constructor.
     * @param string $message
     * @param \Closure|null $customValidateMethod
     */
    public function __construct($message = 'Ошибка в поле', \Closure $customValidateMethod = null)
    {
        $this->message = $message;
        $this->customValidateMethod = $customValidateMethod;
    }

    /**
     * @return void
     */
    public static function initSettings()
    {
        $default = include __DIR__ . '/defaultSettings.php';
        Settings::getInstance()->merge('validator', $default);
        self::$settingsInitialised = true;
    }

    /**
     * @return bool
     */
    public function isSettingsInitialised()
    {
        return self::$settingsInitialised;
    }

    /** @inheritdoc */
    public function isValid($value)
    {
        $this->lastValidated = $value;
        if (isset($this->customValidateMethod)) {
            return $this->customValidateMethod->__invoke($value);
        }

        return $this->validateValue($value);
    }

    protected function validateValue($value)
    {
        return true;
    }

    public function getError()
    {
        return $this->replaceFieldName($this->message);
    }

    protected function replaceFieldName($message)
    {
        $name = !empty($this->field->getTitle()) ? $this->field->getTitle() : $this->field->getName();

        return preg_replace('/\{f\}/', $name, $message);
    }


    /**
     * @param \Closure $customValidateMethod
     */
    public function setCustomValidateMethod(\Closure $customValidateMethod)
    {
        $this->customValidateMethod = $customValidateMethod;
    }

    /**
     * @param array $options
     * @throws ArgumentTypeException
     */
    public function setOptions(array $options)
    {
        foreach ($options as $argName => $arg) {
            TypeChecker::getInstance()
                ->isString($argName, 'argName')
                ->throwTypeErrorIfNotValid();
            $argName = 'set' . ucfirst($argName);
            $this->$argName($arg);
        }
    }

    /**
     * @param string $message
     * @return $this
     * @throws ArgumentTypeException
     */
    public function setMessage($message)
    {
        TypeChecker::getInstance()
            ->isString($message, 'message')
            ->throwTypeErrorIfNotValid();
        $this->message = $message;

        return $this;
    }

    /**
     * @param FieldInterface $field
     */
    public function field(FieldInterface $field)
    {
        $this->field = $field;
    }
}