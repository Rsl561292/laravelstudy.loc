@extends('.modules.admin.layouts.main')

@php
    $listButton = [];
@endphp

@section('titlePage', 'All articles')


@section('content')

    @if(count($articles) > 0)
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Auth</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Upduted</th>
                        <th>Published</th>
                        <th class="th-actions"><a href="{{ route('admin.articles.index') }}">Refresh</a></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $indexRow = 1;
                    @endphp
                    @foreach($articles as $article)
                        <tr>
                            <td>{{ $indexRow++ }}</td>
                            <td>{{ $article->user->name }}</td>
                            <td>{{ $article->category->name }}</td>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->getStatusName() }}</td>
                            <td>{{ $article->created_at }}</td>
                            <td>{{ $article->published_at }}</td>
                            <td class="td-actions">
                                <a class="btn btn-primary" href="{{ route('admin.articles.one', ['id' => $article->id]) }}">
                                    <i class="fa fa-eye fa-fw" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <center><h4>On site not is anyone article.</h4></center>
    @endif
@endsection
