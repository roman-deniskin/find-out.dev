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
    public function getRelationship()
    {
        $array = [];
        $array[] = trans('user::relationship.'.$this->gender.'.single');
        $array[] = trans('user::relationship.'.$this->gender.'.in_a_relationship');
        $array[] = trans('user::relationship.'.$this->gender.'.engaged');
        $array[] = trans('user::relationship.'.$this->gender.'.married');
        $array[] = trans('user::relationship.'.$this->gender.'.in_love');
        $array[] = trans('user::relationship.'.$this->gender.'.its_complicated');
        $array[] = trans('user::relationship.'.$this->gender.'.actively_searching');

        return $array;
    }

}