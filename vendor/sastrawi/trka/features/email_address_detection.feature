Feature: Email Address Detection
  I need to be able to detect email address from any given text

  Scenario: Detect email address #1
    Given The following text:
      """
      Budi mengirim email ke andylibrian@gmail.com untuk menanyakan perihal sastrawi.
      """
    When I detect email address
    Then I should get the following email address:
      """
      andylibrian@gmail.com
      """

  Scenario: Detect email address #2
    Given The following text:
      """
      andylibrian@gmail.com tidak dapat menerima email baru.
      """
    When I detect email address
    Then I should get the following email address:
      """
      andylibrian@gmail.com
      """

  Scenario: Detect email address #3
    Given The following text:
      """
      Budi mengirim email ke andylibrian@gmail.com. Dia tidak mendapat jawaban.
      """
    When I detect email address
    Then I should get the following email address:
      """
      andylibrian@gmail.com
      """

  Scenario: Detect email address #4
    Given The following text:
      """
      andyajadeh@gmail.com mengirim email ke andylibrian@gmail.com.
      """
    When I detect email address
    Then I should get the following email address:
      """
      andyajadeh@gmail.com andylibrian@gmail.com
      """

