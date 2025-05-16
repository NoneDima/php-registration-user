<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration Form</title>
    <link rel="stylesheet" href="./css/style.css" />
  </head>
  <body>
    <div class="container">
      <h2>Registration Form</h2>
      <form action="/submit" method="POST">
        <label for="firstname">First name</label>
        <input type="text" id="firstname" name="firstname" required />

        <label for="lastname">Last name</label>
        <input type="text" id="lastname" name="lastname" required />

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required />

        <label for="phone">Mobile phone</label>
        <input type="tel" id="phone" name="phone" required />

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />

        <button type="submit">Register</button>
      </form>
      <div class="form-footer">
        <p>Already have an account? <a href="/login">Login here</a></p>
      </div>
    </div>
  </body>
</html>
