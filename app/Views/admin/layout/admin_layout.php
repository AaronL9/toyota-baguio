<?php

/**
 * @var array $js
 */

use App\Libraries\Vite;

$vite = new Vite();
$tags = $vite->tags(...$js)
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Toyota Ilocos Sur</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <base href="<?= base_url() ?>">

    <?= $tags->css ?>
</head>

<body class="flex flex-col min-h-screen">

    <?= $this->renderSection("login_content") ?>
    <?= $this->renderSection("sidebar") ?>
    <?= $this->renderSection("adminContent") ?>

    <?= $tags->js ?>
</body>

</html>