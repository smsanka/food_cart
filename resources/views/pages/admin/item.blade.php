@extends('layouts.app')

@section('content')
    <br>
    <br>
    <br>
    <div class="container ">

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
            <div class="col-lg-5 border border-primary">
                <p class="h5">NEW ITEM</p>
                <form method="POST" action="{{ route('item.save') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="item">Item Name</label>
                        <input type="text" class="form-control" id="item" placeholder="Enter Item name" required
                            name="name">
                    </div>
                    <div class="form-group">
                        <label for="price">Price (RS)</label>
                        <input type="text" class="form-control" id="price" placeholder="price" required name="price">
                    </div>
                    <div class="form-group">
                        <label for="image">Item Image</label>
                        <input type="file" class="form-control" id="image" required name="image">
                    </div>
                    <br>
                    <div class="row "><button type="submit" class="btn btn-primary">ADD</button></div>
                </form>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-6 border">
                <p class="h5"> ITEMS</p>
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ITEM</th>
                            <th scope="col">PRICE (RS)</th>
                            <th scope="col">IMAGE</th>
                            <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $key => $item)
                            <tr>
                                <td scope="row">{{ $key + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ sprintf('%.2f', $item->price) }}</td>
                                <td><img src="{{ url('images/' . $item->itemimage) }}" alt="" width="100px"
                                        height="100px">
                                </td>
                                <td>
                                    <a href="{{ route('item.delete', $item->id) }}" class="btn btn-danger"><i
                                            class="fa-solid fa-trash-can"></i></a>
                                    <a href="{{ route('item.update', $item->id) }}" class="btn btn-warning"><i
                                            class="fa-solid fa-pencil"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
@endsection



@push('css')
    <style>

    </style>
@endpush
