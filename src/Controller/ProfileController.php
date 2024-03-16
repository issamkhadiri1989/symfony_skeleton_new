<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\FavoriteType;
use App\Form\Type\ProfileType;
use App\Service\Favorite\Favorite;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/profile', name: 'app_profile_')]
#[IsGranted('ROLE_USER')]
class ProfileController extends AbstractController
{
    #[Route('/edit', name: 'homepage')]
    public function edit(
        #[CurrentUser]
        User $user,
        Request $request,
    ): Response {
        // $user = $this->getUser();

        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/favorites', name: 'favorites')]
    public function index(
        #[CurrentUser]
        User $user,
        Request $request,
        Favorite $favorite,
    ): Response {
        $form = $this->createForm(FavoriteType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $favorite->handleFavorite($user);

            return $this->redirectToRoute('app_profile_favorites');
        }

        return $this->render('profile/favorites.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
