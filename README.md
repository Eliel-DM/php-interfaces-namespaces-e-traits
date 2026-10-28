# php-interfaces-namespaces-e-traits

Projeto de estudos em **PHP** com foco nos recursos avançados de orientação a objetos:

- Classes e métodos **abstratos**
- **Contratos** com interfaces
- Reutilização de código via **Traits**
- Organização de código com **namespaces** e **autoload**
- **Tratamento de exceções**

O projeto gira em torno de uma aplicação fictícia chamada **ScreenMatch**, que representa filmes e séries, permite avaliá-los com notas e calcular a duração de uma maratona.

---

## Tecnologias

- PHP 8.3+ (usa `enum`, `readonly`, promoted constructor properties, `#[\Override]`, `match` e `try/catch` sem variável)
- Sem dependências externas — o autoload é implementado manualmente com `spl_autoload_register`

---

## Estrutura do projeto

```
.
├── conta.php                  # Exercício: simulador de conta bancária via terminal (STDIN)
├── entrada.php                # Exercício: leitura de número pelo terminal
├── primeiro-programa.php      # Exercício: Hello World
├── string-numerica.php        # Exercício: coerção de strings numéricas
└── screen-match/
    ├── autoload.php           # Autoload PSR-4 simplificado (mapeia ScreenMatch\ -> src/)
    ├── index.php              # Script principal de demonstração
    ├── erro.php               # Demonstração de tratamento de exceções
    ├── importar.php           # Leitura de um filme a partir de arquivo JSON
    ├── antigo.php             # Versão anterior do código (procedural/funções)
    ├── .gitignore             # Ignora o filme.json gerado em runtime
    ├── public/
    │   ├── index.html         # Formulário HTML de cadastro de filme
    │   ├── exporta-arquivo.php# Recebe o POST e gera filme.json
    │   └── sucesso.php        # Página de confirmação
    └── src/
        ├── funcoes.php        # Funções auxiliares (versão antiga)
        ├── Calculos/
        │   ├── CalculadoraDeMaratona.php
        │   └── ConvesorNotaEstrela.php
        ├── Exception/
        │   └── NotaInvalidException.php
        └── Modelo/
            ├── Avaliavel.php      # Interface
            ├── ComAvalicao.php    # Trait com a lógica de avaliação
            ├── Genero.php         # Enum de gêneros
            ├── Titulo.php         # Classe abstrata base
            ├── Filme.php          # extends Titulo
            ├── Serie.php          # extends Titulo
            └── Episodio.php       # implements Avaliavel
```

---

## Conceitos aplicados

### Namespaces e autoload

Todo o código de domínio vive sob o namespace raiz `ScreenMatch`, com sub-namespaces `Modelo`, `Calculos` e `Exception`. O arquivo `screen-match/autoload.php` registra uma função de autoload que traduz o nome da classe (`ScreenMatch\Modelo\Filme`) para o caminho do arquivo (`src/Modelo/Filme.php`), evitando `require` manual espalhado pelo código.

```php
spl_autoload_register(function (string $className) {
    $caminho = str_replace('ScreenMatch', 'src', $className) . '.php';
    $caminho = str_replace('\\', DIRECTORY_SEPARATOR, $caminho);
    // ...
});
```

### Interface

`Avaliavel` define o contrato que todo título avaliável deve cumprir:

```php
interface Avaliavel {
    public function avalia(float $nota): void;
    public function media(): float;
}
```

### Trait

`ComAvalicao` encapsula o armazenamento das notas e o cálculo da média, permitindo que `Titulo` e `Episodio` reutilizem a mesma implementação sem herança. A trait também dispara a exceção `NotaInvalidException` caso a nota esteja fora do intervalo de 0 a 10.

### Classe abstrata

`Titulo` é a base para `Filme` e `Serie`, guardando os dados comuns (`nome`, `anoLancamento`, `genero`) via propriedades `readonly` no construtor promovido, e obrigando as subclasses a implementar `duracaoEmMinutos()`.

### Enum

`Genero` modela os gêneros disponíveis de forma tipada (`Acao`, `Comedia`, `Terror`, `SuperHeroi`, `Drama`).

### Exceções

`NotaInvalidException` estende `InvalidArgumentException` e é lançada pela trait de avaliação. O script `erro.php` demonstra o tratamento com `try/catch`, e o `ConvesorNotaEstrela` converte a média em estrelas de 0 a 5 tratando qualquer `Throwable` para não quebrar a aplicação.

---

## Como executar

Pré-requisito: PHP 8.3 ou superior instalado.

```bash
# Script principal (demonstra filmes, séries, avaliações e maratona)
php screen-match/index.php

# Demonstração de exceções
php screen-match/erro.php

# Exercícios
php primeiro-programa.php
php conta.php
```

Para a interface web (formulário de cadastro que gera o `filme.json`), suba o servidor embutido do PHP:

```bash
php -S localhost:8000 -t screen-match/public
```

E acesse `http://localhost:8000/index.html`.

> Observação: os scripts `importar.php` e o fluxo web dependem do arquivo `screen-match/filme.json`, que é gerado em tempo de execução e por isso está no `.gitignore`.

---

## Certificado e conclusão do curso

Curso concluído na **Alura**: *PHP: interfaces, namespaces e traits* (avançando em PHP com classes/métodos abstratos, interfaces, traits, namespaces/autoload e exceções).

**Certificado:** https://cursos.alura.com.br/certificate/ef61f913-40fa-4ef3-b6ea-7822db95b565

---

## Aviso

Este `README.md` foi gerado por um modelo de **Inteligência Artificial** — **DeepSeek V4.1 Flash** (`deepseek/deepseek-v4.1-flash`) — a partir da leitura do código-fonte existente no repositório. Nenhum arquivo de código foi alterado durante a geração deste documento.
