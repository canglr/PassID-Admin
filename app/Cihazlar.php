<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Cihazlar extends Eloquent  {

    protected $connection = 'mongodb';
    protected $collection = 'cihazlar';

}
