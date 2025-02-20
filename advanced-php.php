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

<h2>3.4/32 - Dependency Injection Container With & Without Reflection API</h2>

<p>
    In this lesson, we create a simple but working dependency injection container following the PSR-11 Container
    Interface. We begin by installing the PSR Container Interface using <code>composer require psr/container</code>.
    The package provides simple interfaces, other classes and functionality that we can use to build up our container.
</p>

<p>
    To start, our <code>Container</code> should implement the <code>ContainerInterface</code> interface which has two
    methods that must be implemented: <code>get($id)</code> and <code>has($id)</code> methods. The
    <code>get($id)</code> returns an instance of the dependency while the <code>has($id)</code> checks whether the
    dependency has a binding in our container using the <code>$id</code> parameter. In both cases, the <code>$id</code>
    parameter is usually the fully qualified name of the service (or dependency) class. <br>
    The services are stored in the container as an array (preferably as a static property). <br>
    It is important to also notice that the <code>ContainerInterface</code> provided by PSR does not include a
    <code>set()</code> method to be implemented since different containers may have a different pattern to set up the
    service bindings and may take different arguments. It is up to you to choose if you need it, and how to do it. In
    our case, we implement a simple <code>set(string $id, callable $concrete)</code> method to bind services in our
    container. The method takes the name of the class as <code>$id</code> and a callable <code>$concrete</code> which
    should accept our <code>Container</code> instance and return a concrete instance of the service. The
    <code>Container</code> passed to the <code>set()</code> method allows it to have access to the container and also
    instantiate the dependencies of the method as needed.
</p>

<p>
    Lastly, the services are registered towards the beginning of the callstack (say, in the <code>App</code> class) and
    can now be accessed in the controllers or where they are needed. This basic implementation works well but has
    potential flaws or maybe, should have even more features, like: caching the service instantiating, automatically
    instantiating the class if the service does not require any dependency or letting the container automatically figure
    out how to instantiate the classes even without registering them.
</p>

<p>
    An improved version of our Dependency Injection Container has the <b>autowiring</b> feature that allows it to
    instantiate a service (or dependency) class without registering them. It uses the <code>Reflection API</code> to
    inspect the behaviour and structure of the class and determine which services the constructor needs and
    instantiates as need may be, if possible.
</p>

<p>
    The <code>Reflection API</code> provides methods, classes and interfaces which mirror a class and gives us access
    to information or details about a class, thus, allowing us to inspect the class.
</p>

<h2>3.5/32 - DI Container With Interface Support</h2>

<p>
    The Dependency Injection container we built in the last lesson, while improved lacked many essential features that
    are required for most application. Some of these features include: caching, singleton support, optional parameters,
    interface support etc. In this lesson, we'll add support for injecting interfaces to DI container.
</p>

<p>
    One way to do this by simply binding the interface to a concrete implementation in the container using the usual
    <code>set()</code> method passing the fully qualified name of the interface as the <code>$id</code> parameter and a
    closure that returns the concrete implementation of the interface. That way, the container instantiates the
    implementation whenever the interface is to be injected.
</p>

<p>
    To improve this feature, we could instead pass the fully qualified class name of the concrete implementation
    instead of worrying about how to instantiate it in the closure. That, way the interface is bound to the name of the
    concrete implementation of the class and takes care of the resolving the class. The <code>set()</code> method may
    be modified slightly to not only accept <code>callable</code> type but also <code>string</code> values for the
    <code>$concrete</code> parameter. That way we can pass the fully qualified name of the concrete implementation of
    the class.
</p>

<p>
    One huge benefit of supporting interfaces injection is that allows the concrete implementation to be swapped by a
    similar concrete implementation without rewriting the implementation of the old one.
</p>

<h2>3.6/32 - PHP Generators</h2>

<p>
    Generators provide an easy way to implement simple iterators without needing to build an array in memory.
    Generator functions, are like normal functions but can return (in this case, yield) as many values as specified.
    While the <code>return</code>statement stops the execution of a function and returns some value,
    the <code>yield</code> keyword <code>pauses</code> the execution of a function and returns the value.
</p>
<p>
    A generator function returns a <code>Generator</code> type and the generator function is not executed at the time
    the function is called. The execution begins when the <code>Generator</code> object returned by the generator
    function calls its <code>current</code> method for the first time. After this, the execution is paused when a
    <code>yield</code> function is encountered and can be resumed using the <code>next</code> method of the
    <code>Generator</code> object. <br>
    Note that the <code>Generator</code> type implements the <code>Iterator</code> interface and hence can be iterated
    over using the <code>foreach</code> loop and has access to the methods of an <code>Iterator</code> object.
