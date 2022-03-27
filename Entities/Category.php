<?php

namespace Modules\FinanceCategoryMod\Entities;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'billing_type_id',
        'active',
    ];

    public static function getInstance() : Category
    {
        return new Category([
            'title' => '',
            'billing_type_id' => 1,
            'active' => true,
        ]);
    }

    public function rules() : array
    {
        return [
            'title' => [
                'required',
                Rule::unique('categories')->ignore($this->id)
            ],
            'billing_type_id' => 'required',
            'active' => 'required'
        ];
    }

    public function messages() : array
    {
        return [
            'title.required' => 'O campo :attribute precisa ser preenchido.',
            'title.unique' => 'Já existe uma Categoria com este nome.',
            'billing_type_id.required' => 'O campo :attribute precisa ser preenchido.',
            'active.required' => 'O campo :attribute precisa ser preenchido.',
        ];
    }

    public function namedFields(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Nome',
            'billing_type_id' => 'Tipo de Cobrança',
            'active' => 'Ativo?',
        ];
    }

    public function computedValues() : array
    {
        return [
            'active' => function ( $value )
            {
                return $value ? "SIM" : "NÃO";
            },
            'billing_type_id' => function ( $value )
            {
                switch ( $value ) {
                    case "1": return "[$value] Receita";
                    case "2": return "[$value] Despesa";
                    default: return $value;
                }
            }
        ];
    }

    protected static function newFactory()
    {
        return \Modules\FinanceCategoryMod\Database\factories\CategoryFactory::new();
    }
}
