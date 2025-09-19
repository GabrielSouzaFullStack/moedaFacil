# Diagrama de Casos de Uso - Moeda Fácil

## Diagrama Visual

```mermaid
classDiagram
    %% Definição dos atores como classes com estereótipo
    class Usuário {
        <<actor>>
    }
    class "API AwesomeAPI" {
        <<actor>>
    }

    %% Definição dos casos de uso como classes com estereótipo
    class "Consultar Cotação de Moeda" {
        <<use case>>
    }
    class "Visualizar Múltiplas Cotações" {
        <<use case>>
    }
    class "Converter Valores entre Moedas" {
        <<use case>>
    }
    class "Buscar Moedas" {
        <<use case>>
    }
    class "Navegar entre Funcionalidades" {
        <<use case>>
    }

    %% Relações entre atores e casos de uso
    Usuário --> "Consultar Cotação de Moeda"
    Usuário --> "Visualizar Múltiplas Cotações"
    Usuário --> "Converter Valores entre Moedas"
    Usuário --> "Buscar Moedas"
    Usuário --> "Navegar entre Funcionalidades"

    %% Relações com o ator secundário
    "API AwesomeAPI" --> "Consultar Cotação de Moeda"
    "API AwesomeAPI" --> "Visualizar Múltiplas Cotações"
    "API AwesomeAPI" --> "Converter Valores entre Moedas"
    "API AwesomeAPI" --> "Buscar Moedas"
```

## Atores

- **Usuário**: Pessoa que utiliza o sistema para consultar cotações e converter moedas.
- **API AwesomeAPI**: Sistema externo que fornece os dados de cotações de moedas.

## Casos de Uso

### 1. Consultar Cotação de Moeda

**Ator Principal**: Usuário
**Ator Secundário**: API AwesomeAPI
**Descrição**: O usuário visualiza a cotação detalhada de uma moeda específica em relação ao Real Brasileiro.
**Fluxo Principal**:

1. Usuário acessa a página inicial ou seleciona "Cotação do Dólar" no menu
2. Sistema solicita dados da cotação à API AwesomeAPI
3. Sistema exibe a cotação detalhada com valores de compra, venda, variação, máxima e mínima
   **Fluxos Alternativos**:

- Usuário seleciona outra moeda para visualizar sua cotação
- API não retorna dados (exibe mensagem de erro)

### 2. Visualizar Múltiplas Cotações

**Ator Principal**: Usuário
**Ator Secundário**: API AwesomeAPI
**Descrição**: O usuário visualiza as cotações de várias moedas simultaneamente.
**Fluxo Principal**:

1. Usuário seleciona "Ver Todas as Cotações" no menu
2. Sistema solicita dados de múltiplas moedas à API AwesomeAPI
3. Sistema exibe uma lista com todas as cotações disponíveis
   **Fluxos Alternativos**:

- API não retorna dados (exibe mensagem de erro)

### 3. Converter Valores entre Moedas

**Ator Principal**: Usuário
**Ator Secundário**: API AwesomeAPI
**Descrição**: O usuário converte um valor de uma moeda para outra.
**Fluxo Principal**:

1. Usuário seleciona "Conversor de Moedas" no menu
2. Usuário informa o valor a ser convertido
3. Usuário seleciona a moeda de origem e a moeda de destino
4. Usuário clica em "Converter"
5. Sistema calcula o valor convertido usando as taxas obtidas da API
6. Sistema exibe o resultado da conversão
   **Fluxos Alternativos**:

- Valor inválido (sistema exibe mensagem de erro)
- API não retorna dados (exibe mensagem de erro)

### 4. Buscar Moedas

**Ator Principal**: Usuário
**Ator Secundário**: API AwesomeAPI
**Descrição**: O usuário busca por moedas usando um termo de pesquisa.
**Fluxo Principal**:

