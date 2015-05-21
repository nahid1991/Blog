@extends('something')

@section('content')
	<head>
		<title>{{ $article->title }}</title>
	</head>

	<h1>{{ $article->title }}</h1>

	<article>
		<h3>{{  $article->body }}</h3>
		<br/>
		{{  $article->published_at->diffForHumans() }}
	</article>

	<hr/>

    <h5>Tags:</h5>

    @unless($article->tags->isEmpty())
        <ul>

            @foreach($article->tags as $tag)

                <li>{{ $tag->name  }}</li>

            @endforeach

        </ul>
    @endunless

	<a href="{{  action('ArticlesController@edit', [$article->id]) }}">Edit the article.</a>

	<hr/>

@stop