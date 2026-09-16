<?php

class Calculadora
{
    public function somar($A, $B)
    {
        return $A + $B;
    }

    public function subtrair($A, $B)
    {
        return $A - $B;
    }

    public function multiplicar($A, $B)
    {
        return $A * $B;
    }

    public function dividir($A, $B)
    {
        if ($B == 0)
        {
            throw new Exception("Não é possível dividir por zero.");
        }

        return $A / $B;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>
    <form method="post" action="Calculadora.php">
        <label>Valor 1</label>
        <input type="number" name="num1" require />
        <br />
        <label>Valor 2</label>
        <input type="number" name="num2" require />
        <br />
        <input type="submit" name = "somar" value = "Somar" />
        <input type="submit" name = "subtrair" value = "Subtrair" />
        <input type="submit" name = "dividir" value = "Dividir" />
        <input type="submit" name = "multiplicar" value = "Multiplicar" />
        </form>
</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $minhaCalculadora = new Calculadora();

    if (isset($_POST["somar"]))
    {
        echo "O resultado é: " .
             $minhaCalculadora->somar($_POST["num1"], $_POST["num2"]);
    }

    if (isset($_POST["subtrair"]))
    {
        echo "O resultado é: " .
             $minhaCalculadora->subtrair($_POST["num1"], $_POST["num2"]);
    }

    if (isset($_POST["dividir"]))
    {
        try
        {
            echo "O resultado é: " .
                 $minhaCalculadora->dividir($_POST["num1"], $_POST["num2"]);
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }

    if (isset($_POST["multiplicar"]))
    {
        echo "O resultado é: " .
             $minhaCalculadora->multiplicar($_POST["num1"], $_POST["num2"]);
    }
}


echo "<hr>";
echo "<h1>TESTES</h1>";

$calculadora = new Calculadora();

function testar($nome, $esperado, $obtido)
{
    echo "<h3>Teste: " . $nome . "</h3>";

    echo "Esperado: " . $esperado . "<br>";

    echo "Obtido: " . $obtido . "<br>";

    if ($esperado == $obtido)
    {
        echo "<strong>Status: APROVADO</strong>";
    }
    else
    {
        echo "<strong>Status: REPROVADO</strong>";
    }

    echo "<hr>";
}


//TESTE DE ADIÇÃO//

testar(
    "Soma 2 + 3",
    5,
    $calculadora->somar(2, 3)
);

testar(
    "Soma 10 + 20",
    30,
    $calculadora->somar(10, 20)
);

testar(
    "Soma -5 + 5",
    0,
    $calculadora->somar(-5, 5)
);


//TESTES DE SUBTRAÇÃO// 

testar(
    "Subtração 10 - 5",
    5,
    $calculadora->subtrair(10, 5)
);

testar(
    "Subtração 20 - 30",
    -10,
    $calculadora->subtrair(20, 30)
);

testar(
    "Subtração 0 - 0",
    0,
    $calculadora->subtrair(0, 0)
);


//TESTES DE MULTIPLICAÇÃO// 

testar(
    "Multiplicação 4 x 5",
    20,
    $calculadora->multiplicar(4, 5)
);

testar(
    "Multiplicação 0 x 10",
    0,
    $calculadora->multiplicar(0, 10)
);

testar(
    "Multiplicação -2 x 3",
    -6,
    $calculadora->multiplicar(-2, 3)
);


//TESTES DE DIVISÃO// 

testar(
    "Divisão 20 / 4",
    5,
    $calculadora->dividir(20, 4)
);

testar(
    "Divisão 15 / 3",
    5,
    $calculadora->dividir(15, 3)
);

testar(
    "Divisão 10 / 2",
    5,
    $calculadora->dividir(10, 2)
);


//TESTE DE DIVISÃO POR ZERO//

echo "<h3>Teste: Divisão 10 / 0</h3>";

try
{
    $calculadora->dividir(10, 0);

    echo "Esperado: Erro ao dividir por zero<br>";
    echo "Obtido: Nenhum erro ocorreu<br>";
    echo "<strong>Status: REPROVADO</strong>";
}
catch (Exception $e)
{
    echo "Esperado: Erro ao dividir por zero<br>";
    echo "Obtido: " . $e->getMessage() . "<br>";
    echo "<strong>Status: APROVADO</strong>";
}

?>



