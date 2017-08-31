<?php
/**
 * Created by PhpStorm.
 * User: opeadeyomoye
 * Date: 8/30/17
 * Time: 11:42 AM
 */

namespace App\Controller\Api;

use Cake\Controller\Controller;


class AppController extends Controller
{
    /**
     * Initialize method for api controllers.
     *
     * Makes sure we don't try to render view files by default,
     * sets the default response type to json.
     *
     * @return void
     */
    public function initialize()
    {
        $this->autoRender = false;
        $this->response = $this->response->withType('json');
    }

    /**
     * Tries to parse this request's raw input as JSON.
     *
     * @return mixed
     */
    public function getJsonInput()
    {
        return json_decode(json_encode($this->request->input('json_decode')), true);
    }
}
