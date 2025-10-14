<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f7f8;
      display: flex;
      height: 100vh;
      justify-content: center;
      align-items: center;
      margin: 0;
    }
    .login-container {
      background: white;
      padding: 2rem 3rem;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      width: 320px;
    }
    h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: #333;
    }
    label {
      display: block;
      margin-bottom: 0.3rem;
      font-weight: bold;
      color: #555;
    }
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 0.6rem;
      margin-bottom: 1.2rem;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      font-size: 1rem;
    }
    button {
      width: 100%;
      padding: 0.7rem;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      font-size: 1rem;
      cursor: pointer;
    }
    button:hover {
      background-color: #0056b3;
    }
    .forgot {
      text-align: right;
      font-size: 0.9rem;
      margin-top: -1rem;
      margin-bottom: 1rem;
    }
    .forgot a {
      color: #007bff;
      text-decoration: none;
    }
    .forgot a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <form action="<?php echo e(route('login.post')); ?>" method="POST">
        <?php echo csrf_field(); ?>
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required placeholder="you@example.com" />

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required placeholder="••••••••" />

      <?php if(false): ?>    
      <div class="forgot">
        <a href="/forgot-password">Forgot password?</a>
      </div>
      <?php endif; ?>

      <button type="submit">Sign In</button>
    </form>
  </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\resources\views/login.blade.php ENDPATH**/ ?>