@extends('layouts.app')

@section('content')
    <br>
    <br>
    <div class="row ">
        <div class="col-lg-3"></div>
        <div class="col-lg-6  border border-primary">
            <p class="h5">NEW PROFILE</p>
            <form method="POST" action="{{ route('user.save') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <div class="form-check role">
                        <label class="form-check-label" for="radio1">
                            <input type="radio" class="form-check-input" id="radio1" name="role" value="admin" checked>Admin
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label" for="radio2">
                            <input type="radio" class="form-check-input" id="radio2" name="role" value="waiter">Waiter
                        </label>
                    </div>
                </div>



                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter password">
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6 text-center"> <button type="submit" class="btn btn-primary">Submit</button></div>
                </div>
                <br>
            </form>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <p class="h5">PROFILES</p>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NAME</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">ROLE</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($user as $key => $item)
                        <tr>
                            <td scope="row">{{ $key + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->role }}</td>
                            <td>
                                <a href="{{ route('admin.delete', $item->id) }}" class="btn btn-danger"><i
                                        class="fa-solid fa-trash-can"></i></a>
                                <a href="{{ route('admin.update', $item->id) }}" class="btn btn-warning"><i
                                        class="fa-solid fa-pencil"></i></a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection

@push('css')
    <style>

    </style>
@endpush
