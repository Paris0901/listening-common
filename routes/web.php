<?php

use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminEpisodeController;
use App\Http\Controllers\Admin\AdminGuestController;
use App\Http\Controllers\Admin\AdminInboxController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\ThemeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes — The Listening Commons
|--------------------------------------------------------------------------
*/

// 1. Homepage
Route::get('/', HomeController::class)->name('home');

// 2. Master Episodes & Conversations (Canonical + Alias)
Route::get('/episodes', [EpisodeController::class, 'index'])->name('episodes.index');
Route::get('/episodes/{slug}', [EpisodeController::class, 'show'])->name('episodes.show');
Route::get('/conversations', [EpisodeController::class, 'index'])->name('conversations.index');
Route::get('/conversations/{slug}', [EpisodeController::class, 'show'])->name('conversations.show');

// 3. Guests Directory & Profiles
Route::get('/guests', [GuestController::class, 'index'])->name('guests.index');
Route::get('/guests/{slug}', [GuestController::class, 'show'])->name('guests.show');

// 4. Thematic Collections
Route::get('/themes', [ThemeController::class, 'index'])->name('themes.index');
Route::get('/themes/{slug}', [ThemeController::class, 'show'])->name('themes.show');

// 5. Watch, Listen & Editorial Portals
Route::get('/watch', [PortalController::class, 'watch'])->name('watch');
Route::get('/listen', [PortalController::class, 'listen'])->name('listen');
Route::get('/articles', [PortalController::class, 'articles'])->name('articles.index');
Route::get('/essays', [PortalController::class, 'articles'])->name('essays.index');
Route::get('/about', [PortalController::class, 'about'])->name('about');
Route::get('/newsletter', [PortalController::class, 'newsletter'])->name('newsletter');
Route::get('/press', [PortalController::class, 'press'])->name('press');
Route::get('/collaborate', [PortalController::class, 'collaborations'])->name('collaborate');
Route::get('/collaborations', [PortalController::class, 'collaborations'])->name('collaborations');
Route::get('/contact', [PortalController::class, 'contact'])->name('contact');

// 6. Policy & Governance (matching listeningcommons.com)
Route::get('/editorial-policy', [PortalController::class, 'editorialPolicy'])->name('editorial.policy');
Route::get('/medical-disclaimer', [PortalController::class, 'medicalDisclaimer'])->name('medical.disclaimer');
Route::get('/privacy', [PortalController::class, 'privacy'])->name('privacy');

// 7. Syndication & SEO Feeds
Route::get('/feed/podcast', [FeedController::class, 'podcastRss'])->name('feed.podcast');
Route::get('/sitemap.xml', [FeedController::class, 'sitemap'])->name('sitemap');

/*
|--------------------------------------------------------------------------
| Editorial Authentication Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Administrative Publishing & Safety Distribution Hub (Protected)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.guests.index'));

    // Simplified CRM: Website Typography & Font Selection
    Route::get('/typography', [AdminSettingController::class, 'typography'])->name('settings.typography');
    Route::post('/typography', [AdminSettingController::class, 'updateTypography'])->name('settings.typography.update');
    Route::post('/sync-spotify', [AdminSettingController::class, 'syncSpotify'])->name('settings.sync_spotify');
    Route::post('/sync-substack', [AdminSettingController::class, 'syncSubstack'])->name('settings.sync_substack');

    // 1. Master CMS: Episode Management
    Route::get('/episodes', [AdminEpisodeController::class, 'index'])->name('episodes.index');
    Route::post('/episodes/sync-spotify', [AdminEpisodeController::class, 'syncSpotify'])->name('episodes.sync_spotify');
    Route::get('/episodes/create', [AdminEpisodeController::class, 'create'])->name('episodes.create');
    Route::post('/episodes', [AdminEpisodeController::class, 'store'])->name('episodes.store');
    Route::get('/episodes/{id}/edit', [AdminEpisodeController::class, 'edit'])->name('episodes.edit');
    Route::put('/episodes/{id}', [AdminEpisodeController::class, 'update'])->name('episodes.update');
    Route::delete('/episodes/{id}', [AdminEpisodeController::class, 'destroy'])->name('episodes.destroy');

    // 2. Essays & Reflections CMS
    Route::get('/articles', [AdminArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [AdminArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [AdminArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{id}/edit', [AdminArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{id}', [AdminArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{id}', [AdminArticleController::class, 'destroy'])->name('articles.destroy');

    // 3. Guest Constellation & Internal Pipeline
    Route::get('/guests', [AdminGuestController::class, 'index'])->name('guests.index');
    Route::get('/guests/create', [AdminGuestController::class, 'create'])->name('guests.create');
    Route::post('/guests', [AdminGuestController::class, 'store'])->name('guests.store');
    Route::get('/guests/{id}/edit', [AdminGuestController::class, 'edit'])->name('guests.edit');
    Route::put('/guests/{id}', [AdminGuestController::class, 'update'])->name('guests.update');
    Route::delete('/guests/{id}', [AdminGuestController::class, 'destroy'])->name('guests.destroy');

    // 4. Letters from Commons / Inquiries Inbox
    Route::get('/inbox', [AdminInboxController::class, 'index'])->name('inbox.index');
});
