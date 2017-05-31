<?php

namespace Models;


use \Illuminate\Database\Eloquent\Model;

class Event extends Model{

  protected $table = 'event';
  protected $fillable = ['id','title','description'];
  public $timestamps = false;
}
