<?php

require_once(__DIR__ . '/enum/TipoUsuario.php');

class Usuario
{
        private ?int $id;
        private ?string $nomeSobrenome;
        private ?string $nomeUsuario;
        private ?string $email;
        private ?string $senha;
        private ?string $bio;
        private ?string $tipoUsuario;
        private ?string $dataCriacao;
        private ?string $fotoPerfil;
        private ?string $compMatricula;
        private ?string $status;
        private ?string $isEstudante;


        public function __construct() {
                $this->id = null;
                $this->email = null;
                $this->dataCriacao = null;
                $this->nomeUsuario = null;
                $this->compMatricula = null;
                $this->fotoPerfil = null;
                $this->status = null;
                $this->isEstudante = null;
                $this->tipoUsuario = null;
            }
        
        /**
         * Get the value of id
         */
        public function getId(): ?int
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */
        public function setId(?int $id): self
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of nomeSobrenome
         */
        public function getNomeSobrenome(): ?string
        {
                return $this->nomeSobrenome;
        }

        /**
         * Set the value of nomeSobrenome
         *
         * @return  self
         */
        public function setNomeSobrenome(?string $nomeSobrenome): self
        {
                $this->nomeSobrenome = $nomeSobrenome;

                return $this;
        }

        /**
         * Get the value of nomeUsuario
         */
        public function getNomeUsuario(): ?string
        {
                return $this->nomeUsuario;
        }

        /**
         * Set the value of nomeUsuario
         *
         * @return  self
         */
        public function setNomeUsuario(?string $nomeUsuario): self
        {
                $this->nomeUsuario = $nomeUsuario;

                return $this;
        }

        /**
         * Get the value of email
         */
        public function getEmail(): ?string
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */
        public function setEmail(?string $email): self
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of senha
         */
        public function getSenha(): ?string
        {
                return $this->senha;
        }

        /**
         * Set the value of senha
         *
         * @return  self
         */
        public function setSenha(?string $senha): self
        {
                $this->senha = $senha;

                return $this;
        }

        /**
         * Get the value of bio
         */
        public function getBio(): ?string
        {
                return $this->bio;
        }

        public function getBioHTML(): ?string
        {
                return nl2br($this->bio);
        }

        /**
         * Set the value of bio
         *
         * @return  self
         */
        public function setBio(?string $bio): self
        {
                $this->bio = $bio;

                return $this;
        }

        /**
         * Get the value of tipoUsuario
         */
        public function getTipoUsuario(): ?string
        {
                return $this->tipoUsuario;
        }

        /**
         * Set the value of tipoUsuario
         *
         * @return  self
         */
        public function setTipoUsuario(?string $tipoUsuario): self
        {
                $this->tipoUsuario = $tipoUsuario;

                return $this;
        }

        /**
         * Get the value of dataCriacao
         */
        public function getDataCriacao(): ?string
        {
                return $this->dataCriacao;
        }

        /**
         * Set the value of dataCriacao
         *
         * @return  self
         */
        public function setDataCriacao(?string $dataCriacao): self
        {
                $this->dataCriacao = $dataCriacao;

                return $this;
        }

        /**
         * Get the value of fotoPerfil
         */
        public function getFotoPerfil(): ?string
        {
                return $this->fotoPerfil;
        }

        /**
         * Set the value of fotoPerfil
         *
         * @return  self
         */
        public function setFotoPerfil(?string $fotoPerfil): self
        {
                $this->fotoPerfil = $fotoPerfil;

                return $this;
        }

        /**
         * Get the value of matricula
         */
        public function getCompMatricula(): ?string
        {
                return $this->compMatricula;
        }

        /**
         * Set the value of matricula
         *
         * @return  self
         */
        public function setCompMatricula(?string $compMatricula): self
        {
                $this->compMatricula = $compMatricula;

                return $this;
        }

        /**
         * Get the value of status
         */ 
        public function getStatus()
        {
                return $this->status;
        }

        /**
         * Set the value of status
         *
         * @return  self
         */ 
        public function setStatus($status)
        {
                $this->status = $status;

                return $this;
        }

        /**
         * Get the value of isEstudante
         */ 
        public function getIsEstudante()
        {
                return $this->isEstudante;
        }

        /**
         * Set the value of isEstudante
         *
         * @return  self
         */ 
        public function setIsEstudante($isEstudante)
        {
                $this->isEstudante = $isEstudante;

                return $this;
        }
}
