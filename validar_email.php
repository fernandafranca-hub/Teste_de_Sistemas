<?php

class Validador
{
    public function validarEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function validarSenha($senha)
    {
        if (strlen($senha) < 8)
        {
            return false;
        }

        if (!preg_match("/[A-Za-z]/", $senha))
        {
            return false;
        }

        if (!preg_match("/[0-9]/", $senha))
        {
            return false;
        }

        return true;
    }
}

function testar($descricao, $esperado, $resultado)
{
    echo "<p>";

    echo "<strong>Teste:</strong> $descricao<br>";

    echo "<strong>Esperado:</strong> "
        . ($esperado ? "true" : "false")
        . "<br>";

    echo "<strong>Obtido:</strong> "
        . ($resultado ? "true" : "false")
        . "<br>";

    if ($resultado === $esperado)
    {
        echo "<strong>Status: APROVADO</strong>";
    }
    else
    {
        echo "<strong>Status: REPROVADO</strong>";
    }

    echo "</p>";

    echo "<hr>";
}

$validador = new Validador();


// TESTES DO VALIDADOR// 

echo "<h1>TESTES DO VALIDADOR</h1>";


// TESTES DE E-MAIL// 

echo "<h2>Testes de E-mail</h2>";


testar(
    "E-mail teste@gmail.com",
    true,
    $validador->validarEmail("teste@gmail.com")
);


testar(
    "E-mail fernanda@email.com",
    true,
    $validador->validarEmail("fernanda@email.com")
);


testar(
    "E-mail teste@gmail",
    false,
    $validador->validarEmail("teste@gmail")
);


testar(
    "E-mail fernanda",
    false,
    $validador->validarEmail("fernanda")
);


testar(
    "E-mail teste@",
    false,
    $validador->validarEmail("teste@")
);


//TESTES DE SENHA// 

echo "<h2>Testes de Senha</h2>";


testar(
    "Senha Abc12345",
    true,
    $validador->validarSenha("Abc12345")
);


testar(
    "Senha 12345678",
    false,
    $validador->validarSenha("12345678")
);


testar(
    "Senha abcdefgh",
    false,
    $validador->validarSenha("abcdefgh")
);


testar(
    "Senha Abc123",
    false,
    $validador->validarSenha("Abc123")
);


testar(
    "Senha Senha2026",
    true,
    $validador->validarSenha("Senha2026")
);

?>
