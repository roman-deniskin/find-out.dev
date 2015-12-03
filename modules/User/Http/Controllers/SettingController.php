<?php namespace Modules\User\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Modules\User\Entities\UserData;
use Modules\User\Entities\UserSetting;
use Pingpong\Modules\Routing\Controller;
use Modules\User\Entities\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => []]);
    }

    public function index(Request $request)
    {

        $user = User::find(Auth::user()->id);
        $userData = UserData::findOne($user->id);

        if ($request->isMethod('post'))
        {
            $data = $request->all();
            $validator = Validator::make($data, [
                'email' => 'email|max:100|unique:users_activation|unique:users,email,'.$user->id,
                'login' => 'max:64|min:2|unique:users,login,'.$user->id,
                'anonymous_nick' => 'max:64|min:2|unique:users,login,'.$user->id.'|unique:users_data,anonymous_nick,user_id'.$user->id,
                'old_password' => 'min:6|max:100|required_with:new_password,new_password2',
                'new_password' => 'min:6|max:100|required_with:old_password',
                'new_password2' => 'min:6|max:100|required_with:new_password,old_password',
            ]);

            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }

            $user->login = $data['login'];
            $user->email = $data['email'];

            if(isset($request->new_password) && !empty($request->new_password))
            $user->password = bcrypt($data['new_password']);

            $user->save();

            $userData->anonymous_nick = $data['anonymous_nick'];
            $userData->save();

            $request->session()->flash('message', trans('user::settings.saved'));
        }

        return view('user::settings/index', [
            'user' => $user,
        ]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @var $user User
     * @var $userData UserData
     * @var $userSetting UserSetting
     */
    public function data(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $userData = UserData::findOne($user->id);
        $userSetting = UserSetting::findOne($user->id);

        if ($request->isMethod('post'))
        {
            $messages = [
                'require' => 'The :attribute and :other must match.',
                'same'    => 'The :attribute and :other must match.',
                'size'    => 'The :attribute must be exactly :size.',
                'between' => 'The :attribute must be between :min - :max.',
                'in'      => 'The :attribute must be one of the following types: :values',
                'max'      => 'Поле :attribute не должно быть длиной больше чем :value',
            ];

            $data = $request->all();
            $validator = Validator::make($data, [
                'first_name' => 'max:100',
                'last_name' => 'max:100',
                'status' => 'max:255',

                'country' => 'max:255',
                'city' => 'max:255',
                'hobby' => 'max:255',
                'activity' => 'max:255',
                'location' => 'max:255',
                'date_of_birth' => 'max:10|date|date_format:"d.m.Y"|before:"now"',
                'date_of_birth_view_type' => 'between:0,'.count(User::getDateViewTypes()),

                'social_network_vk' => 'max:255',
                'social_network_fb' => 'max:255',
                'social_network_tw' => 'max:255',
                'social_network_in' => 'max:255',
                'social_network_skype' => 'max:255',
                'social_homepage' => 'max:255',

                'gender' => 'in:0,1',
                'relationship' => 'between:0,'.count($user->getRelationship()),
            ], $messages);

            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }
            
            $userData->first_name = $data['first_name'];
            $userData->last_name = $data['last_name'];
            $userData->status = $data['status'];

            $userData->country = $data['country'];
            $userData->city = $data['city'];
            $userData->hobby = $data['hobby'];
            $userData->activity = $data['activity'];
            $userData->location = $data['location'];
            $userData->date_of_birth = $data['date_of_birth'];

            $userData->social_network_vk = $data['social_network_vk'];
            $userData->social_network_fb = $data['social_network_fb'];
            $userData->social_network_tw = $data['social_network_tw'];
            $userData->social_network_in = $data['social_network_in'];
            $userData->social_network_skype = $data['social_network_skype'];
            $userData->social_homepage = $data['social_homepage'];

            $userData->gender = $data['gender'];
            $userData->relationship = $data['relationship'];

            $userData->save();

            $userSetting->date_of_birth_view_type = $data['date_of_birth_view_type'];
            $userSetting->save();

            $request->session()->flash('message', trans('user::settings.saved'));
        }

        return view('user::settings/data', [
            'user' => $user,
            'userData' => $userData,
        ]);
    }

    public function contacts()
    {
        return view('user::settings/contacts', [
            'user' => Auth::user(),
        ]);
    }

    public function privacy()
    {
        return view('user::settings/privacy', [
            'user' => Auth::user(),
        ]);
    }

    public function profile($id)
    {
        $account = User::find($id);
        if ($account) {
            return view('user::profile', [
                'account' => $account,
            ]);
        } else {
            throw new NotFoundHttpException(trans('user::messages.user.not_found'));
        }
    }

    public function postUpdate(Request $request)
    {
        $account = Auth::user();
        if ($account) {
            $validator = Validator::make($request->all(), [
                'name' => 'max:255',
                'surname' => 'max:255',
                'gender' => 'in:0,1',
            ]);
            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }
            $user = Auth::user();
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->gender = $request->gender;
            $user->save();
            return redirect(url('/user/profile/edit'))->with('message', trans('user::messages.data.saved'));
        } else {
            return redirect(url('/'))->with('message', trans('user::messages.tokenNotFound'));
        }
    }

    public function update()
    {
        $account = Auth::user();
        if ($account) {
            return view('user::edit', [
                'account' => $account,
            ]);
        } else {
            return redirect(url('/'))->with('message', trans('user::messages.tokenNotFound'));
        }
    }

}