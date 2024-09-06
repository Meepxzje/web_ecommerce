<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function showVerificationNotice()
    {
        return view('auth.verify-email');
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/');
    }

    public function resendVerificationNotification(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $user->sendEmailVerificationNotification();
            return back()->with('message', 'Đã gửi lại liên kết xác minh!');
        }

        return back()->withErrors(['message' => 'Không tìm thấy người dùng.']);
    }
}
