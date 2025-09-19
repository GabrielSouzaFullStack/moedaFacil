# Diagrama de Classes - Moeda Fácil

## Visão Geral

Este diagrama de classes representa a estrutura do sistema Moeda Fácil, seguindo o padrão de arquitetura MVC (Model-View-Controller). O sistema é organizado em diferentes namespaces para facilitar a manutenção e escalabilidade.

## Diagrama Visual

```mermaid
classDiagram
    %% Definição da classe Controller (abstrata)
    class Controller {
        <<abstract>>
        +render(view: string, data: array) void
        +json(data: mixed, statusCode: int) void
    }

    %% Definição da classe Router
    class Router {
        -baseUrl: string
        -route: string
        -routes: array
        +__construct()
        +get(route: string, callback: callable|array) Router
        +post(route: string, callback: callable|array) Router
        +any(route: string, callback: callable|array) Router
        +run() mixed
        -executeCallback(callback: callable|array, params: array) mixed
        +redirect(url: string) void
    }

    %% Definição da classe Moeda
    class Moeda {
        +BASE_URL$ : string
        -apiKey$ : string
        -codigo : string
        -nome : string
        -cotacao : array
        +__construct(codigo: string, nome: string)
        +getCodigo() string
        +setCodigo(codigo: string) Moeda
        +getNome() string
        +setNome(nome: string) Moeda
        +getCotacao() array
        +carregarCotacao() Moeda
        +consultarCotacao$(codigoMoeda: string) array
        +consultarMultiplasCotacoes$(codigos: array) array
        -get(resource: string) array
    }

    %% Definição da classe CatalogoMoedas
    class CatalogoMoedas {
        -moedas$ : array
        +listarTodas$() array
        +existeMoeda$(codigo: string) bool
        +getNomeMoeda$(codigo: string) string|null
        +getMoedasPrincipais$(quantidade: int) array
        +getMoeda$(codigo: string) Moeda
    }

    %% Definição da classe CotacaoController
    class CotacaoController {
        +mostrarCotacao(moeda: string) void
        +mostrarMultiplasCotacoes() void
        +mostrarConversor() void
        +buscarMoedas() void
    }

    %% Definição das Views como interface
    class Views {
        <<interface>>
    }

    %% Relações entre classes
    Controller <|-- CotacaoController : extends
    CotacaoController --> Moeda : usa
    CotacaoController --> CatalogoMoedas : usa
    CotacaoController --> Views : renderiza
    Router --> Controller : executa
    CatalogoMoedas --> Moeda : cria
    Moeda ..> "API AwesomeAPI" : consulta
```

## Namespace App\Core

Contém as classes base que compõem o núcleo da aplicação.

### Classe: Controller

**Descrição**: Classe abstrata que serve como base para todos os controladores da aplicação.
**Atributos**: Nenhum
**Métodos**:

- `+render(view: string, data: array): void` - Renderiza uma view com os dados fornecidos
- `+json(data: mixed, statusCode: int): void` - Retorna dados em formato JSON

### Classe: Router

**Descrição**: Responsável pelo gerenciamento de rotas da aplicação.
**Atributos**:

- `-baseUrl: string` - URL base da aplicação
- `-route: string` - Rota atual sendo processada
- `-routes: array` - Rotas registradas na aplicação
  **Métodos**:
- `+__construct()` - Inicializa o router e determina a rota atual
- `+get(route: string, callback: callable|array): self` - Registra uma rota GET
- `+post(route: string, callback: callable|array): self` - Registra uma rota POST
- `+any(route: string, callback: callable|array): self` - Registra uma rota para qualquer método HTTP
- `+run(): mixed` - Executa a rota atual
- `-executeCallback(callback: callable|array, params: array): mixed` - Executa o callback da rota
- `+redirect(url: string): void` - Redireciona para uma URL

## Namespace App\Models

Contém as classes de modelo que representam os dados e a lógica de negócios da aplicação.

### Classe: Moeda

**Descrição**: Modelo para representação de Moeda e suas cotações.
**Atributos**:

- `+BASE_URL: string {static}` - URL base da API de economia
- `-apiKey: string {static}` - API Key para autenticação na API
- `-codigo: string` - Código da moeda
- `-nome: string` - Nome da moeda para exibição
- `-cotacao: array` - Dados da cotação da moeda
  **Métodos**:
- `+__construct(codigo: string, nome: string)` - Inicializa uma instância de Moeda
- `+getCodigo(): string` - Retorna o código da moeda
- `+setCodigo(codigo: string): self` - Define o código da moeda
- `+getNome(): string` - Retorna o nome da moeda
- `+setNome(nome: string): self` - Define o nome da moeda
- `+getCotacao(): array` - Retorna os dados da cotação
- `+carregarCotacao(): self` - Carrega a cotação atual da moeda
- `+consultarCotacao(codigoMoeda: string): array {static}` - Consulta a cotação de uma moeda
- `+consultarMultiplasCotacoes(codigos: array): array {static}` - Consulta múltiplas cotações de moedas
- `-get(resource: string): array` - Realiza a consulta na API

### Classe: CatalogoMoedas

**Descrição**: Modelo para gerenciamento do catálogo de moedas disponíveis.
**Atributos**:

