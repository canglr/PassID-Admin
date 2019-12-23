<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Dogrulamakodlari extends Eloquent
{
   protected $connection = 'mongodb';
   protected $collection = 'dogrulamakodlari';
}
