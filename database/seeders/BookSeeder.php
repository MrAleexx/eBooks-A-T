<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'Manual del Docente Innovador aplicando IA Generativa',
            'author' => 'Ing. Alex Taya',
            'editorial' => 'Pedro Alex Taya Yactayo',
            'isbn' => 9786120313879,
            'language' => 'Español',
            'pages' => 112,
            'publication' => '2025-09-30',
            'format' => 'Edición Kindle',
            'price' => 10.00,
            'image' => 'https://isbn.bnp.gob.pe/files/titulos/160765.jpg',
            'pdf_file' => 'books/pdfs/1.pdf',
                        'description' => 'La educación es un viaje que nunca se detiene. Cada día, en cada aula, los docentes tienen en sus manos la oportunidad de sembrar curiosidad, encender la imaginación y acompañar a sus estudiantes en la construcción de sus sueños. Sin embargo, también sabemos que enseñar no siempre es fácil: requiere creatividad, tiempo, recursos y, sobre todo, mucha pasión.
Este libro nace justamente de esa necesidad de apoyar al maestro en su tarea diaria. Aquí encontrarás un banco de 1,440 prompts maestros para EBR/EBA, diseñados como pequeñas llaves que abren puertas a nuevas formas de planificar, enseñar y evaluar. Cada prompt es una invitación a mirar la clase con otros ojos, a experimentar estrategias distintas y a descubrir cómo la inteligencia artificial puede ser un aliado creativo y cercano.
Lo que tienes entre tus manos no es un manual frío, sino un compañero de camino. Está pensado para acompañarte mientras preparas una unidad, diseñas una sesión, elaboras una rúbrica o buscas ideas frescas para motivar a tus estudiantes. La IA Generativa aquí no sustituye tu voz ni tu experiencia; al contrario, las potencia y las multiplica, claro si permites que la IA ingrese en tu día a día.
Este libro une dos mundos: la sensibilidad pedagógica de quienes llevan décadas dedicados a la educación y la fuerza de la tecnología actual. En esa unión florece una propuesta innovadora, práctica y profundamente humana.
Este libro reúne prompts maestros para Educación Básica Regular (EBR) y Educación Básica Alternativa (EBA) en Perú, alineados al Currículo Nacional de la Educación Básica (RM N.° 281-2016-ED), al Programa Curricular de EBA Ciclos Inicial–Intermedio (2019) y al Programa Curricular de EBA Ciclo Avanzado (2019). Su objetivo es apoyar al docente en el diseño de unidades, sesiones, evaluaciones, estrategias, rúbricas y diversas actividades contextualizadas a las necesidades de niños, jóvenes y adultos.
Que cada página te recuerde que enseñar es transformar y que cada transformación comienza con un pequeño impulso de inspiración.',
            'is_new' => true
        ]);
    }
}
