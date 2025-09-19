# Diagrama de Componentes - Moeda Fácil

## Visão Geral

Este diagrama de componentes representa a estrutura modular do sistema Moeda Fácil, mostrando os principais componentes do sistema e suas dependências. Os componentes são organizados de acordo com a arquitetura MVC (Model-View-Controller) adotada no projeto.

## Componentes Principais

### 1. Camada de Apresentação (Interface com o Usuário)

- **Browser**: Componente externo que representa o navegador do usuário que interage com a aplicação.
- **Views**:
  - **cotacao-view**: Responsável por exibir a cotação de uma moeda específica.
  - **multiplas-cotacoes-view**: Responsável por exibir múltiplas cotações.
  - **conversor-view**: Responsável por exibir o formulário de conversão e resultados.
  - **busca-view**: Responsável por exibir o formulário de busca e os resultados.
- **Partials**:
  - **header**: Componente reutilizável para o cabeçalho das páginas.
  - **footer**: Componente reutilizável para o rodapé das páginas.
  - **nav**: Componente reutilizável para a navegação entre as páginas.

### 2. Camada de Controle

- **Router**: Componente responsável por direcionar as requisições para os controladores apropriados.
- **Controller Base**: Componente abstrato que fornece funcionalidades comuns a todos os controladores.
- **CotacaoController**: Componente que implementa a lógica de negócio para as cotações e conversões.

### 3. Camada de Modelo

- **Moeda**: Componente que representa o modelo de uma moeda e interage com a API externa.
- **CatalogoMoedas**: Componente que gerencia o catálogo de moedas disponíveis.

### 4. Camada de Infraestrutura

- **Bibliotecas PHP**: Componentes padrão do PHP necessários para a aplicação.
- **Bootstrap**: Framework CSS utilizado para o design responsivo da interface.
- **Composer**: Gerenciador de dependências PHP.

### 5. Sistemas Externos

- **AwesomeAPI**: API externa que fornece os dados de cotações de moedas.

## Interfaces

### Interfaces Fornecidas

- **HTTP Interface**: Interface fornecida pelo servidor web para receber requisições HTTP.
- **View Interface**: Interface fornecida pelas views para exibir dados aos usuários.
- **Controller Interface**: Interface fornecida pelos controladores para processar requisições.
- **Model Interface**: Interface fornecida pelos modelos para acessar e manipular dados.

### Interfaces Requeridas

- **API Interface**: Interface requerida pela aplicação para comunicação com a AwesomeAPI.
- **Bootstrap Interface**: Interface requerida pelas views para estilização da interface.

## Dependências

1. **Browser depende de:**

   - HTTP Interface (para enviar requisições ao servidor)
   - View Interface (para renderizar a interface do usuário)

2. **Views dependem de:**

   - Bootstrap (para estilização)
   - Partials (componentes reutilizáveis)

3. **CotacaoController depende de:**

   - Controller Base (herda funcionalidades comuns)
   - Moeda (para obter dados de cotações)
   - CatalogoMoedas (para obter informações sobre moedas disponíveis)
   - Views (para renderizar a interface)

4. **Moeda depende de:**

   - API Interface (para comunicação com a AwesomeAPI)

5. **Router depende de:**
   - CotacaoController (para direcionar requisições)

## Relações de Composição

1. **Views são compostas por:**

   - header
   - footer
   - nav

2. **Camada de Apresentação contém:**

   - Views
   - Partials

3. **Camada de Controle contém:**

   - Router
   - Controller Base
   - CotacaoController

4. **Camada de Modelo contém:**
   - Moeda
   - CatalogoMoedas

## Diagrama em Notação UML

Em um diagrama UML de componentes:

- Os componentes são representados por retângulos com o símbolo de componente
- As interfaces são representadas por círculos (lollipops) para interfaces fornecidas e semicírculos para interfaces requeridas
- As dependências são representadas por setas tracejadas
- As relações de composição são representadas por linhas sólidas com diamantes preenchidos
- Os componentes externos são representados por retângulos com linhas tracejadas

## Notas de Implementação

- Todos os componentes internos são implementados em PHP
- O sistema segue o padrão arquitetural MVC
- A comunicação com a API externa é feita através de requisições HTTP
- As views utilizam HTML, CSS (Bootstrap) e PHP para renderização
- O sistema utiliza Composer para gerenciar dependências
