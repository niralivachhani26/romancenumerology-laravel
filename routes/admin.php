<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DailyAngelController;
use App\Http\Controllers\Admin\LoveTarotController;
use App\Http\Controllers\Admin\WealthTarotController;
use App\Http\Controllers\Admin\LoveQuestionsController;
use App\Http\Controllers\Admin\LoveQuestionAnswerController;
use App\Http\Controllers\Admin\AdsBaseController;
use App\Http\Controllers\Admin\AdsManagerController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\AffiliateContestController;
use App\Http\Controllers\Admin\DivineAngelicMessageController;
use App\Http\Controllers\Admin\LuckyTarotController;
use App\Http\Controllers\Admin\AffirmationController;
use App\Http\Controllers\Admin\PrayerCategoryController;
use App\Http\Controllers\Admin\PrayerArticleController;
use App\Http\Controllers\Admin\LoveQuizCategoryController;
use App\Http\Controllers\Admin\LoveQuizArticleController;
use App\Http\Controllers\Admin\AngelNumberController;
use App\Http\Controllers\Admin\MaskUrlController;
use App\Http\Controllers\Admin\LuckyNumberController;
use App\Http\Controllers\Admin\LoveAuraController;
use App\Http\Controllers\Admin\LoveChakraController;
use App\Http\Controllers\Admin\LoveCrystalController;
use App\Http\Controllers\Admin\LoveFengShuiController;
use App\Http\Controllers\Admin\MoonologyReadingController;
use App\Http\Controllers\Admin\FortuneCookieController;
use App\Http\Controllers\Admin\CoffeeCupReadingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/signup', [AdminAuthController::class, 'signup'])->name('signup');
// Route::get('/login', [AdminAuthController::class, 'login'])->name('adminLogin');
// Route::post('/login', [AdminAuthController::class, 'login'])->name('adminLoginPost');
// Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


// Route::group(['middleware' => 'adminauth'], function () {
//     Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

//     Route::group(['prefix' => 'login-history'],function(){
//         Route::get('/', [DashboardController::class, 'login_history'])->name('admin.login.history');
//         Route::post('/', [DashboardController::class, 'login_history'])->name('admin.login.historypost');
//         Route::get('/{history}', [DashboardController::class, 'login_history_view'])->name('admin.login.history.view');
//     });

//     Route::group(['prefix' => 'manage'],function(){
//         Route::group(['prefix' => 'admin'],function(){
//             Route::get('/change-password/{id?}', [AdminController::class, 'change_password'])->name('admin.manage.admin.change-password');
//             Route::post('/change-password/{id?}', [AdminController::class, 'change_password'])->name('admin.manage.admin.change-password.post');

//             Route::get('/', [AdminController::class, 'index'])->name('admin.manage.admin.index');
//             Route::post('/', [AdminController::class, 'index'])->name('admin.manage.admin.index.post');
//             Route::get('/add', [AdminController::class, 'add'])->name('admin.manage.admin.add');
//             Route::post('/add', [AdminController::class, 'add'])->name('admin.manage.admin.add.post');
//             Route::get('/{id}', [AdminController::class, 'view'])->name('admin.manage.admin.view');
//             Route::get('/edit/{id}', [AdminController::class, 'add'])->name('admin.manage.admin.edit');
//             Route::post('/edit/{id}', [AdminController::class, 'add'])->name('admin.manage.admin.edit.post');

//         });
//         Route::group(['prefix' => 'user'],function(){
//             Route::get('/', [UserController::class, 'index'])->name('admin.manage.user.index');
//             Route::post('/', [UserController::class, 'index'])->name('admin.manage.user.index.post');
//             Route::get('/add', [UserController::class, 'add'])->name('admin.manage.user.add');
//             Route::post('/add', [UserController::class, 'add'])->name('admin.manage.user.add.post');
//             Route::get('/{id}', [UserController::class, 'view'])->name('admin.manage.user.view');
//             Route::get('/edit/{id}', [UserController::class, 'add'])->name('admin.manage.user.edit');
//             Route::post('/edit/{id}', [UserController::class, 'add'])->name('admin.manage.user.edit.post');
//         });
//     });

