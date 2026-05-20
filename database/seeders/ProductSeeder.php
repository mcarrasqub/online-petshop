<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comida = Category::where('name', 'Comida')->first();
        $accesorios = Category::where('name', 'Accesorios')->first();
        $higiene = Category::where('name', 'Higiene')->first();
        $juguetes = Category::where('name', 'Juguetes')->first();

        $products = [
            [
                'name' => 'Alimento Premium Adulto (15kg)',
                'description' => 'Nutrición completa para perros adultos. Con omega 3 y 6.',
                'price' => 145000,
                'stock' => 50,
                'specie' => 'dog',
                'image' => 'products/dog_food.png',
                'category_id' => $comida->getId(),
            ],
            [
                'name' => 'Mezcla de Semillas para Canarios',
                'description' => 'Variedad de semillas seleccionadas para plumaje brillante.',
                'price' => 12000,
                'stock' => 40,
                'specie' => 'bird',
                'image' => 'products/bird_food.jpg',
                'category_id' => $comida->getId(),
            ],
            [
                'name' => 'Hojuelas para Goldfish (100g)',
                'description' => 'Alimento que no enturbia el agua, enriquecido con vitaminas.',
                'price' => 25000,
                'stock' => 60,
                'specie' => 'fish',
                'image' => 'products/fish_food.jpg',
                'category_id' => $comida->getId(),
            ],

            [
                'name' => 'Cama Ortopédica Grande',
                'description' => 'Cama con espuma viscoelástica para máximo confort.',
                'price' => 120000,
                'stock' => 15,
                'specie' => 'dog',
                'image' => 'products/dog_bed.jpg',
                'category_id' => $accesorios->getId(),
            ],
            [
                'name' => 'Rascador Multinivel 1.5m',
                'description' => 'Árbol rascador con plataformas y juguetes colgantes.',
                'price' => 180000,
                'stock' => 10,
                'specie' => 'cat',
                'image' => 'products/cat_tree.jpg',
                'category_id' => $accesorios->getId(),
            ],

            [
                'name' => 'Arena Sanitaria Aglomerante (5kg)',
                'description' => 'Control de olores superior y fácil limpieza.',
                'price' => 35000,
                'stock' => 100,
                'specie' => 'cat',
                'image' => 'products/cat_litter.jpg',
                'category_id' => $higiene->getId(),
            ],
            [
                'name' => 'Shampoo Hidratante para Perros',
                'description' => 'Limpia profundamente y cuida la piel sensible.',
                'price' => 28000,
                'stock' => 45,
                'specie' => 'dog',
                'image' => 'products/dog_shampoo.jpg',
                'category_id' => $higiene->getId(),
            ],

            [
                'name' => 'Rueda de Ejercicio Silenciosa',
                'description' => 'Rueda segura para hámsters y erizos.',
                'price' => 45000,
                'stock' => 20,
                'specie' => 'all',
                'image' => 'products/hamster_wheel.jpg',
                'category_id' => $juguetes->getId(),
            ],
            [
                'name' => 'Pelota de Goma Ultra Resistente',
                'description' => 'Juguete para morder ideal para perros medianos y grandes.',
                'price' => 22000,
                'stock' => 70,
                'specie' => 'dog',
                'image' => 'products/dog_ball.jpg',
                'category_id' => $juguetes->getId(),
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
