<?php namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_data';

    public $timestamps = false;

   # protected $fillable = ['user_id',];

    protected $guarded = [];


    public static function findOne($uid){
        return self::where('user_id', $uid)->first();
    }


}