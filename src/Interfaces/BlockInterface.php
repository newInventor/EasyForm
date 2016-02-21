<?php

namespace NewInventor\EasyForm\Interfaces;

use NewInventor\EasyForm\Field\Select;
use NewInventor\EasyForm\Field\TextArea;

interface BlockInterface extends FormObjectInterface
{
    /**
     * @param string $name
     * @param string $title
     *
     * @return BlockInterface
     */
    public function block($name, $title = '');

    /**
     * @param FieldInterface $field
     *
     * @return FieldInterface
     */
    public function field($field);

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function button($name, $value = '');

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function checkbox($name, $value = '');

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function file($name, $value = '');

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function hidden($name, $value = '');

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function image($name, $value = '');

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function password($name, $value = '');

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function radio($name, $value = '');

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function reset($name, $value = '');

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function submit($name, $value = '');

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function text($name, $value = '');

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function color($name, $value = '');

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function date($name, $value = '');

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function datetime($name, $value = '');

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function datetimeLocal($name, $value = '');

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function email($name, $value = '');

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function number($name, $value = '');

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function range($name, $value = '');

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function search($name, $value = '');

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function tel($name, $value = '');

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function time($name, $value = '');

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function url($name, $value = '');

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function month($name, $value = '');

    /**
     * @param string $name
     * @param string $value
     *
     * @return FieldInterface
     */
    public function week($name, $value = '');


    /**
     * @param string            $name
     * @param string|array|null $value
     *
     * @return Select
     */
    public function select($name, $value = null);

    /**
     * @param string $name
     * @param string $value
     *
     * @return TextArea
     */
    public function textArea($name, $value = '');

    /**
     * @param null|array $data
     *
     * @return bool
     */
    public function load($data = null);
}