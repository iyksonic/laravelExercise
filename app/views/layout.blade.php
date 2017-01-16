<!DOCTYPE html>
 <html lang="en">
 
 <head>
 <meta charset="UTF-8" />
 <link rel="stylesheet" href="/css/layout.css" />
 <title>Next Idea</title>
 </head>

 <body>
 @include("header")
 <div class="content">
 <div class="container">
 @yield("content")
 </div>
 </div>
 @include("footer")
 </body>
 