<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Articulo;

class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articulos = [
            [
                'codigo' => 1,
                'nombre' => 'Aceite',
                'imagen' => 'path/to/image1.jpg',
                'precio_unitario' => 100.00,
                'categoria_id' => 1, // Assuming you have categories
                'marca_id' => 100, // Corresponding to Valvoline
                'modelo_id' => 1, // Assuming you have models
                'stock' => 50,
                'descripcion' => 'Descripción del Articulo 1',
            ],
            [
                'codigo' => 2,
                'nombre' => 'Articulo 2',
                'imagen' => 'path/to/image2.jpg',
                'precio_unitario' => 200.00,
                'categoria_id' => 2,
                'marca_id' => 101, // Corresponding to Brembo
                'modelo_id' => 2,
                'stock' => 30,
                'descripcion' => 'Descripción del Articulo 2',
            ],
            [
                'codigo' => 3,
                'nombre' => 'Articulo 3',
                'imagen' => 'path/to/image3.jpg',
                'precio_unitario' => 150.00,
                'categoria_id' => 3,
                'marca_id' => 102, // Corresponding to Ohlins
                'modelo_id' => 3,
                'stock' => 70,
                'descripcion' => 'Descripción del Articulo 3',
            ],
            // Add more articles as needed
        ];

        Articulo::insert($articulos);
    }
}
