<?php

use ScreenMatch\Calculos\ConvesorNotaEstrela;
use ScreenMatch\Modelo\Episodio;
use ScreenMatch\Modelo\Genero;
use ScreenMatch\Modelo\Serie;

require 'autoload.php';

$serie = new Serie('Nome da serie', 2026, Genero::Acao, 7, 20, 0);
$episodio = new Episodio($serie, 'Piloto', 1);
//$episodio->avalia(10);

$conversor = new ConvesorNotaEstrela();
echo $conversor->converte($episodio);
