<div class="form-group">
	{!! Form::label('title', 'Desktop URL:') !!}
	{!! Form::text('desktop_url', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('title', 'Mobile URL:') !!}
	{!! Form::text('mobile_url', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>