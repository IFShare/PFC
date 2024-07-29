<?php
    
    class TipoUsuario {

        public static string $SEPARADOR = "|";

        const USUARIO = "USUARIO";
        const ADMINISTRADOR = "ADMINISTRADOR";

        public static function getAllAsArray() {
            return [TipoUsuario::USUARIO, TipoUsuario::ADMINISTRADOR];
        }
}