</p>
<p>
    A generator function can <i>yield</i> a key-value pair using the syntax: <code>yield $key => $value</code>. And it
    can also return a value using the <code>return</code> statement which can be accessed using the
    <code>getReturn()</code> method. This method can however, be called only when all values have been yielded.
</p>
<p>
    Generators can be used in fetching database records in a lazy manner, reading contents of a file and populating
    data structures on demand. However, <code>Generator</code> can only yield a value once - it cannot be iterated over
    and over again and the <code>rewind()</code> method from the <code>Iterator</code> class cannot be called on it
    once the generator starts yielding a value.
</p>

<h2>3.7/32 - PHP WeakMap</h2>

<p>
    The <code>WeakMap</code> class stores weak references of objects. In PHP, when a variable is created, it is stored
    in memory. When the variable is assigned a value, a data structure known as <i>zend value</i> container or
    (<i>zval</i> in short) is stored separately which holds the information about the variable. However, the value
    assigned to it is not stored in the <i>zval</i>, rather it is stored separately and an <i>id</i> stored in the
    <i>zval</i> points to the value. This way, even if a variable is created, and another variable created is assigned
    to the first, unsetting the first one does not affect the second. PHP does not garbage-collect the value but only
    removes the reference of the first one to the value; the value is still intact and the <code>zval</code> of the
    second one still has a reference to the value stored. The value is garbage-collected only when there is no other
    reference to it, usually at the end of the script.
</p>

<p>
    In PHP 7.4, the <code>WeakReference</code> class was introduced which stores a weak reference to an object. When a
    weak reference of an object is created, the reference is lost when the original value is unset. A weak reference is
    created using <code>$ref = WeakReference::create($object)</code> which returns a (weak) reference to the object. The
    object can be accessed using the <code>$ref->get()</code> method. Once the original object (<code>$object</code>)
    is unset, the value of <code>$ref->get()</code> becomes <code>NULL</code>.
</p>
<p>
    PHP 8 introduced <code>WeakMap</code> which stores weak references of object. It is much similar to the
    <code>SplObjectStorage</code> class, except that this class stores hard references. A weak map is created by
    invoking the constructor of the <code>WeakMap</code> class, thus: <code>$map = new WeakMap()</code>. You can add a
    reference to an object using array square bracket syntax: <code>$map[$object] = $someInfo</code>. Hence, the weak
    map can be used to store information associated with an object but not directly stored within the object. An object
    may be garbage-collected if the only reference to it is that which is stored in the weak map. That is, if an object
    is unset and there is no other reference to it, except in the weak map, then the value of the object is garbage
    collected.
</p>
<p>
    While <code>WeakMap</code> may not be used frequently, it is very useful in application, packages or libraries
    where caching, memoization, and prevent memory leaks in long-running processes. A few thing to note about the
    <code>WeakMap</code> class is that the key must be an <code>object</code>; you cannot also append a value using the
    array square bracket syntax (i.e. <code>$map[] = $someInfo</code>) and lastly, trying to access a value which does
    not exist in the weak map throws an error.
</p>

<h2>3.8/32  - What's New In PHP 8.1 - Deprecations & Backward Incompatible</h2>

<p>
    In this lesson, we'll discuss the new features in PHP 8.1:
