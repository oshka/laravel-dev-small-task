@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <form action="/messages" method="POST">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h2>Add New Message</h2>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <div class="form-group row">
                                <label for="students"
                                       class="col-md-4 col-form-label">{{ __('Students') }}</label>
                                <select id="students" name="students[]" multiple class="form-control">
                                    @foreach($students as $student)
                                        @if (old('student')==$student->id)
                                            <option value={{$student->id}} selected>{{ $student->email }}</option>
                                        @else
                                            <option value={{$student->id}} >{{ $student->email }}</option>
                                        @endif

                                    @endforeach
                                </select>

                                @if($errors->has('students'))
                                    <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('students') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group row">
                                <label for="teachers"
                                       class="col-md-4 col-form-label">{{ __('Teachers') }}</label>
                                <select id="teachers" name="teachers[]" multiple class="form-control">
                                    @foreach($teachers as $teacher)
                                        @if (old('teacher')==$teacher->id)
                                            <option value={{$teacher->id}} selected>{{ $teacher->email }}</option>
                                        @else
                                            <option value={{$teacher->id}} >{{ $teacher->email }}</option>
                                        @endif

                                    @endforeach
                                </select>

                                @if($errors->has('teachers'))
                                    <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('teachers') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-8">
                            <div class="form-group row">
                                <label for="subject"
                                       class="col-md-4 col-form-label">{{ __('Subject') }}</label>
                                <input id="subject" type="text"
                                       class="form-control @error('subject') is-invalid @enderror"
                                       name="subject" value="{{ old('subject') }}" autocomplete="subject"
                                       autofocus>
                                @if($errors->has('subject'))
                                    <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('subject') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-8">
                            <div class="form-group row">
                                <label for="body"
                                       class="col-md-4 col-form-label">{{ __('Body') }}</label>
                                <select id="body" name="body" class="form-control">
                                    @foreach($body_list as $body)
                                        @if (old('body')==basename($body))
                                            <option value={{$body}} selected>{{$body }}</option>
                                        @else
                                            <option value={{$body}} >{{ $body }}</option>
                                        @endif

                                    @endforeach
                                </select>

                                @if($errors->has('body'))
                                    <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('body') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="row pt-4">
                        <button class="btn btn-primary">
                            Add New Message
                        </button>
                    </div>
                </div>
            </div>
        </form>


    </div>
@endsection
