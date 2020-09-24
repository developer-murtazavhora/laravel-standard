@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Product Detail</div>

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
                                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary mr-2">Back</a>
                                    <a href="{{ route('products.edit', $product->id) }}"
                                       class="btn btn-outline-secondary">Edit</a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <p>
                                    <strong>Title: </strong><br>
                                    {{ !empty($product) ? $product->title : '-' }}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p>
                                    <strong>Status: </strong><br>
                                    {{ (isset($product->is_active) && $product->is_active == 1) ? 'Active' : 'Inactive' }}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p>
                                    <strong>Added By: </strong><br>
                                    {{ isset($product->user) && !empty($product->user) ? $product->user->name : 'N/A' }}
                                </p>
                            </div>
                            <div class="col-md-12">
                                <p>
                                    <strong>Description: </strong><br>
                                    {{ !empty($product) ? $product->description : '-' }}
                                </p>
                            </div>
                        </div>

                        <p class="mt-4 mb-3"><strong>Categories</strong></p>
                        <div class="row">
                            <div class="col-md-12">
                                <table
                                    class="table table-striped table-bordered nowrap product_product_listing">
                                    <thead>
                                    <tr>
                                        <th>Index</th>
                                        <th>Title</th>
                                        <th>Identifier</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($product->categories) > 0)
                                        @foreach($product->categories as $index => $category)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>
                                                    @if(!empty($category->category->title))
                                                        <a href="{{ route('categories.show', [ $category->category->id ]) }}"
                                                           class="text-underline blue">
                                                            <span>{{ $category->category->title }}</span>
                                                        </a>
                                                    @else
                                                        <span>-</span>
                                                    @endif
                                                </td>
                                                <td>{{ !empty($category->category) ? $category->category->identifier : '-' }}</td>
                                                <td>{{ !empty($category->category) && $category->category->is_active == 1 ? 'Active' : 'Inactive' }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4">No record found.</td>
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
            //
        })
    </script>
@stop
