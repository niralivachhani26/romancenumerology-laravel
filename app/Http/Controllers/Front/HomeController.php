<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DailyAngel;
use App\Models\LoveTarot;
use App\Models\WealthTarot;
use App\Models\LoveQuestions;
use App\Models\LoveQuestionAnswer;
use App\Models\WPPost;
use App\Models\WPPostMeta;
use App\Models\Seo;
use App\Models\Page;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\ZodiacSign;
use App\Models\AuspiciousQuestions;
use App\Models\AuspiciousArticles;
use App\Models\LordMessage;
use App\Common\DivineApi;
use App\Models\AdsBase;
use App\Models\TarotMessage;
use App\Models\AngelCard;
use App\Models\User;
use App\Models\ActiveCampaign;
use App\Models\DivineAngelicMessage;
use App\Models\LuckyTarot;
use App\Models\Affirmation;
use App\Models\PrayerCategory;
use App\Models\PrayerArticle;
use App\Models\LoveQuizCategory;
use App\Models\LoveQuizArticle;
use App\Models\AngelNumber;
use App\Models\LuckyNumber;
use App\Models\MaskUrl;
use App\Models\Question;
use App\Models\Article;
use App\Models\lucky_tarot;
use App\Models\ZodiacNumerology;
use App\Models\LoveAura;
use App\Models\LoveChakra;
use App\Models\LoveCrystal;
use App\Models\LoveFeng;
use App\Models\MoonologyReading;
use App\Models\FortuneCookie;
use App\Models\CoffeeCupReading;
use DB;
use URL;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Mail\SendSketch;
use Illuminate\Support\Facades\Mail;
use App\Models\GptPromptPdfContent;
use App\Models\Transcript;
use App\Jobs\GenerateSoulSketchPdfContent;
use Illuminate\Support\Facades\Log;
require_once base_path() . '/public/mpdf/vendor/autoload.php';



class HomeController extends Controller
{
    public function index(Request $request){
        $model = '';
        $WPPostMeta = WPPostMeta::where(['meta_key' => 'post_views_count'])
            // ->orWhere(['meta_key' => 'ekit_post_views_count'])
            // ->orderBy('meta_value', 'ASC')
            ->orderBy('meta_value', 'DESC')
            ->limit(16)
            ->get();

        $post_main = [];
        $recommended = [];
        $post_data = [];

        // print_r('<pre>');
        foreach($WPPostMeta as $key => $data){
            $temp_data = WPPost::where(['ID' => $data['post_id']])->first();
            // print_r($data);
            // print_r($temp_data);
            // die();
            if(empty($temp_data)){
                continue;
            }
            $image = $temp_data->getImage();
            if(empty($image)){
                continue;
            }
            $temp_data->image = $image;
            $post_data[] = $temp_data;
            $post_main[$data['post_id']] = $data['meta_value'];
            $recommended[] = $data['post_id'];
            if(count($recommended) >= 6){
                break;
            }
            // print_r($post_main);
            // die('here');
        }
        // // $posts->post_content = '';
        // print_r('<pre>');
        // print_r($post_main);
        // die('here');

        $posts = WPPost::select('*')
            // ->where('post_author', '<>', 0)
            // ->where('pinged', '<>', '')
            ->where(['post_type' => 'post'])
            ->where('post_content', '<>', '')
            ->where('post_title', '<>', '')
            ->where('pinged', 'NOT LIKE', '%https://cosmiclovetarot.com/auto-draft/%')
            ->whereNotIn('ID', $recommended)
            ->orderBy('post_modified_gmt', 'DESC')
            ->orderBy('ID', 'DESC');
            // ->limit(26)->get();

        $slider_post = $posts;
        $top_section_post = $posts;
        $more_post = $posts;
        $footer_post = $posts;

        $slider_post = $slider_post->skip(0)->limit(5)->get();
        $top_section_post = $top_section_post->skip(5)->limit(2)->get();
        $more_post = $more_post->skip(7)->limit(15)->get();
        $footer_post = $footer_post->skip(22)->limit(5)->get();
        // $footer_post = $footer_post->skip(23)->get();

        // print_r('<pre>');
        // // https://cosmiclovetarot.com/the-lover-archetype-understanding-the-depths
        // // $posts->post_content = '';
        // print_r($posts->get()->toArray());
        // die();
        $signs = ZodiacSign::get();
        $apidata = DivineApi::getDailyTarot();
        $model = new ZodiacSign();

        Session::put('daily_tarot', $apidata);

        return view('front.home.index', compact('slider_post', 'top_section_post', 'more_post', 'footer_post', 'post_data', 'signs', 'apidata', 'model'));
    }

    public function blog(Request $request){
        $model = '';
        $WPPostMeta = WPPostMeta::where(['meta_key' => 'post_views_count'])
            // ->orWhere(['meta_key' => 'ekit_post_views_count'])
            // ->orderBy('meta_value', 'ASC')
            ->orderBy('meta_value', 'DESC')
            ->limit(16)
            ->get();

        $post_main = [];
        $recommended = [];
        $post_data = [];

        // print_r('<pre>');
        foreach($WPPostMeta as $key => $data){
            $temp_data = WPPost::where(['ID' => $data['post_id']])->first();
            // print_r($data);
            // print_r($temp_data);
            // die();
            if(empty($temp_data)){
                continue;
            }
            $image = $temp_data->getImage();
            if(empty($image)){
                continue;
            }
            $temp_data->image = $image;
            $post_data[] = $temp_data;
            $post_main[$data['post_id']] = $data['meta_value'];
            $recommended[] = $data['post_id'];
            if(count($recommended) >= 6){
                break;
            }
            // print_r($post_main);
            // die('here');
        }
        // // $posts->post_content = '';
        // print_r('<pre>');
        // print_r($post_main);
        // die('here');

        $posts = WPPost::select('*')
            // ->where('post_author', '<>', 0)
            // ->where('pinged', '<>', '')
            ->where(['post_type' => 'post'])
            ->where('post_content', '<>', '')
            ->where('post_title', '<>', '')
            ->where('pinged', 'NOT LIKE', '%https://cosmiclovetarot.com/auto-draft/%')
            ->whereNotIn('ID', $recommended)
            ->orderBy('post_modified_gmt', 'DESC')
            ->orderBy('ID', 'DESC');
            // ->limit(26)->get();

        $slider_post = $posts;
        $top_section_post = $posts;
        $more_post = $posts;
        $footer_post = $posts;

        $slider_post = $slider_post->skip(0)->limit(5)->get();
        $top_section_post = $top_section_post->skip(5)->limit(2)->get();
        $more_post = $more_post->skip(7)->limit(15)->get();
        $footer_post = $footer_post->skip(22)->limit(5)->get();
        // $footer_post = $footer_post->skip(23)->get();

        // print_r('<pre>');
        // // https://cosmiclovetarot.com/the-lover-archetype-understanding-the-depths
        // // $posts->post_content = '';
        // print_r($posts->get()->toArray());
        // die();

        return view('front.home.blog', compact('slider_post', 'top_section_post', 'more_post', 'footer_post', 'post_data'));
    }

    public function page(Request $request, $page = ''){
        $page = Page::where(['slug' => $page])->first();
        if(empty($page)){
            abort(404);
        }
        return view('front.home.page', compact('page'));
    }

    public function newsletter(Request $request){
        if($request->ajax() || $request->isMethod('post')){
            $validation_array = [
                'name' => 'required',
                'email' => "required|email|unique:newsletters,email",
            ];

            $messages = array(
                'name.required' => 'Please enter name',
                'email.required' => 'Please enter email',
                'email.unique' => 'This email has already subscribed newsletter',
            );

            $validator = Validator::make($request->all(), $validation_array, $messages);
            if ($validator->fails()) {
                $response = $validator->errors();
                return response()->json($response, 200);
            }
            $model = new Newsletter();
            $model->name = $request->name;
            $model->email = $request->email;
            if(!$model->save()){
                $response = ['error' => ["Something went wrong."]];
                return response()->json($response, 200);
            }

            $msg = "Newsletter Subscribed Successfully";
            $response = ['success' => [$msg, 'Success']];
            return response()->json($response, 200);
        }
        return redirect()->route('home');
    }

    public function daily_angel_love_message(Request $request, $angel = ''){
        $angels = [
            'gabriel',
            'michael',
            'raphael',
            'selaphiel',
            'uriel',
        ];
        if(!empty($angel)){
            $data = Session::get('daily_angel');
            $admin_view = DailyAngel::where(['id' => $angel])->inRandomOrder()->first();
            if(!empty($admin_view)){
                $data = $admin_view;
                $angel = array_rand($angels);
                $angel = $angels[$angel];
            }
            if(empty($admin_view) && !in_array($angel, $angels)){
                return redirect()->route('daily-angel-love-message');
            }
            if(empty($data)){
                return redirect()->route('daily-angel-love-message');
            }
            // $data->description = str_replace('##in_article_ad##', '', $data->description);
            // echo '';
            // print_r($data->description);
            // die();

            $seo = new Seo();
            $seo->slug = url($request->path());
            $seo->meta_title = $data->title . ' - ' . ucfirst($angel) . ' Love Message';
            $seo->meta_keyword = $data->title;
            $seo->meta_description = getMetaDescription($data->description);

            return view('front.daily_angel_love_message.reading', compact('angels', 'angel', 'data', 'seo'));
        }else{
            $data = DailyAngel::where(['status' => DailyAngel::STATUS_ACTIVE])->inRandomOrder()->first();
            Session::put('daily_angel', $data);
            return view('front.daily_angel_love_message.index', compact('angels'));
        }
    }

    public function love_tarot(Request $request, $reading = ''){
        if(!empty($reading)){
            $data = Session::get('love_tarot');
            $admin_view = LoveTarot::where(['id' => $reading])->inRandomOrder()->first();
            if(!empty($admin_view)){
                $data = $admin_view;
            }
            if(empty($data)){
                return redirect()->route('love_tarot');
            }
            // $data->description = str_replace('##in_article_ad##', '', $data->description);
            $seo = new Seo();
            $seo->slug = url($request->path());
            $seo->meta_title = $data->title . ' - Love Tarot';
            $seo->meta_keyword = $data->title;
            $seo->meta_description = getMetaDescription($data->description);

            return view('front.love_tarot.result', compact('data', 'seo'));
        }else{
            $data = LoveTarot::where(['status' => LoveTarot::STATUS_ACTIVE])->inRandomOrder()->first();
            Session::put('love_tarot', $data);
            return view('front.love_tarot.index');
        }
    }

