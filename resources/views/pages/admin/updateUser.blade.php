@extends('layouts.app')

@section('content')
    <br>
    <br>
    <div class="row ">
        <div class="col-lg-3"></div>
        <div class="col-lg-6  border border-primary">
            <p class="h5">EDIT PROFILE</p>
            <form method="POST" action="{{ route('admin.updater', $user->id) }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                        value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email"
                        value="{{ $user->email }}">
                </div>
                <br>
                <div class="form-group">
                    <label for="role">Role</label>
                    <div class="form-check role">
                        <label class="form-check-label" for="radio1">
                            <input type="radio" class="form-check-input" id="radio1" name="role" value="admin"
                                {{ $user->role == 'admin' ? 'checked' : '' }}>Admin
                        </label>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label" for="radio2">
                            <input type="radio" class="form-check-input" id="radio2" name="role" value="waiter"
                                {{ $user->role == 'waiter' ? 'checked' : '' }}>Waiter
                        </label>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" id="password" name="password" placeholder="Enter password">
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-9"></div>
                    <div class="col-sm-2 text-center"> <button type="submit" class="btn btn-primary">UPDATE</button></div>
                </div>
                <br>
            </form>
        </div>
    </div>
@endsection
