@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-4">

        </div>
        <div class="col-lg-4">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ITEM</th>
                        <th scope="col">APPEARANCE</th>
                        <th scope="col">PRICE (RS)</th>
                        <th scope="col">QTY</th>
                        <th scope="col">SUB TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($a as $key => $order)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ $order[0] }} </td>
                            <td> <img src="{{ url('images/' . $order[1]) }}" alt="" width="100px" height="100px"> </td>
                            <td>{{ sprintf('%.2f', $order[2]) }} </td>
                            <td>{{ $order[3] }} </td>
                            <td class="text-right">{{ sprintf('%.2f', $order[2] * $order[3]) }} </td>

                        </tr>
                    @endforeach
                    <tr>
                        <td class="table-dark text-right" colspan="5">NET TOTAL (RS)</td>
                        <td class="table-dark text-right">{{ sprintf('%.2f', $total) }}</td>
                    </tr>
                    <tr>
                        <td class=" text-right" colspan="7">
                            <a class="btn btn-success" href="{{ route('admin.order.complete', $orderId) }}"
                                role="button">COMPLETE ORDER</a>

                        </td>
                    </tr>

                </tbody>

            </table>
        </div>
        <div class="col-lg-4">

        </div>
    </div>
@endsection
