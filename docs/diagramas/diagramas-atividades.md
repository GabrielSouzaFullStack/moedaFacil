# Diagramas de Atividades - Moeda Fácil

## Diagrama 1: Consulta de Cotação de Moeda

### Descrição

Este diagrama representa o fluxo de atividades que ocorre quando um usuário consulta a cotação de uma moeda específica.

### Fluxo de Atividades

1. **Início**
2. **Verificar parâmetro da moeda na URL**
   - Se parâmetro existe: Usar o código da moeda da URL
   - Se parâmetro não existe: Usar o código padrão 'USD'
3. **Consultar API AwesomeAPI para obter cotação**
4. **Verificar se os dados foram obtidos com sucesso**
   - Se sim: Continuar para próxima atividade
   - Se não: Exibir mensagem de erro e encerrar
5. **Preparar dados para a view**
6. **Renderizar a view de cotação**
7. **Exibir página de cotação para o usuário**
8. **Fim**

### Pontos de Decisão

- Verificação do parâmetro da moeda na URL
- Verificação do sucesso na obtenção dos dados da API

### Atividades Paralelas

Não há atividades paralelas neste fluxo.

## Diagrama 2: Conversão de Valores entre Moedas

### Descrição

Este diagrama representa o fluxo de atividades que ocorre quando um usuário utiliza o conversor de moedas.

### Fluxo de Atividades

1. **Início**
2. **Consultar API AwesomeAPI para obter cotações das moedas disponíveis**
3. **Verificar se os dados foram obtidos com sucesso**
   - Se sim: Continuar para próxima atividade
   - Se não: Exibir mensagem de erro e encerrar
4. **Verificar se é uma requisição POST (formulário submetido)**
   - Se não: Ir para atividade 9
   - Se sim: Continuar para próxima atividade
5. **Extrair dados do formulário (valor, moeda origem, moeda destino)**
6. **Verificar se os dados são válidos**
   - Se não: Exibir mensagem de erro
   - Se sim: Continuar para próxima atividade
7. **Realizar cálculo de conversão**
   - Se origem é BRL: Valor / Cotação destino
   - Se destino é BRL: Valor \* Cotação origem
   - Se ambos são estrangeiros: (Valor \* Cotação origem) / Cotação destino
8. **Preparar resultado da conversão para a view**
9. **Preparar lista de moedas para os selects**
10. **Renderizar a view do conversor**
11. **Exibir página do conversor para o usuário**
12. **Fim**

### Pontos de Decisão

- Verificação do sucesso na obtenção dos dados da API
- Verificação se é uma requisição POST
- Verificação da validade dos dados do formulário
- Determinação do tipo de conversão a ser realizada

### Atividades Paralelas

Não há atividades paralelas neste fluxo.

## Diagrama 3: Busca de Moedas

### Descrição

Este diagrama representa o fluxo de atividades que ocorre quando um usuário busca por moedas.

### Fluxo de Atividades

1. **Início**
2. **Verificar se existe termo de busca na requisição**
   - Se não: Ir para atividade 9
   - Se sim: Continuar para próxima atividade
3. **Filtrar lista de moedas com base no termo de busca**
4. **Verificar se foram encontrados resultados**
   - Se não: Ir para atividade 9
   - Se sim: Continuar para próxima atividade
5. **Consultar API AwesomeAPI para obter cotações das moedas encontradas**
6. **Verificar se os dados foram obtidos com sucesso**
   - Se não: Exibir mensagem de erro para as moedas que falharam
   - Se sim: Continuar para próxima atividade
7. **Formatar dados das cotações**
8. **Preparar resultados da busca para a view**
9. **Renderizar a view de busca**
10. **Exibir página de busca para o usuário**
11. **Fim**

### Pontos de Decisão

- Verificação se existe termo de busca
- Verificação se foram encontrados resultados
- Verificação do sucesso na obtenção dos dados da API

### Atividades Paralelas

Não há atividades paralelas neste fluxo, mas a consulta à API poderia ser paralelizada para múltiplas moedas.

## Diagrama 4: Visualização de Múltiplas Cotações

### Descrição

Este diagrama representa o fluxo de atividades que ocorre quando um usuário visualiza múltiplas cotações de moedas.

### Fluxo de Atividades

1. **Início**
2. **Definir lista de moedas a serem consultadas**
3. **Consultar API AwesomeAPI para obter cotações**
4. **Verificar se os dados foram obtidos com sucesso**
   - Se sim: Continuar para próxima atividade
   - Se não: Exibir mensagem de erro e encerrar
5. **Preparar dados para a view**
6. **Renderizar a view de múltiplas cotações**
7. **Exibir página de múltiplas cotações para o usuário**
8. **Fim**

### Pontos de Decisão

- Verificação do sucesso na obtenção dos dados da API

### Atividades Paralelas

Não há atividades paralelas neste fluxo, mas a consulta à API poderia ser paralelizada para múltiplas moedas.
