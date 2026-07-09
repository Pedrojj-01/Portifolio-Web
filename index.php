<?php
$profile = [
    'name' => 'Pedro Jorge Nogueira Queiroz',
    'initials' => 'PJ',
    'role' => 'Desenvolvedor Web & UX/UI Designer em formação',
    'location' => 'Fortaleza, Brasil',
    'instagram' => '@pedesigner_02',
    'instagram_url' => 'https://www.instagram.com/pedesigner_02/',
    'resume' => 'assets/curriculo-pedro-jorge.pdf',
    'intro' => 'Crio interfaces digitais simples, bonitas e funcionais para landing pages, sites institucionais e produtos web.',
    'about' => 'Sou estudante de Análise e Desenvolvimento de Sistemas, com foco em desenvolvimento web, design de interfaces e soluções digitais. Gosto de entender o problema do cliente, organizar o fluxo da experiência e transformar ideias em produtos claros, responsivos e fáceis de usar.',
];

$stats = [
    ['value' => 'ADS', 'label' => 'UniFAP 2023-2026'],
    ['value' => 'UX/UI', 'label' => 'Certificação Google/Coursera'],
    ['value' => '3', 'label' => 'idiomas de trabalho'],
];

$focusAreas = [
    [
        'title' => 'Landing pages e sites',
        'text' => 'Páginas para apresentar serviços, captar interesse e transmitir confiança com visual limpo e navegação direta.',
        'accent' => 'mint',
    ],
    [
        'title' => 'UX/UI e documentação',
        'text' => 'Organização de telas, fluxos, requisitos, conteúdo e decisões de produto para reduzir ruído antes do código.',
        'accent' => 'coral',
    ],
    [
        'title' => 'Soluções web e automações',
        'text' => 'Interfaces, formulários, consumo de APIs e pequenas rotinas que ajudam negócios e projetos acadêmicos a funcionar melhor.',
        'accent' => 'indigo',
    ],
];

$projects = [
    [
        'title' => 'CineLog - Catálogo de filmes',
        'category' => 'React Native + Expo',
        'image' => 'assets/project-dashboard.png',
        'description' => 'Aplicativo com listagem de filmes e séries, busca por título ou gênero, favoritos, tela de detalhes, cadastro validado e integração com JSON Server via Axios.',
        'problem' => 'Criar uma experiência simples para cadastrar, consultar, favoritar e remover títulos sem deixar o usuário perdido entre telas.',
        'result' => 'Fluxo com navegação por abas, feedbacks de carregamento, estados vazios, validação de formulário e operações GET, POST, PATCH e DELETE.',
        'tags' => ['React Native', 'Expo', 'TypeScript', 'Axios', 'JSON Server'],
    ],
    [
        'title' => 'Portfólio pessoal',
        'category' => 'PHP + UX Writing',
        'image' => 'assets/project-brand.png',
        'description' => 'Site de apresentação profissional com narrativa pessoal, currículo em PDF, projetos selecionados, stack e formulário validado.',
        'problem' => 'Substituir uma página genérica por uma presença digital com conteúdo real, ritmo de leitura e foco em conversão para contato.',
        'result' => 'Página única responsiva, com seções claras, chamadas objetivas, assets otimizados e conteúdo editável direto no PHP.',
        'tags' => ['PHP', 'HTML', 'CSS', 'JavaScript', 'Responsivo'],
    ],
    [
        'title' => 'Interfaces para negócios locais',
        'category' => 'Landing pages',
        'image' => 'assets/project-commerce.png',
        'description' => 'Estrutura preparada para apresentar serviços, vitrines compactas, formulários de interesse e páginas institucionais.',
        'problem' => 'Dar a pequenos negócios uma página enxuta, compreensível e fácil de adaptar conforme a oferta evolui.',
        'result' => 'Modelo modular para hero, benefícios, prova visual, CTA e contato, pensado para publicação rápida.',
        'tags' => ['UX/UI', 'Landing Page', 'Conteúdo', 'Performance'],
    ],
];

