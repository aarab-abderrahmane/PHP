<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en" class="dark"> <!-- Enable dark mode by default -->
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dark Red Form</title>
  <script src="https://cdn.tailwindcss.com "></script>
  <style>
    /* Optional: Smooth transitions */
    .transition-all {
      transition: all 0.3s ease;
    }
  </style>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen p-4">


  <form  action="server.php" method="get" class="w-full max-w-md bg-gray-800 p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all">

    
    <div class="mb-4 text-center">
      <?php if (isset($_SESSION['name'])): ?>
        <h1 class="text-xl text-red-400">Welcome Back <?= htmlspecialchars($_SESSION['name']) ?></h1>
      <?php endif; ?>
    </div>


    <h2 class="text-3xl font-bold mb-6 text-center text-green-500">Get in Touch</h2>

    <!-- Name -->
    <div class="mb-5">
      <label for="name" class="block text-sm font-medium mb-2 text-gray-300">Your Name</label>
      <input type="text" id="name" name="name" placeholder="John Doe"
        class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-red-500 text-white placeholder-gray-400" required />
    </div>

    <!-- Email -->
    <div class="mb-5">
      <label for="email" class="block text-sm font-medium mb-2 text-gray-300">Email Address</label>
      <input type="email" id="email" name="email" placeholder="you@example.com"
        class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-red-500 text-white placeholder-gray-400" required />
    </div>



    <!-- Message -->
    <div class="mb-5">
      <label for="message" class="block text-sm font-medium mb-2 text-gray-300">Your Message</label>
      <textarea id="message" name="message" rows="4" placeholder="Type your message..."
        class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-red-500 text-white placeholder-gray-400" required></textarea>
    </div>

    <!-- Submit Button -->
    <button type="submit"
      class="w-full py-3 px-4 bg-red-600 hover:bg-red-700 text-white font-semibold rounded transition duration-200 transform hover:scale-105">
      Send Message
    </button>
  </form>

</body>
</html>