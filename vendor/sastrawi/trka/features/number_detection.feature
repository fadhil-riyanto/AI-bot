Feature: Number Detection
  I need to be able to detect numeric entity from any given text

  Scenario: Detect number #1
    Given The following text:
      """
      1945 adalah tahun kemerdekaan Indonesia.
      """
    When I detect number
    Then I should get the following numbers:
      """
      1945
      """

  Scenario: Detect number #2
    Given The following text:
      """
      Tahun kemerdekaan Indonesia adalah 1945.
      """
    When I detect number
    Then I should get the following numbers:
      """
      1945
      """

  Scenario: Detect number #3
    Given The following text:
      """
      Harganya adalah Rp 2.500.000 tanpa diskon.
      """
    When I detect number
    Then I should get the following numbers:
      """
      2.500.000
      """
  
  Scenario: Detect number #4
    Given The following text:
      """
      Harganya adalah Rp. 2.500.000.
      """
    When I detect number
    Then I should get the following numbers:
      """
      2.500.000
      """

  Scenario: Detect number #5
    Given The following text:
      """
      Beratnya 4.000,5 kg.
      """
    When I detect number
    Then I should get the following numbers:
      """
      4.000,5
      """

