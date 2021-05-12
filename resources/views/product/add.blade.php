@extends('master')

@section('title')
    Add New Product
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Add Category Form</h4>
                    <form action="{{ route('new-product') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Category Name</label>
                                    <div class="col-sm-9">
                                        <select name="category_id" class="form-control" onchange="getThisSubCategory(this.value)">
                                            <option value="">---- Select Category Name ----</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Sub Category Name</label>
                                    <div class="col-sm-9">
                                        <select name="sub_category_id" class="form-control" id="subCategoryId">
                                            <option value="">---- Select Sub Category Name ----</option>
                                            @foreach ($subCategories as $subcategory)
                                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Brand Name</label>
                                    <div class="col-sm-9">
                                        <select name="brand_id" class="form-control">
                                            <option value="">---- Select Brand Name ----</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Porduct Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" class="form-control" id="horizontal-firstname-input">
                                        <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Porduct Code</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="code" class="form-control" id="horizontal-firstname-input">
                                        <span class="text-danger">{{ $errors->has('code') ? $errors->first('code') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="horizontal-password-input" class="col-sm-3 col-form-label">Product Image</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="image" accept="image/*" class="form-control-file" id="horizontal-password-input">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="horizontal-password-input" class="col-sm-3 col-form-label">Product Sub Image</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="sub_image[]" multiple accept="image/*" class="form-control-file" id="horizontal-password-input">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Unit Name</label>
                                    <div class="col-sm-9">
                                        <select name="unit_id" class="form-control">
                                            <option value="">---- Select Unit Name ----</option>
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Color Name</label>
                                    <div class="col-sm-9">
                                        <select class="select2 form-control select2-multiple" name="color[]" multiple data-placeholder="Choose Product Color">
                                            @foreach ($colors as $color)
                                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Size Name</label>
                                    <div class="col-sm-9">
                                        <select class="select2 form-control select2-multiple" name="size[]" multiple data-placeholder="Choose Product Size">
                                            @foreach ($sizes as $size)
                                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Product Price</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" placeholder="Main Price" name="main_price" class="form-control">
                                            <input type="text" placeholder="Discount Price" name="discount_price" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">Short Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="short_description" id="horizontal-email-input"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="" class="col-sm-3">Publication Status</label>
                                    <div class="col-sm-9">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" checked type="radio" name="status" id="inlineRadio1" value="1">
                                            <label class="form-check-label" for="inlineRadio1">Published</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0">
                                            <label class="form-check-label" for="inlineRadio2">Unpublished</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-sm-12">
                                <textarea class="form-control summernote" name="long_description" id="horizontal-email-input"></textarea>
                            </div>
                        </div>

                        <div class="form-group row justify-content-end">
                            <div class="col-sm-12">
                                <div>
                                    <button type="submit" class="btn btn-primary btn-block w-md">Create New Product</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
