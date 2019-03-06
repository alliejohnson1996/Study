
<!DOCTYPE html>
<html>
<head>
  <title>Clients</title>
  <script src="process.js" defer></script>
  <script src="check_temp.js" defer></script>
</head>
<body>
  <form>
    <label for="company">Comment:</label> <input type="text" name="company" id="company" /> <br/>
    <!--<label for="contact">Contact Name:</label> <input type="text" name="contact" id="contact" /> <br/>
    <label for="email">Company:</label> <input type="email" name="email" id="email" />  <br/>-->
    <input type="button" value="Update" onClick="add_client();" />
  </form>
  <div id="confirm"></div>
    <span id="temp"></span>
  
</body>
</html>




