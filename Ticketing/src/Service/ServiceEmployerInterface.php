<?php
/**
 * Created by PhpStorm.
 * User: opeadeyomoye
 * Date: 4/30/17
 * Time: 11:09 PM
 */

namespace App\Service;

/**
 * Interface ServiceEmployerInterface
 *
 * Objects implementing this interface can employ service classes.
 *
 * The App\Service\ServiceEmployerTrait lets you easily implement
 * this interface.
 *
 * @package App\Service
 */
interface ServiceEmployerInterface
{
    /**
     * Returns a service object of $serviceClassName
     *
     * @param string $serviceClassName Service class name
     *
     * @return AppService|null
     */
    public function getService($serviceClassName);
}