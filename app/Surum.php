<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Surum extends Eloquent  {
    protected $connection = 'mongodb';
    protected $collection = 'surumler';

}
