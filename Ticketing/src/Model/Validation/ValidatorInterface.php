<?php
/**
 * Created by PhpStorm.
 * User: opeadeyomoye
 * Date: 8/30/17
 * Time: 1:29 PM
 */

namespace App\Model\Validation;

/**
 * Interface ValidatorInterface
 *
 * Defines methods a model validator class needs to implement.
 *
 * @package App\Model\Validation
 */
interface ValidatorInterface
{
    /**
     * Set up this validator with the proper rules.
     *
     * @return void.
     */
    public function initialize();

    /**
     * Validates `$data` using the preset rules, returning any errors.
     *
     * @param array $data
     *
     * @return array
     */
    public function check(array $data);

    /**
     * Get the last validation errors.
     *
     * @return array
     */
    public function errors();
}