//     // Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
//     // Route::post('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
//     Route::group(['prefix' => 'orders'],function(){
//         Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index');
//         Route::post('/', [OrderController::class, 'index'])->name('admin.orders.index.post');
//         Route::get('/add', [OrderController::class, 'add'])->name('admin.orders.add');
//         Route::post('/add', [OrderController::class, 'add'])->name('admin.orders.add.post');
//         Route::get('/{id}', [OrderController::class, 'view'])->name('admin.orders.view');
//         Route::get('/edit/{id}', [OrderController::class, 'add'])->name('admin.orders.edit');
//         Route::post('/edit/{id}', [OrderController::class, 'add'])->name('admin.orders.edit.post');
//     });

//     Route::group(['prefix' => 'daily-angel-love-message'],function(){
//         Route::get('/', [DailyAngelController::class, 'index'])->name('admin.daily-angel.index');
//         Route::post('/', [DailyAngelController::class, 'index'])->name('admin.daily-angel.index.post');
//         Route::get('/add', [DailyAngelController::class, 'add'])->name('admin.daily-angel.add');
//         Route::post('/add', [DailyAngelController::class, 'add'])->name('admin.daily-angel.add.post');
//         Route::get('/{id}', [DailyAngelController::class, 'view'])->name('admin.daily-angel.view');
//         Route::get('/edit/{id}', [DailyAngelController::class, 'add'])->name('admin.daily-angel.edit');
//         Route::post('/edit/{id}', [DailyAngelController::class, 'add'])->name('admin.daily-angel.edit.post');
//     });

//     Route::group(['prefix' => 'love-tarot'],function(){
//         Route::get('/', [LoveTarotController::class, 'index'])->name('admin.love-tarot.index');
//         Route::post('/', [LoveTarotController::class, 'index'])->name('admin.love-tarot.index.post');
//         Route::get('/add', [LoveTarotController::class, 'add'])->name('admin.love-tarot.add');
//         Route::post('/add', [LoveTarotController::class, 'add'])->name('admin.love-tarot.add.post');
//         Route::get('/{id}', [LoveTarotController::class, 'view'])->name('admin.love-tarot.view');
//         Route::get('/edit/{id}', [LoveTarotController::class, 'add'])->name('admin.love-tarot.edit');
//         Route::post('/edit/{id}', [LoveTarotController::class, 'add'])->name('admin.love-tarot.edit.post');
//     });

//     Route::group(['prefix' => 'wealth-tarot'],function(){
//         Route::get('/', [WealthTarotController::class, 'index'])->name('admin.wealth-tarot.index');
//         Route::post('/', [WealthTarotController::class, 'index'])->name('admin.wealth-tarot.index.post');
//         Route::get('/add', [WealthTarotController::class, 'add'])->name('admin.wealth-tarot.add');
//         Route::post('/add', [WealthTarotController::class, 'add'])->name('admin.wealth-tarot.add.post');
//         Route::get('/{id}', [WealthTarotController::class, 'view'])->name('admin.wealth-tarot.view');
//         Route::get('/edit/{id}', [WealthTarotController::class, 'add'])->name('admin.wealth-tarot.edit');
//         Route::post('/edit/{id}', [WealthTarotController::class, 'add'])->name('admin.wealth-tarot.edit.post');
//     });

//     Route::group(['prefix' => 'love'],function(){
//         Route::group(['prefix' => 'questions'],function(){
//             Route::get('/', [LoveQuestionsController::class, 'index'])->name('admin.love.questions.index');
//             Route::post('/', [LoveQuestionsController::class, 'index'])->name('admin.love.questions.index.post');
//             Route::get('/add', [LoveQuestionsController::class, 'add'])->name('admin.love.questions.add');
//             Route::post('/add', [LoveQuestionsController::class, 'add'])->name('admin.love.questions.add.post');
//             Route::get('/{id}', [LoveQuestionsController::class, 'view'])->name('admin.love.questions.view');
//             Route::get('/edit/{id}', [LoveQuestionsController::class, 'add'])->name('admin.love.questions.edit');
//             Route::post('/edit/{id}', [LoveQuestionsController::class, 'add'])->name('admin.love.questions.edit.post');
//         });
//         Route::group(['prefix' => 'article'],function(){
//             Route::get('/', [LoveQuestionAnswerController::class, 'index'])->name('admin.love.article.index');
//             Route::post('/', [LoveQuestionAnswerController::class, 'index'])->name('admin.love.article.index.post');
//             Route::get('/add', [LoveQuestionAnswerController::class, 'add'])->name('admin.love.article.add');
//             Route::post('/add', [LoveQuestionAnswerController::class, 'add'])->name('admin.love.article.add.post');
//             Route::get('/{id}', [LoveQuestionAnswerController::class, 'view'])->name('admin.love.article.view');
//             Route::get('/edit/{id}', [LoveQuestionAnswerController::class, 'add'])->name('admin.love.article.edit');
//             Route::post('/edit/{id}', [LoveQuestionAnswerController::class, 'add'])->name('admin.love.article.edit.post');
//         });
//     });

