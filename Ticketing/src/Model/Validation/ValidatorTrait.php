<?php
/**
 * Created by PhpStorm.
 * User: opeadeyomoye
 * Date: 8/30/17
 * Time: 1:30 PM
 */

namespace App\Model\Validation;

use Cake\Validation\Validator;

/**
 * Class ValidatorTrait
 *
 * Provides a construct for easily implementing `ValidatorInterface`.
 *
 * @package App\Model\Validation
 */
trait ValidatorTrait
{
    /**
     * @var Validator
     */
    protected $validator;

    /**
     * @var array
     */
    protected $errors;

    /**
     * ValidatorTrait constructor.
     *
     * Sets our `$validator` property to an instance of `\Cake\Validation\Validator`
     * and calls the initialize method of this validator.
     */
    public function __construct()
    {
        $this->validator = new Validator();
        $this->initialize();
    }

    /**
     * Validates `$data` using the preset rules, returning any errors.
     *
     * @param array $data
     *
     * @return array
     */
    public function check(array $data)
    {
        return ($this->errors = $this->validator->errors($data));
    }

    /**
     * Get the last validation errors.
     *
     * @return array
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * Set up this validator with the proper rules.
     *
     * @return void
     */
    abstract public function initialize();
}