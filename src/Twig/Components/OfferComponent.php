<?php

namespace App\Twig\Components;

use App\Entity\Offer;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent()]
class OfferComponent
{
    public Offer $offer;
}
