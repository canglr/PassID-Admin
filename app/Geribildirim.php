<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Geribildirim extends Eloquent
{
   protected $connection = 'mongodb';
   protected $collection = 'geribildirim';
}
