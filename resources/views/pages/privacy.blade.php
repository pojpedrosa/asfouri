@php $en = app()->getLocale() === 'en'; @endphp

<x-layouts.site
    :title="$en ? 'Privacy Policy' : 'Política de Privacidade'"
    :description="$en
        ? 'How asfouri collects, uses and protects your personal data, and your rights under the GDPR.'
        : 'Como a asfouri recolhe, usa e protege os seus dados pessoais, e os seus direitos ao abrigo do RGPD.'">

    <x-site.page-hero
        :eyebrow="$en ? 'Legal' : 'Legal'"
        :title="$en ? 'Privacy Policy' : 'Política de Privacidade'"
        :intro="$en
            ? 'We treat your data the way we treat everything else: with care. This page explains what we collect, why, and the rights you have over it.'
            : 'Tratamos os seus dados como tratamos tudo o resto: com cuidado. Esta página explica o que recolhemos, porquê, e os direitos que tem sobre eles.'">
        <p class="mt-7 text-sm font-medium text-blue-500">
            {{ $en ? 'Last updated: 2026' : 'Última atualização: 2026' }}
        </p>
    </x-site.page-hero>

    {{-- Bold blue punctuation band --}}
    <section class="bg-blue-500 text-cream">
        <div class="grain relative mx-auto flex max-w-7xl items-center gap-5 overflow-hidden px-5 py-10 sm:px-8">
            <x-brand.mark class="h-12 w-auto shrink-0 text-cream" />
            <p class="max-w-3xl text-pretty text-base leading-relaxed text-cream/90 sm:text-lg">
                {{ $en
                    ? 'asfouri is a regenerative communication agency based in Portugal. We collect as little as possible, keep it only as long as we need to, and never sell it.'
                    : 'A asfouri é uma agência de comunicação regenerativa sediada em Portugal. Recolhemos o mínimo possível, guardamos apenas o tempo necessário, e nunca vendemos os seus dados.' }}
            </p>
        </div>
    </section>

    {{-- Body --}}
    <section class="mx-auto max-w-3xl px-5 py-16 sm:px-8 sm:py-24">
        <div class="prose prose-lg max-w-none text-ink
                    prose-headings:font-display prose-headings:font-semibold prose-headings:text-blue-700 prose-headings:tracking-tight
                    prose-h2:mt-14 prose-h2:mb-4 prose-h2:text-2xl sm:prose-h2:text-3xl
                    prose-h3:mt-8 prose-h3:mb-2 prose-h3:text-lg prose-h3:text-ink
                    prose-p:text-pretty prose-p:leading-relaxed prose-p:text-ink/80
                    prose-li:text-ink/80 prose-li:my-1
                    prose-strong:text-ink
                    prose-a:font-medium prose-a:text-blue-500 prose-a:underline prose-a:decoration-blue-500/30 prose-a:underline-offset-2 hover:prose-a:decoration-blue-500">

            @if ($en)
                <p class="lead !text-ink/90">
                    This Privacy Policy explains how <strong>asfouri</strong> (“we”, “us”, “our”) handles personal data
                    collected through the website <a href="https://asfouri.media">asfouri.media</a>. We are committed to
                    protecting your privacy and complying with the EU General Data Protection Regulation (GDPR) and
                    Portuguese data protection law.
                </p>

                <h2>1. Who we are</h2>
                <p>
                    asfouri is a regenerative communication agency based in Portugal (European Union). For any question
                    about this policy or your personal data, you can reach us at
                    <a href="mailto:hello@asfouri.media">hello@asfouri.media</a>. asfouri acts as the
                    <strong>data controller</strong> for the personal data described below.
                </p>

                <h2>2. What data we collect</h2>
                <h3>Contact form</h3>
                <p>When you use the contact form on our website, we collect the information you choose to provide:</p>
                <ul>
                    <li><strong>Name</strong></li>
                    <li><strong>Email address</strong></li>
                    <li><strong>Organisation</strong> (optional)</li>
                    <li><strong>Subject</strong></li>
                    <li><strong>Your message</strong></li>
                </ul>
                <h3>Server logs</h3>
                <p>
                    Like virtually all websites, our server automatically records technical information when you visit —
                    such as your IP address, browser type, the pages requested and timestamps. These logs help us keep
                    the site secure, available and working correctly.
                </p>
                <h3>Cookies</h3>
                <p>
                    We do not use tracking, advertising or third-party analytics cookies. We use only essential cookies:
                    a <strong>session cookie</strong> needed for the site to function and security (including form
                    protection), and a <strong>locale cookie</strong> that remembers whether you prefer Portuguese or
                    English. These are strictly necessary and do not profile you.
                </p>

                <h2>3. Why we use your data and our legal basis</h2>
                <ul>
                    <li>
                        <strong>To respond to your enquiry</strong> — when you submit the contact form, we process your
                        data on the basis of your <strong>consent</strong> and our <strong>legitimate interest</strong>
                        in answering people who reach out to us.
                    </li>
                    <li>
                        <strong>To operate, secure and improve the website</strong> — server logs and essential cookies
                        are processed on the basis of our <strong>legitimate interest</strong> in running a safe,
                        reliable site.
                    </li>
                    <li>
                        <strong>To remember your language preference</strong> — the locale cookie is processed to provide
                        the service you have asked for.
                    </li>
                </ul>

                <h2>4. Email handling</h2>
                <p>
                    Messages sent through our contact form are delivered by email using <strong>Mailgun</strong> (EU
                    region) acting as our processor. As part of normal email operation, your message may be transmitted,
                    stored and forwarded between our mailboxes so that the right person can reply to you. We keep this
                    correspondence so we can follow up on your request and maintain a record of our exchange.
                </p>

                <h2>5. Who we share data with</h2>
                <p>We do not sell your personal data. We share it only with service providers who help us run asfouri, under appropriate contracts:</p>
                <ul>
                    <li><strong>Mailgun</strong> — email delivery and processing (EU region).</li>
                    <li><strong>DigitalOcean</strong> — website and infrastructure hosting, in EU data centres.</li>
                </ul>
                <p>
                    These providers act as <strong>processors</strong> on our behalf and may only use your data to
                    provide their service to us. We may also disclose data where required to comply with a legal
                    obligation.
                </p>

                <h2>6. International transfers</h2>
                <p>
                    We keep your data within the European Union / European Economic Area wherever possible, choosing
                    EU-based hosting and the EU region of our email provider. If any transfer outside the EEA were ever
                    necessary, we would ensure appropriate safeguards are in place, such as the European Commission's
                    Standard Contractual Clauses.
                </p>

                <h2>7. How long we keep your data</h2>
                <ul>
                    <li><strong>Contact enquiries and related email</strong> — for as long as needed to handle your request and any follow-up, and then for a reasonable period to keep a record, after which it is deleted.</li>
                    <li><strong>Server logs</strong> — for a limited period for security and diagnostics, then routinely deleted or anonymised.</li>
                    <li><strong>Cookies</strong> — the session cookie expires when you close your browser or after inactivity; the locale cookie lasts until it expires or you clear it.</li>
                </ul>

                <h2>8. Your rights under the GDPR</h2>
                <p>You have the right to:</p>
                <ul>
                    <li><strong>Access</strong> the personal data we hold about you;</li>
                    <li><strong>Rectify</strong> inaccurate or incomplete data;</li>
                    <li><strong>Erase</strong> your data (“right to be forgotten”);</li>
                    <li><strong>Restrict or object</strong> to certain processing;</li>
                    <li><strong>Data portability</strong> — receive your data in a portable format;</li>
                    <li><strong>Withdraw consent</strong> at any time, without affecting prior processing.</li>
                </ul>
                <p>
                    To exercise any of these rights, email us at <a href="mailto:hello@asfouri.media">hello@asfouri.media</a>.
                    You also have the right to lodge a complaint with the Portuguese supervisory authority, the
                    <strong>Comissão Nacional de Proteção de Dados (CNPD)</strong> — <a href="https://www.cnpd.pt" rel="noopener">cnpd.pt</a>.
                </p>

                <h2>9. Security</h2>
                <p>
                    We apply appropriate technical and organisational measures to protect your data — including encrypted
                    connections (HTTPS), access controls and trusted EU infrastructure. No method of transmission over
                    the internet is completely secure, but we work to keep your data safe and to limit who can access it.
                </p>

                <h2>10. Changes to this policy</h2>
                <p>
                    We may update this Privacy Policy from time to time. When we do, we will change the “last updated”
                    date above. Significant changes will be made clear on this page.
                </p>

                <h2>11. Contact</h2>
                <p>
                    Questions about your privacy? Write to us at
                    <a href="mailto:hello@asfouri.media">hello@asfouri.media</a>. We read every message and reply with care.
                </p>
            @else
                <p class="lead !text-ink/90">
                    Esta Política de Privacidade explica como a <strong>asfouri</strong> (“nós”) trata os dados pessoais
                    recolhidos através do site <a href="https://asfouri.media">asfouri.media</a>. Comprometemo-nos a
                    proteger a sua privacidade e a cumprir o Regulamento Geral sobre a Proteção de Dados (RGPD) da União
                    Europeia e a legislação portuguesa de proteção de dados.
                </p>

                <h2>1. Quem somos</h2>
                <p>
                    A asfouri é uma agência de comunicação regenerativa sediada em Portugal (União Europeia). Para
                    qualquer questão sobre esta política ou sobre os seus dados pessoais, pode contactar-nos através de
                    <a href="mailto:hello@asfouri.media">hello@asfouri.media</a>. A asfouri atua como
                    <strong>responsável pelo tratamento</strong> dos dados pessoais descritos abaixo.
                </p>

                <h2>2. Que dados recolhemos</h2>
                <h3>Formulário de contacto</h3>
                <p>Quando utiliza o formulário de contacto do nosso site, recolhemos a informação que decide fornecer:</p>
                <ul>
                    <li><strong>Nome</strong></li>
                    <li><strong>Endereço de email</strong></li>
                    <li><strong>Organização</strong> (opcional)</li>
                    <li><strong>Assunto</strong></li>
                    <li><strong>A sua mensagem</strong></li>
                </ul>
                <h3>Registos do servidor (logs)</h3>
                <p>
                    Como praticamente todos os sites, o nosso servidor regista automaticamente informação técnica quando
                    o visita — como o endereço IP, o tipo de navegador, as páginas pedidas e as datas e horas de acesso.
                    Estes registos ajudam-nos a manter o site seguro, disponível e a funcionar corretamente.
                </p>
                <h3>Cookies</h3>
                <p>
                    Não usamos cookies de rastreio, de publicidade ou de análise de terceiros. Usamos apenas cookies
                    essenciais: um <strong>cookie de sessão</strong> necessário ao funcionamento e à segurança do site
                    (incluindo a proteção do formulário), e um <strong>cookie de idioma</strong> que recorda se prefere
                    português ou inglês. São estritamente necessários e não criam perfis sobre si.
                </p>

                <h2>3. Porque usamos os seus dados e qual a base legal</h2>
                <ul>
                    <li>
                        <strong>Para responder ao seu pedido</strong> — quando submete o formulário de contacto,
                        tratamos os seus dados com base no seu <strong>consentimento</strong> e no nosso
                        <strong>interesse legítimo</strong> em responder a quem nos contacta.
                    </li>
                    <li>
                        <strong>Para operar, proteger e melhorar o site</strong> — os registos do servidor e os cookies
                        essenciais são tratados com base no nosso <strong>interesse legítimo</strong> em manter um site
                        seguro e fiável.
                    </li>
                    <li>
                        <strong>Para recordar a sua preferência de idioma</strong> — o cookie de idioma é tratado para
                        lhe prestar o serviço que pediu.
                    </li>
                </ul>

                <h2>4. Tratamento de email</h2>
                <p>
                    As mensagens enviadas pelo formulário de contacto são entregues por email através do
                    <strong>Mailgun</strong> (região da UE), que atua como nosso subcontratante. No funcionamento normal
                    do correio eletrónico, a sua mensagem pode ser transmitida, armazenada e reencaminhada entre as
                    nossas caixas de correio, para que a pessoa certa lhe possa responder. Guardamos esta correspondência
                    para podermos dar seguimento ao seu pedido e manter um registo da nossa troca.
                </p>

                <h2>5. Com quem partilhamos os dados</h2>
                <p>Não vendemos os seus dados pessoais. Partilhamo-los apenas com prestadores de serviços que nos ajudam a operar a asfouri, ao abrigo de contratos adequados:</p>
                <ul>
                    <li><strong>Mailgun</strong> — envio e tratamento de email (região da UE).</li>
                    <li><strong>DigitalOcean</strong> — alojamento do site e da infraestrutura, em centros de dados na UE.</li>
                </ul>
                <p>
                    Estes prestadores atuam como <strong>subcontratantes</strong> em nosso nome e só podem usar os seus
                    dados para nos prestar o serviço. Podemos também divulgar dados quando tal for exigido para cumprir
                    uma obrigação legal.
                </p>

                <h2>6. Transferências internacionais</h2>
                <p>
                    Mantemos os seus dados dentro da União Europeia / Espaço Económico Europeu sempre que possível,
                    escolhendo alojamento na UE e a região europeia do nosso fornecedor de email. Caso alguma
                    transferência para fora do EEE viesse a ser necessária, garantiríamos as salvaguardas adequadas,
                    como as Cláusulas Contratuais-Tipo da Comissão Europeia.
                </p>

                <h2>7. Durante quanto tempo guardamos os seus dados</h2>
                <ul>
                    <li><strong>Pedidos de contacto e email relacionado</strong> — pelo tempo necessário para tratar o seu pedido e eventual seguimento, e depois por um período razoável para manter um registo, sendo então eliminados.</li>
                    <li><strong>Registos do servidor</strong> — por um período limitado, para fins de segurança e diagnóstico, sendo depois eliminados ou anonimizados rotineiramente.</li>
                    <li><strong>Cookies</strong> — o cookie de sessão expira ao fechar o navegador ou após inatividade; o cookie de idioma dura até expirar ou até o eliminar.</li>
                </ul>

                <h2>8. Os seus direitos ao abrigo do RGPD</h2>
                <p>Tem o direito de:</p>
                <ul>
                    <li><strong>Aceder</strong> aos dados pessoais que detemos sobre si;</li>
                    <li><strong>Retificar</strong> dados incorretos ou incompletos;</li>
                    <li><strong>Apagar</strong> os seus dados (“direito a ser esquecido”);</li>
                    <li><strong>Limitar ou opor-se</strong> a determinados tratamentos;</li>
                    <li><strong>Portabilidade</strong> — receber os seus dados num formato portável;</li>
                    <li><strong>Retirar o consentimento</strong> a qualquer momento, sem afetar o tratamento anterior.</li>
                </ul>
                <p>
                    Para exercer qualquer destes direitos, escreva-nos para
                    <a href="mailto:hello@asfouri.media">hello@asfouri.media</a>. Tem também o direito de apresentar
                    reclamação junto da autoridade de controlo portuguesa, a
                    <strong>Comissão Nacional de Proteção de Dados (CNPD)</strong> — <a href="https://www.cnpd.pt" rel="noopener">cnpd.pt</a>.
                </p>

                <h2>9. Segurança</h2>
                <p>
                    Aplicamos medidas técnicas e organizativas adequadas para proteger os seus dados — incluindo ligações
                    encriptadas (HTTPS), controlos de acesso e infraestrutura de confiança na UE. Nenhum método de
                    transmissão pela internet é totalmente seguro, mas trabalhamos para manter os seus dados protegidos e
                    para limitar quem lhes pode aceder.
                </p>

                <h2>10. Alterações a esta política</h2>
                <p>
                    Podemos atualizar esta Política de Privacidade periodicamente. Quando o fizermos, alteraremos a data
                    de “última atualização” acima. Alterações significativas serão assinaladas nesta página.
                </p>

                <h2>11. Contacto</h2>
                <p>
                    Dúvidas sobre a sua privacidade? Escreva-nos para
                    <a href="mailto:hello@asfouri.media">hello@asfouri.media</a>. Lemos cada mensagem e respondemos com cuidado.
                </p>
            @endif
        </div>
    </section>

    <x-site.cta
        :eyebrow="$en ? 'Still curious?' : 'Ainda com dúvidas?'"
        :heading="$en ? 'Let\'s talk' : 'Vamos conversar'"
        :text="$en
            ? 'Whether it\'s about your data or your project, we\'re one message away.'
            : 'Seja sobre os seus dados ou sobre o seu projeto, estamos a uma mensagem de distância.'" />

    <div class="h-20"></div>
</x-layouts.site>
