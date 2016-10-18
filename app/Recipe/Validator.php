<?php
declare(strict_types=1);

namespace App\Recipe;

use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Contracts\Validation;

class Validator
{
    const RULES = [
        'name'                   => 'required|string|between:2,255',
        'directions'             => 'required|string',
        'cook_time'              => 'integer|min:0',
        'prep_time'              => 'integer|min:0',
        'difficulty'             => 'integer|between:0,5',
        'rating'                 => 'integer|between:0,5',
        'ingredients.*.amount'   => 'required_with_all:ingredients.*.value,ingredients.*.position|string|between:2,255',
        'ingredients.*.value'    => 'required_with_all:ingredients.*.amount,ingredients.*.position|string|between:2,255',
        'ingredients.*.position' => 'string|in:pre,post'
    ];

    /** @var Validation\Factory */
    private $validation_factory;

    public function __construct(Validation\Factory $validation_factory)
    {
        $this->validation_factory = $validation_factory;
    }

    /**
     * Get the errors in the supplied data.
     *
     * @param array $data
     *
     * @return MessageBag
     */
    public function getErrors(array $data): MessageBag
    {
        return $this->validation_factory->make($data, self::RULES)->getMessageBag();
    }
}
