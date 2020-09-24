@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Users</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                @if(\Illuminate\Support\Facades\Session::has('notification'))
                                    <div
                                        class="alert alert-{{\Illuminate\Support\Facades\Session::get('notification.type')}}">
                                        <span><?php echo \Illuminate\Support\Facades\Session::get('notification.message'); ?></span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped table-bordered nowrap user_listing">
                                    <thead>
                                    <tr>
                                        <th>Index</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($users) > 0)
                                        @foreach($users as $index => $user)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ !empty($user->name) ? $user->name : '-' }}</td>
                                                <td>{{ !empty($user->email) ? $user->email : '-' }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3">No record found.</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page_js')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).off('click', '.delete_item');
            $(document).on('click', '.delete_item', function () {
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this item!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((will_delete) => {
                        if (will_delete) {
                            swal("Poof! Your item has been deleted!", {
                                icon: "success",
                            });
                            setTimeout(function () {
                                $(document).find('.delete_item_form').submit();
                            }, 1000);
                        }
                    });
            });
        })
    </script>
@stop
