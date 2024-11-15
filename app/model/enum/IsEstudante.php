<?php
    
    class IsEstudante {

        public static string $SEPARADOR = "|";

        const SIM = "SIM";
        const NAO = "NAO";

        public static function getAllAsArray() {
            return [IsEstudante::SIM, IsEstudante::NAO];
        }
}