<?php namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use \Auth;
use App\Tag;


use App\Http\Requests\ArticleRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ArticlesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */




    //Create a new articles controller instance
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }


    /**
     * @return \Illuminate\View\View
     */
    public function index()
	{
		$articles = Article::latest('published_at')->published()->get();

        $latest = Article::latest()->first();

		return view('articles.index', compact('articles', 'latest'));
	}

	public function show(Article $article)
	{
		//dd($article->published_at->diffForHumans());

		return view('articles.show', compact('article'));
	}


	public function create()
	{
        $tags = Tag::lists('name', 'id');

        return view('articles.create', compact('tags'));
	}

	public function store(ArticleRequest $request)
	{
        //$article = new Article($request->all());

        //Auth::user()->articles()->save($article);

		//Article::create($request->all());

        //dd($request->input('tags'));

        $this->createArticle($request);

        //$article->tags()->attach($request->input('tag_list'));

        //session()->flash('flash_message', 'Your article has been created!');

        flash()->overlay('Your article has been created', 'Good job');

        return redirect('articles');

//		return redirect('articles')->with([
//            'flash_message'=>'Your article has been created!',
//            'flash_message_important'=>true
//        ]);
	}


	public function edit(Article $article)
    {
        $tags = Tag::lists('name', 'id');

        return view('articles.edit', compact('article', 'tags'));
	}


    public function update(Article $article, ArticleRequest $request)
    {
        $article->update($request->all());

        $this->syncTags($article, $request->input('tag_list'));

        return redirect('articles');
    }

    /**
     * Sync up tags with the database
     *
     * @param Article $article
     * @param ArticleRequest $request
     */
    public function syncTags(Article $article, array $tags)
    {
        $article->tags()->sync($tags);
    }


    /**
     * save a new article
     *
     * @param ArticleRequest $request
     * @return mixed
     */
    public function createArticle(ArticleRequest $request)
    {
        $article = Auth::user()->articles()->create($request->all());

        //$tagIds = $request->input('tags');

        $this->syncTags($article, $request->input('tag_list'));

        return $article;
    }
}
