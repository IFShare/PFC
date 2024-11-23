<?php
    
    class DenunciaStatus {

        const NAOVERIFICADO = "NAOVERIFICADO";
        const VERIFICADO = "VERIFICADO";

        public static function getAllAsArray() {
            return [DenunciaStatus::NAOVERIFICADO, DenunciaStatus::VERIFICADO];
        }
}