//     Route::group(['prefix' => 'ads-manager'],function(){
//         Route::get('/', [AdsBaseController::class, 'index'])->name('admin.ads-manager.index');
//         Route::post('/', [AdsBaseController::class, 'index'])->name('admin.ads-manager.index.post');
//         Route::get('/add', [AdsBaseController::class, 'add'])->name('admin.ads-manager.add');
//         Route::post('/add', [AdsBaseController::class, 'add'])->name('admin.ads-manager.add.post');
//         Route::get('/{id}', [AdsBaseController::class, 'view'])->name('admin.ads-manager.view');
//         Route::get('/edit/{id}', [AdsBaseController::class, 'add'])->name('admin.ads-manager.edit');
//         Route::post('/edit/{id}', [AdsBaseController::class, 'add'])->name('admin.ads-manager.edit.post');
//     });

//     Route::group(['prefix' => 'seo'],function(){
//         Route::get('/', [SeoController::class, 'index'])->name('admin.seo.index');
//         Route::post('/', [SeoController::class, 'index'])->name('admin.seo.index.post');
//         Route::get('/add', [SeoController::class, 'add'])->name('admin.seo.add');
//         Route::post('/add', [SeoController::class, 'add'])->name('admin.seo.add.post');
//         Route::get('/{id}', [SeoController::class, 'view'])->name('admin.seo.view');
//         Route::get('/edit/{id}', [SeoController::class, 'add'])->name('admin.seo.edit');
//         Route::post('/edit/{id}', [SeoController::class, 'add'])->name('admin.seo.edit.post');
//     });

//     Route::group(['prefix' => 'page'],function(){
//         Route::get('/', [PageController::class, 'index'])->name('admin.page.index');
//         Route::post('/', [PageController::class, 'index'])->name('admin.page.index.post');
//         Route::get('/add', [PageController::class, 'add'])->name('admin.page.add');
//         Route::post('/add', [PageController::class, 'add'])->name('admin.page.add.post');
//         Route::get('/{id}', [PageController::class, 'view'])->name('admin.page.view');
//         Route::get('/edit/{id}', [PageController::class, 'add'])->name('admin.page.edit');
//         Route::post('/edit/{id}', [PageController::class, 'add'])->name('admin.page.edit.post');
//     });

//     Route::group(['prefix' => 'newsletter'],function(){
//         Route::get('/', [NewsletterController::class, 'index'])->name('admin.newsletter.index');
//         Route::post('/', [NewsletterController::class, 'index'])->name('admin.newsletter.index.post');
//     });

//     Route::group(['prefix' => 'affiliate'],function(){
//         Route::get('/', [AffiliateContestController::class, 'affiliate_index'])->name('admin.affiliate.index');
//         Route::post('/', [AffiliateContestController::class, 'affiliate_index'])->name('admin.affiliate.index.post');
//     });

//     Route::group(['prefix' => 'contest'],function(){
//         Route::get('/', [AffiliateContestController::class, 'contest_index'])->name('admin.contest.index');
//         Route::post('/', [AffiliateContestController::class, 'contest_index'])->name('admin.contest.index.post');

//         Route::get('/view/{id}', [AffiliateContestController::class, 'view'])->name('admin.contest.view');

