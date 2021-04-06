@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <b>{{ __('Add New Product') }}</b>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary">List Products</a>
                </div>

                <div class="card-body">
                    <!--begin:: Flash Message -->
                    @include('layouts.flash-message')
                    <!--end:: Flash Message -->

                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title" placeholder="Product Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="description" class="form-control" id="description" placeholder="Product Description">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label">Price <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="price" value="{{ old('price') }}" class="form-control" id="price" placeholder="Product Price">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="col-sm-2 col-form-label">Category <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select name="category" id="category" class="custom-select">
                                    <option value="general" @if(old('category') == 'general') selected @endif>General</option>
                                    <option value="category1" @if(old('category') == 'category1') selected @endif>Category 1</option>
                                    <option value="category2" @if(old('category') == 'category2') selected @endif>Category 2</option>
                                    <option value="category3" @if(old('category') == 'category3') selected @endif>Category 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="logo" class="col-sm-2 col-form-label">Thumbnail</label>
                            <div class="col-sm-10">
                                <input type="file" name="logo" id="logo" accept="image/*">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">Publish</div>
                            <div class="col-sm-10">
                                <div class="custom-control-inline">
                                    <div class="custom-control custom-radio mr-sm-2">
                                        <input type="radio" name="publish" value="1" class="custom-control-input" id="p1" checked>
                                        <label class="custom-control-label" for="p1">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio mr-sm-2">
                                        <input type="radio" name="publish" value="0" class="custom-control-input" id="p2">
                                        <label class="custom-control-label" for="p2">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
