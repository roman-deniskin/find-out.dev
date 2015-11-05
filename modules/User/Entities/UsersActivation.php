<?php namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class UsersActivation extends Model
{
    protected $table = 'users_activation';
    public $timestamps = false;
    protected $fillable = ['email', 'token', 'created_at'];

    /*
    protected static function boot()
    {
        static::creating(function ($model) {
            $model->token = str_random(32);

            return $model->validate();
        });
    }

    protected function validate()
    {
        return 1;
    }
*/
}