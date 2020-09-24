@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Category Detail</div>

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
                                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary mr-2">Back</a>
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                       class="btn btn-outline-secondary">Edit</a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <p>
                                    <strong>Title: </strong><br>
                                    {{ !empty($category) ? $category->title : '-' }}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p>
                                    <strong>Status: </strong><br>
                                    {{ (isset($category->is_active) && $category->is_active == 1) ? 'Active' : 'Inactive' }}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p>
                                    <strong>Added By: </strong><br>
                                    {{ isset($category->user) && !empty($category->user) ? $category->user->name : 'N/A' }}
                                </p>
                            </div>
                            <div class="col-md-12">
                                <p>
                                    <strong>Description: </strong><br>
                                    {{ !empty($category) ? $category->description : '-' }}
                                </p>
                            </div>
                        </div>

                        <p class="mt-4 mb-3"><strong>Products</strong></p>
                        <div class="row">
                            <div class="col-md-12">
                                <table
                                    class="table table-striped table-bordered nowrap category_product_listing">
                                    <thead>
                                    <tr>
                                        <th>Index</th>
                                        <th>Name</th>
                                        <th>Identifier</th>
                                        <th>Status</th>
                                        <th>Featured</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($category->products) > 0)
                                        @foreach($category->products as $index => $product)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>
                                                    @if(!empty($product->product->title))
                                                        <a href="{{ route('products.show', [ $product->product->id ]) }}"
                                                           class="text-underline blue">
                                                            <span>{{ $product->product->title }}</span>
                                                        </a>
                                                    @else
                                                        <span>-</span>
                                                    @endif
                                                </td>
                                                <td>{{ !empty($product->product) ? $product->product->identifier : '-' }}</td>
                                                <td>{{ !empty($product->product) && $product->product->is_active == 1 ? 'Active' : 'Inactive' }}</td>
                                                <td>{{ !empty($product->product) && $product->product->is_featured == 1 ? 'Yes' : 'No' }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">No record found.</td>
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