//         Route::get('/add', [AffiliateContestController::class, 'add'])->name('admin.contest.add');
//         Route::post('/add', [AffiliateContestController::class, 'add'])->name('admin.contest.add.post');

//         Route::get('/edit/{id}', [AffiliateContestController::class, 'add'])->name('admin.contest.edit');
//         Route::post('/edit/{id}', [AffiliateContestController::class, 'add'])->name('admin.contest.edit.post');

//         Route::group(['prefix' => 'daily-lottery'],function(){
//             Route::get('/', [AffiliateContestController::class, 'lottery_index'])->name('admin.contest.daily-lottery.index');
//             Route::post('/', [AffiliateContestController::class, 'lottery_index'])->name('admin.contest.daily-lottery.index.post');
//             Route::get('/view/{id}', [AffiliateContestController::class, 'lottery_view'])->name('admin.contest.daily-lottery.view');
//             Route::get('/add', [AffiliateContestController::class, 'lottery_add'])->name('admin.contest.daily-lottery.add');
//             Route::post('/add', [AffiliateContestController::class, 'lottery_add'])->name('admin.contest.daily-lottery.add.post');
//             Route::get('/edit/{id}', [AffiliateContestController::class, 'lottery_add'])->name('admin.contest.daily-lottery.edit');
//             Route::post('/edit/{id}', [AffiliateContestController::class, 'lottery_add'])->name('admin.contest.daily-lottery.edit.post');
//         });
//     });

//     Route::group(['prefix' => 'divine-angelic-message'],function(){
//         Route::get('/', [DivineAngelicMessageController::class, 'index'])->name('admin.divine-angelic-message.index');
//         Route::post('/', [DivineAngelicMessageController::class, 'index'])->name('admin.divine-angelic-message.index.post');
//         Route::get('/add', [DivineAngelicMessageController::class, 'add'])->name('admin.divine-angelic-message.add');
//         Route::post('/add', [DivineAngelicMessageController::class, 'add'])->name('admin.divine-angelic-message.add.post');
//         Route::get('/{id}', [DivineAngelicMessageController::class, 'view'])->name('admin.divine-angelic-message.view');
//         Route::get('/edit/{id}', [DivineAngelicMessageController::class, 'add'])->name('admin.divine-angelic-message.edit');
//         Route::post('/edit/{id}', [DivineAngelicMessageController::class, 'add'])->name('admin.divine-angelic-message.edit.post');
//     });

//     Route::group(['prefix' => 'lucky-tarot'],function(){
//         Route::get('/', [LuckyTarotController::class, 'index'])->name('admin.lucky-tarot.index');
//         Route::post('/', [LuckyTarotController::class, 'index'])->name('admin.lucky-tarot.index.post');
//         Route::get('/add', [LuckyTarotController::class, 'add'])->name('admin.lucky-tarot.add');
//         Route::post('/add', [LuckyTarotController::class, 'add'])->name('admin.lucky-tarot.add.post');
//         Route::get('/{id}', [LuckyTarotController::class, 'view'])->name('admin.lucky-tarot.view');
//         Route::get('/edit/{id}', [LuckyTarotController::class, 'add'])->name('admin.lucky-tarot.edit');
//         Route::post('/edit/{id}', [LuckyTarotController::class, 'add'])->name('admin.lucky-tarot.edit.post');
//     });

//     Route::group(['prefix' => 'affirmation'],function(){
//         Route::get('/', [AffirmationController::class, 'index'])->name('admin.affirmation.index');
//         Route::post('/', [AffirmationController::class, 'index'])->name('admin.affirmation.index.post');
//         Route::get('/add', [AffirmationController::class, 'add'])->name('admin.affirmation.add');
//         Route::post('/add', [AffirmationController::class, 'add'])->name('admin.affirmation.add.post');
//         Route::get('/{id}', [AffirmationController::class, 'view'])->name('admin.affirmation.view');
//         Route::get('/edit/{id}', [AffirmationController::class, 'add'])->name('admin.affirmation.edit');
//         Route::post('/edit/{id}', [AffirmationController::class, 'add'])->name('admin.affirmation.edit.post');
//     });

