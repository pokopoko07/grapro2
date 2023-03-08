<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\SearchClasses\SearchQuery;

class PostController extends Controller
{
    // 投稿された記事を、新しい順に表示させます
    // 現在は、使っていない関数です。
    public function index()
    {
        $items=Area::all();
        $param=[
            'items_a' => $items
        ];
        return view('post.serch',$param);
    }

    // 詳細画面から、戻るボタンが押されたときに呼び出される関数です。
    // ユーザリクエストと、以前のページ番号が、セッションに格納されているので、
    // それを取り出して、再度検索をかけて表示します。
    public function result_back(Request $request, Post $posts)
    {
        // 複数の単語が、カンマ区切りで文字列としてセッションに入っているため、配列に戻します
        $word           = explode(",",$request->session()->get('words'));

        // 施設区分のセッションに-1が入っていたら、指定がなしという意味なので、配列を空に
        // -1以外なら、配列に格納します
        if($request->session()->get('facilitys') == -1){
            $facility   =[];
        }else{
            $facility   = explode(",",$request->session()->get('facilitys'));
        }

        // 場所のセッションに-1が入っていたら、指定がなしという意味なので、配列を空に
        // -1以外なら、配列に格納します
        if($request->session()->get('areas') == -1){
            $area       = [];
        }else{
            $area       = explode(",",$request->session()->get('areas'));
        }

        // 犬の情報をセッションから取得
        $dogs           = $request->session()->get('dogs');

        // お勧め年代のセッションに-1が入っていたら、指定がなしという意味なので、配列を空に
        // -1以外なら、配列に格納します
        if($request->session()->get('ages') == -1){
            $age        = [];
        }else{
            $age        = explode(",",$request->session()->get('ages'));
        }

        // 検索を行う
        $search= new SearchQuery($word, $facility, $area, $dogs, $age);
        $posts=$search->searchTerms(Post::query());
        $posts=$posts->orderBy('created_at', 'desc');
        
        // 詳細画面から、一覧表示に戻る際は、$transitionにtrueが入っている。trueならば、
        // セッションから以前の表示ページの番号を取得し、その番号のページを表示させる。
        // ペジネーションの次へボタンなどを押された時は、ペジネーションの指定のページを表示
        // するように分岐させた 
        $transition=$request->session()->get('transition');

        if($transition==true){
            $currentPage=$request->session()->get('currentPage');
            $posts = $posts->paginate(5, ['*'], 'page', $currentPage);
            $request->session()->put('transition',false);
        }else{
            $posts = $posts->paginate(5);
        }
        
        
        $posts = $posts->withPath('/result_back/back');

        $user=auth()->user();

        // 遷移元が、result_backからであるかを$moveFromに2を渡すことで示している
        $moveFrom=2;

        // 詳細画面が押された時ように、現在のページをセッションに格納しておく。
        $currentPage = $posts->currentPage();
        $request->session()->put('currentPage',$currentPage);

        return view('post.index', compact('posts', 'user','moveFrom'));
    }

