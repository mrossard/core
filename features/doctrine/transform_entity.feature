Feature: Use an entity transformer to return the correct ressource

  @createSchema
  Scenario: Get collection
    Given there is a TransformedDummyEntity object for date '2025-01-01'
    When I send a "GET" request to "/transformed_dummy_ressources"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node "hydra:totalItems" should be equal to 1

  Scenario: Get item
    Given there is a TransformedDummyEntity object for date '2025-01-01'
    When I send a "GET" request to "/transformed_dummy_ressources/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node "year" should exist
    And the JSON node year should be equal to "2025"

