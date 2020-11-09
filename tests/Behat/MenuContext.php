<?php

declare(strict_types=1);

/*
 * This file is part of the Carte-API Apps package.
 *
 * (c) Dev-Int Création <devint.creation@gmail.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Behat;

use Application\ReadModel\Menu\Menu;
use Behat\Behat\Context\Context;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class MenuContext implements Context
{
    /**
     * @var ResponseInterface
     */
    private $response;
    /**
     * @var HttpClientInterface
     */
    private $client;
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct(HttpClientInterface $client, SerializerInterface $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;
    }

    /**
     * @When /^I request a list of menus from "([^"]*)"$/
     *
     * @throws TransportExceptionInterface
     */
    public function iRequestAListOfMenusFrom(string $arg1): bool
    {
        $this->response = $this->client->request('GET', $arg1, ['verify_peer' => false, 'verify_host' => false]);

        $responseCode = $this->response->getStatusCode();

        if (200 !== $responseCode) {
            throw new \RuntimeException('Expected a 200, but received ' . $responseCode);
        }

        return true;
    }

    /**
     * @Then /^The results should include a menu with label "([^"]*)"$/
     */
    public function theResultsShouldIncludeAMenuWithLabel(string $arg1): bool
    {
        /** @var Menu[] $menus */
        $menus = \json_decode($this->response->getContent(), true);

        foreach ($menus as $menu) {
            $menu = $this->serializer->deserialize($menu, Menu::class, 'json');
            \assert($menu instanceof Menu);
            if ($menu->getLabel() === $arg1) {
                return true;
            }
        }

        throw new \Exception('Expected to find customer with a label like ' . $arg1 . ' , but didnt');
    }
}
