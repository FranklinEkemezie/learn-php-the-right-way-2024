<?php
declare(strict_types=1);
?>

<h2>3.0/32 - PHP OOP Tutorial Section 3 - Intro to Testing</h2>

<p>In this section, we'll discuss more advanced concepts in PHP like:
<ul>
    <li>Testing & PHPUnit</li>
    <li>Dependency Injection Container</li>
    <li>APIs, JSON & Curl</li>
    <li>Generators</li>
    <li>Reflection API</li>
    <li>PHP 8 (i.e. Attributes)</li>
    <li>Data Mapper Pattern</li>
    <li>DTO</li>
    <li>Caching & Security (XSS, CSRF)</li>
    <li>Schedule Jobs</li>
    <li>Hosting & Deployment</li>
    <li>Build an App</li>
</ul>
</p>


<p>
    Tests allows you to test your application automatically. It helps boost confidence level when making or modifying
    the code later as it ensures that the application works as expected all the time. <br>

    Some common types of testing include - accessibility, acceptance, end-to-end, functional, integration, load, unit,
    stress, regression, smoke testing etc. For the purpose of this course, we'll take a look at unit testing as well as
    integration testing.

<ul>
    <li>
        <b>Unit Tests</b> -
        Tests small piece of code (i.e. single function) & mocks/fakes any needed dependencies or database connections.
    </li>

    <li>
        <b>Integration Tests</b> -
        Test multiple modules or units together (i.e. method that connects to database, runs queries & returns
        something). Dependencies can be resolved & can use database connection.
    </li>


</ul>
</p>

<p>
    In testing, two common terminologies are common:
    TDD - Test Driven development and BDD - Behaviour Driven development. <br>

    In both paradigm, test are written before the main code is written and then the test is run to check if the code
    passes the test.
</p>

<h2>3.1/32 - PHP Unit Testing</h2>
<p>
    PHPUnit allows us to write unit tests. The script to run the file is located in <code>vendor/bin/phpunit</code> and
    accepts several options. <br>
    The <code>phpunit.xml</code> file is an XML file holding the configuration for the test. It specifies how to load
    the test files, and where to load them.
</p>

<p>
    By convention, test classes are prefixed with <code>Test</code>. They should extend the <code>TestCase</code>
    class. <br>
    A method in a test class is considered as a test method if it begins with "test" or it has the
    <code>/** @test */</code> annotation on it.
</p>

<p>
    We can use the <code>assertEquals</code> method to check if the expected value of a test equals the result value.
    In cases where an exception should be thrown, the <code>expectException</code> is placed before the code that should
    throw the exception in order to test it.
</p>

<p>
    The parent <code>TestCase</code> method also provides the <code>setUp</code> method which allows us to set up and
    even register/attach some values to the test class which can be used in other test methods. This method is called
    before the testing occurs and helps to make a value available throughout other methods. <br>
    Another useful method is the <code>tearDown</code> method which can be used to close, or terminate
    resource-intensive operation that were initiated.
</p>
<p>
    Sometimes we may need to make the same test but with different argument, we can use data providers to provide the
    values for the arguments. The argument(s) that should be tested are specified as parameter to the test method and
    the cases for the method is provided using a data provider. Data providers are basically static and public method
    which returns an array of arrays or an iterator object which yields an array on every iteration.
    The array is an indexed list of the argument to be passed as cases. The data provided is specified by adding the
    <code>/** @dataProvider [name_of_data_provider] */</code> to other annotations.
    Note that if you wish to have a <code>DataProvider</code> class or namespace to separate your data providers from
    the test cases, be sure to autoload via the composer.json by adding an "autoload-dev" key with necessary configuration
    (which should be identical to the "autoload" key). This ensures that the classes within the <code>test/</code>
    directory are loaded properly.
</p>

<p>Lastly, use <code>assertEquals</code> only when a strict comparison between the expected outcome and the result is
    not needed. The <code>assertSame</code> asserts using strict comparison, thus, it checks if the values are identical
    (same value and same type) and also ensure that object values are basically the same object rather than different copies
    of the same object.</p>