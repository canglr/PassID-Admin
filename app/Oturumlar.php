<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Oturumlar extends Eloquent  {
    protected $connection = 'mongodb';
    protected $collection = 'oturumlar';

}
