<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Mail extends Eloquent  {
    protected $connection = 'mongodb';
    protected $collection = 'mail';

}
