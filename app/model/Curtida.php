<?php

require_once(__DIR__ . '/Usuario.php');
require_once(__DIR__ . '/Post.php');
    
    class Curtida{
        private ?int $id;
        private ?Usuario $usuario;
        private ?Post $post;

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
    }