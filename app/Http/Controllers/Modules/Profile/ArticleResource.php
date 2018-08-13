<?php

namespace App\Http\Controllers\Modules\Profile;

use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Article;

class ArticleResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $articles = Article::with([
            'category'
        ])
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('modules/profile/article/index', [
            'articles' => $articles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $categories = Category::getListId();

        return view('modules/profile/article/create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        //

        $user = Auth::user();
        $article = new Article([
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'status' => $request->input('status'),
        ]);

        if($user->articles()->save($article)) {

            Session::put('flash_message', [
                [
                    'type' => 'success',
                    'message' => 'You success saved article with title "' . $request->input('title') . '".'
                ]
            ]);

            return redirect()->route('articles.index');
        } else {
            Session::put('flash_message', [
                [
                    'type' => 'error',
                    'message' => 'Sorry but your article don\'t saved. Please try again.'
                ]
            ]);

            return redirect()->route('articles.create')->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $article = Article::find($id);

        if(Gate::denies('update', $article)) {

            Session::put('flash_message', [
                [
                    'type' => 'error',
                    'message' => 'You can not edit this article because you have not created it.'
                ]
            ]);

            return redirect()->back();
        }

        if(!empty($article)) {

            $categories = Category::getListId();

            return view('modules/profile/article/edit', [
                'article' => $article,
                'categories' => $categories,
            ]);

        }

        Session::put('flash_message', [
            [
                'type' => 'error',
                'message' => 'Sorry but the article don\'t may be edit. Record with id "' . $id . '" not found.'
            ]
        ]);

        return redirect()->route('articles.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        //
        $article = Article::find($id);

        if(Gate::denies('update', $article)) {

            Session::put('flash_message', [
                [
                    'type' => 'error',
                    'message' => 'You can not edit this article because you have not created it.'
                ]
            ]);

            return redirect()->back()->withInput();
        }

        if(!empty($article)) {

            if($article->title != $request->input('title') ||
                $article->content != $request->input('content') ||
                $article->category_id != $request->input('category_id')) {

                $article->status = Article::STATUS_MODERATION;
            } else {

                $article->status = $request->input('status');
            }

            $article->category_id = $request->input('category_id');
            $article->title = $request->input('title');
            $article->content = $request->input('content');

            if($article->save()) {

                Session::put('flash_message', [
                    [
                        'type' => 'success',
                        'message' => 'You success saved your changes article with title "' . $article->title . '".'
                    ]
                ]);

                return redirect()->route('articles.index');
            } else {
                Session::put('flash_message', [
                    [
                        'type' => 'error',
                        'message' => 'Sorry but your article don\'t saved. Please try again.'
                    ]
                ]);

                return redirect()->route('articles.create')->withInput();
            }
        }

        Session::put('flash_message', [
            [
                'type' => 'error',
                'message' => 'Sorry but the article don\'t may be updated. Record with id "' . $id . '" not found.'
            ]
        ]);

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $article = Article::find($id);

        if(Gate::denies('delete', $article)) {

            Session::put('flash_message', [
                [
                    'type' => 'error',
                    'message' => 'You can not delete this article because you have not created it.'
                ]
            ]);

            return redirect()->back()->withInput();
        }

        if(!empty($article)) {

            $name = $article->title;

            if($article->delete()) {

                Session::put('flash_message', [
                    [
                        'type' => 'success',
                        'message' => 'You success deleted article with title "' . $name . '".'
                    ]
                ]);
            } else {
                Session::put('flash_message', [
                    [
                        'type' => 'error',
                        'message' => 'You don\'t deleted article with title "' . $name . '". There was a system error. Please again.'
                    ]
                ]);
            }

        } else {
            Session::put('flash_message', [
                [
                    'type' => 'error',
                    'message' => 'Sorry but the article don\'t delete. Record with id "' . $id . '" not found.'
                ]
            ]);
        }

        return redirect()->route('articles.index');
    }
}
