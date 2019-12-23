<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Girisler extends Eloquent  {
    protected $connection = 'mongodb';
    protected $collection = 'girisler';

}
