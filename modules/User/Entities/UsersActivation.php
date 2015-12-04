<?php namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class UsersActivation extends Model
{
    protected $table = 'users_activation';
    public $timestamps = false;
    protected $fillable = ['email', 'token', 'created_at'];


}