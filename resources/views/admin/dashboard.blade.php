@extends('layouts.app')

@section('content')
    <h1>Admin Dashboard</h1>

    @if (auth()->user()->role == 'admin')
        <p>Welcome, Admin! Here you can manage users.</p>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- User Management Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            @if (auth()->user()->id != $user->id) <!-- Prevent self-role change -->
                                <form action="{{ route('admin.change-role', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        Change to {{ $user->role == 'client' ? 'Admin' : 'Client' }}
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Welcome to the client dashboard!</p>
    @endif
@endsection

