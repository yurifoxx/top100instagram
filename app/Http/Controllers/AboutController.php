<?php

namespace App\Http\Controllers;

class AboutController extends Controller
{
    public function index()
    {
        $seo = [
            'title'       => 'Sobre o Ranking | Top 100 Instagram Brasil',
            'description' => 'Saiba como funciona o ranking dos 100 perfis do Instagram com mais seguidores no Brasil. Metodologia, critérios e perguntas frequentes.',
            'canonical'   => route('about'),
        ];

        return view('about', compact('seo'));
    }
}
