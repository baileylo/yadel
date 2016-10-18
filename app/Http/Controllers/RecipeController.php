<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    const CREATE_FORM_FIELDS = [
        'prep_time',
        'cook_time',
        'servings',
        'rating',
        'name',
        'description',
        'ingredients',
        'directions'
    ];

    public function show(Recipe $recipe)
    {
        $recipe->load('ingredients');
        return view('recipes.show', ['recipe' => $recipe]);
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function save(Request $request, Recipe\Validator $validator)
    {
        $form_values = $request->only(self::CREATE_FORM_FIELDS);

        $form_values['ingredients'] = array_map(function ($amount_and_ingredient) {
            $amount_and_ingredient = explode('::', $amount_and_ingredient);
            $ingredient = '';
            if (count($amount_and_ingredient) < 2) {
                list($amount) = $amount_and_ingredient;
                $ingredient = '';
            } else {
                list($amount, $ingredient) = $amount_and_ingredient;
            }

            return ['amount' => $amount, 'name' => $ingredient];
        }, explode("\n", $form_values['ingredients'] ?? ''));

        $errors = $validator->getErrors($form_values);
        if (!$errors->isEmpty()) {
            return back()->withErrors($errors)->withInput();
        }

        $recipe = Recipe::create($form_values);

        foreach ($form_values['ingredients'] as $ingredient) {
            $recipe->ingredients()->create($ingredient);
        }

        return $recipe;
    }
}