</p>
<ul>
    <li>
        <b>Array unpacking with string keys: </b> While prior version of PHP supports array unpacking for indexed array
        only, PHP 8.1 adds array unpacking with string keys using the same syntax.
    </li>
    <li>
        <b>Enumerations: </b> With enums, you can define fixed set of values. Enums allow you to type arguments where
        you wish to accept only a given set of values e.g. payment status codes, etc. Enums are like normal PHP class
        defined using the <code>enum</code> keyword. The set of values are defined as cases, using the <code>case</code>
        keyword. Enums can have methods, implement interfaces, etc. The case are like objects of that particular enum
        class.
    </li>
    <li>
        <b>Readonly Properties: </b> You can mark your properties as readonly so that they can't be overwritten when set
        the first time. PHP 8 introduces promoted properties so that we can set the properties in the method argument
        list. With PHP 8.1, we can mark these properties as readonly using the <code>readonly</code> keyword. By
        defining our properties as <code>readonly</code>, we can safely set their access level as <code>public</code>
        without worry that it may be overwritten externally. Properties can be marked as <code>readonly</code> as
        promoted properties or during property definitions. They can only be marked on properties whose type have been
        defined. Additionally, properties defined to be <i>readonly</i> during property definition cannot have default
        values. Default values can only be set to the parameters which are defined as promoted (readonly) properties,
        for example <code>public readonly string $country='US'</code> in parameter definition but not in
        property definition. This is because the default value is set to the parameter which is then received by the
        property if a value is not passed.
    </li>
    <li>
        <b>Pure Intersection Types (&)</b> - While union type (|) allow a function or method to receive arguments for
        any of the specified types for a given parameter, PHP 8.1 introduces intersection types which require that the
        value passed must be of the two types specified. This prevents us from creating another interfaces which implement
        two types so that we can ensure that the value passed implements both interface. You cannot use both union and
        intersection types; you cannot also use intersection types with primitive data types since you can't have a
        value which is 'string' and another type. Intersection types are very useful when working with interfaces.
    </li>
    <li>
        <b>Never Return types: </b>The <code>never</code> return type is used to indicate that the function never
        returns a value. That is, the function or method is expected to stop the execution by an <code>exit</code>
        statement or an error is thrown. The <code>void</code> return type specifies that the function or method
        returns "nothing" while the <code>never</code> return type specifies that the function does not return anything.
    </li>
    <li>
        <b><code>array_is_list</code> method: </b>List is an array with ordered numerical indexes. The function checks
        whether a given array qualifies as a list. This is useful if we wish to verify an array is a list, especially
        when the array is returned from other functions (e.g. <code>array_filter()</code> does not re-order the keys;
        this can be fixed using <code>array_value()</code>) or passed as an argument.
    </li>
    <li>
        <b>First-class callable syntax: </b> PHP 8.1 introduced a "first-class" callable syntax to create closures from
        another closure or functions. Before now, the Closure::fromCallable($functionName) method was used to create a
        closure from another function. Now, you can create a closure using the functionName(...) syntax i.e. to create
        a closure from a function "sum", <code>sum(...)</code> returns a closure that can be called like the
        original <code>sum</code> function.
    </li>
    <li>
        <b>New In Initialisers: </b> PHP 8.1 allows you to initialise object instances as default argument in a function
        or method. When an argument is not passed for the parameter, the new object is then instantiated and used.
        This is only allowed in the parameter definitions and not in the property definitions.
    </li>
    <li>
        <b>Final Constants: </b> With constants marked as "final" using the <code>final</code> keyword, we can prevent
        the value of a constant to be overwritten during inheritance by a child class.
    </li>
</ul>
<p>
    Other changes or additions which are not discussed include: <code>fsync()</code>, <code>pcntl_rfork()</code>,
    <code>fdatasync()</code>, full path key for file uploads, fibers etc. Some of which is advanced and beyond the
    scope of the lesson.
</p>

<h4>Backward Incompatible Changes</h4>

<ul>
    <li>
        Static variables in inherited methods are now shared when they are not overwritten. This means that when a
        static variable (a variable declared with <code>static</code> whose values are not garbage-collected after the
        method or function is called) is used in a parent method, the child method will now make use of the static
        variable if the method is not over-ridden by the child. Before now, the child method would have a separate
        static variable for itself while the parent keeps its own to itself. This is important as it affects how a
        class and its child classes behave when making use of the static variable.
    </li>

    <li>
        Integers and floats in result sets will now be returned using native PHP types instead of strings when using
        emulated prepared statements. This matches the behaviour of native prepared statements. The previous behaviour
        can be restored by enabling the <code>PDO::ATTR_STRINGIFY_FETCHES</code> option.
    </li>
</ul>

<h4>Deprecations</h4>

<ul>
    <li>
        Implementing <code>Serializable</code> without <code>__serialize()</code> and <code>__unserialize()</code>
        method is now deprecated.
    </li>

    <li>
        Passing <code>null</code> to non-nullable parameters of built-in functions is no longer allowed. Previously,
        built-in functions may accept <code>null</code> for even non-nullable parameters; this deprecation makes the
        built-in function similar to the user-defined functions.
    </li>

    <li>
        Implicit incompatible <code>float</code> to <code>int</code> conversions <em>which leads to a loss in
        precision</em> is now deprecated.
    </li>
</ul>

<p>For other changes, you can always visit the official PHP documentation for more information.</p>