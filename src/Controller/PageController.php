<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[AsController]
class PageController
{
    public function __construct(private readonly Environment $renderer)
    {
        
    }

    #[Route(name: "app_homepage", path: "/")]
    public function homepage(): Response
    {
        $content = $this->renderer->render('page/homepage.html.twig');

        return new Response($content);
    }
}
