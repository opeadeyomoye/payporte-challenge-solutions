<?php
/**
 * Created by PhpStorm.
 * User: opeadeyomoye
 * Date: 8/31/17
 * Time: 11:02 AM
 */

namespace App\Controller\Api\Traits;

use App\Model\Validation\ValidatorInterface;


/**
 * Trait ValidatesInput
 *
 * Eases JSON input validation for controllers.
 *
 * @package App\Controller\Api\Traits
 *
 * @property \Cake\Http\Response $response
 */
trait ValidatesInput
{
    /**
     * @var ValidatorInterface
     */
    protected $_inputValidator;

    /**
     * Set the input validator to use for subsequent checks.
     *
     * @param ValidatorInterface $validator
     *
     * @return $this
     */
    public function validator(ValidatorInterface $validator)
    {
        $this->_inputValidator = $validator;
        return $this;
    }

    /**
     * Validates request input, sending a 400 Bad Request
     * HTTP response if there were any errors found.
     * Along with the errors. Of course.
     *
     * @param array|null $data
     *
     * @return bool|null
     */
    public function validate($data = null)
    {
        if (!$this->_inputValidator) {
            return null;
        }
        if (is_null($data)) {
            $data = $this->getJsonInput();
        }
        if (!empty($this->_inputValidator->check($data))) {
            $this->response
                ->withStatus(400)
                ->withStringBody(json_encode(['errors' => $this->_inputValidator->errors()]))
                ->send();
            exit();
        }
        return true;
    }

    /**
     * Tries to parse this request's raw input as JSON.
     *
     * @return mixed
     */
    abstract public function getJsonInput();
}
