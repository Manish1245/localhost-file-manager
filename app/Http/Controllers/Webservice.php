<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Webservice extends Controller {

    use \Shridhar\Webservices\Webservice;

    public function __invoke($path) {
        return $this->perform($path);
    }

}
