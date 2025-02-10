<?php
declare(strict_types=1);
?>

<h2>2.1 / 33 - PHP INTRO TO OOP</h2>

<p>
    In the last section, we took a look at procedural programming, where
    the application logic is encapsulated in functions which ideally take in
    global variables and work on (a copy of - as local variables) them returning
    some value back, if need be.
</p>

<p>
    In this section, we will explore the Object-Oriented Programming (OOP) paradigm.
    In this, application logic is encapsulated in what is called classes. A class usually
    maps out to real world entity which has some properties and methods (functions belonging
    to a particular class).
    <p>
        A <i>class</i> is analogous to the blueprint for architectural constructions. It defines
        what an <i>object</i> created from it can do, what it should have (i.e. some sort of attributes)
        called properties and what it can also do. For illustration, the blueprint of a building can
        be considered the <i>class</i>. Any <i>object</i> (i.e. a particular house) created from that
        building do not need to be exactly the same as any other created from it but they should possess 
        similar attributes like roof, garage, room structure etc. The difference may be in the colours of the rooms, etc.
        Another good illustration is the general knowledge of a fruit, an animal, or a car. These are generic names for real world
        objects which have certain properties and can perform certain actions to qualify as a fruit e.g. colour, taste, has a seed, etc,
        or animal - legs, colour, makes some sound, or a car - type of car, speed limit, engine design etc.
    </p>
    <p>
        Objects are therefore considered to be instances of a class. <br>
        And in programming, classes or objects do not need to refer to concrete terms we can see or touch. It can be some representation
        of a Transaction, a User, a File resource etc.
    </p>
</p>

<p>
    <h4>Why OOP?</h4>
    OOP principles and features allow us to:
    <ul>
        <li>Write better structured code</li>
        <li>Write easy-to-maintain code</li>
        <li>Makes code modular (separation of logic in different files)
            and thus, re-usable as well as easily extendable
        </li>
        <li>Flexibilty</li>
        <li>On Demand</li>
    </ul>
    We can write pretty good code in procedural programming, but OOP makes it easier to
    do so.
</p>

<p>A common misconception is that OOP is the same as <i>MVC</i>. OOP as we have
    seen is programming paradigm (sort of a programming thought process) while
    MVC is a architectural (design) pattern. We'll talk about design pattern later on.
    But simply put, MVC is a design pattern (a way of designing your code to solve some particular problem)
    and it leverages the OOP principles.
</p>
<p>
    <h4>OOP Principles</h4>
    The four main principles of OOP are:
    <ul>
        <li>Polymorphism</li>
        <li>Abstraction</li>
        <li>Inheritance</li>
        <li>Encapsulation</li>
    </ul>
    We'll discuss this later on. Head over to <a href="overview.txt" target="_blank">overview</a>
    file to get an overview of what we intend in this section.
</p>


<h2>2.2 / 33 - DOCKER </h2>

<p>
    So far, we have been Apache bundled into XAMPP to run our PHP application. <br>
    However, it has some of it's own limitation:
    <ul>
        <li>
            The working (development) environment is usually different from the production environment
            causing the application to break. This difference might be due to different available versions
            of PHP, MySQL, or web server used leading to situation where it works on your machine but not production.
        </li>
        <li>
            With Apache, you can only have one version of PHP in your application. This is not ideal in cases you need to easily
            switch between different versions of a PHP for different application.
        </li>
    </ul>

    In cases like this, Docker is usually the preferred option as it makes our code portable as possible.
    It basically allows you to bundle your development environment in <i>containers</i> that are portable.
    With Docker containerization, you can containerize your dependencies and your project which can easily be 
    shared, deleted or ported over to another OS.

    <ol>
        <li><b>A container</b>: basically bundles up your application with all the necessary dependencies.</li>
        <li><b>DockerFile</b>: a text file that has instructions on how to build a docker image.</li>
        <li><b>Docker Image</b>: a read-only executable package that includes everything needed to run your application.
        It is more like a template or base to build your containers. And you can describe a container, as a runtime instance of
        a docker image that can be modified. Docker Image can be stored on repository e.g. dockerhub from where you can pull
        the docker image and use them to build your containers.
        </li>
    </ol>