//     Route::group(['prefix' => 'prayer'],function(){
//         Route::group(['prefix' => 'category'],function(){
//             Route::get('/', [PrayerCategoryController::class, 'index'])->name('admin.prayer.category.index');
//             Route::post('/', [PrayerCategoryController::class, 'index'])->name('admin.prayer.category.index.post');
//             Route::get('/add', [PrayerCategoryController::class, 'add'])->name('admin.prayer.category.add');
//             Route::post('/add', [PrayerCategoryController::class, 'add'])->name('admin.prayer.category.add.post');
//             Route::get('/{id}', [PrayerCategoryController::class, 'view'])->name('admin.prayer.category.view');
//             Route::get('/edit/{id}', [PrayerCategoryController::class, 'add'])->name('admin.prayer.category.edit');
//             Route::post('/edit/{id}', [PrayerCategoryController::class, 'add'])->name('admin.prayer.category.edit.post');
//         });
//         Route::group(['prefix' => 'article'],function(){
//             Route::get('/', [PrayerArticleController::class, 'index'])->name('admin.prayer.article.index');
//             Route::post('/', [PrayerArticleController::class, 'index'])->name('admin.prayer.article.index.post');
//             Route::get('/add', [PrayerArticleController::class, 'add'])->name('admin.prayer.article.add');
//             Route::post('/add', [PrayerArticleController::class, 'add'])->name('admin.prayer.article.add.post');
//             Route::get('/{id}', [PrayerArticleController::class, 'view'])->name('admin.prayer.article.view');
//             Route::get('/edit/{id}', [PrayerArticleController::class, 'add'])->name('admin.prayer.article.edit');
//             Route::post('/edit/{id}', [PrayerArticleController::class, 'add'])->name('admin.prayer.article.edit.post');
//         });
//     });

//     Route::group(['prefix' => 'love-quiz'],function(){
//         Route::group(['prefix' => 'category'],function(){
//             Route::get('/', [LoveQuizCategoryController::class, 'index'])->name('admin.love-quiz.category.index');
//             Route::post('/', [LoveQuizCategoryController::class, 'index'])->name('admin.love-quiz.category.index.post');
//             Route::get('/add', [LoveQuizCategoryController::class, 'add'])->name('admin.love-quiz.category.add');
//             Route::post('/add', [LoveQuizCategoryController::class, 'add'])->name('admin.love-quiz.category.add.post');
//             Route::get('/{id}', [LoveQuizCategoryController::class, 'view'])->name('admin.love-quiz.category.view');
//             Route::get('/edit/{id}', [LoveQuizCategoryController::class, 'add'])->name('admin.love-quiz.category.edit');
//             Route::post('/edit/{id}', [LoveQuizCategoryController::class, 'add'])->name('admin.love-quiz.category.edit.post');
//         });
//         Route::group(['prefix' => 'article'],function(){
//             Route::get('/', [LoveQuizArticleController::class, 'index'])->name('admin.love-quiz.article.index');
//             Route::post('/', [LoveQuizArticleController::class, 'index'])->name('admin.love-quiz.article.index.post');
//             Route::get('/add', [LoveQuizArticleController::class, 'add'])->name('admin.love-quiz.article.add');
//             Route::post('/add', [LoveQuizArticleController::class, 'add'])->name('admin.love-quiz.article.add.post');
//             Route::get('/{id}', [LoveQuizArticleController::class, 'view'])->name('admin.love-quiz.article.view');
//             Route::get('/edit/{id}', [LoveQuizArticleController::class, 'add'])->name('admin.love-quiz.article.edit');
//             Route::post('/edit/{id}', [LoveQuizArticleController::class, 'add'])->name('admin.love-quiz.article.edit.post');
//         });
//     });

//     Route::group(['prefix' => 'angel-numbers'],function(){
//         Route::get('/', [AngelNumberController::class, 'index'])->name('admin.angel-numbers.index');
//         Route::post('/', [AngelNumberController::class, 'index'])->name('admin.angel-numbers.index.post');
//         Route::get('/add', [AngelNumberController::class, 'add'])->name('admin.angel-numbers.add');
//         Route::post('/add', [AngelNumberController::class, 'add'])->name('admin.angel-numbers.add.post');
//         Route::get('/{id}', [AngelNumberController::class, 'view'])->name('admin.angel-numbers.view');
//         Route::get('/edit/{id}', [AngelNumberController::class, 'add'])->name('admin.angel-numbers.edit');
//         Route::post('/edit/{id}', [AngelNumberController::class, 'add'])->name('admin.angel-numbers.edit.post');
//     });

