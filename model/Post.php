<?php

require_once(__DIR__ . '/Usuario.php');

class Post
{
        private ?int $id;
        private ?string $imagem;
        private ?string $legenda;
        private $dataPostagem;
        private ?Usuario $usuario;

        public function __construct() {
                $this->id = null;
            }
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
         * Get the value of imagem
         */
        public function getImagem()
        {
                return $this->imagem;
        }

        /**
         * Set the value of imagem
         *
         * @return  self
         */
        public function setImagem($imagem)
        {
                $this->imagem = $imagem;

                return $this;
        }

        /**
         * Get the value of legenda
         */
        public function getLegenda()
        {
                return $this->legenda;
        }

        /**
         * Set the value of legenda
         *
         * @return  self
         */
        public function setLegenda($legenda)
        {
                $this->legenda = $legenda;

                return $this;
        }

        /**
         * Get the value of dataPostagem
         */
        public function getDataPostagem()
        {
                return $this->dataPostagem;
        }

        /**
         * Set the value of dataPostagem
         *
         * @return  self
         */
        public function setDataPostagem($dataPostagem)
        {
                $this->dataPostagem = $dataPostagem;

                return $this;
        }

        /**
         * Get the value of usuario
         */
        public function getUsuario()
        {
                return $this->usuario;
        }

        /**
         * Set the value of usuario
         *
         * @return  self
         */
        public function setUsuario($usuario)
        {
                $this->usuario = $usuario;

                return $this;
        }
}
