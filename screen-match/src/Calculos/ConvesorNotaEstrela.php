<?php

class ConvesorNotaEstrela {
    public function converte(Titulo $titulo): float {
        $nota = $titulo->media();

        // Realiza a conversão

        return $nota;
    }
}
