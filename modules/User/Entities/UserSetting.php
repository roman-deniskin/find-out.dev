<?php namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_setting';

    protected $guarded = [];

    public static function findOne($uid){
        return self::where('user_id', $uid)->first();
    }

}