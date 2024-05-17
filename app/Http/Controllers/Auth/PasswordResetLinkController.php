<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Symfony\Component\Console\Helper\ProgressBar;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(Request $request): View
    {
        if ($request->is('forgot-password')) {
            return view('auth.forgot-password');
        } elseif ($request->is('admin/forgot-password')) {
            return view('admin.auth.forgot-password');
        } else {
            abort(404); // Hoặc một xử lý khác nếu không khớp URL nào
        }
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );
        toastr('Email sent successfully','success','',        [
            'ProgressBar'=>'true',
            'closeButton'=>'true',
        ]);
        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
//     public function store(Request $request): RedirectResponse
// {
//     $request->validate([
//         'email' => ['required', 'email'],
//     ]);

//     // Kiểm tra xem user có phải là admin hay không
//     $user = \App\Models\User::where('email', $request->email)->first();

//     if ($user && $user->role == 'admin') {
//         // Xử lý link reset password cho admin
//         $status = Password::broker('admins')->sendResetLink(
//             $request->only('email')
//         );
//     } else {
//         // Xử lý link reset password cho user thường
//         $status = Password::sendResetLink(
//             $request->only('email')
//         );
//     }

//     // Hiển thị thông báo thành công hoặc lỗi
//     toastr('Email sent successfully','success','', [
//         'ProgressBar' => 'true',
//         'closeButton' => 'true',
//     ]);

//     return $status == Password::RESET_LINK_SENT
//         ? back()->with('status', __($status))
//         : back()->withInput($request->only('email'))
//                 ->withErrors(['email' => __($status)]);
// }
}
