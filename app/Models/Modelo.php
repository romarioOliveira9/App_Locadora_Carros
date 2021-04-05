<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $fillable = ['marca_id','nome', 'imagem', 'numero_portas', 'lugares', 'air_bag', 'abs'];

    public function rules()
    {
        /**
         * 1) Tabela
         * 2) Nome da coluna que será pesquisada na tabela
         * 3) ID do registro que sera desconsiderado na pesquisa
         */
        return [
            'marca_id' => 'exists:marcas,id',
            'nome' => 'required|unique:modelos,nome,'.$this->id.'|min:3',
            'imagem' => 'required|file|mimes:png,jpeg,jpg',
            'numero_portas' => 'required|integer|digits_between:1,5', //(1,2,3,4,5)
            'lugares' => 'required|integer|digits_between:1,20',
            'air_bag' => 'required|boolean',
            'abs' => 'required|boolean', //true, false, 1, 0, "1", "0"
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatorio',
            'nome.unique' => 'O nome da marca já existe',
            'nome.min' => 'O nome deve ter no minimo 3 letras',
            'imagem.mimes' => 'O arquivo deve ser uma imagem do tipo .png'
        ];
    }

    public function marca()
    {
        //UM modelo PERTENCE a UMA marca
        return $this->belongsTo('App\Models\Marca');
    }
}
