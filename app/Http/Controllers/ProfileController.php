<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use RuntimeException;

class ProfileController extends Controller
{
    public function profile($nickname): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        Bugsnag::notifyException(new RuntimeException("Test error"));
        $withDeleted = null;

        if (in_array(request('deleted'), User::FILTER) && request('deleted') === 'true') {
            $withDeleted = true;
        }
        try {
            $user = User::userFindBy($nickname);

        } catch (ModelNotFoundException $exception){
            return view('profile.errors.notfound');
        } catch (RelationNotFoundException $exception){
            return view('profile.errors.relationsNotFound');
        }


        $deletedUsers = User::with('roles')
            ->when($withDeleted, function ($query) {
                $query->withTrashed();
            })->paginate(20);

        if (!$user) {
            abort(404);
        }



        return view('profile.public-index', [
            'user' => $user,
            'withDeleted' => $withDeleted,
            'deletedUsers' => $deletedUsers,
        ]);


    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