</p>

<p>
    Another good alternative of Apache server is <i>Nginix</i>. With Apache (bundled in XAMPP), PHP interpreter is embedded within
    within the Apache web server and runs PHP as an Apache Module (which is known as <i>nod_php</i>). To know if the PHP interpreter
    is a <i>mod_php</i>, check the <code>Server API</code> value for the <code>phpinfo();</code> and the value should be
    <code>Apache 2.0 Handler</code>.
    The downside of this is that Apache handles every requests even if it is a static file. This isn't much of an issue as we can use
    CDN (Content Delivery Network) to server our static files.
    But, Nginix provides us with PHP-FPM, where FPM stands for Fast-CGI Process Manager, an alternative and faster and more advanced form of Fast-CGI.
    It acts a gateway that sits between your web server and PHP code. You can use PHP FPM on Apache anyways and it's a matter of choice and how much
    time you've got to set it up.
    <br>

    Go to the official <a href="https://docs.docker.com" target="_blank">Docker documentation</a> for a guide to get started and get your
    application up and running.

    <br>
    <p>
        <ul>
        Hint:
        <li>You can use Docker compose to easily get multiple docker container running at the same time. </li>
        <li>When Nginix (with PHP-FPM) is set up, the <code>Server API</code> value for <code>phpinfo();</code> should now
        be <code>FPM/Fast-CGI</code></li>
        <li>Another good alternative to XAMPP is Laragon, which allows you to run different versions of PHP. It also has lots of
            other powerful features too.
        </li>
        </ul>
    </p>
</p>

<h2>2.3 / 33 - CLASSES AND OBJECTS</h2>

<p>
    <i>Objects</i> along with <i>iterables</i> are two PHP data types we haven't talked about in depth. <br>
    Today, we look at <i>object</i> data, which we have seen to be instances of a class.
    You can create your custom class using thee <code>class</code> keyword.
</p>

<h2>2.29 / 33 - INTRO TO MYSQL FOR PHP</h2>

<p>
    Databases are a crucial component of a typical web application for persisting data. <br>

    With databases, we can store information in a disk that last for a given period. SQL is a common 
    query language that allows us to access, update, modify, delete the data in our database. Databse can be
    <i>relational</i> or <i>non-relational</i>. <br>

    MySQL is an example of a relational database system. In relational database system, information is stored in tables.
    Each table contains rows and columns and two or more tables are connected to each other, hence the term <i>relational</i>.
    Other examples of relational databases include: PostgreSQL, OracleDB. <br> Non-relational databse, on the other hand, do
    not a well-structured format as can be seen in relational databases. <br>

    MySQL is a common and popular choice for most PHP developers and as every other relational databases, commands known as
    <i>SQL queries</i> are used to perform certain operations on the database. Non-relational databases, are therefore called
    <i>non-relational databases.</i> While some of these SQL queries or commands are vendor-specific i.e. each SQL Database Mangement
    System (DBMS) has specific queries or commands tied to it, most of the popular SQL queries are common and widely used over
    different databases.

    Some of them include:
    <ul>
        <li><code>CREATE TABLE</code> - Create a table</li>
        <li><code>SELECT</code> - Select data from a table</li>
        <li><code>INSERT</code> - Insert a row into a table</li>
        <li><code>UPDATE</code> - Update the data in a row(s)</li>
        <li><code>DELETE</code> - Delete the data in a row(s)</li>
        <li><code>ALTER</code> - Alter the data in a row</li>
    </ul>
    ...and so on

    <p>
        NB: You can always visit the SQL documentation for more details
        and the syntax for the commands.
    </p>

    Aside from the common operations, you can also <i>join</i> tables to
    work with more than one table at a time, <i>index</i> tables
    specifically columns in a table to make search (or select) queries faster.
    You can also decide which row(s) to return and how to return them using the
    <code>WHILE</code>, <code>LIKE</code>, <code>ORDER BY</code>... clauses.

    <p>
        Since the series is mainly focused, this is just a fast-paced introduction
        to the very basics of databases, SQL and MySQL as a whole.
        In the next lesson, we shall see how to perform SQL queries right from our
        PHP application.
    </p>
</p>