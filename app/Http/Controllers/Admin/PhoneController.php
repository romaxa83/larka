<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// контролер для верификации телефона
class PhoneController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function request(Request $request)
    {
        $user = Auth::user();

        try {
            $token = $user->requestPhoneVerification(Carbon::now());
        } catch (\Exception $error) {
            return redirect()->back()->with('error', $error->getMessage());
        }

        return redirect()->route('admin.user.phone');
    }

    public function form()
    {
        $user = Auth::user();
        $title = 'Verify phone';

        return view('admin.user.phone', compact('user', 'title'));
    }

    /**
     * @param Request $request
     * @return $this
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
    public function verify(Request $request)
    {
        $this->validate($request, [
            'token' => 'required|string|max:255'
        ]);

        $user = Auth::user();

        try {
            $user->verifyPhone($request['token'], Carbon::now());
        } catch (\Exception $error) {
            return redirect()->route('admin.user.phone')->with('error', $error->getMessage());
        }

        return redirect()->route('admin.user', ['id' => $user->id])
            ->with('success', 'Phone verify');
    }
}