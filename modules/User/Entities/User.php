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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login',
        'email',
        'password',
        'name',
        'surname',
        'gender',
    ];

    /**
     * @return string
     */
    public function getGender(){
        $array = [];
        $array[0] = trans('user::names.gender.women');
        $array[1] = trans('user::names.gender.men');
        return $array[$this->gender];
    }

    /**
     * @return string
     */
    public function getBirthDate(){
        $array = [];
        $array[] = $this->date_of_birth;
        $array[] = null;
        $array[] = substr($this->date_of_birth,0,5);
        $array[] = substr($this->date_of_birth,3);
        $array[] = substr($this->date_of_birth,6);

        return $array[$this->date_of_birth_view_type];
    }

    /**
     * @return string
     */
    public function getFullName(){
        return sprintf('%s %s', $this->name, $this->surname);
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
        $array[] = trans('user::relationship.'.$this->gender.'.single');
        $array[] = trans('user::relationship.'.$this->gender.'.in_a_relationship');
        $array[] = trans('user::relationship.'.$this->gender.'.engaged');
        $array[] = trans('user::relationship.'.$this->gender.'.married');
        $array[] = trans('user::relationship.'.$this->gender.'.in_love');
        $array[] = trans('user::relationship.'.$this->gender.'.its_complicated');
        $array[] = trans('user::relationship.'.$this->gender.'.actively_searching');

        return $array[$this->relationship];
    }
    /**
     * gender 1 = Men / 0 - Women
     * @param int $gender
     * @return array
     */
    public static function getRelationship($gender = 1)
    {
        $array = [];
        $array[] = trans('user::relationship.'.$gender.'.single');
        $array[] = trans('user::relationship.'.$gender.'.in_a_relationship');
        $array[] = trans('user::relationship.'.$gender.'.engaged');
        $array[] = trans('user::relationship.'.$gender.'.married');
        $array[] = trans('user::relationship.'.$gender.'.in_love');
        $array[] = trans('user::relationship.'.$gender.'.its_complicated');
        $array[] = trans('user::relationship.'.$gender.'.actively_searching');

        return $array;
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
}