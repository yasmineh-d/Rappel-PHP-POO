<?php
declare(strict_types=1);

class Article {
    public int $id;
    public string $title;
    public ?string $excerpt = null;
    public int $views = 0;

    public function __construct(int $id, string $title) {
        $this->id = $id;
        $this->title = $title;
    }

    public function incrementViews(int $delta = 1): void {
        $this->views += max(0, $delta);
    }
}

$a = new Article(1, 'Intro Laravel');
$a->incrementViews();

// Hna fin ghadi nzidou l'affichage
echo '<pre>'; // <pre> bach l'output it organizar mzyan f l'navigateur
print_r($a);
echo '</pre>';

echo '<hr>'; // bach nferqo binathom

echo '<pre>';
var_dump($a);
echo '</pre>';
?>