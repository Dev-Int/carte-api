# This file contains a user story for demonstration only.
# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html

Feature: List of menus
    In order to retrieve the list of menus
    As a user
    I must visit the menus page

    Scenario: I want a list of menus
        When I request a list of menus from "https://127.0.0.1:8000/api/menus/list"
        Then The results should include a menu with label "Tradition"
