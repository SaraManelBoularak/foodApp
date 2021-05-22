<h1>fill in these infos please:</h1>

<form action="addU" method="post">
   @csrf
  
  <label for="email">Email:</label><br>
  <input type="email" id="email" name="email" ><br><br>
  
  <label for="password">Password:</label><br> 
  <input type="password" id="password" name="password" ><br><br>
  
  <input type="hidden" id="usertype" name="usertype" value="manager">

  <button type="submit">Add manager</button>
</form>