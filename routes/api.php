<?php

use App\Recipe;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Http\Request;

/** @var \Illuminate\Routing\Router $router */
$router->get('/recipes', function (Request $request) {
    $recipes = Recipe::all();
    $recipes->load('ingredients');

    return $recipes;
});

$router->get('/recipes/{recipe}', function (Recipe $recipe) {
    return $recipe->load('ingredients');
});

$router->post('/recipes', function (Request $request, Factory $validator_factory) {
    $input = $request->only(['name', 'cook_time', 'prep_time', 'difficulty', 'rating', 'directions', 'ingredients', 'description']);

    $validator = $validator_factory->make($input, [
        'name'                   => 'required|string|between:2,255',
        'directions'             => 'required|string',
        'cook_time'              => 'integer|min:0',
        'prep_time'              => 'integer|min:0',
        'description'            => 'required|string',
        'difficulty'             => 'integer|between:0,5',
        'rating'                 => 'integer|between:0,5',
        'ingredients.*.amount'   => 'required_with_all:ingredients.*.value,ingredients.*.position|string|between:2,255',
        'ingredients.*.value'    => 'required_with_all:ingredients.*.amount,ingredients.*.position|string|between:2,255',
        'ingredients.*.position' => 'string|in:pre,post'
    ]);

    if ($validator->fails()) {
        return new \App\Http\Responses\ErrorResponse($validator->getMessageBag()->all());
    }

    $recipe = Recipe::create($input);

    foreach ($input['ingredients'] ?? [] as $ingredient) {
        $recipe->ingredients()->create($ingredient);
    }

    return $recipe;
});
