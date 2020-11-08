# This file contains a user story for demonstration only.
# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html

Feature: List of products
    In order to retrieve the list of products
    As a user
    I must visit the products page

    Scenario: I want a list of products
        When I request a list of products from "https://127.0.0.1:8000/api/products/list"
        Then The results should include a product with label "pizza"
