@extends('.modules.admin.layouts.main')

@php
    $listButton = [];
@endphp

@section('titlePage', 'Users')


@section('content')

    @if(count($users) > 0)
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Upduted</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $indexRow = 1;
                    @endphp
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $indexRow++ }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                <select class="form-control" id="role_select" data-user_id="{{ $user->id }}" data-user_name="{{ $user->name }}">
                                    @foreach(App\User::getRoleList() as $key => $value)
                                        @if($key == $user->role)
                                            <option value="{{ $key }}" selected>{{ $value }}</option>
                                        @else
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="form-control" id="status_select" data-user_id="{{ $user->id }}" data-user_name="{{ $user->name }}">
                                    @foreach(App\User::getStatusList() as $key => $value)
                                        @if($key == $user->status)
                                            <option value="{{ $key }}" selected>{{ $value }}</option>
                                        @else
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td>{{ $user->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <center><h4>On site not is anyone user.</h4></center>
    @endif

    <script type="text/javascript">
        var roleSelect = $('#role_select'),
            statusSelect = $('#status_select'),
            previous;

        $(function() {

            $(document).on('focus', '#role_select', function() {

                previous = $(this).val();

            }).on('change', '#role_select', function() {

                var userName = $(this).data('user_name');

                if(confirm('Are you want really change role for user -- ' + userName + '?')) {

                    $.ajax({
                        type:'GET',
                        url: '{{ route('admin.users.change_role') }}',
                        data:{
                            user_id: $(this).data('user_id'),
                            user_role: $(this).val()
                        },
                        success:function(responce){
                            if(!responce.status) {
                                alert('Error! The role for the user "' + userName + '" has been not changed. Please refresh the page and try again or contact the site administrator.');
                                $(this).val(previous);
                            }
                        },
                        error:function(){
                            alert('Sorry but don\'t changed role user because there was a system error');
                            $(this).val(previous);
                        }
                    });
                } else {
                    $(this).val(previous);
                }
            });

            $(document).on('focus', '#status_select', function() {

                previous = $(this).val();

            }).on('change', '#status_select', function() {

                var userName = $(this).data('user_name');

                if(confirm('Are you want really change status for user -- ' + userName + '?')) {

                    $.ajax({
                        type:'GET',
                        url: '{{ route('admin.users.change_status') }}',
                        data:{
                            user_id: $(this).data('user_id'),
                            user_status: $(this).val()
                        },
                        success:function(responce){
                            if(!responce.status) {
                                alert('Error! The status for the user "' + userName + '" has been not changed. Please refresh the page and try again or contact the site administrator.');
                                $(this).val(previous);
                            }
                        },
                        error:function(){
                            alert('Sorry but don\'t changed status user because there was a system error');
                            $(this).val(previous);
                        }
                    });
                } else {
                    $(this).val(previous);
                }
            });
        });

    </script>
@endsection
