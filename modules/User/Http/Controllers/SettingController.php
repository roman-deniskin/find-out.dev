<?php namespace Modules\User\Http\Controllers;

use Illuminate\Support\Facades\Session;
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

        if ($request->isMethod('post'))
        {
            $data = $request->all();
            $validator = Validator::make($data, [
                'email' => 'email|max:100|unique:users_activation|unique:users,email,'.Auth::user()->id,
                'login' => 'max:64|min:2|unique:users,login,'.Auth::user()->id,
                'anonymous_nick' => 'max:64|min:2|unique:users,login,'.Auth::user()->id.'|unique:users,anonymous_nick,'.Auth::user()->id,
                'old_password' => 'min:6|max:100|required_with:new_password,new_password2',
                'new_password' => 'min:6|max:100|required_with:old_password',
                'new_password2' => 'min:6|max:100|required_with:new_password,old_password',
            ]);

            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }

            $user = Auth::user();
            $user->login = $data['login'];
            $user->email = $data['email'];
            $user->anonymous_nick = $data['anonymous_nick'];

            if(isset($request->new_password) && !empty($request->new_password))
            $user->password = bcrypt($data['new_password']);

            $user->save();

            $request->session()->flash('message', trans('user::settings.saved'));
        }

        return view('user::settings/index', [
            'user' => Auth::user(),
        ]);

    }

    public function data(Request $request)
    {
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
                'name' => 'max:100',
                'surname' => 'max:100',
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
                'relationship' => 'between:0,'.count(User::getRelationship(Auth::user()->gender)),
            ], $messages);

            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }

            $user = Auth::user();
            $user->name = $data['name'];
            $user->surname = $data['surname'];
            $user->status = $data['status'];

            $user->country = $data['country'];
            $user->city = $data['city'];
            $user->hobby = $data['hobby'];
            $user->activity = $data['activity'];
            $user->location = $data['location'];
            $user->date_of_birth = $data['date_of_birth'];
            $user->date_of_birth_view_type = $data['date_of_birth_view_type'];

            $user->social_network_vk = $data['social_network_vk'];
            $user->social_network_fb = $data['social_network_fb'];
            $user->social_network_tw = $data['social_network_tw'];
            $user->social_network_in = $data['social_network_in'];
            $user->social_network_skype = $data['social_network_skype'];
            $user->social_homepage = $data['social_homepage'];

            $user->gender = $data['gender'];
            $user->relationship = $data['relationship'];

            $user->save();

            $request->session()->flash('message', trans('user::settings.saved'));
        }

        return view('user::settings/data', [
            'user' => Auth::user(),
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