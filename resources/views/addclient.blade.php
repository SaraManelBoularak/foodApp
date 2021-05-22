<h1>fill in these infos please:</h1>

<form action="add" method="POST">
   @csrf
  
  <label for="email">Email:</label><br>
  <input type="email" id="email" name="email" ><br><br>
  
  <label for="password">Password:</label><br> 
  <input type="password" id="password" name="password" ><br><br>
  
  <input type="hidden" id="usertype" name="usertype" value="client">

  <button type="submit">Add client</button>
</form>