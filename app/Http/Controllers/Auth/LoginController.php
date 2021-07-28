<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\RedirectResponse as HttpFoundationRedirectResponse;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param Request $request
     * @return Response|HttpFoundationResponse
     *
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);
        $this->handleTooManyLoginAttempts($request);

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector|HttpFoundationResponse
     * @throws ValidationException
     * @noinspection PhpUnused
     */
    public function adminLogin(Request $request)
    {
        $this->validateLogin($request);
        $this->handleTooManyLoginAttempts($request);

        $admins = config('admin.users');
        $credentials = $this->credentials($request);

        foreach ($admins as $admin) {
            if ($admin['username'] === $credentials['email'] &&
                Hash::check($credentials['password'], $admin['password']))
             {
                 $user = new User();
                 $user->name = "Admin";
                 $user->email = $credentials['email'];
                 if ($this->attemptAdminLogin($request)) {
                     return redirect('/admin/dashboard');
                 }
            }
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);

    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return StatefulGuard
     */
    protected function adminGuard(): StatefulGuard
    {
        return Auth::guard('admin');
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param Request $request
     * @return bool
     */
    protected function attemptAdminLogin(Request $request): bool
    {
        return $this->adminGuard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector|mixed
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $this->adminGuard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect('/');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return HttpFoundationRedirectResponse
     * @noinspection PhpUnused
     */
    public function redirectToProvider(): HttpFoundationRedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response|HttpFoundationRedirectResponse
     * @noinspection PhpUnused
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

        } catch (Exception $e) {
            Log::error('Login with google failed', [
                'error' => $e->getMessage(),
            ]);
            return redirect('/login');
        }

        // check if they're an existing user
        $registeredUser = User::where('email', $user->email)->first();
        if ($registeredUser) {
            // log them in
            auth()->login($registeredUser, true);
        } else {

            // create a new user
            $newUser                    = new User();
            $newUser->name              = $user->name;
            $newUser->email             = $user->email;
            /** @noinspection PhpUndefinedFieldInspection */
            $newUser->google_id         = $user->id;
            /** @noinspection PhpUndefinedFieldInspection */
            $newUser->google_avatar_url = $user->avatar;
            $newUser->password          = Hash::make(Str::random(16));
            /** @noinspection PhpUndefinedFieldInspection */
            $newUser->email_verified_at = now();
            /** @noinspection PhpUndefinedFieldInspection */
            $newUser->remember_token = '';
            $newUser->save();
            auth()->login($newUser, true);
        }
        return redirect()->to('/home');
    }

    /**
     * @param Request $request
     *
     * @return void
     *
     * @throws ValidationException
     */
    private function handleTooManyLoginAttempts(Request $request): void
    {
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $this->sendLockoutResponse($request);
        }
    }
}
