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
                <th>Title</th>
                <th>Recipients count</th>
                <th>Sent</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($messages as $message)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $message->subject }}</td>
                    <td>{{ $message->recipient_count }}</td>
                    <td>{{ $message->sent ? 'Yes' : 'No' }}</td>
                    <td>
                        <form action="{{ route('messages.destroy',$message->id) }}" method="POST">


                            <a class="btn btn-primary" href="{{ route('messages.edit',$message->id) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                            <a class="btn btn-success" href="{{ route('messages.send',$message->id) }}">Send</a>

                        </form>

                    </td>
                </tr>
            @endforeach
        </table>

        {!! $messages->links() !!}
    </div>
@endsection