//     Route::group(['prefix' => 'mask-url'],function(){
//         Route::get('/', [MaskUrlController::class, 'index'])->name('admin.mask-url.index');
//         Route::post('/', [MaskUrlController::class, 'index'])->name('admin.mask-url.index.post');
//         Route::get('/add', [MaskUrlController::class, 'add'])->name('admin.mask-url.add');
//         Route::post('/add', [MaskUrlController::class, 'add'])->name('admin.mask-url.add.post');
//         Route::get('/{id}', [MaskUrlController::class, 'view'])->name('admin.mask-url.view');
//         Route::get('/edit/{id}', [MaskUrlController::class, 'add'])->name('admin.mask-url.edit');
//         Route::post('/edit/{id}', [MaskUrlController::class, 'add'])->name('admin.mask-url.edit.post');
//     });

//     Route::group(['prefix' => 'lucky-number'],function(){
//         Route::get('/', [LuckyNumberController::class, 'index'])->name('admin.lucky-number.index');
//         Route::post('/', [LuckyNumberController::class, 'index'])->name('admin.lucky-number.index.post');
//         Route::get('/add', [LuckyNumberController::class, 'add'])->name('admin.lucky-number.add');
//         Route::post('/add', [LuckyNumberController::class, 'add'])->name('admin.lucky-number.add.post');
//         Route::get('/{id}', [LuckyNumberController::class, 'view'])->name('admin.lucky-number.view');
//         Route::get('/edit/{id}', [LuckyNumberController::class, 'add'])->name('admin.lucky-number.edit');
//         Route::post('/edit/{id}', [LuckyNumberController::class, 'add'])->name('admin.lucky-number.edit.post');
//     });

//     Route::group(['prefix' => 'love-aura'],function(){
//         Route::get('/', [LoveAuraController::class, 'index'])->name('admin.love-aura.index');
//         Route::post('/', [LoveAuraController::class, 'index'])->name('admin.love-aura.index.post');
//         Route::get('/add', [LoveAuraController::class, 'add'])->name('admin.love-aura.add');
//         Route::post('/add', [LoveAuraController::class, 'add'])->name('admin.love-aura.add.post');
//         Route::get('/{id}', [LoveAuraController::class, 'view'])->name('admin.love-aura.view');
//         Route::get('/edit/{id}', [LoveAuraController::class, 'add'])->name('admin.love-aura.edit');
//         Route::post('/edit/{id}', [LoveAuraController::class, 'add'])->name('admin.love-aura.edit.post');
//     });

//     Route::group(['prefix' => 'love-chakra'],function(){
//         Route::get('/', [LoveChakraController::class, 'index'])->name('admin.love-chakra.index');
//         Route::post('/', [LoveChakraController::class, 'index'])->name('admin.love-chakra.index.post');
//         Route::get('/add', [LoveChakraController::class, 'add'])->name('admin.love-chakra.add');
//         Route::post('/add', [LoveChakraController::class, 'add'])->name('admin.love-chakra.add.post');
//         Route::get('/{id}', [LoveChakraController::class, 'view'])->name('admin.love-chakra.view');
//         Route::get('/edit/{id}', [LoveChakraController::class, 'add'])->name('admin.love-chakra.edit');
//         Route::post('/edit/{id}', [LoveChakraController::class, 'add'])->name('admin.love-chakra.edit.post');
//     });

//     Route::group(['prefix' => 'love-crystal'],function(){
//         Route::get('/', [LoveCrystalController::class, 'index'])->name('admin.love-crystal.index');
//         Route::post('/', [LoveCrystalController::class, 'index'])->name('admin.love-crystal.index.post');
//         Route::get('/add', [LoveCrystalController::class, 'add'])->name('admin.love-crystal.add');
//         Route::post('/add', [LoveCrystalController::class, 'add'])->name('admin.love-crystal.add.post');
//         Route::get('/{id}', [LoveCrystalController::class, 'view'])->name('admin.love-crystal.view');
//         Route::get('/edit/{id}', [LoveCrystalController::class, 'add'])->name('admin.love-crystal.edit');
//         Route::post('/edit/{id}', [LoveCrystalController::class, 'add'])->name('admin.love-crystal.edit.post');
//     });

