<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventManagerController;
use App\Http\Controllers\EventoMarketController;
use App\Http\Controllers\EventReviewController;
use App\Http\Controllers\EventTimelineController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LockScreenController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\testController;
use App\Http\Controllers\UserCalendarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserTasksController;
use App\Http\Middleware\UserStatus;
use App\Models\Location;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LockScreenMiddleware;


require_once 'admin.php';
// Public Routes
Route::get('/', [HomeController::class,'index'])->name('index');
Route::post('/render-post', [HomeController::class, 'renderPost'])->name('post.render');
// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.submit');
    Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [UserController::class, 'register'])->name('register.submit');

    Route::view('/logout', 'auth.logout')->name('logout.view'); // This should be used only for view; actual logout needs no view
});




Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

// Help Route
Route::view('/help', 'dashboard.help')->name('help');

// Lock Screen Routes
Route::get('/lock-screen', [LockScreenController::class, 'show'])->name('lock.screen');
Route::post('/unlock', [LockScreenController::class, 'unlock'])->name('unlock');
Route::post('/manual-lock', [LockScreenController::class, 'manualLock'])->name('manual.lock');

// Grouped Routes with Lock Screen Middleware
Route::middleware([LockScreenMiddleware::class,UserStatus::class, 'auth'])->group(function () {
    // Display the edit profile page
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    // Update profile information
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    // Update profile information
    Route::put('/profile/update-contact', [ProfileController::class, 'updateContact'])->name('profile.contactUpdate');
    // Update profile information
    Route::put('/profile/update-links', [ProfileController::class, 'updateLinks'])->name('profile.updateSocialLinks');
    // Update profile information
    Route::put('/profile/update-image', [ProfileController::class, 'update-image'])->name('profile.updateImage');


    Route::get('/todo', [UserTasksController::class, 'index'])->name('task.index');
    Route::post('events/{event}/tasks', [UserTasksController::class, 'store'])->name('task.store');
    Route::patch('/tasks/{task}/update-category', [UserTasksController::class, 'updateCategory'])->name('task.updateCategory');

    // Change password
    Route::put('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
    // Profile and Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    //Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');

    // Profile Updates
    Route::post('/profile/image/upload', [UserController::class, 'profile_image_upload'])->name('profile.image.upload');
    Route::post('/profile/portfolio', [UserController::class, 'add_Portfolios'])->name('profile.portfolio');
    Route::delete('/profile/portfolio/{id}', [UserController::class, 'destroy_Portfolio_web'])->name('portfolio.delete');

    // Skills and Market Resources
    Route::resource('skills', SkillController::class);
    Route::resource('asset', AssetController::class);
    Route::post('/assets/{assetId}/reviews', [AssetController::class, 'storeOrUpdate'])->name('reviews.storeOrUpdate');
    Route::resource('market', EventoMarketController::class);
    Route::resource('posts', EventController::class);
    // Events Resources
    Route::resource('events', EventController::class);
    Route::post('/teams/requests/send', [TeamController::class, 'sendTeamRequest'])->name('teams.requests.send');
    Route::post('/team-requests/{id}/accept', [TeamController::class, 'acceptRequest'])->name('team-requests.accept');
    Route::post('/team-requests/{id}/reject', [TeamController::class, 'rejectRequest'])->name('team-requests.reject');
    Route::get('/events/{id}/panel', [EventManagerController::class, 'eventPanel'])->name('events-panel');
    
    Route::get('/events/fetch', [EventController::class, 'fetchEvents'])->name('events.fetch');
    Route::get('/live-search', [EventController::class, 'liveSearch'])->name('events.liveSearch');
    Route::get('/event-categories', [EventController::class, 'eventsByCategory'])->name('events.categories');
    Route::get('/event-categories/{category}', [EventController::class, 'eventsByCategoryName'])->name('events.categories.name');
    Route::get('/my-events', [EventController::class, 'myEvents'])->name('myEvents');
    Route::post('/events/{event}/reviews', [EventReviewController::class, 'store'])->name('event_reviews.store');
    Route::put('/reviews/{reviewId}', [EventReviewController::class, 'update'])->name('event_reviews.update');
    Route::delete('/reviews/{reviewId}', [EventReviewController::class, 'destroy'])->name('event_reviews.destroy');
    Route::get('/events/{id}/reviews/load', [EventController::class, 'loadMoreReviews'])->name('events.reviews.load');
    Route::put('/assets/eventNeed', [EventManagerController::class, 'updateAssetNeed'])->name('assetsNeed.update');
    Route::delete('/asset-needs/{id}', [EventManagerController::class, 'destroyEventNeed'])->name('assetNeeds.destroy');
    Route::put('/eventNeed/skills', [EventManagerController::class, 'updateSkill'])->name('event-skill-need.update');
    // Store New Timeline Entry
    Route::post('events/{event}/timeline', [EventTimelineController::class, 'store'])->name('timeline.store');

    // Show Edit Form for a Timeline Entry
    Route::get('timeline/{timeline}/edit', [EventTimelineController::class, 'edit'])->name('timeline.edit');

    // Update a Timeline Entry
    Route::put('timeline/{timeline}', [EventTimelineController::class, 'update'])->name('timeline.update');

    // Delete a Timeline Entry
    Route::delete('timeline/{timeline}', [EventTimelineController::class, 'destroy'])->name('timeline.destroy');
    // In your web.php routes file

    Route::post('/event/{eventId}/upload-banner', [EventManagerController::class, 'uploadBanner'])->name('event.visualIdentity.uploadBanner');
    Route::post('/event/{eventId}/upload-logo', [EventManagerController::class, 'uploadLogo'])->name('event.visualIdentity.uploadLogo');

    // routes/web.php
    Route::get('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('markAllAsRead');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/{notification}/status', [NotificationController::class, 'updateStatus']);

});

Route::middleware(['auth'])->group(function () {
    Route::get('/calendar', [UserCalendarController::class, 'viewCalendar'])->name('calendar.view');
    Route::post('/calendar/add/{eventId}', [UserCalendarController::class, 'addToCalendar'])->name('calendar.add');
    Route::post('/calendar/remove', [UserCalendarController::class, 'removeFromCalendar'])->name('calendar.remove');

});










Route::get('/test', [testController::class, 'index']);

// Artisan Command Route (for development or maintenance)
Route::get('/foo', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('storage:link');
    return redirect()->route('index')->with('success', 'Welcome to the platform!');
});