$skillGroups = [
    [
        'title' => 'Desenvolvimento',
        'items' => ['HTML5', 'CSS3', 'JavaScript', 'PHP', 'React Native', 'TypeScript', 'Axios', 'JSON Server'],
    ],
    [
        'title' => 'Design e produto',
        'items' => ['UX/UI Design', 'Interfaces responsivas', 'Jornada do usuário', 'Documentação', 'Trello', 'Prototipação'],
    ],
    [
        'title' => 'Pessoas e comunicação',
        'items' => ['Atendimento ao público', 'Organização', 'Trabalho em equipe', 'Inglês intermediário', 'Espanhol intermediário'],
    ],
];

$timeline = [
    [
        'step' => '2023-2026',
        'title' => 'Análise e Desenvolvimento de Sistemas',
        'text' => 'Formação na UniFAP, com foco no crescimento em tecnologia, desenvolvimento e criação de soluções digitais.',
    ],
    [
        'step' => '2024.2',
        'title' => 'UX/UI Designer - Google/Coursera',
        'text' => 'Certificação voltada a experiência do usuário, interfaces, pesquisa, organização de telas e decisões de design.',
    ],
    [
        'step' => 'Produto',
        'title' => 'Product Owner em projeto acadêmico',
        'text' => 'Atuação com documentação, UX, gestão no Trello e alinhamento de entregas junto ao time.',
    ],
    [
        'step' => 'Público',
        'title' => 'Atendimento e comunicação',
        'text' => 'Experiência com atendimento em escritório de advocacia, desenvolvendo escuta, clareza e trato com diferentes perfis.',
    ],
];

$workflow = [
    ['title' => 'Entender', 'text' => 'Mapeio objetivo, público, conteúdo essencial e o problema que a interface precisa resolver.'],
    ['title' => 'Organizar', 'text' => 'Transformo ideias soltas em seções, fluxos e prioridades visuais antes da implementação.'],
    ['title' => 'Construir', 'text' => 'Desenvolvo a página ou aplicação com estrutura limpa, responsividade e interações úteis.'],
    ['title' => 'Ajustar', 'text' => 'Reviso clareza, estados, espaçamento, navegação e detalhes que deixam a entrega mais profissional.'],
];

$contactLinks = [
    ['label' => 'Instagram', 'value' => $profile['instagram'], 'href' => $profile['instagram_url']],
    ['label' => 'Currículo', 'value' => 'Baixar PDF', 'href' => $profile['resume'], 'download' => true],
    ['label' => 'Localização', 'value' => $profile['location'], 'href' => null],
];

