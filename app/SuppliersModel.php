<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuppliersModel extends Model
{
    protected $table = 'suppliers';
    protected $primaryKey  = 'idsupplier';
    public $timestamps = false;
    
    //Cambiar el nombre de la tabla por defecto a la cual apunta el modelo de laravel por medio de eloquent.
    // protected $table = “autores”;

    // Si el nombre de la clave primaria es diferente de id puedes cambiarlo con el atributo:

    // protected $primary_key = 'autor_id';

    // Si la clave primaria no es auto-incremental lo cambiaríamos agregando:

    // public $incrementing = false;

    // Para indicar que la tabla del modelo no usará los campos created_at y updated_at

    // public $timestamps = false;

    // Pero si lo que quieres es personalizar los nombre de los campos añade las siguientes constantes asignándole el nuevo nombre que tienen en la tabla de la base de datos:

    // const CREATED_AT = 'fecha_creado';
    // const UPDATED_AT = 'fecha_actualizado';

    // Si un modelo usa una conexión de base de datos diferente puedes especificarla con:

    // protected $connection = 'nombre-conexion';

    // public function products()
    // {
    //         return $this->hasMany(ProductsModel::class, 'idproduct');
    // }
}
