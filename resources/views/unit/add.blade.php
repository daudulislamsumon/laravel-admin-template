@extends('master')

@section('title')
    Manage Unit
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
                    <h4 class="card-title mb-4">Add Unit Form</h4>

                    <form action="{{ route('new-unit') }}" method="POST">
                        @csrf
                        <div class="form-group row mb-4">
                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Unit Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="horizontal-firstname-input">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Unit Code</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="code" />
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Unit Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" id="horizontal-email-input"></textarea>
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

                        <div class="form-group row justify-content-end">
                            <div class="col-sm-9">
                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Create New Unit</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Unit Info Goes Here</h4>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Unit Name</th>
                                <th>Unit Code</th>
                                <th>Unit Description</th>
                                <th>Publication Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($units as $unit)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $unit->name }}</td>
                                    <td>{{ $unit->code }}</td>
                                    <td>{{ $unit->description }}</td>

                                    <td>{{ $unit->status == 1 ? 'Published' : 'Unpublished' }}</td>
                                    <td class="text-center">
                                        @if ($unit->status == 1)
                                            <a href="{{ route('update-unit-status', ['id' => $unit->id]) }}" class="btn btn-success btn-sm">
                                                <i class="far fa-arrow-alt-circle-down"></i>
                                            </a>
                                        @else
                                            <a href="" class="btn btn-warning btn-sm">
                                                <i class="far fa-arrow-alt-circle-down"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('edit-unit', ['id' => $unit->id]) }}" onclick="return confirm('Are you sure to edit it?')" class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('delete-unit', ['id' => $unit->id]) }}" onclick="return confirm('Are you sure to delete it?')" class="btn btn-danger btn-sm">
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
