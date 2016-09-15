<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Umma Star Picture Memory Game</title>
    
    
    
    
        <style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      * {
	margin: 0;
	padding: 0;
}
body {
	font: 18px Verdana;
	color: #FFF;
  background: #CCC;
}
#picbox {
	margin: 0px auto;
	width: 640px;
}
#boxcard {
	z-index: 1;
	margin: 10px 0 0;
}
#boxcard div{
	float: left;
	width: 100px;
	height: 100px;
	margin: 5px;
	padding: 5px;
	border: 4px solid #EE872A;
	cursor: pointer;
	border-radius: 10px;
	box-shadow: 0 1px 5px rgba(0,0,0,.5);
  background: #B1B1B1;
	z-index: 2;
}
#boxcard div img {
	display: none;
	border-radius: 10px;
	z-index: 3;
}
#boxbuttons {
	text-align: center;
	margin: 20px;
	display: block;
}
#boxbuttons .button {
	text-transform: uppercase;
	background: #EE872A;
	padding: 5px 10px;
	margin: 5px;
	border-radius: 10px;
	cursor: pointer;
}
#boxbuttons .button:hover {
	background: #999;
}
    </style>

    
        <script src="js/prefixfree.min.js"></script>

    
  </head>

  <body>

    <div id="picbox">
  <span id="boxbuttons">
    <span class="button">
      <span id="counter">0</span>
      Clicks
    </span>
    <span class="button">
      <a onclick="ResetGame();">Reset</a>
    </span> 
  </span>
  <div id="boxcard"></div>
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>

    
    
    
  </body>
</html>
