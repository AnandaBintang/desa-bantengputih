<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomLogoutController extends Controller
{
    public function logout(Request $request)
    {
        $user = Auth::user();

        // Update last_login_at before logout
        if ($user) {
            $user->update([
                'last_login' => now()
            ]);
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
