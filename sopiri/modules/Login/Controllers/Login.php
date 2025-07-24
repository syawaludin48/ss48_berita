<?php
namespace Modules\Login\Controllers;

// use Config\Email;
use App\Controllers\BaseController;
use Modules\Login\Models\Model_login as MLogin;
use Myth\Auth\Entities\User;

class Login extends BaseController
{
	protected $auth;
	protected $config;
	protected $session;

	public function __construct(){

		$this->session = service('session');

		$this->config = config('Auth');
		$this->auth = service('authentication');
	}

	
	public function index()
	{
		//$controller = $this->Model_login->findAll();
		$config = $this->config;

		$data = [
			'title' => 'Login',
			'seg' => $this->request->uri->getSegments(),
			'config' => $config
		];
		
		return view('Modules\Login\Views\login',$data);
	}
	
	public function attemptLogin()
	{
		$rules = [
			'login'	=> 'required',
			'password' => 'required',
		];
		if ($this->config->validFields == ['email'])
		{
			$rules['login'] .= '|valid_email';
		}
		if (! $this->validate($rules))
		{
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$login = $this->request->getPost('login');
		$password = $this->request->getPost('password');
		$remember = (bool)$this->request->getPost('remember');

		$type = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

		if (! $this->auth->attempt([$type => $login, 'password' => $password], $remember))
		{
			return redirect()->back()->withInput()->with('error', $this->auth->error() ?? lang('Auth.badAttempt'));
		}
		if ($this->auth->user()->force_pass_reset === true)
		{
			return redirect()->to(route_to('reset-password') .'?token='. $this->auth->user()->reset_hash)->withCookies();
		}

		$redirectURL = '/admin';
		return redirect()->to($redirectURL)->withCookies()->with('message', lang('Auth.loginSuccess'));
	}
	
	
	
	
	
	
	
	
	public function register()
	{
		//$controller = $this->Model_login->findAll();

		$data = [
			'title' => 'Register',
			'seg' => $this->request->uri->getSegments(),
			//'controller' => $controller
		];

		return view('Modules\Login\Views\register',$data);
	}
	public function forgot()
	{
		//$controller = $this->Model_login->findAll();

		$data = [
			'title' => 'Forgot Password',
			'seg' => $this->request->uri->getSegments(),
			//'controller' => $controller
		];

		return view('Modules\Login\Views\forgot',$data);
	}
	public function reset()
	{
		//$controller = $this->Model_login->findAll();

		$data = [
			'title' => 'Reset Password',
			'seg' => $this->request->uri->getSegments(),
			//'controller' => $controller
		];

		return view('Modules\Login\Views\reset',$data);
	}

}
