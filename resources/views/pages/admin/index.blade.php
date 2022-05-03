@extends('layouts.app')

@section('content')
    <br><br>
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10 border">
            <p class="h5"> ORDERS</p>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">DATE</th>
                        <th scope="col">STATES</th>
                        <th scope="col">TOTAL (RS)</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $order->updated_at }}</td>
                            <td>
                                @if ($order->status == 'pending')
                                    <span class="badge bg-warning text-dark">Not Complete</span>
                                @else
                                    <span class="badge bg-success">Complete</span>
                                @endif
                            </td>
                            <td>{{ sprintf('%.2f', $order->total) }}</td>
                            <td style="width: 120px;">
                                <a href="{{ route('admin.order.delete', $order->id) }}" class="btn btn-danger"><i
                                        class="fa-solid fa-trash-can"></i></a>
                                <a href="{{ route('admin.order.confirm', $order->id) }}" class="btn btn-success"><i
                                        class="fa-solid fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach


                </tbody>

            </table>
        </div>
        <div class="col-lg-4"></div>
    </div>
@endsection
