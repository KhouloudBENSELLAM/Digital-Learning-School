<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Basics</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }
        h1{
            text-align: center;
        }
        h1, h2 {
            color: red;
        }
        h3{
            color: green;
        }
        section {
            margin-bottom: 30px;
        }
        .code {
            background-color: #f0f0f0;
            padding: 10px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            overflow-x: auto;
        }
        #p {
            font-size: 16px;
            text-align: center;
        }
        #p b{
            font-size: 17px;
            font-family: Georgia, 'Times New Roman', Times, serif;
            color: #508AC6;
        }
    </style>
</head>
<body>
    <header>
        <h1>PHP Basics</h1>
    </header>
    <main>
        <section>
            <h2>Introduction to PHP</h2>
            <p>PHP (Hypertext Preprocessor) is a server-side scripting language designed for web development. It is widely used for creating dynamic and interactive web pages.</p>
        </section>

        <section>
            <h2>PHP Syntax</h2>
            <div class="code">
                <pre>
&lt;?php
    // This is a comment
    echo "Hello, World!"; // Outputting text
?&gt;
                </pre>
            </div>
            <p>PHP code is embedded within HTML using <code>&lt;?php ?&gt;</code> tags. Comments can be added with <code>//</code> for single-line or <code>/* */</code> for multi-line comments.</p>
        </section>

        <section>
            <h2>Variables</h2>
            <div class="code">
                <pre>
&lt;?php
    $name = "John"; // String
    $age = 30; // Integer
    $is_student = true; // Boolean
    echo $name, $age, $is_student;
?&gt;
                </pre>
            </div>
            <p>Variables in PHP start with a dollar sign (<code>$</code>). PHP is a loosely typed language, so variable types do not need to be declared explicitly.</p>
        </section>

        <section>
            <h2>Data Types</h2>
            <p>PHP supports various data types including:</p>
            <ul>
                <li><strong>String:</strong> Textual data enclosed in quotes (" " or ' ')</li>
                <li><strong>Integer:</strong> Whole numbers</li>
                <li><strong>Float:</strong> Numbers with decimal points</li>
                <li><strong>Boolean:</strong> Logical values (<code>true</code> or <code>false</code>)</li>
                <li><strong>Array:</strong> Indexed or associative collections of values</li>
                <li><strong>Object:</strong> Instances of classes</li>
                <li><strong>NULL:</strong> Special type representing a variable with no value</li>
            </ul>
        </section>

        <section>
            <h2>Operators</h2>
            <p>PHP includes various operators for performing operations:</p>
            <ul>
                <li><strong>Arithmetic Operators:</strong> +, -, *, /, %</li>
                <li><strong>Assignment Operators:</strong> =, +=, -=, *=, /=, %=</li>
                <li><strong>Comparison Operators:</strong> ==, ===, !=, !==, >, <, >=, <=</li>
                <li><strong>Logical Operators:</strong> &&, ||, !</li>
            </ul>
        </section>

        <section>
            <h2>Control Structures</h2>
            <h3>If-Else</h3>
            <div class="code">
                <pre>
&lt;?php
    $hour = 10;
    if ($hour < 12) {
        echo "Good morning";
    } else {
        echo "Good afternoon";
    }
?&gt;
                </pre>
            </div>
            <h3>Loops</h3>
            <div class="code">
                <pre>
&lt;?php
    for ($i = 0; $i < 5; $i++) {
        echo $i;
    }
?&gt;
                </pre>
            </div>
            <p>Control structures like <code>if-else</code> and loops (<code>for</code>, <code>while</code>, <code>foreach</code>) are used to perform different actions based on different conditions.</p>
        </section>

        <section>
            <h2>Functions</h2>
            <div class="code">
                <pre>
&lt;?php
    function greet($name) {
        return "Hello, " + $name + "!";
    }
    echo greet("Alice");
