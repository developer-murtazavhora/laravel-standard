@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Category {{ isset($category) ? ' Edit' : ' Create' }}</div>

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
                                <div class="form-group float-right">
                                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Back</a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                $redirect_route = !empty($category)
                                    ? route('categories.update', $category->id)
                                    : route('categories.store');
                                ?>
                                <form action="{{ $redirect_route }}" method="post"
                                      enctype="multipart/form-data" class="category_form" id="category_form">
                                    {{ csrf_field() }}
                                    @if(isset($category) && !empty($category))
                                        <input type="hidden" name="_method" value="put">
                                        <input type="hidden" name="id" class="category_id"
                                               value="{{ isset($category) && !empty($category) ? $category->id : 0 }}">
                                    @endif
                                    @include('categories.form')
                                </form>
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
        //
    </script>
@stop
