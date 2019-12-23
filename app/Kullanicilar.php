<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Kullanicilar extends Eloquent
{
   protected $connection = 'mongodb';
   protected $collection = 'kullanicilar';
}
