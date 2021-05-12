@extends('master')

@section('title')
    View Product
@endsection

@section('body')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Product Basic Info Goes Here</h4>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <td>{{ $product->id }}</td>
                            </tr>
                            <tr>
                                <th>Product Name</th>
                                <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <th>Product Code</th>
                                <td>{{ $product->code }}</td>
                            </tr>
                            <tr>
                                <th>Category Name</th>
                                <td>{{ $product->category->name }}</td>
                            </tr>
                            <tr>
                                <th>Sub Category Name</th>
                                <td>{{ $product->subCategory->name }}</td>
                            </tr>
                            <tr>
                                <th>Main Price</th>
                                <td>{{ $product->main_price }}</td>
                            </tr>
                            <tr>
                                <th>Discount Price</th>
                                <td>{{ $product->discount_price }}</td>
                            </tr>
                            <tr>
                                <th>Short Description</th>
                                <td>{{ $product->short_description }}</td>
                            </tr>
                            <tr>
                                <th>Long Description</th>
                                <td>{!! $product->long_description !!}</td>
                            </tr>
                            <tr>
                                <th>Product Image</th>
                                <td><img src="{{ asset($product->image) }}" alt="" height="120" width="160"></td>
                            </tr>
                            <tr>
                                <th>Pubication Status</th>
                                <td>{{ $product->status }}</td>
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Product Color Info Goes Here</h4>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Color Name</th>
                                <th>Color Code</th>
                                <th>Color Description</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($colors as $color)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $color->color->name }}</td>
                                    <td>{{ $color->color->code }}</td>
                                    <td>{{ $color->color->description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Product Size Info Goes Here</h4>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Size Name</th>
                                <th>Size Code</th>
                                <th>Size Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sizes as $size)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $size->size_id }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Product Sub Images Goes Here</h4>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <tr>
                            <th>Sub Image</th>
                            <td>
                                @foreach ($sub_images as $sub_image)
                                    <img src="{{ asset($sub_image->image) }}" alt="" width="130" height="150">
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