    public function wealth_tarot(Request $request, $reading = ''){
        if(!empty($reading)){
            $data = Session::get('wealth_tarot');
            $admin_view = WealthTarot::where(['id' => $reading])->inRandomOrder()->first();
            if(!empty($admin_view)){
                $data = $admin_view;
            }
            if(empty($data)){
                return redirect()->route('wealth_tarot');
            }
            // $data->description = str_replace('##in_article_ad##', '', $data->description);
            $seo = new Seo();
            $seo->slug = url($request->path());
            $seo->meta_title = $data->title . ' - Wealth Tarot';
            $seo->meta_keyword = $data->title;
            $seo->meta_description = getMetaDescription($data->description);

            return view('front.wealth_tarot.result', compact('data', 'seo'));
        }else{
            $data = WealthTarot::where(['status' => WealthTarot::STATUS_ACTIVE])->inRandomOrder()->first();
            Session::put('wealth_tarot', $data);
            return view('front.wealth_tarot.index');
        }
    }

    public function love_questions(Request $request, $reading = '', $id = ''){
        if(!empty($reading)){
            if(empty($id)){
                // Session::forget('data');
                $session_data = Session::get('love_questions');
                if(!isset($session_data[$reading])){
                    $question = LoveQuestions::where(['slug' => $reading])->first();
                    $data = LoveQuestionAnswer::where(['question_id' => $question->id, 'status' => LoveQuestionAnswer::STATUS_ACTIVE])->inRandomOrder()->first();
                    $session_data[$reading] = $data;
                    Session::put('love_questions', $session_data);
                    // print_r($reading);
                    // die('fdsda');
                }
                $session_data = Session::get('love_questions');
                if(!isset($session_data[$reading]) || empty($session_data[$reading])){
                    return redirect()->route('love_questions');
                }
                $data = $session_data[$reading];
            }else{
                $data = LoveQuestionAnswer::where(['id' => $id])->inRandomOrder()->first();
                if(empty($data)){
                    abort(404);
                }
            }

            // $data->description = str_replace('##in_article_ad##', '', $data->description);

            $seo = new Seo();
            $seo->slug = url($request->path());
            $seo->meta_title = $data->question->title . ' - Love Questions';
            $seo->meta_keyword = $data->title;
            $seo->meta_description = getMetaDescription($data->description);

            return view('front.love_questions.result', compact('data', 'seo'));
        }else{

            $questions = LoveQuestions::where(['status' => LoveQuestions::STATUS_ACTIVE])->get();

            return view('front.love_questions.index', compact('questions'));
        }
    }

    public function angel_cards(Request $request, $reading = '', $id = ''){
        $angelArr = [
            'Arielle', 'Azure', 'Celeste', 'Chantall', 'Crystal', 'Gab', 'Grace','Isaiah', 'Maya', 'Merlina', 'Michael', 'Omega', 'Patience', 'Raphael', 'Raye', 'Serephina', 'Shanti','Zanna'
        ];
        if(!empty($reading) && $reading != 'angels'){
            $data = AngelCard::where(['slug' => $reading])->first();

            $ads = AdsBase::where(['status' => 1])->first();

            $data->description = str_replace('##in_article_ads##', '', $data->description);
            $data->description = str_replace('##in_article_ad##', $ads->in_article_ad, $data->description);

            $seo = new Seo();
            $seo->slug = url($request->path());
            $seo->meta_title = $data->title . ' - Angel Cards';
            $seo->meta_keyword = $data->title;
            $seo->meta_description = getMetaDescription($data->description);

            return view('front.angel_cards.result', compact('data', 'seo'));
        }elseif(!empty($reading) && $reading == 'angels'){
            $angel_cards = AngelCard::where(['status' => AngelCard::STATUS_ACTIVE])->limit(18)->get();

            shuffle($angelArr);

            return view('front.angel_cards.angels', compact('angel_cards', 'angelArr'));

        }else{
            return view('front.angel_cards.index');
        }
    }


    public function auspicious_signs(Request $request, $slug = '', $reading = '', $id = ''){
        if(!empty($slug) && empty($reading)){
            $question = AuspiciousQuestions::where(['slug' => $slug])->first();
            if(empty($question)){
                abort(404);
            }

            $data = AuspiciousArticles::where(['question_id' => $question->id, 'status' => AuspiciousArticles::STATUS_ACTIVE])->inRandomOrder()->first();
            $session_data[$slug] = $data;
            // print_r("<pre>");
            // print_r($session_data);
            // die();
            Session::put('auspicious_signs', $session_data);

            $seo = new Seo();
            $seo->slug = url($request->path());
            $seo->meta_title = $question->title . ' - Auspicious Signs';
            $seo->meta_keyword = $question->title;
            $seo->meta_description = getMetaDescription($question->title);

            return view('front.auspicious_signs.card', compact('question', 'seo'));
        }elseif(!empty($reading)){
            if(empty($id)){
                $session_data = Session::get('auspicious_signs');
                if(!isset($session_data[$slug]) || empty($session_data[$slug])){
                    return redirect()->route('auspicious-signs');
                }
                $data = $session_data[$slug];
            }else{
                $data = LoveQuestionAnswer::where(['id' => $id])->inRandomOrder()->first();
                if(empty($data)){
                    abort(404);
                }
            }

            // $data->description = str_replace('##in_article_ad##', '', $data->description);
            // print_r("<pre>");
            // print_r($data);
            // die();
            $seo = new Seo();
            $seo->slug = url($request->path());
            $seo->meta_title = $data->question->title . ' - Auspicious Signs';
            $seo->meta_keyword = $data->title;
            $seo->meta_description = getMetaDescription($data->description);

            return view('front.auspicious_signs.result', compact('data', 'seo'));
        }else{

            $questions = AuspiciousQuestions::where(['status' => LoveQuestions::STATUS_ACTIVE])->get();

            return view('front.auspicious_signs.index', compact('questions'));
        }
    }

    public function lords_message(Request $request, $reading = '', $id = ''){
        if(!empty($reading)){
            // if(empty($id)){
            //     // Session::forget('data');
            //     $session_data = Session::get('lords_message');
            //     if(!isset($session_data[$reading])){
            //         $question = LoveQuestions::where(['slug' => $reading])->first();
            //         $data = LoveQuestionAnswer::where(['question_id' => $question->id, 'status' => LoveQuestionAnswer::STATUS_ACTIVE])->inRandomOrder()->first();
            //         $session_data[$reading] = $data;
            //         Session::put('lords_message', $session_data);
            //         // print_r($reading);
            //         // die('fdsda');
            //     }
            //     $session_data = Session::get('lords_message');
            //     if(!isset($session_data[$reading]) || empty($session_data[$reading])){
            //         return redirect()->route('lords-message');
            //     }
            //     $data = $session_data[$reading];
            // }else{
            //     $data = LoveQuestionAnswer::where(['id' => $id])->inRandomOrder()->first();
            //     if(empty($data)){
            //         abort(404);
            //     }
            // }


            $seo = new Seo();
            $data = LordMessage::where(['slug' => $reading])->first();
            if(empty($data)){
                abort(404);
            }

            $ads = AdsBase::where(['status' => 1])->first();

            // $data->description = str_replace('##in_article_ad##', '', $data->description);
            $data->description = str_replace('##in_article_ad##', $ads->in_article_ad, $data->description);

            $seo->slug = url($request->path());
            $seo->meta_title = $data->title . ' - Lords Message';
            $seo->meta_keyword = $data->title;
            $seo->meta_description = getMetaDescription($data->description);

            $lords = LordMessage::where(['status' => LordMessage::STATUS_ACTIVE])->inRandomOrder()->limit(8)->get();
            $article = LordMessage::where(['status' => LordMessage::STATUS_ACTIVE])->inRandomOrder()->first();

            return view('front.lords_message.result', compact('data', 'seo', 'lords', 'article'));
        }else{

            $lords = LordMessage::where(['status' => LordMessage::STATUS_ACTIVE])->inRandomOrder()->limit(8)->get();
            $articles = LordMessage::where(['status' => LordMessage::STATUS_ACTIVE])->orderBy('views', 'DESC')->limit(3)->get();

            // print_r("<pre>");
            // print_r($data);
            // die();

            // $questions = LoveQuestions::where(['status' => LoveQuestions::STATUS_ACTIVE])->get();

            return view('front.lords_message.index', compact('lords', 'articles'));
        }
    }

    public function tarot_message(Request $request, $reading = '', $id = ''){
        if(!empty($reading)){

            $seo = new Seo();
            $data = TarotMessage::where(['slug' => $reading])->first();
            if(empty($data)){
                abort(404);
            }

            $ads = AdsBase::where(['status' => 1])->first();

            // $data->description = str_replace('##in_article_ad##', '', $data->description);
            $data->description = str_replace('##in_article_ad##', $ads->in_article_ad, $data->description);

            $seo->slug = url($request->path());
            $seo->meta_title = $data->title . ' - Tarot Message';
            $seo->meta_keyword = $data->title;
            $seo->meta_description = getMetaDescription($data->description);

            $tarots = TarotMessage::where(['status' => TarotMessage::STATUS_ACTIVE])->inRandomOrder()->limit(8)->get();
            $article = TarotMessage::where(['status' => TarotMessage::STATUS_ACTIVE])->inRandomOrder()->first();

            return view('front.tarot_message.result', compact('data', 'seo', 'tarots', 'article'));
        }else{

            $tarots = TarotMessage::where(['status' => TarotMessage::STATUS_ACTIVE])->inRandomOrder()->limit(22)->get();
            $articles = TarotMessage::where(['status' => TarotMessage::STATUS_ACTIVE])->orderBy('views', 'DESC')->limit(3)->get();

            // print_r("<pre>");
            // print_r($data);
            // die();

            // $questions = LoveQuestions::where(['status' => LoveQuestions::STATUS_ACTIVE])->get();

            return view('front.tarot_message.index', compact('tarots', 'articles'));
        }
    }

