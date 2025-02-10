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
    of the same object.
</p>

<h2>3.2/32 - Mocking</h2>

<p>
    In this lesson, we extend testing with PHPUnit to writing tests for functionalities which may require external
    classes (or services). To do this, PHPUnit provides methods for creating mock classes, stubbing methods so that we
    can simulate the functionality of a class without actually instantiating the class itself.
</p>

<p>
    The <code>createMock</code> method allows us to create mock classes; it accepts the original class name and returns
    a mock version of the class containing all the accessible methods of the original method. By default, the methods
    of the mock classes return <code>NULL</code>. The <code>NULL</code> returned may be type-casted if the return value
    of the method is specified when declaring the method. <br>. The mock classes can also be referred to as
    test doubles.
    In order to specify the expected return method for a method, PHPUnit provides a <code>method($methodName)</code>
    and is chained to another method: <code>willReturn($value)</code> to stub the test double's method so that we can
    specify that the <code>$methodName</code> of the test double returns <code>$value</code> instead of NULL. <br>
</p>

<p>

    We can also verify if some methods were invoked when another method is called. The <code>expects()</code> takes in
    an <code>InvocationOrder</code> object and returns an <code>InvocationMocker</code> method. An
    <code>InvocationOrder</code> method states how the method is expected to be invoked and object of these types can be
    easily created with PHPUnit's <code>TestCase</code> helper method e.g. <code>$this->once()</code> to indicate that
    the method is expected to be called once. We can then attach the <code>method($methodName)</code> followed by the
    <code>with(...$arguments)</code> method on the <code>InvocationMocker</code> object to specify that we expect the
    method <code>$methodName</code> of the test double class is expected to be called with the arguments specified in
    the <code>with()</code> method.
</p>

<h2>3.3/32 - Dependency Injection (DI) and Dependency Injection Containers</h2>

<p>
    Dependency Injection is a technique in which an object receives other objects that it depends on, called
    dependencies. <br>
    Many times, we may need to use a service that depends on another service as seen in our <code>InvoiceService</code>
    class. Instantiating the dependencies which the service requires in a method where it is needed is not ideal because
    it introduces tight coupling. Best practices are to accept these dependencies in the constructor instead of
    hard-coding them in the service class that needs it. That way the dependencies the class needs is being passed to it
    when the service is being instantiated. This principle is known as Inversion of Control (IOC) in software
    engineering which can be applied in many other scenarios aside from this. <br>
    The question to ask is which class should then instantiate the service? Since, the class which needs and therefore,
    tries to instantiate the class may also need those dependencies as its own dependencies. Towards the top of the
    function callstack is the Router where the controller class is instantiated which usually needs a service that has
    certain dependencies. However, different controllers may need different services making it hard to decide which one
    to instantiate and pass down when calling the method of a controller. Furthermore, instantiating the services in the
    router further leads to even more tight coupling as the router now has to know how to create those classes which it
    does not fundamentally use but only to pass it to the controller.<br>
    This is where <b>Dependency Injection (DI) containers</b> come in handy.
</p>

<p>
    Dependency Injection (DI) containers are classes responsible for instantiating other classes. They provide methods
    which allow an instance of a object to be created so that the class which needs it does not worry about creating
    them. There are different types of dependency injection techniques, but we'll focus on the most common one:
    constructor dependency injection. <br>
    In the next few lesson, we'll discuss in details about this type of dependency injection; how they work; how to
    implement a simple one following the PSR-11: Container Interface convention and lots more!
</p>