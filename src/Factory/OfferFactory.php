<?php

namespace App\Factory;

use App\Entity\Offer;
use App\Repository\OfferRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Offer>
 *
 * @method        Offer|Proxy                     create(array|callable $attributes = [])
 * @method static Offer|Proxy                     createOne(array $attributes = [])
 * @method static Offer|Proxy                     find(object|array|mixed $criteria)
 * @method static Offer|Proxy                     findOrCreate(array $attributes)
 * @method static Offer|Proxy                     first(string $sortedField = 'id')
 * @method static Offer|Proxy                     last(string $sortedField = 'id')
 * @method static Offer|Proxy                     random(array $attributes = [])
 * @method static Offer|Proxy                     randomOrCreate(array $attributes = [])
 * @method static OfferRepository|RepositoryProxy repository()
 * @method static Offer[]|Proxy[]                 all()
 * @method static Offer[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Offer[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Offer[]|Proxy[]                 findBy(array $attributes)
 * @method static Offer[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Offer[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class OfferFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'fullDescription' => '<p>' . \implode('</p><p>', self::faker()->paragraphs(\rand(5, 10))) . '</p>',
            'shortDescription' => self::faker()->text(),
            'title' => self::faker()->text(60),
            'updatedAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Offer $offer): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Offer::class;
    }
}
