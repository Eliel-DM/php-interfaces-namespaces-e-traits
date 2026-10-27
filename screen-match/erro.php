<?php

use ScreenMatch\Calculos\ConvesorNotaEstrela;
use ScreenMatch\Modelo\Episodio;
use ScreenMatch\Modelo\Genero;
use ScreenMatch\Modelo\Serie;

require 'autoload.php';

$serie = new Serie('Nome da serie', 2026, Genero::Acao, 7, 20, 0);
$episodio = new Episodio($serie, 'Piloto', 1);
try {
    $episodio->avalia(45);
    $episodio->avalia(-35);


    $conversor = new ConvesorNotaEstrela();
    echo $conversor->converte($episodio);
} catch (Exception $e) {
    echo "Um problema aconteceu: " . $e->getMessage();
}