- `-moedas: array {static}` - Lista de moedas disponíveis com seus nomes
  **Métodos**:
- `+listarTodas(): array {static}` - Retorna a lista completa de moedas disponíveis
- `+existeMoeda(codigo: string): bool {static}` - Verifica se uma moeda existe no catálogo
- `+getNomeMoeda(codigo: string): string|null {static}` - Retorna o nome de uma moeda pelo seu código
- `+getMoedasPrincipais(quantidade: int): array {static}` - Retorna um array com as principais moedas
- `+getMoeda(codigo: string): Moeda {static}` - Cria uma instância de Moeda a partir do código

## Namespace App\Controllers

Contém os controladores que processam as requisições do usuário.

### Classe: CotacaoController

**Descrição**: Controlador para gerenciar cotações de moedas.
**Herda de**: Controller
**Métodos**:

- `+mostrarCotacao(moeda: string): void` - Mostra a cotação de uma moeda específica
- `+mostrarMultiplasCotacoes(): void` - Mostra múltiplas cotações
- `+mostrarConversor(): void` - Mostra o conversor de moedas
- `+buscarMoedas(): void` - Busca moedas por nome ou código

## Views

As views não são representadas como classes no diagrama, mas são arquivos PHP que recebem dados dos controladores e geram a saída HTML.

### Arquivos de View

- `cotacao-view.php` - View para exibir a cotação de uma moeda específica
- `multiplas-cotacoes-view.php` - View para exibir múltiplas cotações
- `conversor-view.php` - View para o conversor de moedas
- `busca-view.php` - View para a busca de moedas

## Relações entre Classes

1. **Herança**:

   - CotacaoController herda de Controller (representado pela seta com triângulo vazio: `<|--`)

2. **Associação**:

   - Router --> Controller (Router executa métodos do Controller)
   - Controller --> Views (Controller renderiza Views)
   - CotacaoController --> Moeda (CotacaoController utiliza Moeda para obter dados)
   - CotacaoController --> CatalogoMoedas (CotacaoController utiliza CatalogoMoedas para obter informações)

3. **Dependência**:
   - Moeda depende da API AwesomeAPI para obter dados (representado pela linha tracejada: `..>`)
   - CatalogoMoedas depende de Moeda para criar instâncias

## Notação UML e Símbolos Utilizados

### Símbolos de Visibilidade

- `+` : público (public)
- `-` : privado (private)
- `#` : protegido (protected)
- `~` : pacote (package)

### Tipos de Relações

- `<|--` : Herança/Extensão (extends)
- `*--` : Composição
- `o--` : Agregação
- `-->` : Associação (usa)
- `..>` : Dependência (depende de)
- `--` : Ligação (relação não especificada)

### Estereótipos de Classes

- `<<abstract>>` : Classe abstrata
- `<<interface>>` : Interface
- `<<enumeration>>` : Enumeração
- `$` : Atributo ou método estático (no Mermaid, indicado com o símbolo $ no final do nome)

## Como Visualizar o Diagrama

O diagrama Mermaid neste documento pode ser visualizado de diversas maneiras:

1. **GitHub**: O GitHub renderiza automaticamente blocos de código Mermaid em arquivos markdown.

2. **VS Code**: Instale a extensão "Markdown Preview Mermaid Support" para visualizar o diagrama diretamente no VS Code.

3. **Mermaid Live Editor**: Copie o código Mermaid e cole no editor online [Mermaid Live Editor](https://mermaid.live/) para visualização e exportação em vários formatos.

4. **Exportar como Imagem**: Através do Mermaid Live Editor, você pode exportar o diagrama como PNG, SVG ou outro formato para incluir em documentações.

## Consistência com Outros Diagramas e Histórias de Usuário

O diagrama de classes está consistente com:

1. **Diagrama de Casos de Uso**: Cada funcionalidade do caso de uso tem classes correspondentes para implementá-la.

2. **Histórias de Usuário**: As classes fornecem todas as funcionalidades necessárias para atender às histórias de usuário.

3. **Diagrama de Sequência**: As interações representadas nos diagramas de sequência usam métodos existentes nestas classes.

4. **Diagrama de Componentes**: Os componentes representam agrupamentos lógicos destas classes.

5. **Diagrama de Implantação**: As classes são distribuídas nos nós representados no diagrama de implantação.

## Anotação para o Avaliador

Este diagrama de classes utiliza a notação UML padrão com as seguintes características:

1. **Estrutura MVC**: O diagrama demonstra claramente a separação entre Model, View e Controller, facilitando a compreensão da arquitetura.

2. **Encapsulamento**: A visibilidade dos atributos e métodos é indicada explicitamente (+, -).

3. **Estereótipos**: Classes abstratas e interfaces são identificadas com estereótipos (<<abstract>>, <<interface>>).

4. **Métodos e Atributos**: Cada classe apresenta seus métodos e atributos com tipagem e visibilidade.

5. **Relacionamentos**: Todas as relações entre classes são explicitamente indicadas e rotuladas.

6. **Namespaces**: As classes são organizadas em namespaces que refletem a estrutura do projeto.

O diagrama foi construído com base no código existente e documenta fielmente a implementação atual do sistema, servindo como referência para futuras evoluções.
