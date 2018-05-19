Feature: Behavior tests

  @homepage
  Scenario: See the home page
    Given I am on the homepage
    Then I should see "Symfony 3.2.13"

  @product
  Scenario: See the products page
    When I go to "/products"
    Then I should see "Products"
    Then I should see 101 "a" elements
    When I click "2" link
    Then I should see "Product_1"
    Then I should see "Category_1"
    Then I should see "Brand_1"

  @brand
  Scenario: See the brands page
    When I go to "/brands"
    Then I should see "Brands"
    Then I should see 11 "a" elements
    When I click "1" link
    Then I should see "Brand_0"
    Then I move backward one page
    When I click "2" link
    Then I should see "Brand_1"
    Then I should see "Products"
    Then I should see 20 "a" elements
    When I click "1" link
    Then I should see "Brand_1"
    Then I should see "Category_1"
    Then I should see "Product_1"

  @category
  Scenario: See the categorys page
    When I go to "/categories"
    Then I should see "Categories"
    Then I should see 11 "a" elements
    When I click "1" link
    Then I should see "Category_0"
    Then I move backward one page
    When I click "2" link
    Then I should see "Category_1"
    Then I should see "Products"
    Then I should see 10 "a" elements
    When I click "1" link
    Then I should see "Brand_1"
    Then I should see "Category_1"
    Then I should see "Product_1"