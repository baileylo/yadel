@extends('layout')

@section('content')
    <div class="container" style="margin-top:30px;">
        <form action="/add-recipe" method="post">
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-lg-4">
                    <h1>Add Image</h1>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="prep_time">Prep Time</label>
                                <input type="text" name="prep_time" id="prep_time" class="form-control" value="{{ old('prep_time') }}"/>
                                @if ($errors->has('prep_time'))
                                <p class="form-text text-muted">
                                    {{ $errors->get('prep_time') }}
                                </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="cook_time">Cook Time</label>
                                <input type="text" name="cook_time" id="cook_time" class="form-control" value="{{ old('cook_time') }}"/>
                                @if ($errors->has('cook_time'))
                                    <p class="form-text text-muted">
                                        {{ $errors->get('cook_time') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="servings">Servings</label>
                                <input type="text" name="servings" id="servings" class="form-control" value="{{ old('servings') }}"/>
                                @if ($errors->has('servings'))
                                    <p class="form-text text-muted">
                                        {{ $errors->get('servings') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="rating">Rating</label>
                                <select name="rating" id="rating" class="form-control">
                                    <option value="1">1 - Cut</option>
                                    <option value="2">2 - Thin Ice</option>
                                    <option value="3">3 - meh</option>
                                    <option value="4">4 - in Rotation</option>
                                    <option value="5">5 - Nightly</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="name">Title</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Suzy's Chicken Pot Pie" value="{{ old('name') }}"required>
                        @if ($errors->has('name'))
                            <p class="form-text text-muted">
                                {{ $errors->get('name') }}
                            </p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        @if ($errors->has('description'))
                            <p class="form-text text-muted">
                                {{ $errors->get('description') }}
                            </p>
                        @endif
                        <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="ingredients">Ingredients</label>
                        @if ($errors->has('ingredients'))
                            <p class="form-text text-muted">
                                {{ $errors->get('ingredients') }}
                            </p>
                        @endif
                        <textarea name="ingredients" id="ingredients" rows="6" class="form-control" placeholder="Place each on it's own line. using :: to separate the amount from the ingredient. e.g. 4 cups::flour">{{ old('ingredients') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="directions">Directions</label>
                        @if ($errors->has('directions'))
                            <p class="form-text text-muted">
                                {{ $errors->get('directions') }}
                            </p>
                        @endif
                        <textarea name="directions" id="directions" rows="6" class="form-control">{{ old('directions') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-lg-right">
                    <input type="submit" class="btn btn-success" value="Add Recipe" />
                </div>
            </div>
        </form>
    </div>
@endsection