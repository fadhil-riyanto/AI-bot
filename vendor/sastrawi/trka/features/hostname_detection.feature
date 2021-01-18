Feature: Hostname Detection
  I need to be able to detect hostname from any given text

  Scenario: Detect hostname #1
    Given The following text:
      """
      Budi membuka halaman sastrawi.github.io untuk mencoba sastrawi.
      """
    When I detect hostname
    Then I should get the following hostname:
      """
      sastrawi.github.io
      """

  Scenario: Detect hostname #2
    Given The following text:
      """
      Budi membuka halaman sastrawi.github.io.
      """
    When I detect hostname
    Then I should get the following hostname:
      """
      sastrawi.github.io
      """

  Scenario: Detect hostname #3
    Given The following text:
      """
      sastrawi.github.io dibuka oleh Budi.
      """
    When I detect hostname
    Then I should get the following hostname:
      """
      sastrawi.github.io
      """