    // 検索画面から、検索ボタンがおされたとき、呼び出される関数
    // ユーザ入力された、検索条件から検索し、結果を一覧表示させます。
    // 詳細画面から、戻るボタンがおされたときに、検索条件を保持するため、
    // セッションに格納しておきます
    public function result(Request $request)
    {
        // 単語検索のために
        // 入力されたデータを成形して、word[]に入力します
        $word = str_replace('、', ',', $request->word);
        $word = str_replace(' ',  ',', $word);
        $word = str_replace('　',  ',', $word);

        $request->session()->put('words',$word);//セッションに単語検索の単語を入れる
        $word = explode(",",$word);
        for($i=0;$i<count($word);$i++){
            $word[$i]=trim($word[$i]);
        }
        
        // 施設区分で検索のために
        // 得られたデータをわかりやすく変数に入れます
        $facility   = $request->facility_name;
        if (empty($facility)){
            $request->session()->put('facilitys', -1);
        }else{
            $request->session()->put('facilitys',implode(',', $facility));//セッションに施設区分を入れます
        }

        // 地域で検索するために
        // 得られたデータをわかりやすく変数に入れます
        $area       = $request->area_name;
        if (empty($area)){
            $request->session()->put('areas', -1);
        }else{
            $request->session()->put('areas',implode(',', $area));//セッションに地域を入れます
        }

        // 犬ＯＫかで検索するために、変数に格納します
        $dogs       = $request->dogs;
        $request->session()->put('dogs',$dogs);//セッションに犬OKを入れます

        // 年代で検索するために、データを格納
        $age        = $request->age_name;

        if (empty($age)){
            $request->session()->put('ages', -1);
        }else{
            $request->session()->put('ages',implode(',', $age));//セッションに地域を入れます
        }

        // 検索を行う
        $search= new SearchQuery($word, $facility, $area, $dogs, $age);
        $posts=$search->searchTerms(Post::query());
        $posts=$posts->orderBy('created_at', 'desc')->paginate(5)->withPath('/result/back');

        $user=auth()->user();

        // 遷移元が、resultからであるかを$moveFromに1を渡すことで示している
        $moveFrom=1;


        // 現在のページを取得して、セッションに入れます
        $currentPage = $posts->currentPage();
        $request->session()->put('currentPage',$currentPage);

        return view('post.index', compact('posts', 'user','moveFrom'));
    }

    /* create 関数
    　新規投稿画面に遷移します　　　　　　　　　　　　　　　　 */
    public function create()
    {
        $items=Area::all();
        $param=[
            'items_a' => $items
        ];
        return view('post.create',$param);
    }

    // 投稿記事をDBに格納します
    public function store(Request $request)
    {
        // 入力のバリデーション処理
        $inputs=$request->validate([
            'title'     =>'required|max:255',
            'body'      =>'required|max:5000',
            'image_main'=>'image|max:1024',
            'image_sub1'=>'image|max:1024',
            'image_sub2'=>'image|max:1024',
            'image_sub3'=>'image|max:1024',
            'image_sub4'=>'image|max:1024',
            // 'hp_adress' =>'url',
            'infant'    =>'numeric|between:1,5',
            'lower_grade'=>'numeric|between:1,5',
            'higher_grade'=>'numeric|between:1,5',
            'over13'    =>'numeric|between:1,5'
        ]);

        $post=new Post();

        // ユーザID
        $post->user_id=auth()->user()->id;
        // 施設名
        $post->title=$request->title;
        // 本文
        $post->body=$request->body;
        // 画像
        if (request('image_main')){
            $original = request()->file('image_main')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            request()->file('image_main')->move('storage/images', $name);
            $post->image_main = $name;
        }
        if (request('image_sub1')){
            $original = request()->file('image_sub1')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            request()->file('image_sub1')->move('storage/images', $name);
            $post->image_sub1 = $name;
        }
        if (request('image_sub2')){
            $original = request()->file('image_sub2')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            request()->file('image_sub2')->move('storage/images', $name);
            $post->image_sub2 = $name;
        }
        if (request('image_sub3')){
            $original = request()->file('image_sub3')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            request()->file('image_sub3')->move('storage/images', $name);
            $post->image_sub3 = $name;
        }
        if (request('image_sub4')){
            $original = request()->file('image_sub4')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            request()->file('image_sub4')->move('storage/images', $name);
            $post->image_sub4 = $name;
        }
        // HPアドレス
        $post->hp_adress=$request->hp_adress;
        // 地域
        $post->area_id=(int)$request->areas;
        // 施設区分
        $post->park         =false;
        $post->indoor_fac   =false;
        $post->shopping     =false;
        $post->gourmet      =false;
        $post->others       =false;
        if(in_array('park', $request->facility)){
            $post->park=true;
        }
        if(in_array('indoor_fac', $request->facility)){
            $post->indoor_fac=true;
        }
        if(in_array('shopping', $request->facility)){
            $post->shopping=true;
        }
        if(in_array('gourmet', $request->facility)){
            $post->gourmet=true;
        }
        if(in_array('others', $request->facility)){
            $post->others   =true;
        }

        // おすすめ年代
        $post->infant       =(int)$request->infant;
        $post->lower_grade  =(int)$request->lower_grade;
        $post->higher_grade =(int)$request->higher_grade;
        $post->over13       =(int)$request->over13;
        // 犬OK？
        $post->dogs         =(int)$request->dogs;

        $post->save();

        return redirect()->route('post.create')->with('message', '投稿を作成しました');    
    }

