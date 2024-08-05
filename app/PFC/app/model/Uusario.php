<?php

require_once(__DIR__ . '/enum/TipoUsuario.php');
    
    class Usuario {
        private ?int $id;
        private ?string $nomeSobrenome;
        private ?string $nomeUsuario;
        private ?string $email;
        private ?string $senha;
        private ?string $bio;
        private ?string $tipoUsuario;
        private ?string $dataCriacao;
        private ?string $fotoPerfil;
        private ?string $matricula;

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of nomeSobrenome
         */ 
        public function getNomeSobrenome()
        {
                return $this->nomeSobrenome;
        }

        /**
         * Set the value of nomeSobrenome
         *
         * @return  self
         */ 
        public function setNomeSobrenome($nomeSobrenome)
        {
                $this->nomeSobrenome = $nomeSobrenome;

                return $this;
        }

        /**
         * Get the value of nomeUsuario
         */ 
        public function getNomeUsuario()
        {
                return $this->nomeUsuario;
        }

        /**
         * Set the value of nomeUsuario
         *
         * @return  self
         */ 
        public function setNomeUsuario($nomeUsuario)
        {
                $this->nomeUsuario = $nomeUsuario;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of senha
         */ 
        public function getSenha()
        {
                return $this->senha;
        }

        /**
         * Set the value of senha
         *
         * @return  self
         */ 
        public function setSenha($senha)
        {
                $this->senha = $senha;

                return $this;
        }

        /**
         * Get the value of bio
         */ 
        public function getBio()
        {
                return $this->bio;
        }

        /**
         * Set the value of bio
         *
         * @return  self
         */ 
        public function setBio($bio)
        {
                $this->bio = $bio;

                return $this;
        }

        /**
         * Get the value of tipoUsuario
         */ 
        public function getTipoUsuario()
        {
                return $this->tipoUsuario;
        }

        /**
         * Set the value of tipoUsuario
         *
         * @return  self
         */ 
        public function setTipoUsuario($tipoUsuario)
        {
                $this->tipoUsuario = $tipoUsuario;

                return $this;
        }

        /**
         * Get the value of dataCriacao
         */ 
        public function getDataCriacao()
        {
                return $this->dataCriacao;
        }

        /**
         * Set the value of dataCriacao
         *
         * @return  self
         */ 
        public function setDataCriacao($dataCriacao)
        {
                $this->dataCriacao = $dataCriacao;

                return $this;
        }

        /**
         * Get the value of fotoPerfil
         */ 
        public function getFotoPerfil()
        {
                return $this->fotoPerfil;
        }

        /**
         * Set the value of fotoPerfil
         *
         * @return  self
         */ 
        public function setFotoPerfil($fotoPerfil)
        {
                $this->fotoPerfil = $fotoPerfil;

                return $this;
        }

        /**
         * Get the value of matricula
         */ 
        public function getMatricula()
        {
                return $this->matricula;
        }

        /**
         * Set the value of matricula
         *
         * @return  self
         */ 
        public function setMatricula($matricula)
        {
                $this->matricula = $matricula;

                return $this;
        }
}