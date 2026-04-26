@extends('layouts.app')

@push('head')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    {
      "@@type": "Question",
      "name": "Quem é o brasileiro com mais seguidores no Instagram?",
      "acceptedAnswer": {
        "@@type": "Answer",
        "text": "Neymar Jr é o brasileiro com mais seguidores no Instagram, com mais de 220 milhões de seguidores."
      }
    },
    {
      "@@type": "Question",
      "name": "Com que frequência o ranking é atualizado?",
      "acceptedAnswer": {
        "@@type": "Answer",
        "text": "O ranking é revisado e atualizado regularmente, geralmente de forma diária ou semanal, para refletir as variações no número de seguidores."
      }
    },
    {
      "@@type": "Question",
      "name": "Como são escolhidos os perfis do ranking?",
      "acceptedAnswer": {
        "@@type": "Answer",
        "text": "Os perfis são selecionados com base no número de seguidores públicos no Instagram, priorizando brasileiros natos ou residentes que representam o Brasil."
      }
    }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BreadcrumbList",
  "itemListElement": [
    {"@@type":"ListItem","position":1,"name":"Top 100","item":"{{ route('home') }}"},
    {"@@type":"ListItem","position":2,"name":"Sobre","item":"{{ route('about') }}"}
  ]
}
</script>
@endpush

@section('content')

<div class="bg-gradient-to-br from-purple-700 to-pink-600 text-white py-12 px-4">
    <div class="max-w-3xl mx-auto text-center">
        <h1 class="text-3xl md:text-4xl font-black mb-3">Sobre o Ranking</h1>
        <p class="text-white/90">Saiba como funciona o Top 100 Instagram Brasil</p>
    </div>
</div>

<div class="max-w-3xl mx-auto px-4 py-12">

    <nav class="text-sm text-gray-500 mb-8">
        <a href="{{ route('home') }}" class="hover:text-purple-600">Ranking</a>
        <span class="mx-2">/</span>
        <span class="text-gray-700">Sobre</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-8">

        <section>
            <h2 class="text-xl font-bold text-gray-800 mb-3">O que é o Top 100 Instagram Brasil?</h2>
            <p class="text-gray-600 leading-relaxed">
                O <strong>Top 100 Instagram Brasil</strong> é o ranking mais completo e atualizado dos 100 perfis do Instagram
                com mais seguidores no Brasil. Reunimos celebridades, atletas, músicos, influenciadores digitais e humoristas
                que representam o que há de maior nas redes sociais brasileiras.
            </p>
        </section>

        <section>
            <h2 class="text-xl font-bold text-gray-800 mb-3">Metodologia</h2>
            <p class="text-gray-600 leading-relaxed mb-3">
                Os perfis são selecionados e ranqueados com base nos seguintes critérios:
            </p>
            <ul class="list-disc list-inside text-gray-600 space-y-2">
                <li>Número total de seguidores públicos no Instagram</li>
                <li>Perfil ativo (publicações recentes)</li>
                <li>Personalidades brasileiras natas ou residentes que representam o Brasil</li>
                <li>Conta pública e acessível</li>
            </ul>
        </section>

        <section>
            <h2 class="text-xl font-bold text-gray-800 mb-3">Com que frequência é atualizado?</h2>
            <p class="text-gray-600 leading-relaxed">
                O ranking é revisado regularmente para refletir as variações no número de seguidores.
                Cada perfil exibe o indicador de tendência (▲ subiu, ▼ caiu, — estável) em relação à última atualização.
            </p>
        </section>

        <section>
            <h2 class="text-xl font-bold text-gray-800 mb-6">Perguntas Frequentes</h2>

            <div class="space-y-5">
                <div>
                    <h3 class="font-semibold text-gray-800 mb-2">Quem é o brasileiro com mais seguidores no Instagram?</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Neymar Jr é o brasileiro com mais seguidores no Instagram, com mais de 220 milhões de seguidores,
                        sendo um dos perfis mais seguidos do mundo.
                    </p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800 mb-2">Qual a cantora brasileira com mais seguidores?</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Anitta é a cantora brasileira com mais seguidores no Instagram, com mais de 65 milhões de seguidores.
                    </p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800 mb-2">Quais as categorias do ranking?</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        O ranking é dividido em: Atletas, Músicos, Atores/Atrizes, Influencers, Humoristas, Modelos e Outros.
                    </p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800 mb-2">Como sugerir um perfil?</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Estamos sempre atualizando o banco de dados. Se você conhece um perfil que deveria estar no ranking,
                        nossos editores revisam periodicamente novos candidatos.
                    </p>
                </div>
            </div>
        </section>

    </div>

    <div class="mt-8 text-center">
        <a href="{{ route('home') }}"
           class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-pink-500 text-white px-6 py-3 rounded-full font-semibold hover:opacity-90 transition-opacity">
            📊 Ver o Ranking Completo
        </a>
    </div>

</div>

@endsection
