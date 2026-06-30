@php $en = app()->getLocale() === 'en'; @endphp

<x-layouts.site
    :title="$en ? 'Terms & Conditions' : 'Termos e Condições'"
    :description="$en
        ? 'The terms that govern your use of the asfouri website.'
        : 'Os termos que regem a utilização do site da asfouri.'">

    <x-site.page-hero
        :eyebrow="$en ? 'Legal' : 'Legal'"
        :title="$en ? 'Terms & Conditions' : 'Termos e Condições'"
        :intro="$en
            ? 'A short, plain agreement for using this website. By browsing asfouri.media, you accept the terms below.'
            : 'Um acordo curto e claro para a utilização deste site. Ao navegar em asfouri.media, aceita os termos abaixo.'">
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
                    ? 'This website is run by asfouri, a regenerative communication agency in Portugal. These terms are governed by Portuguese law.'
                    : 'Este site é gerido pela asfouri, uma agência de comunicação regenerativa em Portugal. Estes termos regem-se pela lei portuguesa.' }}
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
                    These Terms &amp; Conditions (“Terms”) govern your access to and use of the website
                    <a href="https://asfouri.media">asfouri.media</a> (the “Website”), operated by
                    <strong>asfouri</strong>. Please read them carefully.
                </p>

                <h2>1. Acceptance of these Terms</h2>
                <p>
                    By accessing or using the Website, you agree to be bound by these Terms. If you do not agree with
                    them, please do not use the Website.
                </p>

                <h2>2. Who we are</h2>
                <p>
                    asfouri is a regenerative communication agency based in Portugal (European Union). You can contact us
                    at <a href="mailto:hello@asfouri.media">hello@asfouri.media</a> about anything on this Website.
                </p>

                <h2>3. The Website is informational</h2>
                <p>
                    The Website presents asfouri and the services we offer (such as strategy, narrative, social media,
                    web platforms, AI, branding and illustration). All content is provided for general information only.
                    Nothing on the Website is a binding offer, quote or contract. Any engagement is governed by a
                    separate agreement we sign with you, which prevails over any information shown here.
                </p>

                <h2>4. Intellectual property</h2>
                <p>
                    The asfouri name, the sparrow mark, wordmark, logo, visual identity, text, illustrations, design and
                    other content on the Website are owned by asfouri (or used with permission) and protected by
                    intellectual property law. You may view and share links to the Website for personal,
                    non-commercial purposes. You may not copy, reproduce, modify, distribute or use our brand or content
                    for any other purpose without our prior written permission.
                </p>

                <h2>5. Acceptable use</h2>
                <p>When using the Website, you agree not to:</p>
                <ul>
                    <li>use it for any unlawful, harmful or fraudulent purpose;</li>
                    <li>attempt to gain unauthorised access to the Website, its servers or any connected systems;</li>
                    <li>disrupt or overload the Website, or interfere with its security;</li>
                    <li>submit false information, spam or malicious content through the contact form;</li>
                    <li>scrape, harvest or misuse content or data from the Website.</li>
                </ul>

                <h2>6. Third-party links</h2>
                <p>
                    The Website may link to external sites (for example social media or partner projects) that we do not
                    control. We provide these links for convenience and are not responsible for the content, policies or
                    practices of third-party sites. Visiting them is at your own risk.
                </p>

                <h2>7. No warranty</h2>
                <p>
                    The Website is provided “as is” and “as available”. While we work to keep it accurate, current and
                    online, we make no warranties — express or implied — that the Website will be uninterrupted,
                    error-free, secure or free of harmful components, or that the information it contains is complete or
                    up to date.
                </p>

                <h2>8. Limitation of liability</h2>
                <p>
                    To the fullest extent permitted by law, asfouri shall not be liable for any indirect, incidental or
                    consequential loss or damage arising from your use of, or inability to use, the Website, or from
                    reliance on any content on it. Nothing in these Terms excludes or limits liability that cannot
                    lawfully be excluded or limited.
                </p>

                <h2>9. Privacy</h2>
                <p>
                    Your use of the Website is also governed by our
                    <a href="{{ route('privacy') }}">Privacy Policy</a>, which explains how we handle personal data.
                </p>

                <h2>10. Governing law and jurisdiction</h2>
                <p>
                    These Terms are governed by the laws of <strong>Portugal</strong>. Any dispute arising from or
                    relating to the Website or these Terms shall be subject to the exclusive jurisdiction of the
                    <strong>competent Portuguese courts</strong>, without prejudice to any mandatory consumer protections
                    you may have under EU or Portuguese law.
                </p>

                <h2>11. Changes to these Terms</h2>
                <p>
                    We may update these Terms from time to time. The “last updated” date above shows the current version.
                    Continuing to use the Website after a change means you accept the revised Terms.
                </p>

                <h2>12. Contact</h2>
                <p>
                    Questions about these Terms? Write to us at
                    <a href="mailto:hello@asfouri.media">hello@asfouri.media</a>.
                </p>
            @else
                <p class="lead !text-ink/90">
                    Estes Termos e Condições (“Termos”) regem o acesso e a utilização do site
                    <a href="https://asfouri.media">asfouri.media</a> (o “Site”), explorado pela
                    <strong>asfouri</strong>. Por favor, leia-os com atenção.
                </p>

                <h2>1. Aceitação destes Termos</h2>
                <p>
                    Ao aceder ou utilizar o Site, concorda em ficar vinculado a estes Termos. Se não concordar com eles,
                    por favor não utilize o Site.
                </p>

                <h2>2. Quem somos</h2>
                <p>
                    A asfouri é uma agência de comunicação regenerativa sediada em Portugal (União Europeia). Pode
                    contactar-nos através de <a href="mailto:hello@asfouri.media">hello@asfouri.media</a> sobre qualquer
                    assunto deste Site.
                </p>

                <h2>3. O Site é informativo</h2>
                <p>
                    O Site apresenta a asfouri e os serviços que oferecemos (como estratégia, narrativa, redes sociais,
                    plataformas web, IA, branding e ilustração). Todo o conteúdo é disponibilizado apenas para
                    informação geral. Nada no Site constitui uma proposta, orçamento ou contrato vinculativo. Qualquer
                    colaboração rege-se por um acordo próprio que assinamos consigo, o qual prevalece sobre qualquer
                    informação aqui apresentada.
                </p>

                <h2>4. Propriedade intelectual</h2>
                <p>
                    O nome asfouri, o pássaro (a marca), o logótipo, a identidade visual, os textos, as ilustrações, o
                    design e os restantes conteúdos do Site pertencem à asfouri (ou são usados com autorização) e estão
                    protegidos pela legislação de propriedade intelectual. Pode consultar e partilhar ligações para o
                    Site para fins pessoais e não comerciais. Não pode copiar, reproduzir, modificar, distribuir ou
                    utilizar a nossa marca ou conteúdos para qualquer outro fim sem a nossa autorização prévia por
                    escrito.
                </p>

                <h2>5. Utilização aceitável</h2>
                <p>Ao utilizar o Site, compromete-se a não:</p>
                <ul>
                    <li>usá-lo para qualquer fim ilícito, lesivo ou fraudulento;</li>
                    <li>tentar obter acesso não autorizado ao Site, aos seus servidores ou a sistemas associados;</li>
                    <li>perturbar ou sobrecarregar o Site, ou interferir com a sua segurança;</li>
                    <li>submeter informação falsa, spam ou conteúdo malicioso através do formulário de contacto;</li>
                    <li>extrair, recolher ou utilizar indevidamente conteúdos ou dados do Site.</li>
                </ul>

                <h2>6. Ligações para terceiros</h2>
                <p>
                    O Site pode conter ligações para sites externos (por exemplo, redes sociais ou projetos parceiros)
                    que não controlamos. Disponibilizamos estas ligações por conveniência e não somos responsáveis pelo
                    conteúdo, políticas ou práticas de sites de terceiros. A sua visita a esses sites é feita por sua
                    conta e risco.
                </p>

                <h2>7. Ausência de garantias</h2>
                <p>
                    O Site é disponibilizado “tal como está” e “conforme disponível”. Embora trabalhemos para o manter
                    rigoroso, atualizado e em funcionamento, não prestamos quaisquer garantias — expressas ou implícitas
                    — de que o Site funcionará sem interrupções, sem erros, em segurança ou livre de componentes
                    nocivos, nem de que a informação que contém é completa ou está atualizada.
                </p>

                <h2>8. Limitação de responsabilidade</h2>
                <p>
                    Na máxima medida permitida por lei, a asfouri não será responsável por quaisquer danos ou prejuízos
                    indiretos, incidentais ou consequenciais decorrentes da utilização, ou da impossibilidade de
                    utilização, do Site, ou da confiança depositada em qualquer conteúdo nele incluído. Nada nestes
                    Termos exclui ou limita responsabilidade que não possa, por lei, ser excluída ou limitada.
                </p>

                <h2>9. Privacidade</h2>
                <p>
                    A utilização do Site rege-se também pela nossa
                    <a href="{{ route('privacy') }}">Política de Privacidade</a>, que explica como tratamos os dados
                    pessoais.
                </p>

                <h2>10. Lei aplicável e foro competente</h2>
                <p>
                    Estes Termos regem-se pela lei de <strong>Portugal</strong>. Qualquer litígio decorrente do Site ou
                    destes Termos, ou com eles relacionado, fica sujeito à jurisdição exclusiva dos
                    <strong>tribunais portugueses competentes</strong>, sem prejuízo das proteções imperativas do
                    consumidor que lhe possam assistir ao abrigo da legislação da UE ou portuguesa.
                </p>

                <h2>11. Alterações a estes Termos</h2>
                <p>
                    Podemos atualizar estes Termos periodicamente. A data de “última atualização” acima indica a versão
                    em vigor. Continuar a utilizar o Site após uma alteração significa que aceita os Termos revistos.
                </p>

                <h2>12. Contacto</h2>
                <p>
                    Dúvidas sobre estes Termos? Escreva-nos para
                    <a href="mailto:hello@asfouri.media">hello@asfouri.media</a>.
                </p>
            @endif
        </div>
    </section>

    <x-site.cta
        :eyebrow="$en ? 'Ready when you are' : 'Quando quiser'"
        :heading="$en ? 'Let\'s talk' : 'Vamos conversar'"
        :text="$en
            ? 'Got a project or a question? We\'re one message away.'
            : 'Tem um projeto ou uma questão? Estamos a uma mensagem de distância.'" />

    <div class="h-20"></div>
</x-layouts.site>
