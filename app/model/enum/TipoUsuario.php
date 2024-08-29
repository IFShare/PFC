<?php
    
    class TipoUsuario {

        public static string $SEPARADOR = "|";

        const USUARIO = "USUARIO";
        const ADM = "ADM";
        const ESTUDANTE = "ESTUDANTE";

        public static function getAllAsArray() {
            return [TipoUsuario::USUARIO, TipoUsuario::ADM, TipoUsuario::ESTUDANTE];
        }
}