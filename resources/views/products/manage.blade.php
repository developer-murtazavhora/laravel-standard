@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Product {{ isset($product) ? ' Edit' : ' Create' }}</div>

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
                                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Back</a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                $redirect_route = !empty($product)
                                    ? route('products.update', $product->id)
                                    : route('products.store');
                                ?>
                                <form action="{{ $redirect_route }}" method="post"
                                      enctype="multipart/form-data" class="product_form" id="product_form">
                                    {{ csrf_field() }}
                                    @if(isset($product) && !empty($product))
                                        <input type="hidden" name="_method" value="put">
                                        <input type="hidden" name="id" class="product_id"
                                               value="{{ isset($product) && !empty($product) ? $product->id : 0 }}">
                                    @endif
                                    @include('products.form')
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
