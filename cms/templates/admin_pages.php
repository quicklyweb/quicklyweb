<h1>Manage Pages</h1>
<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Slug</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pages as $page): ?>
    <tr>
      <td><?= $page['id'] ?></td>
      <td><?= htmlspecialchars($page['title']) ?></td>
      <td><?= htmlspecialchars($page['slug']) ?></td>
      <td>
        <a href="edit_page.php?id=<?= $page['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
        <a href="delete_page.php?id=<?= $page['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<p><a href="add_page.php" class="btn btn-primary">Add New Page</a></p>