@extends('something')

@section('content')
	<h1>Write a new article</h1>


	<hr/>

    {!! Form::open(array('route' => 'articles.store')) !!}
        @include('articles.form', ['submitButtonText'=>'Add Article']);

    {!! Form::close() !!}

	@include('errors.list');

@stop