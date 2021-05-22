<h1>fill in these infos please:</h1>

<form action="register" method="POST">
   @csrf
  
  <label for="email">Email:</label><br>
  <input type="email" id="email" name="email" ><br><br>
  
  <label for="password">Password:</label><br> 
  <input type="password" id="password" name="password" ><br><br>
  
  <button type="submit">Add User</button>
</form>