    // 投稿した内容を一覧表示する
    public function show(Request $request, Post $post)
    {
        // 詳細画面が開かれたことを知らせるため、セッションのtransition
        // にtrueを格納しておきます
        $request->session()->put('transition',true);
        return view('post.show', compact('post'));
    }

    // 詳細画面の編集を行う画面を表示する
    // 編集操作は、adminしか行えません
    public function edit(Post $post)
    {
        Gate::authorize('admin');
        
        $items=Area::all();
        $param=[
            'items_a' => $items,
            'post'=> $post
        ];
        return view('post.edit', $param);
    }

    //　記事を編集後、DBをアップデートします 
    public function update(Request $request, Post $post)
    {
        // 入力のバリデーション処理
        $inputs=$request->validate([
            'title'     =>'required|max:255',
            'body'      =>'required|max:5000',
            'image_main'=>'image|max:1024',
            'image_sub1'=>'image|max:1024',
            'image_sub2'=>'image|max:1024',
            'image_sub3'=>'image|max:1024',
            'image_sub4'=>'image|max:1024',
            'hp_adress' =>'url',
            'infant'    =>'numeric|between:1,5',
            'lower_grade'=>'numeric|between:1,5',
            'higher_grade'=>'numeric|between:1,5',
            'over13'    =>'numeric|between:1,5'
        ]);

        // ユーザID
        $post->user_id = auth()->user()->id;
        // 施設名
        $post->title = $request->title;
        // 本文
        $post->body = $request->body;
        // 画像
        if (request('image_main')){
            $original = request()->file('image_main')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            $file = request()->file('image_main')->move('storage/images', $name);
            $post->image_main = $name;
        }
        if (request('image_sub1')){
            $original = request()->file('image_sub1')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            $file = request()->file('image_sub1')->move('storage/images', $name);
            $post->image_sub1 = $name;
        }
        if (request('image_sub2')){
            $original = request()->file('image_sub2')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            $file = request()->file('image_sub2')->move('storage/images', $name);
            $post->image_sub2 = $name;
        }
        if (request('image_sub3')){
            $original = request()->file('image_sub3')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            $file = request()->file('image_sub3')->move('storage/images', $name);
            $post->image_sub3 = $name;
        }
        if (request('image_sub4')){
            $original = request()->file('image_sub4')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            $file = request()->file('image_sub4')->move('storage/images', $name);
            $post->image_sub4 = $name;
        }
        // HPアドレス
        $post->hp_adress=$request->hp_adress;
        // 地域
        $post->area_id=(int)$request->areas;
        // 施設区分
        $post->park         =false;
        $post->indoor_fac   =false;
        $post->shopping     =false;
        $post->gourmet      =false;
        $post->others       =false;
        if(in_array('park', $request->facility)){
            $post->park=true;
        }
        if(in_array('indoor_fac', $request->facility)){
            $post->indoor_fac=true;
        }
        if(in_array('shopping', $request->facility)){
            $post->shopping=true;
        }
        if(in_array('gourmet', $request->facility)){
            $post->gourmet=true;
        }
        if(in_array('others', $request->facility)){
            $post->others   =true;
        }

        // おすすめ年代
        $post->infant       =(int)$request->infant;
        $post->lower_grade  =(int)$request->lower_grade;
        $post->higher_grade =(int)$request->higher_grade;
        $post->over13       =(int)$request->over13;
        // 犬OK？
        $post->dogs         =(int)$request->dogs;
                
        $post->save();

        return redirect()->route('post.show', $post)->with('message', '記事を更新しました');
    }

    // 投稿記事を削除します
    // この操作は、Adminしか行えません。
    public function destroy(Post $post)
    {
        Gate::authorize('admin');
        
        $post->comments()->delete();
        $post->delete();
        return redirect()->route('post.index')->with('message', '記事を削除しました');
    }
}
