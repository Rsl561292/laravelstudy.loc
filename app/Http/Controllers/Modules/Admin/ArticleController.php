<?php

namespace App\Http\Controllers\Modules\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Article;

class ArticleController extends Controller
{
    //
    public function getIndex()
    {
        //

        $articles = Article::with([
            'category',
            'user'
        ])
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('modules/admin/article/index', [
            'articles' => $articles,
        ]);
    }

    public function getOne($id)
    {
        //
        $article = Article::with([
            'category',
            'user',
        ])->find($id);

        if(!empty($article)) {

            return view('modules/admin/article/one', [
                'article' => $article,
            ]);

        }

        Session::put('flash_message', [
            [
                'type' => 'error',
                'message' => 'Sorry but the article don\'t may be revised. Record with id "' . $id . '" not found.'
            ]
        ]);

        return redirect()->route('admin.articles.index');
    }

    public function setChangeStatus($id, $status)
    {
        //
        $article = Article::find($id);

        if(!empty($article)) {

            $date = $article->published_at;

            if(Arr::exists(Article::getStatusList(), $status)) {

                if($article->status == Article::STATUS_MODERATION &&
                    $status == Article::STATUS_ACTIVE && $article->published_at == null) {

                    $date = time();
                }

                DB::table('articles')->where('id', $article->id)
                    ->update([
                        'status' => $status,
                        'published_at' => date('Y-m-d H:i:s', $date)
                ]);

                $article->status = $status;

                Session::put('flash_message', [
                    [
                        'type' => 'success',
                        'message' => 'Status article with title "' . $article->title . '" was by change on status "' . $article->getStatusName() . '" not use on our site.'
                    ]
                ]);

            } else {

                Session::put('flash_message', [
                    [
                        'type' => 'error',
                        'message' => 'Status with code "' . $status . '" not use on our site.'
                    ]
                ]);

                return redirect()->back();
            }

        } else {
            Session::put('flash_message', [
                [
                    'type' => 'error',
                    'message' => 'Record with id "' . $id . '" not found.'
                ]
            ]);

            return redirect()->back();
        }


        return redirect()->route('admin.articles.index');
    }
}
