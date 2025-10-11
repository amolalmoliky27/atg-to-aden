// app/Http/Controllers/AuthController.php
public function enterAsGuest(Request $request)
{
    $request->session()->put('optional_auth', false);
    return redirect()->intended('/');
}