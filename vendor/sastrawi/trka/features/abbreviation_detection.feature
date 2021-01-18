Feature: Abbreviation Detection
  I need to be able to detect abbreviation from any given text

  Scenario: Detect simple abbreviation
    Given The following text:
      """ 
      Budi pergi ke Jl. KH. Mukmin no. 67. Dia tersesat.
      """
    When I detect its abbreviation
    Then I should get the following abbreviations:
      """ 
      Jl. KH. no.
      """

  Scenario: Detect complex abbreviation
    Given The following text:
      """ 
      Budi mengirim uang ke rekening a.n. Budi. Uang tersebut adalah biaya kursus NLP Bahasa Indonesia.
      Budi sedang mencari kepanjangan dari a.m.v.b. yang membingungkan.
      """
    When I detect its abbreviation
    Then I should get the following abbreviations:
      """ 
      a.n. a.m.v.b.
      """
