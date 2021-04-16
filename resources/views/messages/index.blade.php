@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Messages</h2>
                </div>
                <div class="pull-right mb-3">
                    <a class="btn btn-success" href="{{ route('messages.create') }}"> Create New Product</a>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Subject</th>
                <th>Body</th>
                <th>Recipients</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($messages as $message)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $message->subject }}</td>
                    <td>{{ $message->body }}</td>
                    <td>{{ $message->recipients }}</td>
                    <td>
                        <form action="{{ route('messages.destroy',$message->id) }}" method="POST">

                            <a class="btn btn-success" href="{{ route('messages.show',$message->id) }}">Show</a>

                            <a class="btn btn-primary" href="{{ route('messages.edit',$message->id) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        {!! $messages->links() !!}
    </div>
@endsection
