<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Infra\EntityManagerCreator;

class RealizarLogin implements InterfaceControladorRequisicao
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repositorioDeUsuarios;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())
            ->getEntityManager();
        $this->repositorioDeUsuarios = $entityManager
            ->getRepository(Usuario::class);
    }

    public function processaRequisicao(): void
    {
        $email = filter_input(
            INPUT_POST,
            'email',
            FILTER_VALIDATE_EMAIL
        );

        if (is_null($email) || $email === false) {
            echo "E-mail digitado é inválido!";
            return;
        }

        $senha = filter_input(
            INPUT_POST,
            'senha',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );

        $usuario = $this->repositorioDeUsuarios
            ->findOneBy(['email' => $email]);

        if (is_null($usuario) || !$usuario->senhaEstaCorreta($senha)) {
            echo "E-mail ou senha inválidos.";
            // var_dump($usuario);
            // var_dump($senha);
            return;
        }

        $_SESSION['logado'] = true;

        header('Location: /listar-cursos');
    }
}