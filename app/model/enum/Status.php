<?php
    
    class Status {

        const ATIVO = "ATIVO";
        const INATIVO = "INATIVO";
        const NAOVERIFICADO = "NAOVERIFICADO";
        const ATIVOVERIFICADO = "ATIVOVERIFICADO";

        public static function getAllAsArray() {
            return [Status::ATIVO, Status::INATIVO, Status::NAOVERIFICADO, Status::ATIVOVERIFICADO];
        }
}