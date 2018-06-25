@extends('.modules.admin.layouts.main')

@php
use \App\Article;

$listButton = [];
@endphp

@section('titlePage', 'Revise article')

@section('content')

    @if(!empty($article))
        <div class="blog-article">
            <p class="title-article">{{ $article['title'] }}</p>
            <div class="list-meta-data">
                <p class="meta-data div-left"><span class="parameter">Category:</span> {{ $article['category']['name'] }} ; <span class="parameter">Status:</span> {{ $article->getStatusName() }} </p>
                <p class="meta-data div-right">
                    @if($article['published_at'] != null)
                        <span class="parameter">Published:</span> {{ date('F d, Y', strtotime($article['published_at'])) }} ;
                    @endif
                        <span class="parameter">Update:</span> {{ date('F d, Y', strtotime($article['updated_at'])) }} ; <span class="parameter">By:</span> <a href="#">{{ $article['user']['name'] }}</a>
                </p>
            </div>

            <div class="content-article">{{ $article['content'] }}</div>
        </div>

        <div class="line-btn">
            @switch($article['status'])
                @case(\App\Article::STATUS_ACTIVE)
                    <a class="btn btn-danger" href="{{ route('admin.articles.change-status', ['id' => $article['id'], 'status' => \App\Article::STATUS_BLOCKED]) }}">To block</a>
                    @break

                @case(\App\Article::STATUS_INACTIVE)
                    <a class="btn btn-danger" href="{{ route('admin.articles.change-status', ['id' => $article['id'], 'status' => \App\Article::STATUS_BLOCKED]) }}">To block</a>
                    @break

                @case(\App\Article::STATUS_BLOCKED)
                    <a class="btn btn-success" href="{{ route('admin.articles.change-status', ['id' => $article['id'], 'status' => \App\Article::STATUS_ACTIVE]) }}">Unblock</a>
                    @break

                @case(\App\Article::STATUS_MODERATION)
                    <a class="btn btn-success" href="{{ route('admin.articles.change-status', ['id' => $article['id'], 'status' => \App\Article::STATUS_ACTIVE]) }}">Approve</a>
                    <a class="btn btn-danger" href="{{ route('admin.articles.change-status', ['id' => $article['id'], 'status' => \App\Article::STATUS_BLOCKED]) }}">Eeject</a>
                    @break

                @default
                    <a class="btn btn-success" href="{{ route('admin.articles.change-status', ['id' => $article['id'], 'status' => \App\Article::STATUS_ACTIVE]) }}">Approve</a>
                    <a class="btn btn-danger" href="{{ route('admin.articles.change-status', ['id' => $article['id'], 'status' => \App\Article::STATUS_BLOCKED]) }}">Eeject</a>
            @endswitch

            <a class="btn btn-danger div-right" href="{{ route('admin.articles.index') }}">Cancel</a>
        </div>
    @else
        <center><h4>Articles not found!</h4></center>
    @endif
@endsection
