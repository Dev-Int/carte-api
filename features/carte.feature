# This file contains a user story for demonstration only.
# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html

Feature: List of cartes
    In order to retrieve the list of cartes
    As a user
    I must visit the cartes page

    Scenario: I want a list of cartes
        When I request a list of cartes from "https://127.0.0.1:8000/api/cartes/list"
        Then The results should include a carte with label "Carte d'été"
