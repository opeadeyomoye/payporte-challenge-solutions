<?php
/**
 * Created by PhpStorm.
 * User: opeadeyomoye
 * Date: 4/30/17
 * Time: 10:39 PM
 */
namespace App\Service;

use App\Error\HiccupProneTrait;
use Cake\Datasource\ModelAwareTrait;
use Cake\View\ViewVarsTrait;

/**
 * Parent class for all service classes
 *
 * @package App\Service
 *
 * @todo not everyone'll need the all of the traits used. Find out who does.
 */
class AppService
{

    use ModelAwareTrait;
    use ViewVarsTrait;

    /**
     * Namespace prefix for service classes
     *
     * @var string
     */
    protected static $_serviceClassesPrefix = 'App\Service\Objects\\';

    /**
     * An array of already-loaded service class instances.
     *
     * @var array
     */
    private static $_loadedServiceClasses = [];


    /**
     * Returns a service object of $serviceClassName.
     *
     * @param string $serviceClassName Service class name.
     *
     * @return AppService|bool False if we can't find the class. The class otherwise.
     */
    public static function getService($serviceClassName)
    {
        $serviceClass = self::$_serviceClassesPrefix . ucfirst($serviceClassName);

        if (array_key_exists($serviceClass, self::$_loadedServiceClasses)) {
            return self::$_loadedServiceClasses[$serviceClass];
        }

        if (class_exists($serviceClass)) {
            return self::$_loadedServiceClasses[$serviceClass] = new $serviceClass;
        }

        return false;
    }


    /**
     * Returns an array of the loaded service classes.
     *
     * @internal Meant for unit tests only.
     *
     * @return array
     */
    public static function getLoadedServiceClasses()
    {
        return static::$_loadedServiceClasses;
    }


    final protected function __construct()
    {
        // dependency injection expressions and whatnot go here...
        $this->initialize();
    }


    /**
     * Initialization hook method.
     *
     * Use this method to do stuff you'd normally do with the constructor
     *
     * @return void
     */
    public function initialize()
    {
    }
}