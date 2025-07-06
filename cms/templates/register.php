<h1>Register</h1>
<?php if (!empty($errors)): ?>
    <div class="alert alert-danger"><?php echo implode('<br>', $errors); ?></div>
<?php endif; ?>
<form method="post">
  <div class="mb-3">
    <label>Username</label>
    <input type="text" name="username" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>
  <button class="btn btn-primary">Register</button>
</form>
<p>Already have an account? <a href="login.php">Login</a></p>