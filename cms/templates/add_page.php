<h1>Add New Page</h1>
<?php if (!empty($errors)): ?>
  <div class="alert alert-danger"><?= implode('<br>', $errors) ?></div>
<?php endif; ?>
<form method="post">
  <div class="mb-3">
    <label>Title</label>
    <input type="text" name="title" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Slug (URL)</label>
    <input type="text" name="slug" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Content</label>
    <textarea name="content" class="form-control" rows="6" required></textarea>
  </div>
  <button class="btn btn-primary">Create Page</button>
</form>
<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/ahwfy0q0yr6bi2gsvnkhv0o68600kqora4c1ta93taeobrn2/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea[name="content"]',
    height: 400,
    menubar: false,
    plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
    toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | link image | code preview'
  });
</script>