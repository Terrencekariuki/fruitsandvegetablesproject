<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign In & Sign Up</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

<div class="button-container">
  <button class="btn sign-in" onclick="openForm('in')">Sign In</button>
  <button class="btn sign-up" onclick="openForm('up')">Sign Up</button>
</div>

<div class="form-popup" id="formContainer">
  <h2 id="formTitle">Form</h2>
  <form>
    <input type="text" placeholder="Full Name" required>
    <input type="text" placeholder="ID Number" required>
    <input type="email" placeholder="Email Address" required>
    <input type="tel" placeholder="Phone Number" required>
    <button type="submit" class="btn sign-in">Submit</button>
    <button type="button" class="close-btn" onclick="closeForm()">Cancel</button>
  </form>
</div>

<script>
  function openForm(type) {
    const title = type === 'in' ? 'Sign In' : 'Sign Up';
    document.getElementById('formTitle').textContent = title;
    document.getElementById('formContainer').style.display = 'block';
  }

  function closeForm() {
    document.getElementById('formContainer').style.display = 'none';
  }
</script>

</body>
</html>