<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InstagramProfile;
use App\Models\Category;
use Carbon\Carbon;

class InstagramProfileSeeder extends Seeder
{
    public function run(): void
    {
        $cat = fn(string $name) => Category::where('name', $name)->value('id');

        $profiles = [
            [1,  'neymarjr',           'Neymar Jr',              220_000_000, true,  'atleta',     4,  'Jogador de futebol brasileiro, Paris Saint-Germain e Seleção Brasileira.'],
            [2,  'anitta',             'Anitta',                  65_000_000, true,  'musico',     2,  'Cantora e empresária carioca, uma das artistas mais seguidas do Brasil.'],
            [3,  'matheuscarrieri',    'Matheus Carrieri',        55_000_000, true,  'humorista',  1,  'Ator e comediante, famoso por vídeos de humor nas redes sociais.'],
            [4,  'whindersson',        'Whindersson Nunes',       53_000_000, true,  'humorista',  0,  'Youtuber e comediante piauiense, um dos maiores criadores de conteúdo do Brasil.'],
            [5,  'ogilbertogil',       'Gilberto Gil',            51_000_000, true,  'musico',    -1,  'Cantor, compositor e ex-Ministro da Cultura. Ícone da música brasileira.'],
            [6,  'ivete',              'Ivete Sangalo',           47_000_000, true,  'musico',     3,  'Cantora baiana e apresentadora, um dos maiores nomes do axé music.'],
            [7,  'gessicapassosoficial','Gessica Kayane',         44_000_000, true,  'influencer', 2,  'Influenciadora digital e YouTuber, uma das maiores do Brasil.'],
            [8,  'camila_queiroz',     'Camila Queiroz',          43_000_000, true,  'ator',       0,  'Atriz brasileira conhecida por Angel em Verdades Secretas.'],
            [9,  'felipelessa',        'Felipe Neto',             43_000_000, true,  'influencer', 1,  'YouTuber e influenciador digital, um dos maiores do Brasil.'],
            [10, 'sabrinasato',        'Sabrina Sato',            40_000_000, true,  'influencer', -2, 'Apresentadora, atriz e influenciadora japonesa-brasileira.'],
            [11, 'luana_piovani',      'Luana Piovani',           38_000_000, true,  'ator',       0,  'Atriz, apresentadora e modelo brasileira.'],
            [12, 'marcelloadnet',      'Marcelo Adnet',           36_000_000, true,  'humorista',  1,  'Humorista, ator e apresentador do Domingão do Fantástico.'],
            [13, 'taissearaujo',       'Taís Araújo',             35_000_000, true,  'ator',       2,  'Atriz e apresentadora brasileira.'],
            [14, 'juliannealves',      'Julianne Alves',          34_000_000, true,  'ator',       0,  'Atriz e apresentadora brasileira.'],
            [15, 'juliette',           'Juliette',                34_000_000, true,  'influencer', -1, 'Vencedora do BBB21, advogada e influenciadora digital.'],
            [16, 'bruna_marquezine',   'Bruna Marquezine',        42_000_000, true,  'ator',       3,  'Atriz brasileira conhecida por Marina em Em Família.'],
            [17, 'selmamariabr',       'Selma Maria',             32_000_000, true,  'influencer', 0,  'Influenciadora digital brasileira.'],
            [18, 'mckevin_o_chris',    'MC Kevin o Chris',        31_000_000, true,  'musico',     1,  'Funkeiro carioca com vários hits no Brasil.'],
            [19, 'nathycapponeraa',    'Nathy Caporner',          30_000_000, true,  'musico',     2,  'Cantora de funk carioca.'],
            [20, 'feroferroli',        'Ferozan Ferroli',         29_000_000, true,  'influencer', 0,  'Influenciadora digital e criadora de conteúdo.'],
            [21, 'mcgime',             'MC Gui',                  28_000_000, true,  'musico',     1,  'Cantor de funk e influenciador digital.'],
            [22, 'thiagosilvabr',      'Thiago Silva',            28_000_000, true,  'atleta',    -1,  'Zagueiro da Seleção Brasileira e Chelsea.'],
            [23, 'alissondecker1',     'Alisson Becker',          26_000_000, true,  'atleta',     0,  'Goleiro da Seleção Brasileira e Liverpool FC.'],
            [24, 'gabrielbarbosa',     'Gabigol',                 25_000_000, true,  'atleta',     2,  'Atacante do Flamengo e da Seleção Brasileira.'],
            [25, 'cassiaviterr',       'Cassia Viterr',           24_000_000, false, 'musico',     0,  'Cantora de forró e sertanejo universitário.'],
            [26, 'lucasneto',          'Lucas Neto',              23_000_000, true,  'influencer', 1,  'YouTuber e influenciador infantil mais famoso do Brasil.'],
            [27, 'lore_improta',       'Lorena Improta',          22_000_000, true,  'ator',       0,  'Dançarina e influenciadora digital.'],
            [28, 'fernandinhabegiato', 'Fernanda Begiato',        22_000_000, false, 'influencer', -1, 'Influenciadora digital e empresária.'],
            [29, 'virginiafonseca',    'Virginia Fonseca',        51_000_000, true,  'influencer', 5,  'Influenciadora digital e apresentadora do programa The Noite.'],
            [30, 'gilmesquita1',       'Gil do Vigor',            20_000_000, true,  'influencer', 0,  'Ex-BBB e economista, influenciador digital.'],
            [31, 'rodrigosaraiva',     'Rodrigo Saraiva',         19_500_000, false, 'influencer', 1,  'Influenciador digital e criador de conteúdo.'],
            [32, 'jadsonvieira_jv',    'Jadson Vieira',           19_000_000, false, 'humorista',  0,  'Comediante e criador de conteúdo digital.'],
            [33, 'eliezer',            'Eliezer',                 18_500_000, true,  'influencer', 2,  'Ex-BBB22 e influenciador digital.'],
            [34, 'robertocosta',       'Roberto Carlos',          18_000_000, true,  'musico',    -1,  'Rei da música brasileira, cantor e compositor.'],
            [35, 'maiara',             'Maiara',                  17_500_000, true,  'musico',     0,  'Cantora sertaneja da dupla Maiara & Maraisa.'],
            [36, 'maraisa',            'Maraisa',                 17_000_000, true,  'musico',     1,  'Cantora sertaneja da dupla Maiara & Maraisa.'],
            [37, 'leostronda',         'Leo Stronda',             16_500_000, false, 'influencer', 0,  'Fisiculturista e influenciador fitness.'],
            [38, 'zé_neto',            'Zé Neto',                 16_000_000, true,  'musico',     2,  'Cantor sertanejo da dupla Zé Neto & Cristiano.'],
            [39, 'dj_ivis',            'DJ Ivis',                 15_500_000, false, 'musico',    -2,  'DJ e produtor musical.'],
            [40, 'avelinah',           'Avelina',                 15_000_000, false, 'influencer', 0,  'Influenciadora digital e empresária.'],
            [41, 'luisaferre',         'Luísa Sonza',             25_000_000, true,  'musico',     3,  'Cantora pop brasileira com grandes hits nacionais.'],
            [42, 'marcosmoreiravlog',  'Marcos Moreira',          14_500_000, false, 'influencer', 1,  'Criador de conteúdo de viagens e estilo de vida.'],
            [43, 'maicons_oficial',    'Maicon Souza',            14_000_000, false, 'influencer', 0,  'Influenciador digital e empreendedor.'],
            [44, 'leleo_zl',           'Leleo ZL',                13_500_000, false, 'humorista',  2,  'Comediante da Zona Leste de São Paulo.'],
            [45, 'kayky_brito',        'Kayky Brito',             13_000_000, true,  'ator',       0,  'Ator global conhecido por Rebelde e outras novelas.'],
            [46, 'romario',            'Romário',                 12_800_000, true,  'atleta',    -1,  'Ex-jogador de futebol e político brasileiro.'],
            [47, 'ronaldo',            'Ronaldo Fenômeno',        52_000_000, true,  'atleta',     4,  'Ex-jogador de futebol e empresário brasileiro.'],
            [48, 'rodrigoroca',        'Rodrigo Roca',            12_200_000, false, 'influencer', 0,  'Criador de conteúdo digital.'],
            [49, 'alexfreitasbr',      'Alex Freitas',            12_000_000, false, 'influencer', 1,  'Influenciador digital.'],
            [50, 'rebecabrasil',       'Rebeca Andrade',          14_000_000, true,  'atleta',     6,  'Ginasta olímpica brasileira, medalhista nos Jogos Olímpicos.'],
        ];

        $now = Carbon::now();

        foreach ($profiles as [$rank, $username, $fullName, $followers, $verified, $catName, $change, $bio]) {
            InstagramProfile::updateOrCreate(
                ['username' => $username],
                [
                    'rank'           => $rank,
                    'full_name'      => $fullName,
                    'bio'            => $bio,
                    'followers_count'=> $followers,
                    'is_verified'    => $verified,
                    'category_id'    => $cat($catName),
                    'rank_change'    => $change,
                    'is_active'      => true,
                    'profile_url'    => 'https://instagram.com/' . $username,
                    'country'        => 'BR',
                    'last_updated_at'=> $now,
                ]
            );
        }
    }
}
