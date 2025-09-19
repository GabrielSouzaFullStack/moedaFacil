# Diagramas de Sequência - Moeda Fácil

## Diagrama 1: Consulta de Cotação de Moeda

### Atores e Objetos

- **Usuário**: Ator que inicia a interação com o sistema
- **Browser**: Interface de usuário
- **Router**: Componente de roteamento do sistema
- **CotacaoController**: Controlador responsável pelas cotações
- **Moeda**: Modelo que representa uma moeda e suas cotações
- **API AwesomeAPI**: Serviço externo de cotações
- **View (cotacao-view.php)**: Componente de visualização que exibe a cotação

### Sequência de Eventos

1. **Usuário** acessa a URL da cotação de uma moeda específica (ex: /cotacao.php?moeda=USD)
2. **Browser** envia requisição HTTP GET para o servidor
3. **Router** recebe a requisição e identifica a rota correspondente
4. **Router** encaminha a requisição para o método apropriado do **CotacaoController**
5. **CotacaoController** extrai o parâmetro da moeda da URL
6. **CotacaoController** chama o método `consultarCotacao()` da classe **Moeda**
7. **Moeda** prepara a requisição para a **API AwesomeAPI**
8. **Moeda** envia a requisição para a **API AwesomeAPI**
9. **API AwesomeAPI** processa a requisição e retorna os dados da cotação
10. **Moeda** recebe os dados e os formata
11. **Moeda** retorna os dados formatados para o **CotacaoController**
12. **CotacaoController** prepara os dados para a view
13. **CotacaoController** chama o método `render()` passando 'cotacao-view' e os dados
14. A **View** recebe os dados e gera o HTML correspondente
15. A resposta HTML é enviada para o **Browser**
16. **Browser** exibe a página de cotação para o **Usuário**

### Fluxos Alternativos

- Se ocorrer um erro na API (passo 9), a resposta incluirá um erro
- O **Moeda** (passo 10) detectará o erro e retornará um array vazio
- O **CotacaoController** (passo 12) exibirá uma mensagem de erro ao invés da cotação

## Diagrama 2: Busca de Moedas

### Atores e Objetos

- **Usuário**: Ator que inicia a interação com o sistema
- **Browser**: Interface de usuário
- **Router**: Componente de roteamento do sistema
- **CotacaoController**: Controlador responsável pelas cotações
- **Moeda**: Modelo que representa uma moeda e suas cotações
- **API AwesomeAPI**: Serviço externo de cotações
- **View (busca-view.php)**: Componente de visualização que exibe os resultados da busca

### Sequência de Eventos

1. **Usuário** acessa a página de busca de moedas
2. **Browser** envia requisição HTTP GET para o servidor
3. **Router** recebe a requisição e identifica a rota correspondente
4. **Router** encaminha a requisição para o método `buscarMoedas()` do **CotacaoController**
5. **CotacaoController** verifica se existe um termo de busca na requisição
6. Se existir, **CotacaoController** filtra a lista de moedas com base no termo de busca
7. Para cada moeda encontrada, **CotacaoController** chama o método `consultarMultiplasCotacoes()` da classe **Moeda**
8. **Moeda** prepara a requisição para a **API AwesomeAPI**
9. **Moeda** envia a requisição para a **API AwesomeAPI**
10. **API AwesomeAPI** processa a requisição e retorna os dados das cotações
11. **Moeda** recebe os dados e os formata
12. **Moeda** retorna os dados formatados para o **CotacaoController**
13. **CotacaoController** prepara os dados para a view
14. **CotacaoController** chama o método `render()` passando 'busca-view' e os dados
15. A **View** recebe os dados e gera o HTML correspondente
16. A resposta HTML é enviada para o **Browser**
17. **Browser** exibe a página de resultados da busca para o **Usuário**

### Fluxos Alternativos

- Se nenhum termo de busca for fornecido (passo 5), a view exibe apenas o formulário de busca
- Se nenhum resultado for encontrado (passo 6), a view exibe uma mensagem informando que nenhuma moeda foi encontrada

## Diagrama 3: Conversão de Valores

### Atores e Objetos

- **Usuário**: Ator que inicia a interação com o sistema
- **Browser**: Interface de usuário
- **Router**: Componente de roteamento do sistema
- **CotacaoController**: Controlador responsável pelas cotações
- **Moeda**: Modelo que representa uma moeda e suas cotações
- **API AwesomeAPI**: Serviço externo de cotações
- **View (conversor-view.php)**: Componente de visualização que exibe o conversor e o resultado

