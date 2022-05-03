@extends('layouts.app')

@section('content')
    <br>
    <br>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6 border border-primary">
            <p class="h5">EDIT ITEM</p>
            <form method="POST" action="{{ route('item.updater', $items->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="item">Item Name</label>
                    <input type="text" class="form-control" id="item" placeholder="Enter Item name" required name="name"
                        value="{{ $items->name }}">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" placeholder="price" required name="price"
                        value="{{ $items->price }}">
                </div>
                <div class="form-group">
                    <label for="image">Item Image</label>
                    <input type="file" class="form-control" id="image" required name="image">
                </div>
                <br>
                <div class="row  text-center">
                    <div class="col-sm-4 "></div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4"><button type="submit" class="btn btn-primary">UPDATE</button></div>

                </div>
                <br>

            </form>
        </div>

    @endsection
