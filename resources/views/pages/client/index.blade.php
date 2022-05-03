@extends('layouts.app')

@section('content')
    <br>
    <br>
    <div class="row">
        <div class="col-lg-6">

            @foreach ($items as $item)
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-8 ">
                        <div class="card" style="width: 40rem;">
                            <img class="card-img-top" src="{{ url('images/' . $item->itemimage) }}" alt="Card image cap">
                            <div class="card-body">
                                <form action="{{ route('temp.find', $item->id) }}" method="POST">
                                    @csrf
                                    <h5 class="card-title">{{ $item->name }}</h5>
                                    <p class="card-text">

                                    <div class="form-group row">
                                        <label for="price" class="col-sm-2 col-form-label">ITEM PRICE (RS)</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="price"
                                                name="price" value="{{ sprintf('%.2f', $item->price) }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="qty" class="col-sm-2 col-form-label">QTY</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="qty" placeholder="QTY" name="qty"
                                                required>
                                        </div>
                                    </div>

                                    </p>
                                    <button class="btn btn-primary" type="submit">ADD TO CART</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
            @endforeach
        </div>
        <div class="col-lg-5 ">
            <p class="h5">FOOD CART</p>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ITEM</th>
                        <th scope="col">APPEARANCE</th>
                        <th scope="col">PRICE (RS)</th>
                        <th scope="col">QTY</th>
                        <th scope="col">SUB TOTAL</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($a as $key => $item)
                        <tr>
                            <td> {{ $key + 1 }}</td>
                            <td> {{ $item[0] }}</td>
                            <td> <img src="{{ url('images/' . $item[1]) }}" width="100px" height="100px" alt=""></td>
                            <td> {{ sprintf('%.2f', $item[2]) }}</td>
                            <td> {{ $item[3] }}</td>
                            <td> {{ $item[4] }}</td>
                            <td>
                                <a href="{{ route('tempitem.delete', $item[5]) }}" class="btn btn-danger"><i
                                        class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="table-dark text-right" colspan="6">NET TOTAL (RS)</td>
                        <td class="table-dark">{{ sprintf('%.2f', $total) }}</td>
                    </tr>
                    <tr>
                        <td class=" text-right" colspan="7">
                            <a class="btn btn-primary" href="{{ route('client.new.order', Auth::user()->id) }}"
                                role="button">NEW ORDER</a>
                            <a class="btn btn-success" href="{{ route('client.place.order', Auth::user()->id) }}"
                                role="button">PLACE ORDER</a>
                        </td>
                    </tr>

                </tbody>

            </table>
        </div>
        <div class="col-lg-1"></div>
    </div>
@endsection
