@extends('something')

@section('content')
	<head>
		<title>Articles</title>
	</head>

	<h1>Articles</h1>

	<hr/>

	@foreach($articles as $article)
		<article>
			<h1><a href="{{  action('ArticlesController@show', [$article->id]) }}">{{  $article->title }}</a></h1>

			<div class ="body">{{  $article->body }}</div>

			<div class ="body">{{  $article->published_at->diffForHumans() }}</div>
		</article>
	@endforeach



@stop