    public function mailerlite(Request $request){
        ini_set('max_execution_time', -1);

        try {
            $created_at = '2024-01-01';
            $user = User::where(['mailerlite' => 0])->where('created_at', '>=', $created_at)->limit(100)->get();
            foreach($user as $data){
                $result = $this->addMailerliteTags($data->name, $data->email, $data->id);
                if(isset($result['data']['id'])){
                    $data->mailerlite = 1;
                    $data->save();
                }
                print_r($result);
                die();
            }
            print_r(count($user));
            die();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            die();
        }
    }

    public function addMailerliteTags($name, $email, $user_id, $tag = 'soloads leads'){
        $curl = curl_init();

        $url_mailerlite = 'https://connect.mailerlite.com/api/subscribers';

        $data = [
            'email' => $email,
            'fields' => [
                'name' => ucfirst($name),
            ],
            // 'status' => 'active',
        ];

        $json_data = json_encode($data);
        $header = array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI0IiwianRpIjoiODMzN2Y5MTAzY2YyYWZmNjg4M2M5OGEyY2FiYzA1ODMyYjdkMGY2ZTVmOWQ5NDA4ZDM3MTAzYWFmOWRmMmIyNzlhYmIxOTVkMjVjMzRmNGYiLCJpYXQiOjE3MTY4OTE3MDMuNjAxNzg5LCJuYmYiOjE3MTY4OTE3MDMuNjAxNzkxLCJleHAiOjQ4NzI1NjUzMDMuNTk3MDM1LCJzdWIiOiI5Njk1NzgiLCJzY29wZXMiOltdfQ.UscJCvtU3HjlKTuMdmMXkPtU7zVHgpv_gM9eucjdKeClj6JPYtsaX2NuabmRE0RgODdvkrDx7GCXxwJtohdBKSHBjzb9tlQSZGq0yA63ve02a6H3u2uztbFomt2B1IClOQZXH5mvXkvmP8zDVSw3qJ1OBXuCLyxoXAH0IYlfDH00GrmkWmwBk09tMqidbzWju8hxz_4Ybrje_Zz7porM4CD5nUp6Gi8NiFAnhgUPsCyexWd91SxPxU5qkP-cLgqwdn91S38MQWdffHnhCkg7WvaUrh_zPGaR8RQRPzLW5hHnQ8y0XijqyCiyJvhFrthullQxga9RMezIiW8qf7zF7VhIcCmW2JnIv_mhafCKQqzqI5jnqm4TlUlxW6HfsD-PkXiltM3GdpPbpyxPLDPGHRpoOpGdCb0QQ1XIaJOi3Y6Y8eLsAxpgrZRCVvzbYAkLAXNWdeqHhMQDOp6zV6rhP1_2UT2GdN1XUdKs2EX62A2H2hKA3JQplxm9bRp3QGLR71Qc85RP2YSKvgdMAEV79uFHfNqpXriOWWK_ZxplFLxn2GlLciT8lQD06jrjts4nBsyAT953E0lZ_A1OYMtFoONz9MKQwXsaQeGzhO6WJrJdoDaPalJEgIr7Ib02sgTrco3JSUXZjDPoHJggNU3io-w5xiis9Zg720rf2IM1BQQ',
            );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_mailerlite);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        $jsonresult = curl_exec($ch);
        curl_close($ch);
        $result  = json_decode($jsonresult, true);

        // echo '<pre>';
        // print_r($json_data);
        // print_r($result);
        // die();

        if(isset($result['data']['id']) && !empty($result['data']['id'])){
            ActiveCampaign::saveLog($user_id, $result['data']['id'], 'new mailerlite cron');
        }

        return $result;
    }

    public function divine_angelic_message(Request $request, $category = '', $angel = '', $slug = ''){
        $categories = [
            'health',
            'love',
            'wealth',
        ];
        $category_id = [
            'health' => 1,
            'love' => 2,
            'wealth' => 3,
        ];
        $angels = [
            'Arielle', 'Azure', 'Celeste', 'Chantall', 'Crystal', 'Gabrielle', 'Grace','Isaiah', 'Maya', 'Merlina', 'Michael', 'Omega', 'Patience', 'Raphael', 'Raye', 'Serephina', 'Shanti','Zanna'
        ];
        if(!empty($category) && !in_array($category, $categories)){
            return redirect()->route('divine-angelic-message');
        }
        if(!empty($category) && in_array($category, $categories) && empty($angel)){
            $angel_cards = DivineAngelicMessage::where(['category_id' => $category_id[$category]])->where(['status' => DivineAngelicMessage::STATUS_ACTIVE])->limit(18)->inRandomOrder()->get();
            while ($angel_cards->count() < 18) {
                $additionalRows = DivineAngelicMessage::where(['category_id' => $category_id[$category]])->where(['status' => DivineAngelicMessage::STATUS_ACTIVE])->inRandomOrder()->take(18 - $angel_cards->count())->first();
                // print_r([count($angel_cards)]);
                if(empty($additionalRows)){
                    break;
                }
                $angel_cards = $angel_cards->push($additionalRows);
                // print_r([count($angel_cards)]);
                // print_r([count($additionalRows), count($angel_cards)]);
            }
            // print_r($angel_cards);
            // die();

            $seo = new Seo();
            $seo->slug = url($request->path());
            $seo->meta_title = ucwords($category) . ' - Divine Angelic Message';
            $seo->meta_keyword = $category;
            $seo->meta_description = getMetaDescription($category);

            return view('front.divine_angelic_message.category', compact('angel_cards', 'category', 'angels', 'seo'));
        }
        if(!empty($slug)){
            $data = DivineAngelicMessage::where(['slug' => $slug])->first();

            if(empty($data)){
                return redirect()->route('divine-angelic-message');
            }
            $ads = AdsBase::where(['status' => 1])->first();
            $data->description = str_replace('##in_article_ad##', $ads->in_article_ad, $data->description);

            $seo = new Seo();
            $seo->slug = url($request->path());
            $seo->meta_title = $data->title . ' - Divine Angelic Message';
            $seo->meta_keyword = $data->title;
            $seo->meta_description = getMetaDescription($data->description);

            return view('front.divine_angelic_message.reading', compact('angels', 'data', 'seo', 'angel'));
        }else{
            return view('front.divine_angelic_message.index', compact('angels'));
        }
    }

    public function lucky_tarot(Request $request, $slug = ''){
        $categories = [
            'result',
            'details',
        ];
        if(!empty($slug) && !in_array($slug, $categories)){
            return redirect()->route('lucky-tarot');
        }
        if(!empty($slug) && $slug == 'result'){
            // Session::forget('data');
            $session_data = Session::get('lucky_tarot');
            if(!isset($session_data) || empty($session_data)){
                return redirect()->route('lucky-tarot');
            }
            $data = $session_data;
            // print_r("<pre>");
            // print_r($data);
            // die('fdsda');
            $seo = new Seo();
            $seo->slug = url($request->path());
            $seo->meta_title = ucwords($data->lucky_message) . ' - Lucky Tarot';
            $seo->meta_keyword = $data->lucky_message;
            $seo->meta_description = getMetaDescription($data->lucky_message);

            return view('front.lucky_tarot.result', compact('data', 'seo'));
        }
        if(!empty($slug) && $slug == 'details'){
            $session_data = Session::get('lucky_tarot');
            if(!isset($session_data) || empty($session_data)){
                return redirect()->route('lucky-tarot');
            }
            $data = $session_data;

            $ads = AdsBase::where(['status' => 1])->first();
            $data->description = str_replace('##in_article_ad##', $ads->in_article_ad ?? '', $data->description);

            $seo = new Seo();
            $seo->slug = url($request->path());
            $seo->meta_title = ucwords($data->title) . ' - Lucky Tarot';
            $seo->meta_keyword = $data->lucky_message;
            $seo->meta_description = getMetaDescription($data->description);

            return view('front.lucky_tarot.details', compact('data', 'seo'));
        }else{
            $data = LuckyTarot::where(['status' => LuckyTarot::STATUS_ACTIVE])->limit(1)->inRandomOrder()->first();
            $session_data = $data;
            Session::put('lucky_tarot', $session_data);

            return view('front.lucky_tarot.index');
        }
    }

    public function affirmation(Request $request, $slug = '', $id = ''){
        $categories = [
            'result',
            'reading',
        ];
        if(!empty($slug) && !in_array($slug, $categories)){
            return redirect()->route('affirmation');
        }
        if(!empty($slug) && $slug == 'reading'){

            if(!empty($id)){
                $data = Affirmation::where(['id' => $id])->first();
                if(empty($data)){
                    abort(404);
                }
            }else{
                // Session::forget('affirmation');
                $session_data = Session::get('affirmation');
                if(!isset($session_data) || empty($session_data)){
                    return redirect()->route('affirmation');
                }
                $data = $session_data;
            }

            // print_r("<pre>");
            // print_r($data);
            // die('fdsda');
            $seo = new Seo();
            $seo->slug = url($request->path());
            $seo->meta_title = ucwords($data->title) . ' - Affirmation';
            $seo->meta_keyword = $data->title;
            $seo->meta_description = getMetaDescription($data->short_description);

            // $data->short_description = explode('\n', $data->short_description);

            // print_r("<pre>");
            // print_r($data);
            // die('fdsda');

            return view('front.affirmation.reading', compact('data', 'seo', 'id'));
        }
        if(!empty($slug) && $slug == 'result'){
            if(!empty($id)){
                $data = Affirmation::where(['id' => $id])->first();
                if(empty($data)){
                    abort(404);
                }
            }else{
                // Session::forget('affirmation');
                $session_data = Session::get('affirmation');
                if(!isset($session_data) || empty($session_data)){
                    return redirect()->route('affirmation');
                }
                $data = $session_data;
            }

            $ads = AdsBase::where(['status' => 1])->first();
            $data->description = str_replace('##in_article_ad##', $ads->in_article_ad ?? '', $data->description);

            $seo = new Seo();
            $seo->slug = url($request->path());
            $seo->meta_title = ucwords($data->title) . ' - Affirmation';
            $seo->meta_keyword = $data->title;
            $seo->meta_description = getMetaDescription($data->short_description);

            return view('front.affirmation.result', compact('data', 'seo', 'id'));
        }else{
            $data = Affirmation::where(['status' => Affirmation::STATUS_ACTIVE])->limit(1)->inRandomOrder()->first();
            $session_data = $data;
            Session::put('affirmation', $session_data);

            return view('front.affirmation.index', compact('data'));
        }
    }

    public function prayer(Request $request, $category = '', $article = ''){
        if(!empty($category) && empty($article)){

            $category_data = PrayerCategory::where(['slug' => $category])->first();
            if(empty($category_data)){
                abort(404);
            }
            $data = PrayerArticle::where(['category_id' => $category_data->id])->where(['status' => PrayerArticle::STATUS_ACTIVE])->limit(1)->inRandomOrder()->first();
            if(empty($data)){
                abort(403, "Prayer Article empty");
            }

            $seo = new Seo();
            $seo->slug = url($request->path());
            $seo->meta_title = ucwords($category_data->title) . ' - Prayer';
            $seo->meta_keyword = $category_data->title;
            $seo->meta_description = getMetaDescription($category_data->title);

            // $data->short_description = explode('\n', $data->short_description);

            // print_r("<pre>");
            // print_r($data);
            // die('fdsda');

            return view('front.prayer.reading', compact('data', 'seo', 'category_data'));
        }
        if(!empty($category) && !empty($article)){
            $category_data = PrayerCategory::where(['slug' => $category])->first();
            $data = PrayerArticle::where(['category_id' => $category_data->id])->where(['slug' => $article])->first();
            if(empty($data)){
                abort(404);
            }

            $ads = AdsBase::where(['status' => 1])->first();
            $data->description = str_replace('##in_article_ad##', $ads->in_article_ad ?? '', $data->description);

            $seo = new Seo();
            $seo->slug = url($request->path());
            $seo->meta_title = ucwords($data->title) . ' - Prayer';
            $seo->meta_keyword = $data->title;
            $seo->meta_description = getMetaDescription($data->description);

            return view('front.prayer.result', compact('data', 'seo', 'category_data'));
        }else{
            $data = PrayerCategory::where(['status' => PrayerCategory::STATUS_ACTIVE])->get();

            return view('front.prayer.index', compact('data'));
        }
    }

    public function love_quiz(Request $request, $category = '', $article = ''){
        if(!empty($category) && empty($article)){

            $category_data = LoveQuizCategory::where(['slug' => $category])->first();
            if(empty($category_data)){
                abort(404);
            }
            $data = LoveQuizArticle::where(['category_id' => $category_data->id])->where(['status' => LoveQuizArticle::STATUS_ACTIVE])->limit(1)->inRandomOrder()->first();
            if(empty($data)){
                abort(403, "Love Quiz Article empty");
            }

            $seo = new Seo();
            $seo->slug = url($request->path());
            $seo->meta_title = ucwords($category_data->title) . ' - Love Quiz';
            $seo->meta_keyword = $category_data->title;
            $seo->meta_description = getMetaDescription($category_data->title);

            // $data->short_description = explode('\n', $data->short_description);

            // print_r("<pre>");
            // print_r($data);
            // die('fdsda');

            return view('front.love-quiz.reading', compact('data', 'seo', 'category_data'));
        }
        if(!empty($category) && !empty($article)){
            $category_data = LoveQuizCategory::where(['slug' => $category])->first();
            $data = LoveQuizArticle::where(['category_id' => $category_data->id])->where(['slug' => $article])->first();
            if(empty($data)){
                abort(404);
            }

            $ads = AdsBase::where(['status' => 1])->first();
            $data->description = str_replace('##in_article_ad##', $ads->in_article_ad ?? '', $data->description);

            $seo = new Seo();
            $seo->slug = url($request->path());
            $seo->meta_title = ucwords($data->title) . ' - Love Quiz';
            $seo->meta_keyword = $data->title;
            $seo->meta_description = getMetaDescription($data->description);

            return view('front.love-quiz.result', compact('data', 'seo', 'category_data'));
        }else{
            $data = LoveQuizCategory::where(['status' => LoveQuizCategory::STATUS_ACTIVE])->get();

            return view('front.love-quiz.index', compact('data'));
        }
    }

    public function angel_numbers(Request $request, $number = '', $id = ''){
        if(!empty($number)){
            // $category_data = LoveQuizCategory::where(['slug' => $category])->first();
            if(!empty($id)){
                $data = AngelNumber::where(['id' => $id])->inRandomOrder()->first();
            }else{
                $session_data = Session::get('angel_numbers');
                if(!isset($session_data[$number]) || empty($session_data[$number])){
                    $data = AngelNumber::where(['number' => $number, 'status' => AngelNumber::STATUS_ACTIVE])->inRandomOrder()->first();
                    // print_r($data);
                    // die();
                    if(empty($data)){
                        abort(403, 'Article not available');
                    }
                    $session_data[$number] = $data;
                    Session::put('angel_numbers', $session_data);
                }else{
                    $data = $session_data[$number];
                }
            }
            if(empty($data)){
                abort(404);
            }

            $ads = AdsBase::where(['status' => 1])->first();
            $data->description = str_replace('##in_article_ad##', $ads->in_article_ad ?? '', $data->description);

            $seo = new Seo();
            $seo->slug = url($request->path());
            $seo->meta_title = ucwords($data->title) . ' - Angel Number';
            $seo->meta_keyword = $data->title;
            $seo->meta_description = getMetaDescription($data->description);

            return view('front.angel-numbers.result', compact('data', 'seo'));
        }else{
            return view('front.angel-numbers.index');
        }
    }

    public function lucky_number(Request $request, $number = '', $id = ''){
        $numbers = [
            '1-digit',
            '2-digit',
            '3-digit',
            '4-digit',
        ];
        if(in_array($number, $numbers)){
            $rows = 3;
            if(in_array($number, ['2-digit', '4-digit'])){
                $columns = 10;
            }else{
                $columns = 9;
            }
            $show_row = explode('-', $number)[0];
            if($show_row == 4 || $show_row == 3){
                $show_row = 4;
            }else{
                $show_row = 5;
            }
            // $show_number = 7;
            if($number == '1-digit'){
                $data = LuckyNumber::where(['status' => LuckyNumber::STATUS_ACTIVE])->whereBetween('number', [1, 9])->inRandomOrder()->first();
                if(empty($data)){
                    $show_number = 1;
                }else{
                    $show_number = $data->number;
                }
            }elseif($number == '2-digit'){
                $data = LuckyNumber::where(['status' => LuckyNumber::STATUS_ACTIVE])->whereBetween('number', [11, 99])->inRandomOrder()->first();
                if(empty($data)){
                    $show_number = 11;
                }else{
                    $show_number = $data->number;
                }
            }elseif($number == '3-digit'){
                $data = LuckyNumber::where(['status' => LuckyNumber::STATUS_ACTIVE])->whereBetween('number', [111, 999])->inRandomOrder()->first();
                if(empty($data)){
                    $show_number = 111;
                }else{
                    $show_number = $data->number;
                }
            }else{
                $data = LuckyNumber::where(['status' => LuckyNumber::STATUS_ACTIVE])->whereBetween('number', [1111, 9999])->inRandomOrder()->first();
                if(empty($data)){
                    $show_number = 1111;
                }else{
                    $show_number = $data->number;
                }
            }

            return view('front.lucky-number.numbers', compact('columns', 'rows', 'show_row', 'show_number'));
        }
        if(!empty($number)){
            if(!empty($id)){
                $data = LuckyNumber::where(['id' => $id])->inRandomOrder()->first();
            }else{
                $session_data = Session::get('lucky_number');
                if(!isset($session_data[$number]) || empty($session_data[$number])){
                    $data = LuckyNumber::where(['number' => $number, 'status' => LuckyNumber::STATUS_ACTIVE])->inRandomOrder()->first();
                    // print_r($data);
                    // print_r($number);
                    // die();
                    if(empty($data)){
                        abort(403, 'Article not available');
                    }
                    $session_data[$number] = $data;
                    Session::put('lucky_number', $session_data);
                }else{
                    $data = $session_data[$number];
                }
            }
            if(empty($data)){
                abort(404);
            }

            $ads = AdsBase::where(['status' => 1])->first();
            $data->description = str_replace('##in_article_ad##', $ads->in_article_ad ?? '', $data->description);

            $seo = new Seo();
            $seo->slug = url($request->path());
            $seo->meta_title = ucwords($data->title) . ' - Lucky Number';
            $seo->meta_keyword = $data->title;
            $seo->meta_description = getMetaDescription($data->description);

            return view('front.lucky-number.result', compact('data', 'seo'));
        }else{
            return view('front.lucky-number.index');
        }
    }

    public function redirect_url(Request $request, $slug){
        $data = MaskUrl::where(['slug' => $slug])->first();
        if(empty($data)){
            abort('404');
        }
        return redirect()->away($data->main_url);
    }

    public function love_quiz_2_clt()
    {
        $data = Question::get()->toArray();
        return view('front.love_quiz_2_clt.index', compact('data'));
    }

    public function love_quiz_2_clt_tarot_cart()
    {
        //articles
        $data = Article::inRandomOrder()->first()->toArray();
        Session::put('result_1', $data);
        //$result = Session::get('result_1');
        return view('front.love_quiz_2_clt.tarot_cart');
    }

    public function love_quiz_2_clt_result($slug=NULL)
    {
        if(!empty($slug) && $slug == 'new-card'){
            $data = Article::inRandomOrder()->first()->toArray();
            Session::put('result_1', $data);
            return redirect()->to('love-quiz-2-clt/result');
        }
        $result = Session::get('result_1');
        if(!empty($slug) && $slug == 'result'){
            return view('front.love_quiz_2_clt.result', compact('result'));
        }elseif(!empty($slug) && $slug == 'detail'){
            return view('front.love_quiz_2_clt.detail', compact('result'));
        }else{
            return redirect()->route('love-quiz-2-clt');
        }
    }

    public function lucky_tarot_clt()
    {
        $data = lucky_tarot::inRandomOrder()->first()->toArray();
        Session::put('result_1', $data);
        return view('front.lucky_tarot_clt.index');
    }

    public function lucky_tarot_clt_result($slug=NULL)
    {
        if(!empty($slug)){
            $data = lucky_tarot::where('id', $slug)->first()->toArray();
        }else{
            $data = Session::get('result_1');
        }
        if(empty($data)){
            return redirect()->route('lucky-tarot-clt');
        }
        return view('front.lucky_tarot_clt.result', compact('data'));
    }

    public function lucky_number_clt()
    {
        $data = ZodiacNumerology::inRandomOrder()->first()->toArray();
        Session::put('result_1', $data);
        return view('front.lucky_number_clt.index');
    }

    public function lucky_number_clt_card()
    {
        $numberArray1 = ZodiacNumerology::pluck('lucky_number')->toArray();
        $numArr = json_encode($numberArray1);
        $results = Session::get('result_1');
        return view('front.lucky_number_clt.tarot_cart', compact('numArr', 'results'));
    }

    public function lucky_number_clt_results($slug=NULL)
    {
        if(!empty($slug)){
            $results = ZodiacNumerology::where('lucky_number', $slug)->first()->toArray();
        } else {
            $results = Session::get('result_1');
        }
        return view('front.lucky_number_clt.result', compact('results'));
    }

    /*love-aura Function Start*/
        public function getLoveAura()
        {
            $data = LoveAura::inRandomOrder()->first()->toArray();
            Session::put('lova_aura_result', $data);
            return view('front.love_aura.index');
        }

        public function getLoveAuraResult($slug=NULL)
        {
            if(!empty($slug)){
                $results = LoveAura::where('id', $slug)->first()->toArray();
            } else {
                $results = Session::get('lova_aura_result');
            }
            if(empty($results)){
                return redirect()->route('getLoveAura');
            }
            return view('front.love_aura.result', compact('results'));
        }
    /*love-aura Function End*/

    /*love-chakra Function Start*/
        public function getLoveChakra()
        {
            $data = LoveChakra::inRandomOrder()->first()->toArray();
            Session::put('lova_chakra_result', $data);
            return view('front.love_chakra.index');
        }

        public function getLoveChakraChakra()
        {
            $results = Session::get('lova_chakra_result');
            if(empty($results)){
                $data = LoveChakra::inRandomOrder()->first()->toArray();
                Session::put('lova_chakra_result', $data);
            }
            return view('front.love_chakra.chakra');
        }

        public function getLoveChakraResult($slug=NULL)
        {
            if(!empty($slug)){
                $results = LoveAura::where('id', $slug)->first()->toArray();
            } else {
                $results = Session::get('lova_chakra_result');
            }
            if(empty($results)){
                return redirect()->route('getLoveChakra');
            }
            return view('front.love_chakra.result', compact('results'));
        }
    /*love-chakra Function End*/

    /*love-crystal Function Start*/
        public function getLoveCrystal()
        {
            $data = LoveCrystal::inRandomOrder()->first()->toArray();
            Session::put('lova_crystal_result', $data);
            return view('front.love_crystal.index');
        }

        public function getLoveCrystalResult($slug=NULL)
        {
            if(!empty($slug)){
                $results = LoveCrystal::where('id', $slug)->first()->toArray();
            } else {
                $results = Session::get('lova_crystal_result');
            }
            if(empty($results)){
                return redirect()->route('getLoveCrystal');
            }
            return view('front.love_crystal.result', compact('results'));
        }
    /*love-crystal Function End*/

    /*love-chakra Function Start*/
        public function getLoveFengShui()
        {
            return view('front.love_feng_shui.index');
        }

        public function getLoveFengShuiOption()
        {
            $data1 = LoveFeng::inRandomOrder()->first()->toArray();
            $data2 = LoveFeng::inRandomOrder()->first()->toArray();
            $data3 = LoveFeng::inRandomOrder()->first()->toArray();
            return view('front.love_feng_shui.option', compact('data1', 'data2', 'data3'));
        }

        public function getLoveFengShuiResult($category=NULL,$slug=NULL)
        {
            $results = LoveFeng::where('slug', $slug)->first()->toArray();
            if(empty($results)){
                return redirect()->route('getLoveFengShui');
            }
            return view('front.love_feng_shui.result', compact('results'));
        }
    /*love-chakra Function End*/

    /*Moonology reading Function Start*/
        public function getMoonologyReading()
        {
            $data = MoonologyReading::inRandomOrder()->first()->toArray();
            Session::put('monology_reading_result', $data);
            return view('front.moonology_readings.index');
        }

        public function getMoonologyReadingResult($slug=NULL)
        {
            if(!empty($slug)){
                $results = MoonologyReading::first()->toArray();
            } else {
                $results = Session::get('monology_reading_result');
            }
            if(empty($results)){
                return redirect()->route('getMoonologyReading');
            }
            return view('front.moonology_readings.result', compact('results'));
        }
    /*Moonology reading Function End*/

    /*Fortune cookie Function Start*/
        public function getFortuneCookie()
        {
            return view('front.fortune_cookies.index');
        }

        public function getFortuneCookieOption()
        {
            $imageArray = array('cookie-1.jpg', 'cookie-2.jpg', 'cookie-3.jpg', 'cookie-4.jpg', 'cookie-5.jpg', 'cookie-6.jpg');
            shuffle($imageArray);
            $data = FortuneCookie::inRandomOrder()->first()->toArray();
            Session::put('coffee_cup_result', $data);
            return view('front.fortune_cookies.option', compact('imageArray'));
        }

        public function getFortuneCookieResult($slug=NULL)
        {
            if(!empty($slug)){
                $results = FortuneCookie::first()->toArray();
            } else {
                $results = Session::get('coffee_cup_result');
            }
            if(empty($results)){
                return redirect()->route('getFortuneCookie');
            }
            return view('front.fortune_cookies.result', compact('results'));
        }
    /*Fortune cookie Function End*/

    /*Coffee Cup Reading Function Start*/
        public function getCoffeeCupReading()
        {
            $data = CoffeeCupReading::inRandomOrder()->first()->toArray();
            Session::put('coffee_cup_result', $data);
            return view('front.coffee_cup_readings.index');
        }

        public function getCoffeeCupReadingResult($slug=NULL)
        {
            if(!empty($slug)){
                $results = CoffeeCupReading::first()->toArray();
            } else {
                $results = Session::get('coffee_cup_result');
            }
            if(empty($results)){
                return redirect()->route('getCoffeeCupReading');
            }
            return view('front.coffee_cup_readings.result', compact('results'));
        }
    /*Coffee Cup Reading Function End*/

    /*Soulmate Number Function End*/
        public function getSoulmateNumber()
        {

            $withOutFooter = true;
            $withOutHeader = true;
            //return view('front.soulmate_number.index');
            return view('front.soulmate_number.index_new', compact('withOutFooter', 'withOutHeader'));
        }

        public function postSoulmateNumber(Request $request)
        {
            $insertId = DB::table('report_users')->insertGetId(['name' => $request['name'], 'birth_name' => $request['birth_name'], 'dob' => $request['dob'], 'email' => $request['email'], 'report_id' => 1,
                'payment_status' => 0]);
            Session::put('soulmate_number', $insertId);
            require_once base_path() . '/public/stripe-php/init.php';
            /*Stripe Code Start*/
            // Set your secret key (use your actual secret key from the Stripe Dashboard)
            \Stripe\Stripe::setApiKey('sk_test_hE7Q5lgd4iUQ0gtgxY5RvUCE'); // Replace with your Stripe Secret Key
            // Create a Checkout session to initiate the payment process
            try {
                // Create a new checkout session
                $checkout_session = \Stripe\Checkout\Session::create([
                    'payment_method_types' => ['card'],  // Accept credit cards
                    'line_items' => [
                        [
                            'price_data' => [
                                'currency' => 'usd',  // Set your currency (USD in this case)
                                'product_data' => [
                                    'name' => 'Solmate Number',  // Product name
                                ],
                                'unit_amount' => 2000,  // Product price in cents (e.g., $20.00)
                            ],
                            'quantity' => 1,  // Quantity of the product
                        ],
                    ],
                    'mode' => 'payment',  // 'payment' for one-time payments, 'subscription' for recurring payments
                    'success_url' => url('soulmate-number/thankyou?sid={CHECKOUT_SESSION_ID}'),  // URL after successful payment
                    'cancel_url' => url('soulmate-number?sid=error'),  // URL after payment cancellation
                ]);
                // Send the session ID to the frontend so that the payment page can be opened
                json_encode(['id' => $checkout_session->id]);
            } catch (Exception $e) {
                // Handle errors (e.g., invalid API key)
                json_encode(['error' => $e->getMessage()]);
            }
            /*Stripe Code End*/
            return response()->json(array("success"=>1, "redirect_url"=>$checkout_session->url));
            //return redirect()->route('getSoulmateNumberThankyou');
        }

        public function getSoulmateNumberThankyou()
        {
            /*Stripe Code*/
            $session_id = $_GET['sid'];
            // Include Stripe's PHP library and set your secret key
            require_once base_path() . '/public/stripe-php/init.php';
            \Stripe\Stripe::setApiKey('sk_test_hE7Q5lgd4iUQ0gtgxY5RvUCE');
            // Retrieve the Checkout Session from Stripe
            $session = \Stripe\Checkout\Session::retrieve($session_id);
            /*Stripe Code*/
            $reportData = DB::table('reports')->where('id', 1)->first();
            $data = Session::get('soulmate_number');
            $dbData = DB::table('report_users')->where('id', $data)->first();
            $name = $dbData->name;
            $dob = $dbData->dob;
            $nameDigit =  $this->nameToSingleDigit($name);
            $dobDigit =  $this->dobToSingleDigit($dob);
            $numberDigit =  $this->numberToSingleDigit($nameDigit.$dobDigit);
            DB::table('report_users')->where('id', $data)->update(['transaction_id' => $session->id, 'email' => $session->customer_details->email, 'payment_status' => 1, 'number' => $numberDigit]);
            Session::put('numberDigit', $numberDigit);
            return view('front.soulmate_number.thankyou', compact('data', 'reportData', 'numberDigit'));
        }

        public function nameToSingleDigit($name) {
            $alphabet = [ 'a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5, 'f' => 6, 'g' => 7, 'h' => 8, 'i' => 9, 'j' => 1, 'k' => 2, 'l' => 3, 'm' => 4, 'n' => 5, 'o' => 6, 'p' => 7, 'q' => 8, 'r' => 9, 's' => 1, 't' => 2, 'u' => 3, 'v' => 4, 'w' => 5, 'x' => 6, 'y' => 7, 'z' => 8];
            $name = strtolower(preg_replace("/[^a-z]/", "", $name));
            $sum = 0;
            foreach (str_split($name) as $char) {
                if (isset($alphabet[$char])) {
                    $sum += $alphabet[$char];
                }
            }
            while ($sum > 9) {
                $sum = array_sum(str_split($sum));
            }
            return $sum;
        }

        public function dobToSingleDigit($dob) {
            $dob = preg_replace("/[^0-9]/", "", $dob);
            if(strlen($dob) != 8) {
                return "Invalid DOB format. Please use YYYYMMDD.";
            }
            // Split the DOB into Year, Month, and Day
            $year = substr($dob, 0, 4);
            $month = substr($dob, 4, 2);
            $day = substr($dob, 6, 2);
            $sum = array_sum(str_split($year)) + array_sum(str_split($month)) + array_sum(str_split($day));
            while ($sum > 9) {
                $sum = array_sum(str_split($sum));
            }
            return $sum;
        }

        public function numberToSingleDigit($number) {
            if (!is_numeric($number)) {
                return "Invalid input. Please enter a valid number.";
            }
            if ($number < 10) {
                return $number;
            }
            while ($number >= 10) {
                $number = array_sum(str_split($number));
            }
            return $number;
        }

        public function getGPT()
        {
            $report = DB::table('reports')->first();
            $report_questions = array();
            if(!empty($report)){
                $report_questions = DB::table('report_questions')->where('report_id', $report->id)->get()->toArray();
            }
            $gpt_data = 'new';
            if(isset($_GET['message']) && !empty($_GET['message'])){
                $num = $_GET['message'];
                $s_no = $_GET['data'];
                $next_statu = 'No';
                if(isset($report_questions[$s_no])){
                    $query_data = $report_questions[$s_no];
                    $query = $this->getQuery($query_data,$_GET['message']);
                    $gpt_data = $this->getResponse($query);
                    $content = ($gpt_data['message']->content);
                    $content = str_replace("```json", "", $content);
                    $content1 = $content = str_replace("```", "", $content);
                    $content = json_decode($content);
                    if(empty($content)){
                        $content = str_replace('"description": "', "", $content1);
                        $content = str_replace('"', "", $content);
                        $content = str_replace('}', "", $content);
                        $content = str_replace('{', "", $content);
                        $content = trim($content);
                    } else {
                        $content = $content->description;
                    }
                    DB::table('report_answers')->where('question_id', $report_questions[$s_no]->id)->where('number', $_GET['message'])->update(['ans' => $content]);
                    $keyss = $_GET['data']+1;
                    if(array_key_exists($keyss,$report_questions)){
                        $next_statu = 'Yes';
                    }
                }
                return $next_statu; exit;
            }
            return view('front.gpt.index', compact('gpt_data', 'report_questions'));
        }

        public function getGPTActivity()
        {
            $report = DB::table('reports')->first();
            if(isset($_GET['message']) && !empty($_GET['message'])){
                $num = $_GET['message'];
                $type = $s_no = $_GET['data'];
                if(isset($s_no)){
                    $query_data = $s_no;
                    $query = $this->getQueryActivity($query_data,$_GET['message']);
                    $gpt_data = $this->getResponseActivity($query);
                    $content = ($gpt_data['message']->content);
                    $content = str_replace("```json", "", $content);
                    $content1 = $content = str_replace("```", "", $content);
                    $content = json_decode($content);
                    if(empty($content)){
                        $content = str_replace('"description": "', "", $content1);
                        $content = str_replace('"', "", $content);
                        $content = str_replace('}', "", $content);
                        $content = str_replace('{', "", $content);
                        $content = trim($content);
                    } else {
                        $content = $content->description;
                    }
                    echo __LINE__;echo "<pre>"; print_r($content);
                    DB::table('report_activities')->where('number', $num)->where('type', $type)->delete();
                    foreach ($content as $key => $value) {
                        $activity = (isset($value->activity)) ? $value->activity : '';
                        $purpose = (isset($value->purpose)) ? $value->purpose : '';
                        $instructions = (isset($value->instructions)) ? $value->instructions : '';
                        if(empty($activity) && empty($purpose) && empty($instructions)){
                            $activity = (isset($value->Activity)) ? $value->Activity : '';
                            $purpose = (isset($value->Purpose)) ? $value->Purpose : '';
                            $instructions = (isset($value->Instructions)) ? $value->Instructions : '';
                        }
                        $con = array('number' => $num, 'type' => $type, 'activity' => $activity, 'purpose' => $purpose, 'instructions' => $instructions);
                        DB::table('report_activities')->insertGetId($con);
                    }
                }
                $next_statu = 'Yes';
                return $next_statu; exit;
                echo "<pre>"; print_r($gpt_data); exit;
            }
            return view('front.gpt.index', compact('gpt_data', 'report_questions'));
        }

        public function getResponseActivity($query){
            $curl = curl_init();
            $post_data = array(
                "model" => "gpt-4o",
                'messages' => [
                    [
                        'role' => 'user',
                        // 'role' => 'system',
                        // 'role' => 'assistant',
                        'content' => $query
                    ]
                ],
            );
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.openai.com/v1/chat/completions",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                // CURLOPT_POSTFIELDS => "{\n\"prompt\": \"".$record['result']."\"\n}",
                CURLOPT_POSTFIELDS => json_encode($post_data),
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer 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"
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($response);
            $result_new = isset($response->choices[0]->message) ? $response->choices[0]->message : [];
            $usage = isset($response->usage) ? $response->usage : [];
            $response = [
                'message' => $result_new,
                'usage' => $usage,
            ];
            //echo "<pre>"; print_r($response); exit;
            return $response;
        }

        public function getResponse($query){
            $curl = curl_init();
            $post_data = array(
                "model" => "gpt-4o",
                'messages' => [
                    [
                        'role' => 'user',
                        // 'role' => 'system',
                        // 'role' => 'assistant',
                        'content' => $query
                    ]
                ],
            );
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.openai.com/v1/chat/completions",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                // CURLOPT_POSTFIELDS => "{\n\"prompt\": \"".$record['result']."\"\n}",
                CURLOPT_POSTFIELDS => json_encode($post_data),
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer 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"
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($response);
            $result_new = isset($response->choices[0]->message) ? $response->choices[0]->message : [];
            $usage = isset($response->usage) ? $response->usage : [];
            $response = [
                'message' => $result_new,
                'usage' => $usage,
            ];
            //echo "<pre>"; print_r($response); exit;
            return $response;
        }

        public function getGPTReport()
        {
            $data = Session::get('soulmate_number');
            if(!empty($data)) {
                $dbData = DB::table('report_users')->where('id', $data)->first();
                $reportData = DB::table('reports')->where('id', $dbData->report_id)->first();
                $numberDigit = $dbData->number;
            } else {
                $numberDigit = 5;
                $reportData = DB::table('reports')->where('id', 1)->first();
            }
            $slug = $reportData->code;
            $categoryData = array();
            $reportData = DB::table('reports')->where('code', $slug)->first();
            if(!empty($reportData)){
                $categoryData = DB::table('report_categories')->where('report_id', $reportData->id)->get();
            }
            $dailyData = DB::table('report_activities')->where('type', 'daily')->where('number', $numberDigit)->inRandomOrder()->limit(3)->get()->toArray();
            Session::put('dailyData', $dailyData);
            $weeklyData = DB::table('report_activities')->where('type', 'weekly')->where('number', $numberDigit)->inRandomOrder()->limit(3)->get()->toArray();
            Session::put('weeklyData', $weeklyData);
            $monthlyData = DB::table('report_activities')->where('type', 'monthly')->where('number', $numberDigit)->inRandomOrder()->limit(3)->get()->toArray();
            Session::put('monthlyData', $monthlyData);
            //echo "<pre>"; print_r($dailyData); echo "</pre>"; exit;
            return view('front.gpt.result', compact('reportData', 'categoryData', 'numberDigit', 'dailyData','weeklyData', 'monthlyData'));
        }

        public function getSubCategory($id=NULL)
        {
            $data = "hello";
            $categoryData = DB::table('report_sub_categories')->where('category_id', $id)->get();
            return $categoryData;
        }

        public function getQuestionData($rid=NULL,$cid=NULL,$scid=NULL)
        {
            $categoryData = DB::table('report_questions')->where('report_id', $rid)->where('category_id', $cid)->where('sub_category_id', $scid)->get();
            return $categoryData;
        }

        public function getAnswerData($rid=NULL,$cid=NULL,$scid=NULL,$qid=NULL)
        {
            $categoryData = DB::table('report_answers')->where('number', $rid)->where('category_id', $cid)->where('sub_category_id', $scid)->where('question_id', $qid)->first();
            return $categoryData;
        }



        public function getSoulmatMail()
        {
            $data = DB::table('report_users')->where('payment_status', 1)->where('send_mail', 0)->get();
            if(isset($data[0])){
                foreach($data as $k => $v){
                    $reportData = DB::table('reports')->where('id', $v->report_id)->first();
                    $slug = $reportData->code.'?id='.$v->id;
                    DB::table('report_users')->where('id', $v->id)->update(['send_mail' => 1]);
                }
            }
            echo "Done"; exit;
        }
    /*Soulmate Number Function End*/

    public function thankyou()
        {
            return view('front.thankyou.index');
        }
    public function salesCopyWriting()
        {
            return view('front.salesCopyWriting.index');
        }
    public function padGeneration()
        {
            return view('front.padGeneration.index');
        }
    public function privacyPolicy()
        {
            return view('front.privacyPolicy.index');
        }
    public function termsOfService()
        {
            return view('front.termsOfService.index');
        }
    public function login()
        {
            return view('front.login.login');
        }
    public function forgotpassword()
        {
            return view('front.login.forgotpassword');
        }
    public function resetPassword()
        {
            return view('front.login.resetPassword');
        }
    public function register()
        {
            return view('front.login.register');
        }

    public function sketchgenerator($subscriber=null){


        // $query = <<<EOD

        //    You are a spiritually attuned, hyper-realistic portrait artist with a refined mastery in pencil sketch techniques. Your artistic focus is on capturing the ethereal presence and emotional energy of an individual’s destined soulmate. You work in a medium that mimics hand-drawn pencil or charcoal, producing high-contrast, soft-shaded black-and-white portraits with a subtle, photo-realistic texture. Your artwork resembles the style in classical figure drawing — expressive, detailed, yet warm and soulful — similar to a pencil sketch on textured drawing paper. The expressions are natural and lifelike, with careful rendering of eyes, hair, and facial structure, delivering a highly realistic yet slightly romanticized interpretation of the person.

        //     Your task is to create a head-and-shoulders pencil-style sketch of a person’s future soulmate, guided by spiritual cues derived from their personal numerology and romantic profile. The following inputs should be used: the user’s date of birth, their gender of interest, ethnicity preference, and their soulmate number (a symbolic numerological value representing romantic destiny and vibrational energy).

        //     Please note: The date of birth refers to the user, not the soulmate. Even if the user is under 18 years of age, the drawing must always depict a mature, adult soulmate who appears to be 18 years or older. The soulmate must always be presented as a fully grown adult — emotionally and physically mature in appearance, and has to be around the age range of the user.

        //     Use the soulmate number to influence the subtle mood or spiritual expression of the portrait — for instance, a soulmate number of “1” may suggest a confident, bold gaze, while a “9” might reflect a soulful and wise energy. This influence should be woven softly into their pose, expression, or emotional aura rather than shown as literal symbols.
        //     Ensure that the gender of interest is strictly followed — generate only the gender explicitly provided. The ethnicity preference must also be visibly respected in the subject's facial features, hair texture, and overall appearance, with culturally authentic but natural details.

        //     The subject must be drawn fully within the frame, including their complete head and hair — avoid cropping any part of the head or zooming too closely. The composition should be a well-balanced, head-and-shoulders portrait, centered and elegant. No background elements, symbols, text, or distractions should be added. The portrait must be done in black and white with soft pencil shading, fine facial detail, and a timeless, realistic hand-drawn style — just like a traditional pencil sketch on textured paper.

        //     Clothing Note: The person’s attire should vary naturally — they should not always wear a simple t-shirt. You may include a mix of casual or semi-formal styles such as sweaters, collared shirts, blouses, or simple formal tops, as long as it fits the overall mature and authentic tone of the portrait. Keep the clothing realistic, balanced, and appropriate to the person’s aura.

        //     Now generate a black-and-white pencil sketch image based on the entire description above. The output should be a visual artwork, not a text explanation.

        //     Create the soulmate sketch for this user:
        //         - User's Date of Birth: 15-05-2005
        //         - Gender of Interest: Female
        //         - Ethnicity Preference: South Asian
        //         - Soulmate Number: 2


        // EOD;
        $query = <<<EOD

            You are a spiritually attuned and hyper-realistic portrait artist specializing in hand-drawn pencil sketch techniques.
            Your artwork captures the ethereal presence and emotional energy of a destined soulmate with precision, warmth, and soulful realism.
            Create a highly realistic black-and-white pencil sketch, using soft shading and subtle texture, similar to classical figure drawing on textured paper.
            Focus on expressive eyes, natural facial structure, delicate hair details, and authentic skin textures.
            The subject should appear emotionally alive and realistic, with a gentle romantic aura.

            Your task is to create a head-and-shoulders pencil-style sketch of a person’s future soulmate, guided by spiritual cues derived from their personal numerology and romantic profile. The following inputs should be used: the user’s date of birth, their gender of interest, ethnicity preference, and their soulmate number (a symbolic numerological value representing romantic destiny and vibrational energy).

            Please note: The date of birth refers to the user, not the soulmate. Even if the user is under 18 years of age, the drawing must always depict a mature, adult soulmate who appears to be 18 years or older. The soulmate must always be presented as a fully grown adult — emotionally and physically mature in appearance, and has to be around the age range of the user.

            Use the soulmate number to influence the subtle mood or spiritual expression of the portrait — for instance, a soulmate number of “1” may suggest a confident, bold gaze, while a “9” might reflect a soulful and wise energy. This influence should be woven softly into their pose, expression, or emotional aura rather than shown as literal symbols.
            Ensure that the gender of interest is strictly followed — generate only the gender explicitly provided. The ethnicity preference must also be visibly respected in the subject's facial features, hair texture, and overall appearance, with culturally authentic but natural details.

            The subject must be drawn fully within the frame, including their complete head and hair — avoid cropping any part of the head or zooming too closely. The composition should be a well-balanced, head-and-shoulders portrait, centered and elegant. No background elements, symbols, text, or distractions should be added. The portrait must be done in black and white with soft pencil shading, fine facial detail, and a timeless, realistic hand-drawn style — just like a traditional pencil sketch on textured paper.

            Clothing Note: The person’s attire should vary naturally — they should not always wear a simple t-shirt. You may include a mix of casual or semi-formal styles such as sweaters, collared shirts, blouses, or simple formal tops, as long as it fits the overall mature and authentic tone of the portrait. Keep the clothing realistic, balanced, and appropriate to the person’s aura.

            Now generate a black-and-white pencil sketch image based on the entire description above. The output should be a visual artwork, not a text explanation.

            Create the soulmate sketch for this user:
                - User's Date of Birth: date('d-m-Y', $subscriber->bod)
                - Gender of Interest: $subscriber->custom_gender_interest
                - Ethnicity Preference: $subscriber->custom_ethencity ?? 'India'
                - Soulmate Number: $subscriber->love_Desire_number


        EOD;

        $response = Http::withToken('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')->post('https://api.openai.com/v1/images/generations', [
            'prompt' => $query,
            'model' => 'dall-e-3',
            'n' => 1,
            'size' => '1024x1024',
        ]);

        $imageUrl = $response->json()['data'][0]['url'];

        $imageData = self::saveImage($imageUrl);
        // var_dump($imageData); die();
        if($subscriber){
            $subscriber->image_path = 'soul-sketch/'.$imageData['filename'];
            $subscriber->save();
        }
        // $this->mailSketch($subscriber->email, $imageData['path'], $subscriber->full_name ?? 'John Doe');
        // Storage::disk('public')->put($filename, $imageUrl);
        // dd($response->json());
        // dd( $imageUrl);
    }


    public function sketchgeneratorcolor($subscriber=null){


        $query = <<<EOD

             You are a spiritually guided visual artist who specializes in romantic, emotionally resonant character illustrations. Your work is deeply rooted in the symbolic language of love, energy, and numerology. You create soft, colorized portraits that capture the essence of a person's future soulmate, based on vibrational data drawn from their birthday, gender preference, ethnicity preference, and symbolic soulmate number. Your illustrations blend hand-painted warmth with clean realism — not cartoony or surreal, but emotionally expressive, human, and deeply personal.

            Your task is to create a colorized, head-and-shoulders portrait of the user's future soulmate. This image should depict a realistic adult human (18 years or older) who appears mature and emotionally present. The style should evoke hand-painted or softly stylized digital illustration — clean but not over-polished, romantic but not exaggerated. The focus is on natural skin tones, expressive eyes, lifelike textures (such as hair, light freckles, or clothing), and gentle ambient lighting. Colors should be soft, warm, and inviting — not neon or saturated. Think of a real person, but with a subtle dreamlike glow — as if seen in a vision or lucid dream.

            The character's gender and ethnicity must exactly match the input provided — this is non-negotiable. Do not blend genders or race unless "mixed" is explicitly stated. Facial structure, hairstyle, and features should align culturally and respectfully. The soulmate number should influence the subject’s vibe or expression — not as a symbol, but as subtle emotional energy. A “1” may feel strong and direct; a “7” might appear introspective or wise. This emotional tone should come through in the eyes, posture, or slight expression — not through overt elements.

            Keep the background minimal and neutral, using soft gradients or blurred abstract tones (optional), so the focus remains on the soulmate. Avoid sharp props, locations, or text. This is a spiritual portrait, not a scene.

            Again, it is crucial that the subject appears to be an adult (18+) regardless of the user's age. The soulmate should always be depicted as emotionally and physically mature. No youthful or childlike appearances are allowed. The portrait should suggest depth, calm confidence, or gentle mystery — not exaggeration or cartoon tropes.
            Clothing Note: The subject's outfit should vary naturally — not always a t-shirt. Include tasteful variation such as sweaters, collared shirts, loose blouses, light jackets, or simple formal tops, depending on the subject’s vibe. Additionally, vary the color of the clothing to avoid repetition — use soft, harmonious color palettes that complement the overall tone of the portrait, without overpowering the natural, romantic aesthetic. Avoid neon or overly vibrant hues.

            Important Instruction: Output must be in image format only. Do not describe the image in words or generate text. Return only the illustrated image of the soulmate based on the inputs.

            Create the soulmate sketch for this user:
                - User's Date of Birth: date('d-m-Y', $subscriber->bod)
                - Gender of Interest: $subscriber->custom_gender_interest
                - Ethnicity Preference: $subscriber->custom_ethencity ?? 'India'
                - Soulmate Number: $subscriber->love_Desire_number


        EOD;


        $response = Http::withToken('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')->post('https://api.openai.com/v1/images/generations', [
            'prompt' => $query,
            'model' => 'dall-e-3',
            'n' => 1,
            'size' => '1024x1024',
        ]);

        $imageUrl = $response->json()['data'][0]['url'];
        // dd( $imageUrl);
        $imageData = self::saveImage($imageUrl);
        if($subscriber){
            $subscriber->image_path = 'soul-sketch/'.$imageData['filename'];
            $subscriber->save();
        }
    }

    public function sketchgeneratorbackgroundcolor($subscriber=null){


        $query = <<<EOD

            You are a spiritually guided visual artist who specializes in romantic, emotionally resonant character illustrations. Your work is deeply rooted in the symbolic language of love, energy, and numerology. You create soft, colorized portraits that capture the essence of a person's future soulmate, based on vibrational data drawn from their birthday, gender preference, ethnicity preference, and symbolic soulmate number. Your illustrations blend hand-painted warmth with clean realism — not cartoony or surreal, but emotionally expressive, human, and deeply personal.

            Your task is to create a colorized, head-and-shoulders portrait of the user's future soulmate. This image should depict a realistic adult human (18 years or older) who appears mature and emotionally present. The style should evoke hand-painted or softly stylized digital illustration — clean but not over-polished, romantic but not exaggerated. The focus is on natural skin tones, expressive eyes, lifelike textures (such as hair, light freckles, or clothing), and gentle ambient lighting. Colors should be soft, warm, and inviting — not neon or saturated. Think of a real person, but with a subtle dreamlike glow — as if seen in a vision or lucid dream.

            The character's gender and ethnicity must exactly match the input provided — this is non-negotiable. Do not blend genders or race unless "mixed" is explicitly stated. Facial structure, hairstyle, and features should align culturally and respectfully. The soulmate number should influence the subject’s vibe or expression — not as a symbol, but as subtle emotional energy. A “1” may feel strong and direct; a “7” might appear introspective or wise. This emotional tone should come through in the eyes, posture, or slight expression — not through overt elements.

            Keep the background minimal and neutral, using soft gradients or blurred abstract tones (optional), so the focus remains on the soulmate. Avoid sharp props, locations, or text. This is a spiritual portrait, not a scene.

            Again, it is crucial that the subject appears to be an adult (18+) regardless of the user's age. The soulmate should always be depicted as emotionally and physically mature. No youthful or childlike appearances are allowed. The portrait should suggest depth, calm confidence, or gentle mystery — not exaggeration or cartoon tropes.

            Clothing Note: The subject's outfit should vary naturally — not always a t-shirt. Include tasteful variation such as sweaters, collared shirts, loose blouses, light jackets, or simple formal tops, depending on the subject’s vibe. Additionally, vary the color of the clothing to avoid repetition — use soft, harmonious color palettes that complement the overall tone of the portrait, without overpowering the natural, romantic aesthetic. Avoid neon or overly vibrant hues.

            Important Instruction: Output must be in image format only. Do not describe the image in words or generate text. Return only the illustrated image of the soulmate based on the inputs.


            Create the soulmate sketch for this user:
                - User's Date of Birth: date('d-m-Y', $subscriber->bod)
                - Gender of Interest: $subscriber->custom_gender_interest
                - Ethnicity Preference: $subscriber->custom_ethencity ?? 'India'
                - Soulmate Number: $subscriber->love_Desire_number


        EOD;


        $response = Http::withToken('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')->post('https://api.openai.com/v1/images/generations', [
            'prompt' => $query,
            'model' => 'dall-e-3',
            'n' => 1,
            'size' => '1024x1024',
        ]);

        $imageUrl = $response->json()['data'][0]['url'];
        // dd( $imageUrl);
        $imageData = self::saveImage($imageUrl);
        if($subscriber){
            $subscriber->image_path = 'soul-sketch/'.$imageData['filename'];
            $subscriber->save();
        }
    }

    public function sketchgeneratorbackground($subscriber=null){


        $query = <<<EOD

            You are a spiritually attuned, hyper-realistic portrait artist with a refined mastery in pencil sketch techniques. Your artistic focus is on capturing the ethereal presence and emotional energy of an individual’s destined soulmate. You work in a medium that mimics hand-drawn pencil or charcoal, producing high-contrast, soft-shaded black-and-white portraits with a subtle, photo-realistic texture. Your artwork resembles the style in classical figure drawing — expressive, detailed, yet warm and soulful — similar to a pencil sketch on textured drawing paper. The expressions are natural and lifelike, with careful rendering of eyes, hair, and facial structure, delivering a highly realistic yet slightly romanticized interpretation of the person.

            Your task is to create a head-and-shoulders pencil-style sketch of a person’s future soulmate, guided by spiritual cues derived from their personal numerology and romantic profile. The following inputs should be used: the user’s date of birth, their gender of interest, ethnicity preference, and their soulmate number (a symbolic numerological value representing romantic destiny and vibrational energy).

            Please note: The date of birth refers to the user, not the soulmate. Even if the user is under 18 years of age, the drawing must always depict a mature, adult soulmate who appears to be 18 years or older. The soulmate must always be presented as a fully grown adult — emotionally and physically mature in appearance, and has to be around the age range of the user.

            Use the soulmate number to influence the subtle mood or spiritual expression of the portrait — for instance, a soulmate number of “1” may suggest a confident, bold gaze, while a “9” might reflect a soulful and wise energy. This influence should be woven softly into their pose, expression, or emotional aura rather than shown as literal symbols.
            Ensure that the gender of interest is strictly followed — generate only the gender explicitly provided. The ethnicity preference must also be visibly respected in the subject's facial features, hair texture, and overall appearance, with culturally authentic but natural details.

            The subject must be drawn fully within the frame, including their complete head and hair — avoid cropping any part of the head or zooming too closely. The composition should be a well-balanced, head-and-shoulders portrait, centered and elegant. No background elements, symbols, text, or distractions should be added. The portrait must be done in black and white with soft pencil shading, fine facial detail, and a timeless, realistic hand-drawn style — just like a traditional pencil sketch on textured paper.
            Clothing Note: The person’s attire should vary naturally — they should not always wear a simple t-shirt. You may include a mix of casual or semi-formal styles such as sweaters, collared shirts, blouses, or simple formal tops, as long as it fits the overall mature and authentic tone of the portrait. Keep the clothing realistic, balanced, and appropriate to the person’s aura.

            Now generate a black-and-white pencil sketch image based on the entire description above. The output should be a visual artwork, not a text explanation.

            Create the soulmate sketch for this user:
                - User's Date of Birth: date('d-m-Y', $subscriber->bod)
                - Gender of Interest: $subscriber->custom_gender_interest
                - Ethnicity Preference: $subscriber->custom_ethencity ?? 'India'
                - Soulmate Number: $subscriber->love_Desire_number


        EOD;


        $response = Http::withToken('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')->post('https://api.openai.com/v1/images/generations', [
            'prompt' => $query,
            'model' => 'dall-e-3',
            'n' => 1,
            'size' => '1024x1024',
        ]);

        $imageUrl = $response->json()['data'][0]['url'];
        // dd( $imageUrl);
        $imageData = self::saveImage($imageUrl);
        if($subscriber){
            $subscriber->image_path = 'soul-sketch/'.$imageData['filename'];
            $subscriber->save();
        }
    }

    protected static function saveImage($image_url){
        $fileName = time() . '-' . rand(0, 9999) . Str::random(4) . '.png';
        $savePath = public_path("/soul-sketch/$fileName");
        // Initialize curl
        $ch = curl_init($image_url);
        // Set curl options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        // Execute and get image data
        $imageData = curl_exec($ch);

        // Check for curl errors
        if(curl_errno($ch)){
            return [
                'status' => 2,
                'error' => curl_error($ch),
            ];
        }
        curl_close($ch);

        // Save the image
        file_put_contents($savePath, $imageData);

        return [
            'status' => 1,
            'filename' => $fileName,
            'savepath' => $savePath,
            'path' => '/soul-sketch/'.$fileName,
        ];
    }
    //send sketch
    public function mailSketch($recipientEmail=null, $imagePath, $userName){
            $recipientEmail = $recipientEmail ?? 'chandelranvijaysingh@gmail.com'; // Replace with the recipient's email address
            Mail::to($recipientEmail)->send(new SendSketch($imagePath, $userName));
    }
    // save pdf content using through jb que
    public function savePdfContent($transcript=null) {
         $chapters = [
                'introduction' => 'Welcome to Your Soulmate Journey',
                'chapter_1' => 'The Essence of Soulmate Number 7 in Love',
                'chapter_2' => 'Understanding Soulmate Number 7',
                'chapter_3' => 'Why Soulmate Number 7 Is Perfect for You',
                'chapter_4' => 'Discovering and Recognizing Your Soulmate',
                'chapter_5' => 'Building a Relationship with a Soulmate Number 7',
                'chapter_6' => 'The Spiritual and Transformative Power of Your Soulmate',
                'chapter_7' => 'Common Challenges & How to Grow Through Them',
                'conclusion' => 'Embracing the Path of Love',
            ];
            $transcriptId = $transcript->id;
            foreach ($chapters as $chapter_key => $chapter_title) {
                GenerateSoulSketchPdfContent::dispatch($chapter_key, $chapter_title, $transcript->love_path_number, $transcriptId);
            }
    }

     public function newPdfGeneration(Transcript $transcript, Request $request) {
            $pdfPurpose = !empty($request->pdf_purpose) ? $request->pdf_purpose : 'S';
            $fullName = $transcript->full_name;
            $soulNumber = $transcript->love_path_number;
            $solumatdata= GptPromptPdfContent::where('transcript_id', $transcript->id)->get();
            $html = view('front.chat_gpt.newpdf',['solumatdata' => $solumatdata, 'fullName' => $fullName, 'soulNumber' => $soulNumber])->render();

            $mpdf = new \Mpdf\Mpdf([
                'margin_left' => 0,
                'margin_right' => 0,
                'margin_top' => 10,       // No top margin on first page
                'margin_bottom' => 15,    // No bottom margin on first page
                'default_body_css' => 'margin:0; padding:0;',
                'format' => 'A4',
            ]);

            // Write the HTML content to the PDF
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->SetHTMLFooter('
                <div class="footer">
                    <div class="footer_items">
                        <table width="100%">
                            <tr>
                                <td width="33%"><p>{PAGENO}</p></td>
                                <td width="66%" style="text-align: right;"><p>Romance Numerology</p></td>
                            </tr>
                        </table>
                    </div>
                </div>');

            $mpdf->WriteHTML($html);
            if($pdfPurpose=='D'){
                 return response($mpdf->Output('', 'D'))->header('Content-Type', 'application/pdf'); //s show PDF d Download pdf
            }
            return response($mpdf->Output('', 'S'))->header('Content-Type', 'application/pdf'); //s show PDF d Download pdf
    }
    public function showSketch(Transcript $transcript) {
        $imagePath = $transcript->image_path;
        return view('soul-sketch.index', compact('imagePath'));
    }

}
