<?php

use App\Http\Controllers\{Auth\RegisteredUserController,
    ChatController,
    FriendsController,
    GroupsController,
    ImageController,
    InvoiceController,
    MediaController,
    NewsPage,
    NotificationsController,
    PostController,
    ProfileController,
    SearchController,
    TermsController,
    VacancyController,

};

use App\Http\Livewire\Pages\CandidateProfile;
use App\Http\Middleware\EnsureUserIsEmployer;
use Illuminate\Support\Facades\Route;

// 161 185

Route::permanentRedirect('/','login');

Route::inertia('welcome', 'Auth/Login')->name('authentication');
Route::inertia('about','About')->name('pages.about');

Route::get( 'search',        [SearchController::class,'results'])->name('search.results');
Route::post('notifications', [NotificationsController::class,'get']);

Route::get( '/alert',function (){
    return redirect()->route('home')->with('info','alert');
});

Route::get('users/list', [RegisteredUserController::class, 'index'])->name('users.index');

Route::middleware(['auth','termsAccepted'])->group(function (){
    Route::resource('groups', GroupsController::class);
    Route::resource('news',   NewsPage::class);
    Route::get('vacancies/',            [VacancyController::class, 'index'])->name('vacancy.show');
    Route::get('user/{nickname}',       [ProfileController::class,'profile'])->name('user_profile.index');
    Route::post('{nickname}/pfp/upload',[ImageController::class, 'uploadPfp'])->name('pfp.upload');
    Route::get('{nickname}/friends',    [FriendsController::class, 'index'])->name('friends.index');


    Route::group(['prefix' => 'roles','as' => 'roles.'], function (){
        Route::get('{userId}/change-role/',[RegisteredUserController::class, 'changeRoles'])->name('user.change-role');
        Route::get('candidate/id/{user}',  [CandidateProfile::class, 'render'])->name('user_candidate.index');
    });

    Route::group(['prefix' => 'media', 'as' => 'media.'], function () {
        Route::post('{model}/{id}/upload',               [MediaController::class, 'store'])->name('upload');
        Route::get('{mediaItem}/download',               [MediaController::class, 'download'])->name('download');
        Route::delete('{model}/{id}/{mediaItem}/delete', [MediaController::class, 'destroy'])->name('delete');
    });

    Route::withoutMiddleware('termsAccepted')->group(function (){
        Route::get( 'terms',        [TermsController::class, 'index'])->name('terms.index');
        Route::post('terms/stores', [TermsController::class, 'store'])->name('terms.store');
    });

    Route::get('token', function () {
        return auth()->user()->createToken('api')->plainTextToken;
    });

    Route::post('/invoice/{name}', [InvoiceController::class, 'store'])
        ->name('invoice.store');

    Route::get('/invoices/{name}', [InvoiceController::class, 'show'])
        ->name('invoice.show');

    Route::get('/invoice/cat/{name}', [InvoiceController::class, 'uploadCat'])
        ->name('invoice.cat');
});

Route::post('upload', [PostController::class, 'upload'])->name('upload');

require __DIR__ . '/friends.php';
require __DIR__ . '/posts.php';

Route::controller(ChatController::class)
    ->middleware(EnsureUserIsEmployer::class)
    ->group(function () {
        Route::get('/dialogues', 'index')->name('dialogues.dash');
        Route::inertia('/messages', 'messages');
        Route::inertia('/send', 'send');
    });

Route::middleware([
    'auth:sanctum',
    'auth',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/user-settings', function () {
        return view('dashboard');
    })->name('dashboard');
});
