<?php declare(strict_types=1);

use Doctrine\Common\Annotations\AnnotationRegistry;

$loader = require __DIR__ . '/../vendor/autoload.php';
AnnotationRegistry::registerLoader([$loader, "loadClass"]);
require_once __DIR__ . '/Cat.php';


$cats = [
    new Cat(1, 'brown', 'mruczek'),
    new Cat(2, 'white', 'szatan'),
    new Cat(3, 'mostly black', 'jasiu'),
    new Cat(4, 'brown & white', 'stefan'),
    new Cat(5, 'red', 'garfield'),
    new Cat(6, 'gray', 'rocket'),
    new Cat(7, 'brown', 'steve'),
];


$catId = (int) $_GET['id'];
$catToShow = null;

foreach ($cats as $cat) {
    if ($cat->getId() === $catId) {
        $catToShow = $cat;
    }
}

$objectable = new \Jadob\Objectable\Objectable();

?><!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>objectable example</title>
</head>
<body>
<?php echo $objectable->renderSingleObject($catToShow); ?>
</body>
</html>