$errors = [];
$sent = false;
$form = [
    'name' => '',
    'email' => '',
    'message' => '',
];

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $form['name'] = trim($_POST['name'] ?? '');
    $form['email'] = trim($_POST['email'] ?? '');
    $form['message'] = trim($_POST['message'] ?? '');

    if ($form['name'] === '') {
        $errors['name'] = 'Informe seu nome.';
    }

    if (!filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Informe um e-mail válido.';
    }

    if (strlen($form['message']) < 10) {
        $errors['message'] = 'Escreva uma mensagem com pelo menos 10 caracteres.';
    }

    $sent = count($errors) === 0;
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portfólio de <?php echo e($profile['name']); ?>, desenvolvedor web e UX/UI designer em formação.">
    <title><?php echo e($profile['name']); ?> | Portfólio</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <a class="skip-link" href="#conteudo">Pular para o conteúdo</a>

    <header class="site-header" data-header>
        <a class="brand" href="#inicio" aria-label="<?php echo e($profile['name']); ?>">
            <span class="brand__mark"><?php echo e($profile['initials']); ?></span>
            <span class="brand__text">Pedro Jorge</span>
        </a>

        <button class="nav-toggle" type="button" aria-label="Abrir menu" aria-expanded="false" data-nav-toggle>
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="site-nav" data-nav>
            <a href="#sobre">Sobre</a>
            <a href="#projetos">Projetos</a>
            <a href="#formacao">Formação</a>
            <a href="#stack">Stack</a>
            <a href="#contato">Contato</a>
        </nav>
    </header>

    <main id="conteudo">
        <section class="hero" id="inicio" aria-labelledby="hero-title">
            <div class="hero__shade"></div>
            <div class="hero__content wrap">
                <p class="eyebrow">Portfólio Web</p>
                <h1 id="hero-title"><?php echo e($profile['name']); ?></h1>
                <p class="hero__role"><?php echo e($profile['role']); ?></p>
                <p class="hero__lead"><?php echo e($profile['intro']); ?></p>

                <div class="hero__actions" aria-label="Ações principais">
                    <a class="button button--primary" href="#projetos">
                        Ver projetos
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h12m-5-5 5 5-5 5"/></svg>
                    </a>
                    <a class="button button--ghost" href="<?php echo e($profile['resume']); ?>" download>
                        Baixar currículo
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3v12m0 0 4-4m-4 4-4-4"/><path d="M4 19h16"/></svg>
                    </a>
                    <a class="button button--ghost" href="<?php echo e($profile['instagram_url']); ?>" target="_blank" rel="noreferrer">
                        Instagram
                        <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="5" y="5" width="14" height="14" rx="4"/><circle cx="12" cy="12" r="3"/><path d="M16.5 7.5h.01"/></svg>
                    </a>
                </div>

                <div class="hero__meta" aria-label="Destaques">
                    <span><?php echo e($profile['location']); ?></span>
                    <span>Web, UX/UI e soluções digitais</span>
                </div>
            </div>
        </section>

        <section class="stats wrap" aria-label="Resumo profissional">
            <?php foreach ($stats as $stat): ?>
                <div class="stat">
                    <strong><?php echo e($stat['value']); ?></strong>
                    <span><?php echo e($stat['label']); ?></span>
                </div>
            <?php endforeach; ?>
        </section>

        <section class="section section--split wrap" id="sobre">
            <div>
                <p class="eyebrow">Sobre</p>
                <h2>Design com intenção, código com clareza.</h2>
            </div>
            <div class="section__copy">
                <p><?php echo e($profile['about']); ?></p>
                <p>Minha combinação principal é desenvolvimento, olhar de produto e comunicação com pessoas. Isso me ajuda a criar páginas que explicam bem uma ideia, conduzem o visitante e deixam o projeto pronto para evoluir.</p>
            </div>
        </section>

        <section class="section section--band" aria-labelledby="focus-title">
            <div class="wrap">
                <div class="section__heading">
                    <p class="eyebrow">Atuação</p>
                    <h2 id="focus-title">Onde posso ajudar</h2>
                </div>

                <div class="focus-grid">
                    <?php foreach ($focusAreas as $area): ?>
                        <article class="focus-card focus-card--<?php echo e($area['accent']); ?>">
                            <span class="focus-card__icon" aria-hidden="true"></span>
                            <h3><?php echo e($area['title']); ?></h3>
                            <p><?php echo e($area['text']); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="section wrap" id="projetos">
            <div class="section__heading section__heading--wide">
                <p class="eyebrow">Projetos</p>
                <h2>Cases com problema, solução e stack.</h2>
                <p>Uma seleção para mostrar como organizo a experiência, penso nos estados da interface e conecto a parte visual com funcionalidades reais.</p>
            </div>

            <div class="project-grid">
                <?php foreach ($projects as $project): ?>
                    <article class="project-card">
                        <img src="<?php echo e($project['image']); ?>" alt="Prévia visual do projeto <?php echo e($project['title']); ?>" loading="lazy">
                        <div class="project-card__body">
                            <p class="project-card__category"><?php echo e($project['category']); ?></p>
                            <h3><?php echo e($project['title']); ?></h3>
                            <p><?php echo e($project['description']); ?></p>

                            <div class="project-card__notes">
                                <div>
                                    <strong>Problema</strong>
                                    <span><?php echo e($project['problem']); ?></span>
                                </div>
                                <div>
                                    <strong>Solução</strong>
                                    <span><?php echo e($project['result']); ?></span>
                                </div>
                            </div>

                            <div class="tag-list" aria-label="Tecnologias e temas">
                                <?php foreach ($project['tags'] as $tag): ?>
                                    <small><?php echo e($tag); ?></small>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="section section--band" id="formacao">
            <div class="wrap">
                <div class="section__heading">
                    <p class="eyebrow">Formação</p>
                    <h2>Base técnica, UX e comunicação.</h2>
                </div>

                <div class="timeline">
                    <?php foreach ($timeline as $item): ?>
                        <article class="timeline__item">
                            <strong><?php echo e($item['step']); ?></strong>
                            <h3><?php echo e($item['title']); ?></h3>
                            <p><?php echo e($item['text']); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="section section--skills wrap" id="stack">
            <div>
                <p class="eyebrow">Stack</p>
                <h2>Tecnologias e habilidades que sustentam a entrega.</h2>
            </div>
            <div class="skill-groups">
                <?php foreach ($skillGroups as $group): ?>
                    <article class="skill-group">
                        <h3><?php echo e($group['title']); ?></h3>
                        <ul class="skill-list">
                            <?php foreach ($group['items'] as $skill): ?>
                                <li><?php echo e($skill); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="section section--workflow wrap" aria-labelledby="workflow-title">
            <div class="section__heading">
                <p class="eyebrow">Processo</p>
                <h2 id="workflow-title">Como eu transformo ideia em interface.</h2>
            </div>

            <div class="workflow">
                <?php foreach ($workflow as $index => $item): ?>
                    <article class="workflow__item">
                        <strong><?php echo str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT); ?></strong>
                        <h3><?php echo e($item['title']); ?></h3>
                        <p><?php echo e($item['text']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="contact" id="contato">
            <div class="wrap contact__layout">
                <div>
                    <p class="eyebrow">Contato</p>
                    <h2>Vamos criar uma presença web mais clara e funcional?</h2>
                    <p>Estou disponível para conversar sobre landing pages, sites institucionais, UX/UI e soluções digitais simples.</p>

                    <div class="contact-links" aria-label="Canais de contato">
                        <?php foreach ($contactLinks as $link): ?>
                            <?php if ($link['href']): ?>
                                <a class="contact-link" href="<?php echo e($link['href']); ?>" <?php echo !empty($link['download']) ? 'download' : 'target="_blank" rel="noreferrer"'; ?>>
                                    <span><?php echo e($link['label']); ?></span>
                                    <strong><?php echo e($link['value']); ?></strong>
                                </a>
                            <?php else: ?>
                                <div class="contact-link">
                                    <span><?php echo e($link['label']); ?></span>
                                    <strong><?php echo e($link['value']); ?></strong>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <form class="contact-form" action="#contato" method="post" novalidate>
                    <?php if ($sent): ?>
                        <div class="form-alert form-alert--success" role="status">
                            Mensagem preparada. Obrigado por escrever.
                        </div>
                    <?php elseif ($errors): ?>
                        <div class="form-alert form-alert--error" role="alert">
                            Confira os campos destacados e tente novamente.
                        </div>
                    <?php endif; ?>

                    <label>
                        Nome
                        <input type="text" name="name" value="<?php echo e($form['name']); ?>" autocomplete="name" <?php echo isset($errors['name']) ? 'aria-invalid="true"' : ''; ?>>
                        <?php if (isset($errors['name'])): ?><small><?php echo e($errors['name']); ?></small><?php endif; ?>
                    </label>

                    <label>
                        E-mail
                        <input type="email" name="email" value="<?php echo e($form['email']); ?>" autocomplete="email" <?php echo isset($errors['email']) ? 'aria-invalid="true"' : ''; ?>>
                        <?php if (isset($errors['email'])): ?><small><?php echo e($errors['email']); ?></small><?php endif; ?>
                    </label>

                    <label>
                        Mensagem
                        <textarea name="message" rows="5" <?php echo isset($errors['message']) ? 'aria-invalid="true"' : ''; ?>><?php echo e($form['message']); ?></textarea>
                        <?php if (isset($errors['message'])): ?><small><?php echo e($errors['message']); ?></small><?php endif; ?>
                    </label>

                    <button class="button button--dark" type="submit">
                        Preparar contato
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m4 12 15-7-4 14-3-6-8-1z"/></svg>
                    </button>
                </form>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="wrap">
            <span>© <?php echo date('Y'); ?> <?php echo e($profile['name']); ?>.</span>
            <a href="#inicio">Voltar ao topo</a>
        </div>
    </footer>

    <script src="assets/app.js"></script>
</body>
</html>
