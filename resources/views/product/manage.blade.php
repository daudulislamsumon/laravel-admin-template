@extends('master')

@section('title')
    Manage Product
@endsection

@section('body')

    @if ($message = Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Product Info Goes Here</h4>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->subCategory->name }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->code }}</td>
                                    <td><img src="{{ asset($product->image) }}" alt="" height="50" width="80"></td>
                                    <td>{{ $product->status == 1 ? 'Published' : 'Unpublished' }}</td>
                                    <td class="text-center">
                                        @if ($product->status == 1)
                                            <a href="{{ route('update-product-status', ['id' => $product->id]) }}" class="btn btn-success btn-sm" title="Published Product">
                                                <i class="far fa-arrow-alt-circle-down"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('update-product-status', ['id' => $product->id]) }}" class="btn btn-warning btn-sm">
                                                <i class="far fa-arrow-alt-circle-down" title="Unpublished Product"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('view-product-detail', ['id' => $product->id]) }}" class="btn btn-primary btn-sm" title="Product Details">
                                            <i class="fas fa-book-open"></i>
                                        </a>
                                        <a href="{{ route('edit-product', ['id' => $product->id]) }}" onclick="return confirm('Are you sure to edit it?')" class="btn btn-info btn-sm" title="Product Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('delete-product', ['id' => $product->id]) }}" onclick="return confirm('Are you sure to delete it?')" class="btn btn-danger btn-sm" title="Product Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