?&gt;
                </pre>
            </div>
            <p>Functions are blocks of code designed to perform a particular task. They are executed when "called" (invoked).</p>
        </section>

        <section>
            <h2>Arrays</h2>
            <div class="code">
                <pre>
&lt;?php
    $colors = array("red", "green", "blue");
    echo $colors[0]; // Outputs "red"

    $ages = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
    echo $ages['Ben']; // Outputs 37
?&gt;
                </pre>
            </div>
            <p>Arrays in PHP can be indexed or associative. Indexed arrays use numeric indexes while associative arrays use named keys.</p>
        </section>

        <section>
            <h2>Superglobals</h2>
            <p>PHP provides several predefined global arrays called superglobals:</p>
            <ul>
                <li><strong>$_GET:</strong> Collects data sent via URL parameters</li>
                <li><strong>$_POST:</strong> Collects data sent via HTTP POST method</li>
                <li><strong>$_SESSION:</strong> Used to store session variables</li>
                <li><strong>$_COOKIE:</strong> Used to retrieve stored cookie values</li>
                <li><strong>$_FILES:</strong> Used to handle file uploads</li>
                <li><strong>$_SERVER:</strong> Holds information about headers, paths, and script locations</li>
                <li><strong>$_REQUEST:</strong> Collects data from $_GET, $_POST, and $_COOKIE</li>
            </ul>
        </section>

        <section>
            <h2>Connecting to a Database</h2>
            <div class="code">
                <pre>
&lt;?php
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "database";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
?&gt;
                </pre>
            </div>
            <p>PHP can connect to databases like MySQL using extensions such as MySQLi or PDO. The example above demonstrates a connection using MySQLi.</p>
        </section>

        <section>
            <h2>Basic CRUD Operations</h2>
            <h3>Create</h3>
            <div class="code">
                <pre>
&lt;?php
    $sql = "INSERT INTO MyGuests (firstname, lastname, email)
    VALUES ('John', 'Doe', 'john@example.com')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?&gt;
                </pre>
            </div>
            <h3>Read</h3>
            <div class="code">
                <pre>
&lt;?php
    $sql = "SELECT id, firstname, lastname FROM MyGuests";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        }
    } else {
        echo "0 results";
    }
?&gt;
                </pre>
            </div>
            <h3>Update</h3>
            <div class="code">
                <pre>
&lt;?php
    $sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
?&gt;
                </pre>
            </div>
            <h3>Delete</h3>
            <div class="code">
                <pre>
&lt;?php
    $sql = "DELETE FROM MyGuests WHERE id=3";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
?&gt;
                </pre>
            </div>
            <p>CRUD stands for Create, Read, Update, and Delete. These operations are the foundation of any database-driven application.</p>
        </section>

        <section>
            <h2>Sessions</h2>
            <div class="code">
                <pre>
&lt;?php
    // Start the session
    session_start();

    // Set session variables
    $_SESSION["username"] = "JohnDoe";
    $_SESSION["email"] = "john@example.com";

    // Access session variables
    echo "Username is " . $_SESSION["username"];
?&gt;
                </pre>
            </div>
            <p>Sessions are a way to store information (in variables) to be used across multiple pages. Unlike cookies, session data is stored on the server.</p>
        </section>

        <section>
            <h2>Forms and User Input</h2>
            <div class="code">
                <pre>
&lt;form method="post" action="process.php"&gt;
    Name: &lt;input type="text" name="name"&gt;&lt;br&gt;
    E-mail: &lt;input type="text" name="email"&gt;&lt;br&gt;
    &lt;input type="submit"&gt;
&lt;/form&gt;
                </pre>
            </div>
            <p>Forms are used to collect user input, which can then be sent to a server for processing using the <code>$_GET</code> or <code>$_POST</code> superglobals.</p>
        </section>
    </main>
    <footer>
    <p id="p">Copyright &copy; 2024 <b>Khouloud Ben Sellam</b> .All rights reserved.</p>
    </footer>
</body>
</html>
