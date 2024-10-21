<?php

require_once(__DIR__ . "/Post.php");
require_once(__DIR__ . "/Usuario.php");

class Comentario
{
        private ?int $id;
        private ?string $conteudo;
        private $dataComentario;
        private ?Post $postagem;
        private ?Usuario $usuario;

        public function __construct()
        {
                $this->postagem = new Post();
                $this->usuario = null;
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
         * Get the value of conteudo
         */
        public function getConteudo()
        {
                return $this->conteudo;
        }

        /**
         * Set the value of conteudo
         *
         * @return  self
         */
        public function setConteudo($conteudo)
        {
                $this->conteudo = $conteudo;

                return $this;
        }

        /**
         * Get the value of dataComentario
         */
        public function getDataComentario()
        {
                return $this->dataComentario;
        }

        /**
         * Set the value of dataComentario
         *
         * @return  self
         */
        public function setDataComentario($dataComentario)
        {
                $this->dataComentario = $dataComentario;

                return $this;
        }

        /**
         * Get the value of postagem
         */
        public function getPostagem()
        {
                return $this->postagem;
        }

        /**
         * Set the value of postagem
         *
         * @return  self
         */
        public function setPostagem($postagem)
        {
                $this->postagem = $postagem;

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
