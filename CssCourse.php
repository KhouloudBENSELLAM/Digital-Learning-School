<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSS Basics</title>
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
        <h1>CSS Basics</h1>
    </header>
    <main>
        <section>
            <h2>Introduction to CSS</h2>
            <p>CSS (Cascading Style Sheets) is used to style and layout web pages. It allows you to create visually appealing web pages.</p>
        </section>

        <section>
            <h2>CSS Syntax</h2>
            <div class="code">
                selector {<br>
                &nbsp;&nbsp;property: value;<br>
                }
            </div>
            <p>CSS rules are composed of a selector and a declaration block. The selector points to the HTML element you want to style. The declaration block contains one or more declarations separated by semicolons.</p>
        </section>

        <section>
            <h2>Types of CSS</h2>
            <h3>Inline CSS</h3>
            <div class="code">
                &lt;p style="color: red;"&gt;This is a red paragraph.&lt;/p&gt;
            </div>
            <p>Inline CSS is used to apply a unique style to a single HTML element.</p>

            <h3>Internal CSS</h3>
            <div class="code">
                &lt;style&gt;<br>
                &nbsp;&nbsp;p {<br>
                &nbsp;&nbsp;&nbsp;&nbsp;color: blue;<br>
                &nbsp;&nbsp;}<br>
                &lt;/style&gt;
            </div>
            <p>Internal CSS is used to define styles in the head section of an HTML document.</p>

            <h3>External CSS</h3>
            <div class="code">
                &lt;link rel="stylesheet" href="styles.css"&gt;
            </div>
            <p>External CSS is used to define styles in an external file which can be linked to multiple HTML documents.</p>
        </section>

        <section>
            <h2>CSS Selectors</h2>
            <p>Selectors are used to select the HTML elements you want to style.</p>
            <h3>Element Selector</h3>
            <div class="code">
                p {<br>
                &nbsp;&nbsp;color: green;<br>
                }
            </div>
            <p>Styles all <code>&lt;p&gt;</code> elements.</p>

            <h3>Class Selector</h3>
            <div class="code">
                .classname {<br>
                &nbsp;&nbsp;color: orange;<br>
                }
            </div>
            <p>Styles all elements with class="classname".</p>

            <h3>ID Selector</h3>
            <div class="code">
                #idname {<br>
                &nbsp;&nbsp;color: purple;<br>
                }
            </div>
            <p>Styles the element with id="idname".</p>
        </section>

        <section>
            <h2>Box Model</h2>
            <p>The CSS box model is essentially a box that wraps around HTML elements. It consists of margins, borders, padding, and the actual content.</p>
            <div class="code">
                div {<br>
                &nbsp;&nbsp;width: 300px;<br>
                &nbsp;&nbsp;padding: 10px;<br>
                &nbsp;&nbsp;border: 5px solid gray;<br>
                &nbsp;&nbsp;margin: 20px;<br>
                }
            </div>
            <ul>
                <li><strong>Content:</strong> The content of the box, where text and images appear</li>
                <li><strong>Padding:</strong> Clears an area around the content. The padding is transparent</li>
                <li><strong>Border:</strong> A border that goes around the padding and content</li>
                <li><strong>Margin:</strong> Clears an area outside the border. The margin is transparent</li>
            </ul>
        </section>

        <section>
            <h2>CSS Layout</h2>
            <h3>Display</h3>
            <div class="code">
                .inline {<br>
                &nbsp;&nbsp;display: inline;<br>
                }<br>
                .block {<br>
                &nbsp;&nbsp;display: block;<br>
                }
            </div>
            <p>Control the display behavior of an element.</p>

            <h3>Position</h3>
            <div class="code">
                .relative {<br>
                &nbsp;&nbsp;position: relative;<br>
                }<br>
                .absolute {<br>
                &nbsp;&nbsp;position: absolute;<br>
                }
            </div>
            <p>Control the positioning method of an element.</p>

            <h3>Flexbox</h3>
            <div class="code">
                .container {<br>
                &nbsp;&nbsp;display: flex;<br>
                }<br>
                .item {<br>
                &nbsp;&nbsp;flex: 1;<br>
                }
            </div>
            <p>Use Flexbox to create flexible and responsive layouts.</p>
        </section>

        <section>
            <h2>Responsive Design</h2>
            <p>Responsive design ensures that web pages look good on all devices.</p>
            <h3>Media Queries</h3>
            <div class="code">
                @media (max-width: 600px) {<br>
                &nbsp;&nbsp;.container {<br>
                &nbsp;&nbsp;&nbsp;&nbsp;flex-direction: column;<br>
                &nbsp;&nbsp;}<br>
                }
            </div>
            <p>Use media queries to apply styles based on the device's characteristics.</p>
        </section>
    </main>
    <footer>
        <p id="p">Copyright &copy; 2024 <b>Khouloud Ben Sellam</b> .All rights reserved.</p>

    </footer>
</body>
</html>
