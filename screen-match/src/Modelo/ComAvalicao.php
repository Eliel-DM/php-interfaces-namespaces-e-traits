<?php

namespace ScreenMatch\Modelo;

use ScreenMatch\Exception\NotaInvalidException;


trait ComAvalicao {

    private array $notas;


    /* 
    * @throws  \NotaInvalidException Se a nota for negativa ou maior do que 10
    */
    public function avalia(float $nota): void {
        if ($nota < 0 || $nota > 10) {
            throw new NotaInvalidException();
        }
        $this->notas[] = $nota;
    }

    public function media(): float {
        $somaNotas = array_sum($this->notas);
        $quantidadeNotas = count($this->notas);

        return $somaNotas / $quantidadeNotas;
    }
}