//     Route::group(['prefix' => 'love-feng-shui'],function(){
//         Route::get('/', [LoveFengShuiController::class, 'index'])->name('admin.love-feng-shui.index');
//         Route::post('/', [LoveFengShuiController::class, 'index'])->name('admin.love-feng-shui.index.post');
//         Route::get('/add', [LoveFengShuiController::class, 'add'])->name('admin.love-feng-shui.add');
//         Route::post('/add', [LoveFengShuiController::class, 'add'])->name('admin.love-feng-shui.add.post');
//         Route::get('/{id}', [LoveFengShuiController::class, 'view'])->name('admin.love-feng-shui.view');
//         Route::get('/edit/{id}', [LoveFengShuiController::class, 'add'])->name('admin.love-feng-shui.edit');
//         Route::post('/edit/{id}', [LoveFengShuiController::class, 'add'])->name('admin.love-feng-shui.edit.post');
//     });

//     Route::group(['prefix' => 'moonology-reading'],function(){
//         Route::get('/', [MoonologyReadingController::class, 'index'])->name('admin.moonology-reading.index');
//         Route::post('/', [MoonologyReadingController::class, 'index'])->name('admin.moonology-reading.index.post');
//         Route::get('/add', [MoonologyReadingController::class, 'add'])->name('admin.moonology-reading.add');
//         Route::post('/add', [MoonologyReadingController::class, 'add'])->name('admin.moonology-reading.add.post');
//         Route::get('/{id}', [MoonologyReadingController::class, 'view'])->name('admin.moonology-reading.view');
//         Route::get('/edit/{id}', [MoonologyReadingController::class, 'add'])->name('admin.moonology-reading.edit');
//         Route::post('/edit/{id}', [MoonologyReadingController::class, 'add'])->name('admin.moonology-reading.edit.post');
//     });

//     Route::group(['prefix' => 'fortune-cookie'],function(){
//         Route::get('/', [FortuneCookieController::class, 'index'])->name('admin.fortune-cookie.index');
//         Route::post('/', [FortuneCookieController::class, 'index'])->name('admin.fortune-cookie.index.post');
//         Route::get('/add', [FortuneCookieController::class, 'add'])->name('admin.fortune-cookie.add');
//         Route::post('/add', [FortuneCookieController::class, 'add'])->name('admin.fortune-cookie.add.post');
//         Route::get('/{id}', [FortuneCookieController::class, 'view'])->name('admin.fortune-cookie.view');
//         Route::get('/edit/{id}', [FortuneCookieController::class, 'add'])->name('admin.fortune-cookie.edit');
//         Route::post('/edit/{id}', [FortuneCookieController::class, 'add'])->name('admin.fortune-cookie.edit.post');
//     });

//     Route::group(['prefix' => 'coffee-cup-reading'],function(){
//         Route::get('/', [CoffeeCupReadingController::class, 'index'])->name('admin.coffee-cup-reading.index');
//         Route::post('/', [CoffeeCupReadingController::class, 'index'])->name('admin.coffee-cup-reading.index.post');
//         Route::get('/add', [CoffeeCupReadingController::class, 'add'])->name('admin.coffee-cup-reading.add');
//         Route::post('/add', [CoffeeCupReadingController::class, 'add'])->name('admin.coffee-cup-reading.add.post');
//         Route::get('/{id}', [CoffeeCupReadingController::class, 'view'])->name('admin.coffee-cup-reading.view');
//         Route::get('/edit/{id}', [CoffeeCupReadingController::class, 'add'])->name('admin.coffee-cup-reading.edit');
//         Route::post('/edit/{id}', [CoffeeCupReadingController::class, 'add'])->name('admin.coffee-cup-reading.edit.post');
//     });

//     Route::post('/content/image/upload', [AdminController::class, 'blogImageUpload'])->name('admin.blog.image.upload');

// });
