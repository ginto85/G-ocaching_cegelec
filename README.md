# G-ocaching-Cegelec
<h1>Geocaching game</h1>
<p>This game consists of finding caches in which the game master has placed a question.
Players will have to answer the questions using the multiple choice form. </p>

<h2>Getting started</h2>

<p>Instruction for the implementation of the project:</p>
<ul>
  <li>`composer install` for add vendor packages,</li>
  <li>`npm install` for add node packages</li>
  <li>use the `createDB.sql` file to create the database tables</li>
  <li>use the file in the folder `./core/Connect.php` to connect to the DB.</li>
</ul>


<h3>Administrator's role</h3>
<ul>
  <li>ability to create groups and their passwords,</li>
  <li>ability to create, modify and delete 'geocaches'.</li>
</ul>

<h3>Problem of displaying the map, you can use the following code:</h3>
In case there is a space between the tiles (to be placed in the "assets/js/main.js" file): 
`setTimeout(function(){window.dispatchEvent(new Event('resize'));},1000);`


<h3>To make changes in CSS, follow the procedure below:</h3>
<ol>
  <li>Open the file "assets/css/scss/style.scss"</li>
  <li>open the terminal at the root of the project, and type 
      `npm run sass`</li>
  <li>make the desired changes.</li>
</ol>


