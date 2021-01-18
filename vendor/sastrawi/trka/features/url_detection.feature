Feature: URL Detection
  I need to be able to detect URL from any given text

  Scenario: Detect URL #1
    Given The following text:
      """
      Budi membuka halaman http://sastrawi.github.io/trka.html untuk mencoba sastrawi Trka.
      """
    When I detect url
    Then I should get the following url:
      """
      http://sastrawi.github.io/trka.html
      """

  Scenario: Detect premature URL
    Given The following text:
      """
      Budi membuka halaman sastrawi.github.io/trka.html untuk mencoba sastrawi Trka.
      """
    When I detect url
    Then I should get the following url:
      """
      sastrawi.github.io/trka.html
      """

