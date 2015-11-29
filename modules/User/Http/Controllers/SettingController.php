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
                'old_password' => 'min:6|max:100|required_with:new_password,new_password2',
                'new_password' => 'min:6|max:100|required_with:old_password',
                'new_password2' => 'min:6|max:100|required_with:new_password,old_password',
            ]);;

            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }

            $user = Auth::user();
            $user->login = $data['login'];
            $user->email = $data['email'];

            if(isset($request->new_password) && !empty($request->new_password))
            $user->password = bcrypt($data['new_password']);

            $user->save();

            $request->session()->flash('message', trans('user::settings.saved'));
        }

        return view('user::settings/index', [
            'user' => Auth::user(),
        ]);

    }

    public function data()
    {
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