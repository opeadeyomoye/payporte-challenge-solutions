<?php
/**
 * Created by PhpStorm.
 * User: opeadeyomoye
 * Date: 4/30/17
 * Time: 11:24 PM
 */

namespace App\Service;

/**
 * ServiceEmployerTrait
 *
 * Implements App\Service\ServiceEmployerInterface
 *
 * @package App\Service
 */
trait ServiceEmployerTrait
{
    /**
     * Returns a service object of $serviceClassName.
     *
     * @param string $serviceClassName Service class name.
     *
     * @return AppService|bool False if we can't find the class. The class otherwise.
     */
    public function getService($serviceClassName)
    {
        return AppService::getService($serviceClassName);
    }
}