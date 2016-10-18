@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <header class="col-lg-12">
                <h1>{{ $recipe->name }}</h1>
                <dl class="recipe-metadata">
                    <dt>Rating:</dt>
                    <dd>{{ $recipe->rating }}/5</dd>

                    <dt>Cook Time:</dt>
                    <dd>{{ $recipe->cook_time }} minutes</dd>

                    <dt>Prep Time:</dt>
                    <dd>{{ $recipe->prep_time }} minutes</dd>
                </dl>
            </header>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <dl class="row ingredient-list">
                    @foreach($recipe->ingredients as $ingredient)
                        <dt class="col-lg-3 text-lg-right">{{ $ingredient->amount }}</dt>
                        <dd class="col-lg-9">{{ $ingredient->name }}</dd>
                    @endforeach
                </dl>
            </div>
            <div class="col-lg-8">
                {!! nl2br($recipe->directions) !!}
            </div>
        </div>
    </div>

@endsection