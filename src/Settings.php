<?php
/**
 * User: Ionov George
 * Date: 17.03.2016
 * Time: 9:04
 */

namespace NewInventor\EasyForm;

use NewInventor\EasyForm\Abstraction\SingletonTrait;
use NewInventor\EasyForm\Exception\ArgumentTypeException;
use NewInventor\EasyForm\Helper\ArrayHelper;

class Settings
{
    use SingletonTrait;
    /** @var array */
    private static $settings;

    protected function __construct()
    {
        self::$settings = include(dirname(__FILE__) . '/config/main.php');
    }

    /**
     * @param string|int|array $route
     * @param mixed $default
     * @return mixed
     * @throws ArgumentTypeException
     */
    public function get($route, $default = null)
    {
        return ArrayHelper::get(self::$settings, $route, $default);
    }

    /**
     * @param string|int|array $route
     * @param mixed $value
     * @throws ArgumentTypeException
     */
    public function set($route, $value)
    {
        self::$settings = ArrayHelper::set(self::$settings, $route, $value);
    }

    /**
     * @param string|int|array $route
     * @param array $data
     * @throws ArgumentTypeException
     */
    public function merge($route, array $data)
    {
        $custom = $this->get($route, []);
        $res = array_replace_recursive($data, $custom);
        $this->set($route, $res);
    }

    public function find($baseRoute, $route, $className = '', $default = null)
    {
        $data = $this->get($baseRoute);
        $el = ArrayHelper::get($data, $route);
        if(is_string($el)){
            return $el;
        }elseif(is_array($el)){
            if(in_array($className, $el)){
                return $el[$className];
            }
            if($alias = ArrayHelper::get($data, 'alias') !== null){
                if(isset($el[$alias])){
                    return $el[$alias];
                }else{
                    return $el['default'];
                }
            }else{
                return $el['default'];
            }
        }
        return $default;
    }
}