<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CabinetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cabinets')->truncate();
        DB::table('cabinets')->insert([
            [
                'title' => 'Кабинет "Креатив"',
                'description' => 'Просторное помещение с уютной обстановкой и мягкими креслами, предназначенное для творческих мастер-классов. Оборудовано высококачественными ноутбуками и интерактивной доской для максимального комфорта и продуктивности участников.',
                'img' => 'cabinet1.jpg',
                'cost' => '2000',

            ],
            [
                'title' => 'Аудитория "Технологии"',
                'description' => 'Современное пространство, оборудованное передовой технической оснасткой. Ноутбуки с высокой производительностью и мощными программными инструментами готовы к использованию. Помещение оформлено в техно-стиле, что создает подходящую атмосферу для технологических мастер-классов.',
                'img' => 'cabinet2.jpg',
                'cost' => '2500',
            ],
            [
                'title' => 'Студия "Инновации"',
                'description' => 'Светлая и просторная студия с удобными рабочими местами, идеальная для инновационных проектов и исследований. Ноутбуки с доступом к современным инструментам и программам обеспечивают эффективную работу участников.',
                'img' => 'cabinet3.jpg',
                'cost' => '1500',
            ],
        ]);
    }
}
