<?php
include 'templates/html.php';
?>

<body>
  <main>

    <h2>Buttons</h2>
    <button class="btn btn-default">Save changes</button>

    <button class="btn btn-outline">Cancel</button>

    <button class="btn btn-destructive">Delete</button>

    <button class="btn btn-ghost">
      Menu
    </button>

    <button class="btn btn-link">Forgot password?</button>


    <h2>Alterts</h2>
    <!-- Default / info -->
    <div class="alert alert-success">
      <div>
        <h5 class="alert-title">Heads up!</h5>
        <p class="alert-description">
          You can add components to your app using the cli.
        </p>
      </div>
    </div>

    <!-- Destructive variant -->
    <div class="alert alert-destructive">
      <div>
        <h5 class="alert-title">Error</h5>
        <p class="alert-description">
          Your session has expired. Please log in again.
        </p>
      </div>
    </div>

    <h2>Forms</h2>
    <div class="form-item">
      <label for="email" class="form-label">Email</label>
      <input
        id="email"
        type="email"
        placeholder="example@domain.com"
        class="..." />
      <p class="form-description">We'll never share your email.</p>
      <!-- or -->
      <p class="form-error">This field is required.</p>
    </div>

    <h2>Tables</h2>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Edys Meza</td>
            <td>edys@example.com</td>
            <td>Developer</td>
            <td>
              <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                Active
              </span>
            </td>
            <td>
              <button class="btn btn-ghost btn-sm">Edit</button>
            </td>
          </tr>
          <!-- more rows... -->
        </tbody>
      </table>
    </div>


    <?php include './templates/footer.php'; ?>
