<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Sastrawi\Trka\Finder\EmailAddressFinderFactory;
use Sastrawi\Trka\Finder\NumberFinderFactory;
use Sastrawi\Trka\Finder\HostnameFinderFactory;
use Sastrawi\Trka\Finder\AbbreviationFinderFactory;
use Sastrawi\Trka\Finder\UrlFinderFactory;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    private $emailAddressFinder;

    private $numberFinder;

    private $hostnameFinder;

    private $abbreviationFinder;

    private $urlFinder;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $emailAddressFinderFactory = new EmailAddressFinderFactory();
        $this->emailAddressFinder  = $emailAddressFinderFactory->create();

        $numberFinderFactory = new NumberFinderFactory();
        $this->numberFinder  = $numberFinderFactory->create();

        $hostnameFinderFactory = new HostnameFinderFactory();
        $this->hostnameFinder  = $hostnameFinderFactory->create();

        $abbreviationFinderFactory = new AbbreviationFinderFactory();
        $this->abbreviationFinder  = $abbreviationFinderFactory->create();

        $urlFinderFactory = new UrlFinderFactory();
        $this->urlFinder  = $urlFinderFactory->create();
    }

    /**
     * @Given The following text:
     */
    public function theFollowingText(PyStringNode $string)
    {
        $this->text = (string) $string;
    }

    /**
     * @When I detect email address
     */
    public function iDetectEmailAddress()
    {
        $this->detectedEmailAddresses = $this->emailAddressFinder->find($this->text);
    }

    /**
     * @Then I should get the following email address:
     */
    public function iShouldGetTheFollowingEmailAddress(PyStringNode $string)
    {
        $text = (string) $string;
        $tokens = array();

        foreach ($this->detectedEmailAddresses as $emailAddress) {
            $tokens[] = $emailAddress->getCoveredText($this->text);
        }

        $tokens = implode(' ', $tokens);

        \PHPUnit_Framework_Assert::assertEquals($text, $tokens);
    }

    /**
     * @When I detect number
     */
    public function iDetectNumber()
    {
        $this->detectedNumbers = $this->numberFinder->find($this->text);
    }

    /**
     * @Then I should get the following numbers:
     */
    public function iShouldGetTheFollowingNumbers(PyStringNode $string)
    {
        $text = (string) $string;
        $tokens = array();

        foreach ($this->detectedNumbers as $token) {
            $tokens[] = $token->getCoveredText($this->text);
        }

        $tokens = implode(' ', $tokens);

        \PHPUnit_Framework_Assert::assertEquals($text, $tokens);
    }

    /**
     * @When I detect hostname
     */
    public function iDetectHostname()
    {
        $this->detectedHostnames = $this->hostnameFinder->find($this->text);
    }

    /**
     * @Then I should get the following hostname:
     */
    public function iShouldGetTheFollowingHostname(PyStringNode $string)
    {
        $text = (string) $string;
        $tokens = array();

        foreach ($this->detectedHostnames as $token) {
            $tokens[] = $token->getCoveredText($this->text);
        }

        $tokens = implode(' ', $tokens);

        \PHPUnit_Framework_Assert::assertEquals($text, $tokens);
    }

    /**
     * @When I detect its abbreviation
     */
    public function iDetectItsAbbreviation()
    {
        $this->detectedAbbreviations = $this->abbreviationFinder->find($this->text);
    }

    /**
     * @Then I should get the following abbreviations:
     */
    public function iShouldGetTheFollowingAbbreviations(PyStringNode $string)
    {
        $text = (string) $string;
        $tokens = array();

        foreach ($this->detectedAbbreviations as $token) {
            $tokens[] = $token->getCoveredText($this->text);
        }

        $tokens = implode(' ', $tokens);

        \PHPUnit_Framework_Assert::assertEquals($text, $tokens);
    }

    /**
     * @When I detect url
     */
    public function iDetectUrl()
    {
        $this->detectedUrls = $this->urlFinder->find($this->text);
    }

    /**
     * @Then I should get the following url:
     */
    public function iShouldGetTheFollowingUrl(PyStringNode $string)
    {
        $text = (string) $string;
        $tokens = array();

        foreach ($this->detectedUrls as $token) {
            $tokens[] = $token->getCoveredText($this->text);
        }

        $tokens = implode(' ', $tokens);

        \PHPUnit_Framework_Assert::assertEquals($text, $tokens);
    }
}
