// app/Http/Controllers/HomeController.php
public function index()
{
    if (auth()->check() || session('optional_auth') === false) {
        return view('home');
    }
   
    return redirect()->route('login');
}