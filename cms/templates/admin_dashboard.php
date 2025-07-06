<h1>Admin Dashboard</h1>
<p>Welcome, <?= htmlspecialchars($_SESSION['user']['username']) ?>!</p>
<ul>
  <li><a href="dashboard.php">Dashboard</a></li>
  <li><a href="pages.php">Manage Pages</a></li>
  <li><a href="../auth/logout.php">Logout</a></li>
</ul>