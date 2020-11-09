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

use Application\ReadModel\Product\Product;
use Behat\Behat\Context\Context;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ProductContext implements Context
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
     * @When /^I request a list of products from "([^"]*)"$/
     *
     * @throws TransportExceptionInterface
     */
    public function iRequestAListOfProductsFrom(string $arg1): bool
    {
        $this->response = $this->client->request('GET', $arg1, ['verify_peer' => false, 'verify_host' => false]);

        $responseCode = $this->response->getStatusCode();

        if (200 !== $responseCode) {
            throw new \RuntimeException('Expected a 200, but received ' . $responseCode);
        }

        return true;
    }

    /**
     * @Then /^The results should include a product with label "([^"]*)"$/
     */
    public function theResultsShouldIncludeAProductWithLabel(string $arg1): bool
    {
        /** @var Product[] $products */
        $products = \json_decode($this->response->getContent(), true);

        foreach ($products as $product) {
            $product = $this->serializer->deserialize($product, Product::class, 'json');
            \assert($product instanceof Product);
            if ($product->getLabel() === $arg1) {
                return true;
            }
        }

        throw new \Exception('Expected to find customer with a label like ' . $arg1 . ' , but didnt');
    }
}
