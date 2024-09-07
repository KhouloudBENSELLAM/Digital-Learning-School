<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaScript Basics</title>
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
        <h1>JavaScript Basics</h1>
    </header>
    <main>
        <section>
            <h2>Introduction to JavaScript</h2>
            <p>JavaScript is a programming language that allows you to implement complex features on web pages. It is a versatile language used for both client-side and server-side development.</p>
        </section>

        <section>
            <h2>JavaScript Syntax</h2>
            <div class="code">
                <pre>
&lt;script&gt;
    // This is a comment
    let x = 5; // Declaring a variable
    let y = 6;
    let sum = x + y; // Adding two variables
    console.log(sum); // Outputting the sum
&lt;/script&gt;
                </pre>
            </div>
            <p>JavaScript code can be included in HTML using the <code>&lt;script&gt;</code> tag. Comments can be added with <code>//</code> for single-line or <code>/* */</code> for multi-line comments.</p>
        </section>

        <section>
            <h2>Variables</h2>
            <div class="code">
                <pre>
&lt;script&gt;
    let name = "John"; // String
    let age = 30; // Number
    let isStudent = true; // Boolean
    console.log(name, age, isStudent);
&lt;/script&gt;
                </pre>
            </div>
            <p>Variables can be declared using <code>let</code>, <code>const</code>, or <code>var</code>. The <code>let</code> and <code>const</code> keywords were introduced in ES6 and are block-scoped, while <code>var</code> is function-scoped.</p>
        </section>

        <section>
            <h2>Data Types</h2>
            <p>JavaScript supports various data types including:</p>
            <ul>
                <li><strong>String:</strong> Textual data enclosed in quotes (" " or ' ')</li>
                <li><strong>Number:</strong> Numeric values (both integers and floating-point)</li>
                <li><strong>Boolean:</strong> Logical values (<code>true</code> or <code>false</code>)</li>
                <li><strong>Object:</strong> Collections of properties</li>
                <li><strong>Array:</strong> Ordered collections of values</li>
                <li><strong>Null:</strong> Intentional absence of any value</li>
                <li><strong>Undefined:</strong> Variable declared but not yet assigned a value</li>
            </ul>
        </section>

        <section>
            <h2>Operators</h2>
            <p>JavaScript includes various operators for performing operations:</p>
            <ul>
                <li><strong>Arithmetic Operators:</strong> +, -, *, /, %</li>
                <li><strong>Assignment Operators:</strong> =, +=, -=, *=, /=, %=</li>
                <li><strong>Comparison Operators:</strong> ==, ===, !=, !==, >, <, >=, <=</li>
                <li><strong>Logical Operators:</strong> &&, ||, !</li>
            </ul>
        </section>

        <section>
            <h2>Functions</h2>
            <div class="code">
                <pre>
&lt;script&gt;
    function greet(name) {
        return "Hello, " + name + "!";
    }
    console.log(greet("Alice"));
&lt;/script&gt;
                </pre>
            </div>
            <p>Functions are blocks of code designed to perform a particular task. They are executed when "called" (invoked).</p>
        </section>

        <section>
            <h2>Control Structures</h2>
            <h3>If-Else</h3>
            <div class="code">
                <pre>
&lt;script&gt;
    let hour = 10;
    if (hour < 12) {
        console.log("Good morning");
    } else {
        console.log("Good afternoon");
    }
&lt;/script&gt;
                </pre>
            </div>
            <h3>Loops</h3>
            <div class="code">
                <pre>
&lt;script&gt;
    for (let i = 0; i < 5; i++) {
        console.log(i);
    }
&lt;/script&gt;
                </pre>
            </div>
            <p>Control structures like <code>if-else</code> and loops (<code>for</code>, <code>while</code>) are used to perform different actions based on different conditions.</p>
        </section>

        <section>
            <h2>DOM Manipulation</h2>
            <div class="code">
                <pre>
&lt;script&gt;
    document.getElementById("demo").innerHTML = "Hello, World!";
&lt;/script&gt;
                </pre>
            </div>
            <p>The Document Object Model (DOM) is a programming interface for web documents. It allows scripts to update the content, structure, and style of a document while it is being viewed.</p>
        </section>

        <section>
            <h2>Events</h2>
            <div class="code">
                <pre>
&lt;script&gt;
    function showAlert() {
        alert("Button clicked!");
    }
&lt;/script&gt;
                </pre>
            </div>
            <p>Events are actions or occurrences that happen in the system you are programming, which the system tells you about so your code can respond to them.</p>
            <div class="code">
                <pre>
&lt;button onclick="showAlert()"&gt;Click Me&lt;/button&gt;
                </pre>
            </div>
        </section>

        <section>
            <h2>ES6 Features</h2>
            <h3>Let and Const</h3>
            <div class="code">
                <pre>
&lt;script&gt;
    let a = 10;
    const b = 20;
&lt;/script&gt;
                </pre>
            </div>
            <h3>Arrow Functions</h3>
            <div class="code">
                <pre>
&lt;script&gt;
    const add = (x, y) =&gt; x + y;
    console.log(add(5, 3));
&lt;/script&gt;
                </pre>
            </div>
            <h3>Template Literals</h3>
            <div class="code">
                <pre>
&lt;script&gt;
    let name = "John";
    console.log(`Hello, ${name}!`);
&lt;/script&gt;
                </pre>
            </div>
            <p>ES6 (ECMAScript 2015) introduced many new features such as <code>let</code> and <code>const</code>, arrow functions, template literals, and more.</p>
        </section>
    </main>
    <footer>
        <p id="p">Copyright &copy; 2024 <b>Khouloud Ben Sellam</b> .All rights reserved.</p>
    </footer>
</body>
</html>
