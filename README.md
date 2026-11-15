# Portfólio de Pedro Jorge

Portfólio em HTML, CSS e JavaScript, orientado a oportunidades profissionais em desenvolvimento web e UX/UI.

## Executar

Abra `index.html` no navegador ou execute `python -m http.server 8000` na raiz. Não há etapa de build nem dependências JavaScript. O `index.php` opcional serve o mesmo HTML, para manter uma única fonte de conteúdo.

## Editar

- `index.html`: apresentação, projetos, experiência, formação e contatos.
- `assets/styles.css`: identidade visual, layouts responsivos e preferência por movimento reduzido.
- `assets/app.js`: menu móvel com Escape, filtros de projetos, seção ativa e ano.
- `assets/curriculo-pedro-jorge.pdf`: arquivo existente, identificado na interface como apresentação pessoal, pois não é um currículo profissional completo.

As capas dos projetos são composições ilustrativas em CSS, identificadas nos detalhes; não são capturas de produtos. Substitua-as por imagens reais para documentar os trabalhos. As descrições dos projetos foram preservadas ou adaptadas do conteúdo anterior, sem métricas de resultado inventadas. A formação Google/Coursera é descrita como estudos iniciados, conforme o PDF, sem afirmar conclusão.

O contato usa um link `mailto:` que abre o aplicativo de e-mail do visitante. Não há formulário nem serviço de envio no servidor.

## Publicação no endereço existente

Atualize o projeto Cloudflare Pages já associado ao portfólio. Não crie outro projeto e não altere domínio, nome ou configuração de hospedagem. Se a integração Git estiver configurada para `main`, a incorporação desta alteração nessa branch poderá iniciar a publicação automaticamente. Confirme a configuração no painel da Cloudflare; ela não está definida neste repositório.

## Verificação

A sintaxe JavaScript, os links locais, as âncoras e a lógica de filtros/menu foram verificados localmente. A revisão visual em navegador permanece pendente: o Chromium do ambiente não iniciou por restrição de sockets. Antes de publicar, revisar em desktop e celular, testar menu por teclado, filtros, detalhes, e-mail e download do PDF.
