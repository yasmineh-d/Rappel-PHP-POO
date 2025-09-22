<?php
namespace App\Seed;

use App\Support\Str;

final class ArticleFactory
{
    /** @var string[] */
    private array $authors = ['Amine', 'Sara', 'Youssef', 'Nadia'];
    /** @var string[] */
    private array $topics  = ['PHP', 'Laravel', 'Mobile', 'UX', 'MySQL'];

    /**
     * @return array<int, array<string, mixed>>
     */
    public function make(int $count): array
    {
        $titles = [
            'Bonnes pratiques PHP',
            'Découvrir Eloquent',
            'API REST lisible',
            'Pagination & filtres',
            'Exceptions utiles'
        ];

        $used = [];
        $rows = [];

        for ($i = 1; $i <= $count; $i++) {
            $title = $titles[($i - 1) % count($titles)]." #$i";
            $slug  = Str::slug($title);

            // Garantir l’unicité du slug
            $base = $slug; $n = 2;
            while (isset($used[$slug])) {
                $slug = $base.'-'.$n++;
            }
            $used[$slug] = true;

            $content = "Contenu d’exemple pour « $title ». ".
                       "Cet article illustre la génération de seed JSON côté CLI.";

            // 0..3 tags au hasard
            $tags = array_values(array_unique(array_filter(array_map(function () {
                return (rand(0, 1) ? $this->topics[array_rand($this->topics)] : null);
            }, range(1, 3)))));

            $rows[] = [
                'title'        => $title,
                'slug'         => $slug,
                'excerpt'      => Str::excerpt($content, 180),
                'content'      => $content,
                'author'       => $this->authors[array_rand($this->authors)],
                'published_at' => date('c', time() - rand(0, 60 * 60 * 24 * 30)), // ≤ 30j
                'tags'         => $tags
            ];
        }

        return $rows;
    }
}
