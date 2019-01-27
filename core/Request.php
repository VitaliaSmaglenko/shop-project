<?php
/**
 * Class Request
 */

namespace App;

class Request
{
    /**
     * @var
     */
    private $post;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->post = $_POST;
        }
    }

    /**
     * @param null $value
     * @return mixed
     */
    public function post($value = null)
    {
        if (isset($this->post[$value])) {
            return $this->post[$value];
        }
    }
}
