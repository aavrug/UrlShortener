@extends('app')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('content')
	
	<h1>Enter your URL</h1>
	<hr/>
	{!! Form::model($url = new App\Url, ['url' => 'store']) !!}
		@include ('urls.form', ['submitButtonText' => 'Generate Short URL'])

	{!! Form::close() !!}

@stop