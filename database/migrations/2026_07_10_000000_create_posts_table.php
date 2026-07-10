<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title_pt');
            $table->string('title_en')->nullable();
            $table->text('excerpt_pt')->nullable();
            $table->text('excerpt_en')->nullable();
            $table->longText('body_pt')->nullable();
            $table->longText('body_en')->nullable();
            $table->string('cover_path')->nullable();
            $table->string('author_name')->nullable();
            $table->timestamp('published_at')->nullable()->index();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });

        // A genuine, on-brand starter article so the blog launches alive.
        // Editable/replaceable in the admin (Jornal).
        $bodyPt = <<<'HTML'
<p>Vivemos rodeados de mensagens. Notificações, campanhas, newsletters, anúncios que nos perseguem de site em site. A maior parte foi desenhada para uma coisa: capturar a nossa atenção o mais depressa possível. E, tal como a agricultura industrial esgota o solo para maximizar a colheita de um ano, esta forma de comunicar esgota aquilo de que depende — a confiança e a atenção das pessoas.</p>
<p>Chamamos-lhe comunicação extrativa. Funciona a curto prazo e deixa terra queimada a longo prazo: públicos exaustos, promessas infladas, equipas a correr atrás do algoritmo.</p>
<h2>Uma outra forma de comunicar</h2>
<p>A comunicação regenerativa parte de uma pergunta diferente: e se cada peça de comunicação devolvesse mais do que aquilo que tira? Em vez de extrair atenção, cultiva relação. Em vez de gritar mais alto, chega mais fundo.</p>
<p>Fomos buscar os princípios à agricultura regenerativa — começar pelo solo, trabalhar com os ciclos, cuidar da diversidade, deixar o terreno mais fértil do que o encontrámos — e trouxemo-los para a comunicação, o design e a tecnologia. Não como metáfora bonita, mas como método.</p>
<p>Na prática, isso significa escolhas concretas: profundidade acima do alcance, consentimento em vez de intrusão, criatividade humana à frente da produção em série. Significa medir o sucesso pelo que deixamos para trás — mais confiança, mais literacia, mais vontade de voltar.</p>
<h2>Porque é que isto importa</h2>
<p>Porque há projetos extraordinários — quintas regenerativas, cooperativas, movimentos, organizações de impacto — a fazer um trabalho que muda o mundo e a ficarem invisíveis por falta de meios para o comunicar. Amplificar esse trabalho com cuidado não é só mais eficaz: é coerente com o mundo que queremos ajudar a construir.</p>
<p>É por aqui que vamos escrever. Bem-vindo ao nosso jornal.</p>
HTML;

        $bodyEn = <<<'HTML'
<p>We live surrounded by messages. Notifications, campaigns, newsletters, ads that follow us from site to site. Most were designed to do one thing: capture our attention as fast as possible. And just as industrial farming drains the soil to maximise a single year's harvest, this way of communicating drains the very thing it depends on — people's trust and attention.</p>
<p>We call it extractive communication. It works in the short term and leaves scorched earth in the long one: exhausted audiences, inflated promises, teams forever chasing the algorithm.</p>
<h2>Another way to communicate</h2>
<p>Regenerative communication starts from a different question: what if every piece of communication gave back more than it took? Instead of extracting attention, it cultivates relationship. Instead of shouting louder, it reaches deeper.</p>
<p>We borrowed the principles from regenerative agriculture — start with the soil, work with the cycles, tend diversity, leave the ground more fertile than you found it — and brought them into communication, design and technology. Not as a pretty metaphor, but as a method.</p>
<p>In practice, that means concrete choices: depth over reach, consent instead of intrusion, human creativity ahead of mass production. It means measuring success by what we leave behind — more trust, more literacy, more reason to come back.</p>
<h2>Why it matters</h2>
<p>Because there are extraordinary projects — regenerative farms, cooperatives, movements, impact organisations — doing world-changing work and staying invisible for lack of the means to communicate it. Amplifying that work with care isn't only more effective: it's coherent with the world we want to help build.</p>
<p>This is the ground we'll be writing from. Welcome to our journal.</p>
HTML;

        DB::table('posts')->insert([
            'slug' => 'o-que-e-comunicacao-regenerativa',
            'title_pt' => 'O que é comunicação regenerativa (e porque é que importa)',
            'title_en' => 'What regenerative communication is (and why it matters)',
            'excerpt_pt' => 'Boa parte da comunicação funciona como a agricultura industrial: extrai o máximo no menor tempo e deixa o terreno exausto. Há outra forma — e começa por olhar para a comunicação como quem cuida do solo.',
            'excerpt_en' => "Much of communication works like industrial farming: it extracts the most in the least time and leaves the ground exhausted. There's another way — and it starts by treating communication like tending soil.",
            'body_pt' => $bodyPt,
            'body_en' => $bodyEn,
            'cover_path' => null,
            'author_name' => 'asfouri',
            'published_at' => now(),
            'is_published' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
