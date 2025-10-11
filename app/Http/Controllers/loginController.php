// app/Http/Controllers/Auth/LoginController.php
protected function authenticated(Request $request, $user)
{
    $request->session()->forget('optional_auth');
    return redirect()->intended($this->redirectPath());
}
public function showLoginForm()
{
    // إذا كان مسجل الدخول بالفعل، توجيه إلى الصفحة الرئيسية
    if (auth()->check()) {
        return redirect('/home');
    }

    return view('auth.login');

protected $redirectTo = '/home';
}