# Guia para Visualização de Diagramas UML com Mermaid

## Introdução

Este documento fornece orientações sobre como visualizar e interpretar os diagramas UML criados com a sintaxe Mermaid para o projeto Moeda Fácil. A notação Mermaid foi escolhida por ser compatível com Markdown e por permitir que os diagramas sejam versionados junto com o código e visualizados diretamente em plataformas como GitHub.

## O que é Mermaid?

Mermaid é uma linguagem de marcação baseada em JavaScript que permite criar diagramas e visualizações usando texto e código. Ela segue um princípio similar ao Markdown, onde você descreve o diagrama em um formato textual simples, e ele é renderizado visualmente.

## Como Visualizar os Diagramas

Existem várias maneiras de visualizar os diagramas Mermaid:

### 1. GitHub

O GitHub renderiza automaticamente blocos de código Mermaid em arquivos markdown. Simplesmente visualize os arquivos .md no repositório GitHub para ver os diagramas renderizados.

### 2. Visual Studio Code

Para visualizar os diagramas no VS Code:

1. Instale a extensão "Markdown Preview Mermaid Support"
2. Abra o arquivo markdown contendo o diagrama
3. Pressione Ctrl+Shift+V (ou clique no ícone de visualização no canto superior direito)
4. O diagrama será renderizado na visualização do markdown

### 3. Mermaid Live Editor

Para uma edição mais avançada ou para exportar os diagramas:

1. Copie o código Mermaid (o conteúdo entre os delimitadores `mermaid e `)
2. Acesse o [Mermaid Live Editor](https://mermaid.live/)
3. Cole o código no editor
4. Visualize e edite o diagrama em tempo real
5. Exporte como PNG, SVG ou outros formatos

## Diagramas Disponíveis

O projeto Moeda Fácil inclui os seguintes diagramas UML implementados com Mermaid:

1. **Diagrama de Casos de Uso**: `caso-de-uso.md`

   - Representa as interações do usuário com o sistema
   - Utiliza classes com estereótipos para atores e casos de uso

2. **Diagrama de Classes**: `diagrama-classes.md`

   - Representa a estrutura estática do sistema
   - Mostra classes, atributos, métodos e relações

3. **Diagramas de Sequência**: `diagramas-sequencia.md`

   - Representa as interações entre objetos ao longo do tempo
   - Mostra a ordem das mensagens trocadas

4. **Diagramas de Atividades**: `diagramas-atividades.md`

   - Representa o fluxo de trabalho ou processo
   - Mostra as atividades e decisões

5. **Diagrama de Componentes**: `diagrama-componentes.md`

   - Representa a organização e dependências entre componentes
   - Mostra a estrutura modular do sistema

6. **Diagrama de Implantação**: `diagrama-implantacao.md`
   - Representa a distribuição física do sistema
   - Mostra o hardware e software em que o sistema é implantado

## Notação UML Utilizada

Os diagramas seguem a notação UML padrão, com as seguintes convenções:

### Visibilidade de Atributos e Métodos

- `+` : público (public)
- `-` : privado (private)
- `#` : protegido (protected)
- `~` : pacote (package)

### Estereótipos

- `<<interface>>` : Interface
- `<<abstract>>` : Classe abstrata
- `<<actor>>` : Ator (em diagramas de caso de uso)
- `<<use case>>` : Caso de uso
- `<<component>>` : Componente
- `$` : Membro estático (no Mermaid, indicado com o símbolo $ no final do nome)

### Relacionamentos

- `<|--` : Herança/Extensão
- `*--` : Composição
- `o--` : Agregação
- `-->` : Associação
- `..>` : Dependência
- `--` : Ligação (não especificada)

## Consistência entre Diagramas

Todos os diagramas foram criados para manter consistência entre si e com as histórias de usuário. Por exemplo:

- As classes no diagrama de classes implementam as funcionalidades descritas nos casos de uso
- Os diagramas de sequência utilizam as classes e métodos definidos no diagrama de classes
- Os componentes no diagrama de componentes agrupam as classes do diagrama de classes
- Os nós no diagrama de implantação hospedam os componentes do diagrama de componentes

## Para o Avaliador

Esta abordagem de documentação utilizando Mermaid apresenta várias vantagens:

1. **Versionamento**: Os diagramas são versionados junto com o código, mantendo um histórico de alterações.

2. **Atualização Facilitada**: Como os diagramas são definidos em texto, são mais fáceis de atualizar quando o sistema evolui.

3. **Renderização Universal**: Os diagramas podem ser visualizados em qualquer plataforma que suporte Markdown e Mermaid.

4. **Consistência**: A abordagem textual facilita a manutenção da consistência entre diferentes diagramas.

5. **Integração com Documentação**: Os diagramas são parte integrante da documentação, não arquivos separados.

A análise de consistência completa entre todos os diagramas e histórias de usuário está disponível no arquivo `analise-consistencia.md`.

## Referências

- [Documentação oficial do Mermaid](https://mermaid-js.github.io/mermaid/#/)
- [Mermaid Live Editor](https://mermaid.live/)
- [Especificação UML 2.5](https://www.omg.org/spec/UML/2.5)
