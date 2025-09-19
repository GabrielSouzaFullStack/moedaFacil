# Diagrama de Implantação - Moeda Fácil

## Visão Geral

Este diagrama de implantação representa como o sistema Moeda Fácil é distribuído em termos de hardware, software e componentes de rede. Ele mostra os nós físicos e virtuais onde o sistema é executado, as conexões entre eles e os componentes implantados em cada nó.

## Nós e Dispositivos

### 1. Dispositivo do Cliente

- **Tipo**: Dispositivo físico (computador, tablet, smartphone)
- **Sistema Operacional**: Diversos (Windows, macOS, Android, iOS)
- **Artefatos Implantados**:
  - Navegador Web (Chrome, Firefox, Safari, Edge)

### 2. Servidor Web

- **Tipo**: Servidor físico ou virtual
- **Sistema Operacional**: Linux (Ubuntu, Debian) ou Windows Server
- **Artefatos Implantados**:
  - Servidor HTTP (Apache, Nginx)
  - PHP 7.4+
  - Aplicação Moeda Fácil
    - Arquivos do núcleo
    - Controladores
    - Modelos
    - Views
    - Arquivos estáticos (CSS, JS)
  - Composer (Gerenciador de dependências PHP)

### 3. Servidor de API Externa (AwesomeAPI)

- **Tipo**: Servidor de terceiros
- **Artefatos Implantados**:
  - Serviço de API REST
  - Banco de dados de cotações

## Conexões e Protocolos

### 1. Cliente → Servidor Web

- **Protocolo**: HTTP/HTTPS
- **Porta**: 80/443
- **Descrição**: Usuários acessam a aplicação através de requisições HTTP/HTTPS

### 2. Servidor Web → Servidor de API Externa

- **Protocolo**: HTTPS
- **Porta**: 443
- **Descrição**: A aplicação consome dados de cotações da API externa

## Topologia da Rede

### Ambiente de Desenvolvimento

- **Descrição**: Ambiente local onde os desenvolvedores trabalham
- **Configuração**:
  - Servidor web local (XAMPP, WAMP, etc.)
  - PHP instalado localmente
  - Código-fonte da aplicação
  - Acesso à internet para comunicação com a API externa

### Ambiente de Produção

- **Descrição**: Ambiente onde a aplicação é disponibilizada para os usuários finais
- **Configuração**:
  - Servidor web de produção
  - Configurações de segurança e desempenho otimizadas
  - Sistema de cache para reduzir chamadas à API externa
  - Possível balanceador de carga para alta disponibilidade

## Requisitos de Hardware

### Servidor Web

- **CPU**: 2+ núcleos
- **RAM**: 4GB+ (recomendado)
- **Armazenamento**: 20GB+ para o sistema e logs
- **Rede**: Conexão de banda larga confiável

### Cliente

- **Requisitos mínimos**: Qualquer dispositivo capaz de executar um navegador web moderno
- **Rede**: Conexão à internet

## Requisitos de Software

### Servidor Web

- **Sistema Operacional**: Linux (recomendado) ou Windows Server
- **Web Server**: Apache 2.4+ ou Nginx
- **PHP**: Versão 7.4+ com extensões:
  - curl
  - json
  - mbstring
- **Composer**: Para gerenciamento de dependências

### Cliente

- **Navegador**: Chrome 80+, Firefox 75+, Safari 13+, Edge 80+

## Considerações de Segurança

- Todas as comunicações externas são feitas através de HTTPS
- Possível implementação de firewall para proteção do servidor web
- Validação de entrada de dados para prevenir injeções e ataques XSS
- Limitação de taxa de requisições para a API externa para evitar bloqueios

## Considerações de Escalabilidade

- O sistema pode ser facilmente escalado horizontalmente adicionando mais servidores web
- Implementação de cache para reduzir a carga na API externa
- Possibilidade de implementar CDN para arquivos estáticos em caso de alto tráfego

## Notas para Implantação

- A aplicação não requer banco de dados próprio, pois utiliza API externa para os dados
- A configuração do servidor web deve incluir reescrita de URL para o roteamento
- Deve-se configurar corretamente as permissões de diretório para segurança
- É recomendável implementar monitoramento para detectar problemas de desempenho ou disponibilidade
