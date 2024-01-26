<?php

use Timber\Timber;

$context = Timber::context();

Timber::render('templates/partials/footer.twig', $context);
