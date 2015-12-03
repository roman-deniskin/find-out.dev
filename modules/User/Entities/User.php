<?php namespace Modules\User\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login',
        'email',
        'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function data()
    {
        return $this->hasOne('Modules\User\Entities\UserData', 'user_id', 'id');
    }

    public function setting()
    {
        return $this->hasOne('Modules\User\Entities\UserSetting', 'user_id', 'id');
    }


    public function getGender(){
        $array = [];
        $array[0] = trans('user::names.gender.women');
        $array[1] = trans('user::names.gender.men');
        return $array[$this->data->gender];
    }

    /**
     * @return string
     */
    public function getBirthDate(){
        $array = [];
        $array[] = $this->data->date_of_birth;
        $array[] = null;
        $array[] = substr($this->data->date_of_birth,0,5);
        $array[] = substr($this->data->date_of_birth,3);
        $array[] = substr($this->data->date_of_birth,6);

        return $array[$this->setting->date_of_birth_view_type];
    }

    /**
     * @return string
     */
    public function getFullName(){
        return sprintf('%s %s', $this->data->first_name, $this->data->last_name);
    }

    /**
     * @return array
     */
    public static function getDateViewTypes()
    {
        $array = [];
        $array[] = trans('user::dateview.full');
        $array[] = trans('user::dateview.do_not_show');
        $array[] = trans('user::dateview.only_d_m');
        $array[] = trans('user::dateview.only_m_y');
        $array[] = trans('user::dateview.only_y');

        return $array;
    }


    public function getUserRelationship()
    {
        $array = [];
        $array[] = trans('user::relationship.'.$this->data->gender.'.single');
        $array[] = trans('user::relationship.'.$this->data->gender.'.in_a_relationship');
        $array[] = trans('user::relationship.'.$this->data->gender.'.engaged');
        $array[] = trans('user::relationship.'.$this->data->gender.'.married');
        $array[] = trans('user::relationship.'.$this->data->gender.'.in_love');
        $array[] = trans('user::relationship.'.$this->data->gender.'.its_complicated');
        $array[] = trans('user::relationship.'.$this->data->gender.'.actively_searching');

        return $array[$this->relationship];
    }
    /**
     * gender 1 = Men / 0 - Women
     * @param int $gender
     * @return array
     */
    public function getRelationship()
    {
        $array = [];
        $array[] = trans('user::relationship.'.$this->data->gender.'.single');
        $array[] = trans('user::relationship.'.$this->data->gender.'.in_a_relationship');
        $array[] = trans('user::relationship.'.$this->data->gender.'.engaged');
        $array[] = trans('user::relationship.'.$this->data->gender.'.married');
        $array[] = trans('user::relationship.'.$this->data->gender.'.in_love');
        $array[] = trans('user::relationship.'.$this->data->gender.'.its_complicated');
        $array[] = trans('user::relationship.'.$this->data->gender.'.actively_searching');

        return $array;
    }


}