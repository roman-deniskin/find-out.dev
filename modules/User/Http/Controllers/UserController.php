<?php namespace Modules\User\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

use Modules\User\Entities\UsersActivation;
use Modules\User\Entities\User;

use Validator;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller {

	/**
	 * Контроллер который отвечает за регистрацию и авторизацию пользователей
	 */

	use AuthenticatesAndRegistersUsers, ThrottlesLogins;

	/**
	 * Указатель куда будет переправлен юзер после регистрации/авторизации
	 * @var string
	 */
    protected  $redirectTo = '/';
    protected  $redirectPath = '/';

	/**
	 * Подключение посредника guest для блокировки доступа
	 * к некоторым страницам неавторизированным пользователям
	 */
	public function __construct()
	{
		$this->middleware('guest', ['except' => ['getLogout', 'update', 'profile', 'postUpdate']]);
	}

	public function getRegistration()
	{
		return view('user::register');
	}

    public function profile(Request $request){
        $account = User::find($request->id);

        if($account){
            return view('user::profile', [
                'account' => $account,
            ]);
        }else{
            throw new NotFoundHttpException('User with this token not found');
        }

    }

	/**
	 * Сохранение данных авторизованного пользователя
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function postUpdate(Request $request){
        $account = Auth::user();

        if($account){

            $validator = $this->updateValidator($request->all());

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

        }else{
			return redirect(url('/'))->with('message', trans('user::messages.tokenNotFound'));
        }
    }

	/**
	 * Выводим страницу изменения данных аккаунта
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
	 */
    public function update(Request $request){
        $account = Auth::user();

        if($account){
            return view('user::edit', [
                'account' => $account,
            ]);
        }else{
            return redirect(url('/'))->with('message', trans('user::messages.tokenNotFound'));
        }
    }

	/**
	 * Выводим страницу активации (второго шага регистрации)
	 * На ней пользователь заполняет все свои данные
	 * @param Request $request
	 * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function activation(Request $request){

        $account = UsersActivation::where('token', $request->token)->first();

        if($account){
            return view('user::step2', [
                'email' => $account->email,
            ]);
        }else{
			abort(404, trans('user::messages.tokenNotFound'));
			return false;
        }

    }

	/**
	 * ----------------------
	 * Регистрация пользователя
	 * Функция создает в таблице users_activation пользователя
	 * Отправляет ему письмо на емеил
	 * После этого он должен активировать свой аккаунт
	 * его запись перенесется в таблицу users
	 * там у нас только активированные пользователи
	 * ----------------------
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postRegistration(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'email' => 'required|email|max:255|unique:users_activation|unique:users',
		]);;

		if ($validator->fails()) {
			$this->throwValidationException(
				$request, $validator
			);
		}
		/**
		 * @var $data array
		 * @var $data['token'] -- Токен пользователя для активации.
		 */
		$data['token'] = str_random(32);
		$data['created_at'] = time();
		$url = url('/').'/user/activation/'.$data['token'];
		$data['email'] = $request->email;

		/**
		 * Отправка письма.
		 * Шаблон в modules/user/resources/views/mails/
		 * Прикрепляется ссылка $data['url'] по которой должен перейти пользователь для активации
		 */
		Mail::send('user::mails/welcome', ['url' => $url], function($message) use ($data)
		{
			$message->to($data['email'])->subject(trans('user::messages.ACCOUNT_CONFIRMATION'));
		});

		/**
		 * Создание пользователя.
		 * Записываем только емеил и токен
		 */
		if(UsersActivation::create([
			'email' => $data['email'],
			'token' => $data['token'],
		])) {
			return redirect(url('/'))->with('message', trans('user::messages.DISABLED_ACCOUNT_CREATED'));
		}else{
			return redirect(url('/'))->with('message', trans('user::messages.SAVE_ERROR'));
		}
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postSave(Request $request)
	{
		$validator = $this->valid($request->all());

		if ($validator->fails()) {
			$this->throwValidationException(
				$request, $validator
			);
		}

		Auth::login($this->create($request->all()));

        $account = UsersActivation::where('email', $request->email)->first();
        $account->delete();

		return redirect($this->redirectPath());
	}

	/**
     * Get a validator for an incoming editing account request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function valid(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'name' => 'max:255|min:1',
            'surname' => 'max:255|min:1',
            'gender' => 'in:0,1',
            'login' => 'required|max:255|min:2|unique:users',
            'password' => 'required|min:6|max:100',
        ]);
    }


    protected function updateValidator(array $data)
    {
        return Validator::make($data, [
            #'email' => 'email|max:255',
            'name' => 'max:255',
            'surname' => 'max:255',
            'gender' => 'in:0,1',
            #'login' => 'max:255',
            #'password' => 'required|min:6',
        ]);
    }

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	protected function create(array $data)
	{
		return User::create([
			'login' => $data['login'],
			'name' => $data['name'],
			'surname' => $data['surname'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
		]);
	}

	/**
	 * Show the application login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogin()
	{
		return view('user::login');
	}

	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin(Request $request)
	{
		$this->validate($request, [
			$this->loginUsername() => 'required', 'password' => 'required',
		]);

		// If the class is using the ThrottlesLogins trait, we can automatically throttle
		// the login attempts for this application. We'll key this by the username and
		// the IP address of the client making these requests into this application.
		$throttles = $this->isUsingThrottlesLoginsTrait();

		if ($throttles && $this->hasTooManyLoginAttempts($request)) {
			return $this->sendLockoutResponse($request);
		}

		$credentials = $this->getCredentials($request);

		if (Auth::attempt($credentials, $request->has('remember'))) {
			return $this->handleUserWasAuthenticated($request, $throttles);
		}

		// If the login attempt was unsuccessful we will increment the number of attempts
		// to login and redirect the user back to the login form. Of course, when this
		// user surpasses their maximum number of attempts they will get locked out.
		if ($throttles) {
			$this->incrementLoginAttempts($request);
		}

		return redirect($this->loginPath())
			->withInput($request->only($this->loginUsername(), 'remember'))
			->withErrors([
				$this->loginUsername() => $this->getFailedLoginMessage(),
			]);
	}

	/**
	 * Send the response after the user was authenticated.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  bool  $throttles
	 * @return \Illuminate\Http\Response
	 */
	protected function handleUserWasAuthenticated(Request $request, $throttles)
	{
		if ($throttles) {
			$this->clearLoginAttempts($request);
		}

		if (method_exists($this, 'authenticated')) {
			return $this->authenticated($request, Auth::user());
		}

		return redirect()->intended($this->redirectPath());
	}

	/**
	 * Get the needed authorization credentials from the request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	protected function getCredentials(Request $request)
	{
		return $request->only($this->loginUsername(), 'password');
	}

	/**
	 * Get the failed login message.
	 *
	 * @return string
	 */
	protected function getFailedLoginMessage()
	{
		return Lang::has('auth.failed')
			? Lang::get('auth.failed')
			: 'auth.failed';
	}

	/**
	 * Log the user out of the application.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogout()
	{
		Auth::logout();

		return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
	}

	/**
	 * Get the path to the login route.
	 *
	 * @return string
	 */
	public function loginPath()
	{
		return property_exists($this, 'loginPath') ? $this->loginPath : '/login';
	}

	/**
	 * Get the login username to be used by the controller.
	 *
	 * @return string
	 */
	public function loginUsername()
	{
		return property_exists($this, 'email') ? $this->email : 'login';
	}

	/**
	 * Determine if the class is using the ThrottlesLogins trait.
	 *
	 * @return bool
	 */
	protected function isUsingThrottlesLoginsTrait()
	{
		return in_array(
			ThrottlesLogins::class, class_uses_recursive(get_class($this))
		);
	}

}

