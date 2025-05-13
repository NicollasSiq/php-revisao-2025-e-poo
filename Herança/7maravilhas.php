
<?php

echo '<link rel="stylesheet" type="text/css" href="7mara.css">'; // Link para o arquivo CSS
echo '<h1>7 Maravilhas do Mundo</h1>'; // Título da página
echo '<h2>Lista de Maravilhas</h2>'; // Subtítulo da página
// Classe base MaravilhasDoMundo
class MaravilhasDoMundo {

    // Construtor inicializa o nome
    protected string $nome;

    // Método que retorna o nome do país
    public function __construct(string $nome) {
        $this->nome = $nome;
    }

    
    public function getNome(): string {
        return $this->nome;
    }

    public function getMaravilha(): string {
        return "Maravilha localizada neste país.";
    }
}

// Subclasses de MaravilhasDoMundo
class Brasil extends MaravilhasDoMundo {
    public function getMaravilha(): string {
        return "Cristo Redentor";
    }
}

class China extends MaravilhasDoMundo {
    public function getMaravilha(): string {
        return "Muralha da China";
    }
}

class India extends MaravilhasDoMundo {
    public function getMaravilha(): string {
        return "Taj Mahal";
    }
}

class Italia extends MaravilhasDoMundo {
    public function getMaravilha(): string {
        return "Coliseu";
    }
}

class Mexico extends MaravilhasDoMundo {
    public function getMaravilha(): string {
        return "Chichen Itzá";
    }
}

class Peru extends MaravilhasDoMundo {
    public function getMaravilha(): string {
        return "Machu Picchu";
    }
}

class Jordania extends MaravilhasDoMundo {
    public function getMaravilha(): string {
        return "Petra";
    }
}

class Egito extends MaravilhasDoMundo {
    public function getMaravilha(): string {
        return "Pirâmides de Gizé";
    }
}

// Criando os objetos
$maravilhas = [
    new Brasil("Brasil"),
    new China("China"),
    new India("Índia"),
    new Italia("Itália"),
    new Mexico("México"),
    new Peru("Peru"),
    new Jordania("Jordânia"),
    new Egito("Egito")
];

// Exibindo os dados

// Percorre cada objeto da lista $maravilhas
foreach ($maravilhas as $pais) {
    // Exibe o nome do país seguido da sua respectiva maravilha, separados por dois pontos
    echo $pais->getNome() . ": " . $pais->getMaravilha() . "<br>";

    // Adiciona uma quebra de linha extra para melhor espaçamento entre as saídas
    echo "<br>";
}

?>
