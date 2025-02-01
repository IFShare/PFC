<?php

require_once(__DIR__ . '/Usuario.php');
require_once(__DIR__ . '/Post.php');
require_once(__DIR__ . '/enum/DenunciaStatus.php');
    
    class Denuncia {
        private ?int $id;
        private ?string $motivo;
        private ?string $status;
        private ?string $solucao;
        private ?Usuario $usuario;
        private ?Post $post;

        public function __construct() {
                $this->usuario = null;
                $this->post = null;
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
         * Get the value of motivo
         */ 
        public function getMotivo()
        {
                return $this->motivo;
        }

        /**
         * Set the value of motivo
         *
         * @return  self
         */ 
        public function setMotivo($motivo)
        {
                $this->motivo = $motivo;

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

        /**
         * Get the value of post
         */ 
        public function getPost()
        {
                return $this->post;
        }

        /**
         * Set the value of post
         *
         * @return  self
         */ 
        public function setPost($post)
        {
                $this->post = $post;

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
         * Get the value of solucao
         */ 
        public function getSolucao()
        {
                return $this->solucao;
        }

        /**
         * Set the value of solucao
         *
         * @return  self
         */ 
        public function setSolucao($solucao)
        {
                $this->solucao = $solucao;

                return $this;
        }
    }