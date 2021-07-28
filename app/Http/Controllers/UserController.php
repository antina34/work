<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Models\Order;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Show user settings.
     *
     * @return Renderable
     */
    public function view(): Renderable
    {
        $user = Auth::user();

        /** @noinspection PhpUndefinedFieldInspection */
        /** @noinspection NullPointerExceptionInspection */
        $orders = Order::ofUser($user->id)->count();

        return view('settings', compact('user', 'orders'));
    }

    /**
     * @param UserRequest $request
     *
     * @return RedirectResponse
     */
    public function update(UserRequest $request): RedirectResponse
    {
        if ($request->get('password') !== $request->get('password_confirmation')) {
            return redirect()->back()->with(['error' => 'Passwords do ot match']);
        }
        /** @noinspection PhpUndefinedFieldInspection */
        $userId = Auth::user()->id;
        $fields = [
            'name'  => $request->get('name'),
            'email' => $request->get('email'),
            'telephone' => $request->get('telephone'),
        ];
        if ($request->get('password') && $request->get('password_confirmation')) {
            $fields['password'] = Hash::make($request->get('password'));
        }

        User::where('id', $userId)->update($fields);

        return redirect()->back()->with(['message' => 'Your settings have been added']);
    }
}