### Sequência de Eventos

1. **Usuário** acessa a página do conversor de moedas
2. **Browser** envia requisição HTTP GET para o servidor
3. **Router** recebe a requisição e identifica a rota correspondente
4. **Router** encaminha a requisição para o método `mostrarConversor()` do **CotacaoController**
5. **CotacaoController** obtém a lista de moedas disponíveis
6. **CotacaoController** chama o método `consultarMultiplasCotacoes()` da classe **Moeda** para obter as cotações atuais
7. **Moeda** prepara a requisição para a **API AwesomeAPI**
8. **Moeda** envia a requisição para a **API AwesomeAPI**
9. **API AwesomeAPI** processa a requisição e retorna os dados das cotações
10. **Moeda** recebe os dados e os formata
11. **Moeda** retorna os dados formatados para o **CotacaoController**
12. **CotacaoController** prepara os dados para a view
13. **CotacaoController** chama o método `render()` passando 'conversor-view' e os dados
14. A **View** recebe os dados e gera o HTML correspondente com o formulário de conversão
15. A resposta HTML é enviada para o **Browser**
16. **Browser** exibe a página do conversor para o **Usuário**
17. **Usuário** preenche o valor, seleciona as moedas de origem e destino, e submete o formulário
18. **Browser** envia requisição HTTP POST para o servidor
19. **Router** recebe a requisição e identifica a rota correspondente
20. **Router** encaminha a requisição para o método `mostrarConversor()` do **CotacaoController**
21. **CotacaoController** extrai os dados do formulário (valor, moeda de origem, moeda de destino)
22. **CotacaoController** realiza o cálculo da conversão com base nas cotações obtidas
23. **CotacaoController** prepara os dados do resultado para a view
24. **CotacaoController** chama o método `render()` passando 'conversor-view' e os dados (incluindo o resultado)
25. A **View** recebe os dados e gera o HTML correspondente com o formulário e o resultado
26. A resposta HTML é enviada para o **Browser**
27. **Browser** exibe a página do conversor com o resultado para o **Usuário**

### Fluxos Alternativos

- Se o usuário submeter um valor inválido (passo 21), o sistema exibirá uma mensagem de erro
- Se ocorrer um erro na obtenção das cotações (passo 9), o sistema exibirá uma mensagem de erro

## Diagrama 4: Visualização de Múltiplas Cotações

### Atores e Objetos

- **Usuário**: Ator que inicia a interação com o sistema
- **Browser**: Interface de usuário
- **Router**: Componente de roteamento do sistema
- **CotacaoController**: Controlador responsável pelas cotações
- **Moeda**: Modelo que representa uma moeda e suas cotações
- **API AwesomeAPI**: Serviço externo de cotações
- **View (multiplas-cotacoes-view.php)**: Componente de visualização que exibe as múltiplas cotações

### Sequência de Eventos

1. **Usuário** acessa a página de múltiplas cotações
2. **Browser** envia requisição HTTP GET para o servidor
3. **Router** recebe a requisição e identifica a rota correspondente
4. **Router** encaminha a requisição para o método `mostrarMultiplasCotacoes()` do **CotacaoController**
5. **CotacaoController** define a lista de moedas a serem consultadas
6. **CotacaoController** chama o método `consultarMultiplasCotacoes()` da classe **Moeda**
7. **Moeda** prepara a requisição para a **API AwesomeAPI**
8. **Moeda** envia a requisição para a **API AwesomeAPI**
9. **API AwesomeAPI** processa a requisição e retorna os dados das cotações
10. **Moeda** recebe os dados e os formata
11. **Moeda** retorna os dados formatados para o **CotacaoController**
12. **CotacaoController** prepara os dados para a view
13. **CotacaoController** chama o método `render()` passando 'multiplas-cotacoes-view' e os dados
14. A **View** recebe os dados e gera o HTML correspondente
15. A resposta HTML é enviada para o **Browser**
16. **Browser** exibe a página de múltiplas cotações para o **Usuário**

### Fluxos Alternativos

- Se ocorrer um erro na API (passo 9), a resposta incluirá um erro
- O **Moeda** (passo 10) detectará o erro e retornará um array vazio
- O **CotacaoController** (passo 12) exibirá uma mensagem de erro ao invés das cotações
