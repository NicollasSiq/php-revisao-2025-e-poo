<?php

// Classe abstrata Veiculo
abstract class Veiculo {
    protected string $modelo;
    protected string $placa;
    protected bool $disponivel;

    public function __construct(string $modelo, string $placa) {
        $this->modelo = $modelo;
        $this->placa = $placa;
        $this->disponivel = true;
    }

    abstract public function calcularAluguel(int $dias): float;

    public function isDisponivel(): string {
        if ($this->disponivel) {
            $this->disponivel = false;
            return "Item '{$this->modelo}' alugado com sucesso!";
        }
        return "Item '{$this->modelo}' não está disponível";
    }

    public function getModelo(): string {
        if ($this->disponivel) {
            $this->disponivel = false;
            return "Item '{$this->modelo}' devolvido com sucesso!";
            
        }
        return "Item '{$this->modelo}' já está na locadora";
    }

    public function alugar(): string {
        if ($this->disponivel) {
            $this->disponivel = false;
            return true;
        }
        return false;
    }

    public function devolver(): string {
        if (!$this->disponivel) {
            $this->disponivel = true;
            return true;
        }
        return false;
    }
}

// Classe concreta Carro
class Carro extends Veiculo {
    public function calcularAluguel(int $dias): float {
        return $dias * 100.0;
    }
}

// Classe concreta Moto
class Moto extends Veiculo {
    public function calcularAluguel(int $dias): float {
        return $dias * 50.0;
    }
}

// Classe Locadora
class Locadora {
    private array $veiculos = [];

    public function adicionarVeiculo(Veiculo $veiculo): void {
        $this->veiculos[] = $veiculo;
        echo "Veículo '{$veiculo->getModelo()}' adicionado ao acervo.\n";
    }

    public function alugarVeiculo(string $modelo): void {
        foreach ($this->veiculos as $veiculo) {
            if ($veiculo->getModelo() === $modelo && $veiculo->isDisponivel()) {
                if ($veiculo->alugar()) {
                    echo ucfirst(get_class($veiculo)) . " '{$modelo}' alugado com sucesso!\n";
                    return;
                }
            }
        }
        echo "Veículo '{$modelo}' não está disponível para aluguel.\n";
    }

    public function devolverVeiculo(string $modelo): void {
        foreach ($this->veiculos as $veiculo) {
            if ($veiculo->getModelo() === $modelo && !$veiculo->isDisponivel()) {
                if ($veiculo->devolver()) {
                    echo ucfirst(get_class($veiculo)) . " '{$modelo}' devolvido com sucesso!\n";
                    return;
                }
            }
        }
        echo "Veículo '{$modelo}' não está alugado.\n";
    }
}

// Testes e Simulação
$locadora = new Locadora();

$carro = new Carro("HB20", "ABC-1234");
$moto = new Moto("Yamaha XTZ", "XYZ-5678");

$locadora->adicionarVeiculo($carro);
$locadora->adicionarVeiculo($moto);

$locadora->alugarVeiculo("HB20");
$locadora->alugarVeiculo("Yamaha XTZ");

$locadora->devolverVeiculo("HB20");

echo "Valor do aluguel do carro por 3 dias: R$" . number_format($carro->calcularAluguel(3), 2) . "\n";
echo "Valor do aluguel da moto por 3 dias: R$" . number_format($moto->calcularAluguel(3), 2) . "\n";

?>