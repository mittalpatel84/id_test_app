<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShorterLinks extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'code', 'link'
  ];
}
