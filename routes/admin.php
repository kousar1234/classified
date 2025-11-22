<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageContentController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\MediaController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\UtilityController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Backend\UserAuthController;
use App\Http\Controllers\Backend\ContactUsController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\NotificationController;

Route::prefix('admin')->group(function () {
    //Admin Auth
    Route::get('/login', [UserAuthController::class, 'login'])->name('admin.auth.login')->middleware('guest');
    Route::post('/login', [UserAuthController::class, 'loginAttempt'])->name('admin.auth.login.attempt')->middleware('guest');

    Route::group(['middleware' => ['auth', 'admin']], function () {
        //Profile Management
        Route::get('/profile', [UserAuthController::class, 'profile'])->name('admin.auth.profile');
        Route::post('/profile-update', [UserAuthController::class, 'profileUpdate'])->name('admin.auth.profile.update');
        Route::post('/password-update', [UserAuthController::class, 'passwordUpdate'])->name('admin.auth.password.update');
        Route::get('/logout', [UserAuthController::class, 'logout'])->name('admin.auth.logout');

        //NOTIFICATION
        Route::get('/admin-notification-list', [NotificationController::class, 'adminNotifications'])->name('admin.notification.list');
        Route::post('/admin-notification-mark-as-read', [NotificationController::class, 'adminNotificationMarkAsRead'])->name('admin.notification.mark.as.read.single');
        Route::post('/admin-notification-mark-as-read-all', [NotificationController::class, 'adminAllNotificationMarkAsRead'])->name('admin.notification.mark.as.read.all');
        /**
         * DASHBOARD
         */
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard')->middleware(['can:View Dashboard']);
        /**
         * PAGE MODULE
         */
        Route::prefix('pages')->group(function () {
            Route::get('/', [PageController::class, 'pageList'])->name('admin.page.list')->middleware('can:Manage Pages');
            Route::get('create-new-page', [PageController::class, 'createNewPage'])->name('admin.page.create')->middleware('can:Create New Page');
            Route::post('store-new-page', [PageController::class, 'storeNewPage'])->name('admin.page.new.store')->middleware(['demo', 'can:Create New Page']);
            Route::get('edit/{page}', [PageController::class, 'editPage'])->name('admin.page.edit');
            Route::post('update-page', [PageController::class, 'updatePage'])->name('admin.page.update')->middleware(['demo', 'can:Manage Pages']);
            Route::post('delete-page', [PageController::class, 'deletePage'])->name('admin.page.delete')->middleware(['demo', 'can:Delete Page']);
        });

        /**
         * PAGE CONTENT MODULE
         */
        Route::prefix('page-content')->group(function () {
            Route::get('/home', [PageContentController::class, 'homePageContent'])->name('admin.page.content.home');
            Route::get('/about', [PageContentController::class, 'aboutPageContent'])->name('admin.page.content.about');
            Route::get('/contact', [PageContentController::class, 'contactPageContent'])->name('admin.page.content.contact');
            Route::post('update-page-content', [PageContentController::class, 'updatePageContent'])->name('admin.page.content.update');
        });

        /**
         * BLOGS MODULE
         */
        Route::prefix('blogs')->group(function () {
            // Blog categories
            Route::get('categories', [BlogController::class, 'categoriesList'])->name('admin.blogs.categories.list')->middleware('can:Manage Blog Category');
            Route::post('store-new-category', [BlogController::class, 'storeNewCategory'])->name('admin.blogs.categories.store')->middleware(['demo', 'can:Manage Blog Category']);
            Route::get('edit-category/{id}', [BlogController::class, 'editCategory'])->name('admin.blogs.categories.edit');
            Route::post('delete-category', [BlogController::class, 'deleteCategory'])->name('admin.blogs.categories.delete')->middleware(['demo', 'can:Delete Blog Category']);
            Route::post('category-update', [BlogController::class, 'updateCategory'])->name('admin.blogs.categories.update')->middleware(['demo', 'can:Manage Blog Category']);
            Route::get('category-dropdown-options', [BlogController::class, 'categoryDropdownOptions'])->name('admin.blogs.categories.dropdown.options');

            //Blog Tag
            Route::get('tags-dropdown-options', [BlogController::class, 'tagsDropdownOptions'])->name('admin.blogs.tags.dropdown.options');
            //Blogs 
            Route::get('/', [BlogController::class, 'blogList'])->name('admin.blogs.list')->middleware(['can:Manage Blog']);
            Route::get('create-new-blog', [BlogController::class, 'createNewBlog'])->name('admin.blogs.create');
            Route::post('store-new-blog', [BlogController::class, 'storeNewBlog'])->name('admin.blogs.new.store')->middleware(['demo', 'can:Create New Blog']);
            Route::get('edit/{blog}', [BlogController::class, 'editBlog'])->name('admin.blogs.edit');
            Route::post('update-blog', [BlogController::class, 'updateBlog'])->name('admin.blogs.update')->middleware(['demo', 'can:Create New Blog']);
            Route::post('delete-blog', [BlogController::class, 'deleteBlog'])->name('admin.blogs.delete')->middleware(['demo', 'can:Delete Blog']);

            //Comments
            Route::get('/comments', [BlogController::class, 'blogComments'])->name('admin.blogs.comment.list');
            Route::post('/comment-delete', [BlogController::class, 'blogCommentDelete'])->name('admin.blogs.comment.delete')->middleware(['demo']);
        });



        /**
         * CONTACT MESSAGE
         */
        Route::group(['middleware' => 'can:Manage Message'], function () {
            Route::get('messages', [ContactUsController::class, 'messages'])->name('admin.contact.us.message.list');
            Route::post('delete/message', [ContactUsController::class, 'deleteMessage'])->name('admin.contact.us.message.delete');
        });


        /**
         * USER MODULE 
         */
        //Permissions management
        Route::get('permissions', [UserController::class, 'permissions'])->name('admin.users.permission.list');

        //Roles management
        Route::get('roles', [UserController::class, 'roles'])->name('admin.users.role.list');
        Route::post('store-new-role', [UserController::class, 'storeNewRole'])->name('admin.users.role.store')->middleware(['demo']);
        Route::post('edit-role', [UserController::class, 'editRole'])->name('admin.users.role.edit');
        Route::post('delete-role', [UserController::class, 'deleteRole'])->name('admin.users.role.delete')->middleware(['demo']);
        Route::post('update-role', [UserController::class, 'updateRole'])->name('admin.users.role.update')->middleware(['demo']);

        //users Management
        Route::get('users', [UserController::class, 'users'])->name('admin.users.list');
        Route::post('store-new-user', [UserController::class, 'storeNewUser'])->name('admin.users.store');
        Route::post('edit-user', [UserController::class, 'editUser'])->name('admin.users.edit');
        Route::post('update-user', [UserController::class, 'updateUser'])->name('admin.users.update')->middleware(['demo']);
        Route::post('delete-user', [UserController::class, 'deleteUser'])->name('admin.users.delete')->middleware(['demo', 'can:User Delete']);


        /**
         * SYSTEM MODULE
         */
        Route::prefix('system')->group(function () {
            //Environment setup
            Route::get('environment-setup', [SettingController::class, 'environmentSettings'])->name('admin.system.settings.environment');
            Route::post('environment-setup-update', [SettingController::class, 'environmentSettingsUpdate'])->name('admin.system.settings.environment.update')->middleware(['demo', 'can:Update Environment']);

            //SMTP Setup
            Route::get('smtp-setup', [SettingController::class, 'smtpSettings'])->name('admin.system.settings.smtp');
            Route::post('smtp-setup-update', [SettingController::class, 'smtpSettingsUpdate'])->name('admin.system.settings.smtp.update')->middleware(['demo', 'can:Update SMTP']);
            Route::post('send-test-mail', [SettingController::class, 'testMail'])->name('admin.system.settings.smtp.mail.test');

            /**
             * Language Module
             */
            Route::get('languages', [LanguageController::class, 'language'])->name('admin.system.settings.language.list');
            Route::post('store-language', [LanguageController::class, 'languageStore'])->name('admin.system.settings.language.store');
            Route::post('edit-language', [LanguageController::class, 'languageEdit'])->name('admin.system.settings.language.edit');
            Route::post('update-language', [LanguageController::class, 'languageUpdate'])->name('admin.system.settings.language.update');
            Route::post('delete-language', [LanguageController::class, 'languageDelete'])->name('admin.system.settings.language.delete');
            Route::get('translation/{id}', [LanguageController::class, 'LanguageKeys'])->name('admin.system.settings.language.translation');
            Route::post('translation-update', [LanguageController::class, 'translationUpdate'])->name('admin.system.settings.language.translation.update');
            Route::get('set-language/{code}', [LanguageController::class, 'setSessionLanguage'])->name('admin.system.settings.language.set');
        });


        /**
         * APPEARANCE MODULE
         */
        Route::prefix('appearance')->group(function () {
            //Mega Menu Management
            Route::get('/menus', [MenuController::class, 'menus'])->name('admin.appearance.menu.builder')->middleware(['can:Manage Menu']);
            Route::post('/menu-management', [MenuController::class, 'menuManagement'])->name('admin.appearance.menu.builder.menu.management')->middleware(['demo']);
            Route::post('/add-menu-items', [MenuController::class, 'addMenuItems'])->name('admin.appearance.menu.builder.add.menu.items')->middleware(['demo']);
            Route::post('/remove-menu-item', [MenuController::class, 'removeMenuItem'])->name('admin.appearance.menu.builder.remove.menu.item')->middleware(['demo']);
            Route::post('/update-menu-item', [MenuController::class, 'updateMenuItem'])->name('admin.appearance.menu.builder.update.menu.item')->middleware(['demo']);
            Route::post('/delete-menu', [MenuController::class, 'deleteMenu'])->name('admin.appearance.menu.builder.delete.menu')->middleware(['demo', 'can:Delete Menu']);


            //Site Settings
            Route::get('/site-setting', [SiteSettingController::class, 'siteSetting'])->name('admin.appearance.site.setting');
            Route::post('/site-setting-update', [SiteSettingController::class, 'siteSettingUpdate'])->name('admin.appearance.site.setting.update')->middleware(['demo', 'can:Manage Site Settings']);

            Route::get('/header-setting', [SiteSettingController::class, 'headerSetting'])->name('admin.appearance.site.setting.header');
            Route::post('/header-setting-update', [SiteSettingController::class, 'headerSettingUpdate'])->name('admin.appearance.site.setting.header.update')->middleware(['demo', 'can:Manage Site Settings']);

            Route::get('/footer-setting', [SiteSettingController::class, 'footerSetting'])->name('admin.appearance.site.setting.footer');
            Route::post('/footer-setting-update', [SiteSettingController::class, 'footerSettingUpdate'])->name('admin.appearance.site.setting.footer.update')->middleware(['demo', 'can:Manage Site Settings']);

            Route::get('/seo-setting', [SiteSettingController::class, 'seoSetting'])->name('admin.appearance.site.setting.seo');
            Route::post('/seo-setting-update', [SiteSettingController::class, 'seoSettingUpdate'])->name('admin.appearance.site.setting.seo.update')->middleware(['demo', 'can:Manage Site Settings']);


            Route::get('/colors', [SiteSettingController::class, 'colorSetting'])->name('admin.appearance.site.setting.colors');
            Route::post('/colors-update', [SiteSettingController::class, 'colorSettingUpdate'])->name('admin.appearance.site.setting.colors.update')->middleware(['demo', 'can:Manage Site Settings']);

            Route::get('/custom-css', [SiteSettingController::class, 'customCssSetting'])->name('admin.appearance.site.setting.custom.css');
            Route::post('/custom-css-update', [SiteSettingController::class, 'customCssSettingUpdate'])->name('admin.appearance.site.setting.custom.css.update')->middleware(['demo', 'can:Manage Site Settings']);
        });
        /**
         * MEDIA MODULE
         */
        Route::get('media-manage', [MediaController::class, 'mediaManager'])->name('admin.media.list')->middleware('can:Manage Media');
        Route::post('delete/media', [MediaController::class, 'deleteMedia'])->name('admin.media.delete')->middleware(['demo', 'can:Delete Media']);
    });
});

/**
 * Utility
 */
Route::post('/email-sending', [UtilityController::class, 'sendingEmail'])->name('utility.email.send');
Route::get('/admin/clear-system-cache', [UtilityController::class, 'clearCache'])->name('utility.clear.cache');
Route::post('/store-summer-note-image', [UtilityController::class, 'storeEditorImage'])->name('utility.store.editor.image');


/**
 * Media Management
 */
Route::post('/upload-media-file', [MediaController::class, 'uploadMediaFile'])->name('upload.media.file');
Route::post('/media-items-list', [MediaController::class, 'mediaList'])->name('media.file.list');
Route::post('/selected-media-details', [MediaController::class, 'selectedMediaDetails'])->name('media.selected.file.details');