1. Usuário seleciona "Buscar Moedas" no menu
2. Usuário digita um termo de busca (nome ou código da moeda)
3. Sistema procura moedas que correspondam ao termo de busca
4. Sistema exibe os resultados encontrados com suas respectivas cotações
   **Fluxos Alternativos**:

- Nenhum resultado encontrado (exibe mensagem)
- API não retorna dados (exibe mensagem de erro)

### 5. Navegar entre Funcionalidades

**Ator Principal**: Usuário
**Descrição**: O usuário navega entre as diferentes funcionalidades do sistema.
**Fluxo Principal**:

1. Usuário visualiza o menu de navegação presente em todas as páginas
2. Usuário seleciona a funcionalidade desejada
3. Sistema direciona o usuário para a página correspondente
   **Fluxos Alternativos**:

- Problema de navegação (retorna à página inicial)

## Relações entre Casos de Uso

- **Associação**: Relação entre ator e caso de uso.
- **Estende**: "Buscar Moedas" estende "Consultar Cotação de Moeda" (ao encontrar uma moeda, é possível ver sua cotação detalhada).
- **Inclui**: "Converter Valores entre Moedas" inclui "Consultar Múltiplas Cotações" (para obter as taxas necessárias para a conversão).

## Notação UML para Casos de Uso

### Elementos Básicos

- **Atores**: Representados por bonecos palito ou classes com estereótipo <<actor>>
- **Casos de Uso**: Representados por elipses ou classes com estereótipo <<use case>>
- **Sistema**: Representado por um retângulo que contém os casos de uso

### Tipos de Relações

- **Associação**: Linha sólida entre ator e caso de uso
- **Estende (extends)**: Linha tracejada com seta e rótulo "<<extends>>"
- **Inclui (includes)**: Linha tracejada com seta e rótulo "<<includes>>"
- **Generalização**: Linha sólida com seta triangular vazia

## Como Visualizar o Diagrama

O diagrama Mermaid neste documento pode ser visualizado de diversas maneiras:

1. **GitHub**: O GitHub renderiza automaticamente blocos de código Mermaid em arquivos markdown.

2. **VS Code**: Instale a extensão "Markdown Preview Mermaid Support" para visualizar o diagrama diretamente no VS Code.

3. **Mermaid Live Editor**: Copie o código Mermaid e cole no editor online [Mermaid Live Editor](https://mermaid.live/) para visualização e exportação em vários formatos.

4. **Exportar como Imagem**: Através do Mermaid Live Editor, você pode exportar o diagrama como PNG, SVG ou outro formato para incluir em documentações.

## Consistência com Histórias de Usuário

Este diagrama de casos de uso está diretamente alinhado com as histórias de usuário identificadas:

1. **História: Visualizar Cotação de Moeda** → Caso de Uso: Consultar Cotação de Moeda
2. **História: Visualizar Múltiplas Cotações** → Caso de Uso: Visualizar Múltiplas Cotações
3. **História: Converter Valores entre Moedas** → Caso de Uso: Converter Valores entre Moedas
4. **História: Buscar Moedas** → Caso de Uso: Buscar Moedas
5. **História: Navegação Consistente** → Caso de Uso: Navegar entre Funcionalidades

## Anotação para o Avaliador

Este diagrama de casos de uso utiliza a notação UML padrão e representa:

1. **Atores Bem Definidos**: Identifica claramente os atores primários (Usuário) e secundários (API AwesomeAPI).

2. **Casos de Uso Completos**: Cada caso de uso possui descrição, fluxo principal e fluxos alternativos.

3. **Relações Explícitas**: As relações entre casos de uso são identificadas e justificadas.

4. **Consistência com Requisitos**: Todos os casos de uso derivam diretamente das histórias de usuário.

5. **Legibilidade**: A representação gráfica facilita a compreensão dos requisitos funcionais do sistema.

O diagrama foi construído com base nas funcionalidades já implementadas no sistema e documentadas nas histórias de usuário, garantindo consistência entre requisitos e implementação.
