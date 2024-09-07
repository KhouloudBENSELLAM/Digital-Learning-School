<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Basics</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            padding: 0;
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
        <h1>HTML Basics</h1>
    </header>
    <main>
        <section>
            <h2>Introduction to HTML</h2>
            <p>HTML (HyperText Markup Language) is the standard markup language for creating web pages.</p>
        </section>

        <section>
            <h2>Basic Structure of an HTML Document</h2>
            <div class="code">
                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;Document Title&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br>
                &nbsp;&nbsp;&lt;!-- Content goes here --&gt;<br>
                &lt;/body&gt;<br>
                &lt;/html&gt;
            </div>
            <p>The basic structure consists of an <code>&lt;!DOCTYPE html&gt;</code> declaration, <code>&lt;html&gt;</code>, <code>&lt;head&gt;</code>, and <code>&lt;body&gt;</code> elements.</p>
        </section>

        <section>
            <h2>Common HTML Elements</h2>
            <h3>Headings</h3>
            <div class="code">
                &lt;h1&gt;Heading 1&lt;/h1&gt;<br>
                &lt;h2&gt;Heading 2&lt;/h2&gt;<br>
                &lt;h3&gt;Heading 3&lt;/h3&gt;<br>
                &lt;h4&gt;Heading 4&lt;/h4&gt;<br>
                &lt;h5&gt;Heading 5&lt;/h5&gt;<br>
                &lt;h6&gt;Heading 6&lt;/h6&gt;
            </div>
            <h3>Paragraphs</h3>
            <div class="code">
                &lt;p&gt;This is a paragraph.&lt;/p&gt;
            </div>
            <h3>Lists</h3>
            <div class="code">
                &lt;ul&gt;<br>
                &nbsp;&nbsp;&lt;li&gt;Unordered List Item&lt;/li&gt;<br>
                &lt;/ul&gt;<br>
                &lt;ol&gt;<br>
                &nbsp;&nbsp;&lt;li&gt;Ordered List Item&lt;/li&gt;<br>
                &lt;/ol&gt;
            </div>
            <h3>Links</h3>
            <div class="code">
                &lt;a href="https://example.com"&gt;Link Text&lt;/a&gt;
            </div>
            <h3>Images</h3>
            <div class="code">
                &lt;img src="image.jpg" alt="Description"&gt;
            </div>
        </section>

        <section>
            <h2>HTML Forms</h2>
            <form>
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name"><br>
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email"><br>
                <input type="submit" value="Submit">
            </form>
        </section>
    </main>
    <footer>
        <p id="p">Copyright &copy; 2024 <b>Khouloud Ben Sellam</b> .All rights reserved.</p>
    </footer>
</body>
</html>
