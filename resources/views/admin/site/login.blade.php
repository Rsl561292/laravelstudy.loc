@extends('.admin.layouts.main')

@section('navbar')
    @parent
@endsection

    @section('page-name')

    @endsection

    @section('content')

        <div class="jumbotron"> </div>

        <form class="form-signin" action="{{ route('admin-sign-in') }}" method="post">
            {{ csrf_field() }}
            <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <label for="inputEmail" class="sr-only">Slug your name</label>
            <input type="text" id="inputEmail" name="user_slug" class="form-control" placeholder="Slug your name" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
    @endsection

@section('footer')
    @parent
@endsection
