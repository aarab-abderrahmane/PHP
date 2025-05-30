<html><head>
<link crossorigin="" href="https://fonts.gstatic.com/" rel="preconnect"/>
<link as="style" href="https://fonts.googleapis.com/css2?display=swap&amp;family=Lexend%3Awght%40400%3B500%3B700%3B900&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900" onload="this.rel='stylesheet'" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<meta charset="utf-8"/>
<title>Predicta - Moroccan Football Prediction App</title>
<link href="data:image/x-icon;base64," rel="icon" type="image/x-icon"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<style>
      .zellij-bg {
        background-image: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23006233' fill-opacity='0.1'%3E%3Cpath d='M0 0h40v40H0zM40 40h40v40H40z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
      }
      .gold-highlight {
        text-shadow: 0 0 5px #ffd700, 0 0 10px #ffd700;
      }
      .feature-card-icon i {
        font-size: 32px;color: #ffd700;padding: 12px;
        border-radius: 50%;
        background-color: rgba(255, 215, 0, 0.1);transition: transform 0.3s ease;
      }
      .feature-card:hover .feature-card-icon i {
        transform: scale(1.1);
      }
      .step-icon i {
        font-size: 28px;
        color: #ffd700;
      }
       .how-it-works-step {
        position: relative;
        padding-left: 50px;}
      .how-it-works-step:not(:last-child)::before {
        content: '';
        position: absolute;
        left: 13px;top: 36px;bottom: -16px;width: 2px;
        background-color: #006233;}
       .how-it-works-step .step-number {
        position: absolute;
        left: -5px;
        top: 2px;
        background-color: #006233;
        color: white;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        z-index: 10;
      }
    </style>
</head>
<body class="bg-[#1A1A1A] text-white" style='font-family: Lexend, "Noto Sans", sans-serif;'>
<div class="relative flex size-full min-h-screen flex-col group/design-root overflow-x-hidden zellij-bg">
<div class="layout-container flex h-full grow flex-col">
<header class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-solid border-[#006233]/50 bg-[#1A1A1A]/80 backdrop-blur-md px-6 sm:px-10 py-4">
<div class="flex items-center gap-3 text-white">
<div class="size-8 text-[#C8102E]">
<svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_6_330)">
<path clip-rule="evenodd" d="M24 0.757355L47.2426 24L24 47.2426L0.757355 24L24 0.757355ZM21 35.7574V12.2426L9.24264 24L21 35.7574Z" fill="currentColor" fill-rule="evenodd"></path>
</g>
<defs>
<clipPath id="clip0_6_330"><rect fill="white" height="48" width="48"></rect></clipPath>
</defs>
</svg>
</div>
<h2 class="text-white text-xl font-bold tracking-[-0.015em]">Predicta</h2>
</div>
<nav class="hidden md:flex flex-1 justify-center items-center gap-8">
<a class="text-gray-300 hover:text-white text-sm font-medium transition-colors" href="#">Home</a>
<a class="text-gray-300 hover:text-white text-sm font-medium transition-colors" href="#">Matches</a>
<a class="text-gray-300 hover:text-white text-sm font-medium transition-colors" href="#">Leaderboard</a>
<a class="text-gray-300 hover:text-white text-sm font-medium transition-colors" href="#">About Us</a>
</nav>
<div class="flex items-center gap-3">
<button class="flex min-w-[90px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 px-5 bg-[#C8102E] text-white text-sm font-semibold leading-normal tracking-[0.015em] hover:bg-[#A80D24] transition-colors">
<span class="truncate">Sign Up</span>
</button>
<button class="hidden sm:flex min-w-[90px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 px-5 bg-[#006233] text-white text-sm font-semibold leading-normal tracking-[0.015em] hover:bg-[#004F2A] transition-colors">
<span class="truncate">Log In</span>
</button>
</div>
</header>
<main class="flex flex-1 flex-col">
<section class="relative min-h-[calc(100vh-80px)] flex flex-col items-center justify-center p-6 sm:p-10 text-center bg-cover bg-center bg-no-repeat" style='background-image: linear-gradient(rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.8) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuACcTQIr5p1xNnTu9VVXUwCj5VjLkigh60GmASGPQOEzGlvESBSqXoI0y_wJFBbfEiKimE6B6R4mXcequwVTjoBaZxEE9eq1XGKNwwbD_VtbFur4HG9uqvCo6t3IfbbeoUPDg6t68YVhiTGRv64FWuq9WrjkRfEnkQws-bf6LJUFgRg-HGHOJDQGW8ThrP2wopPJ5932waj9g7V4680Dq_Dh0zdIIIFeKDcYPWHdrNylH1kVsAIs5Zn-6oQEetxSX3aa0RRJLyoeHA");'>
<div class="absolute inset-0 zellij-bg opacity-20"></div>
<div class="relative z-10 max-w-3xl">
<h1 class="text-white text-4xl sm:text-5xl md:text-6xl font-black leading-tight tracking-[-0.033em] mb-6 gold-highlight">
                Predict Key Match Moments!
              </h1>
<p class="text-gray-200 text-lg sm:text-xl mb-8 max-w-xl mx-auto">
                Join Predicta, the ultimate Moroccan football prediction app. Test your skills, climb the leaderboard, and connect with fans!
              </p>
<button class="flex mx-auto min-w-[180px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-12 px-6 sm:h-14 sm:px-8 bg-[#C8102E] text-white text-base sm:text-lg font-bold leading-normal tracking-[0.015em] hover:bg-[#A80D24] transition-all duration-300 ease-in-out transform hover:scale-105">
<span class="truncate">Sign Up &amp; Predict</span>
</button>
</div>
</section>
<section class="py-16 sm:py-24 bg-[#1F1F1F]">
<div class="container mx-auto px-6">
<h2 class="text-3xl sm:text-4xl font-bold text-center text-white mb-4">Why Choose <span class="text-[#C8102E]">Predicta?</span></h2>
<p class="text-gray-300 text-center text-lg mb-12 max-w-2xl mx-auto">
                Experience the thrill of Moroccan football like never before. Predicta offers unique features to enhance your passion for the game.
              </p>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 @container">
<div class="feature-card flex flex-col items-center text-center gap-4 rounded-xl border border-[#006233]/70 bg-[#2A2A2A] p-6 hover:shadow-2xl hover:shadow-[#006233]/30 transition-all duration-300">
<div class="feature-card-icon">
<i class="material-icons">list_alt</i>
</div>
<h3 class="text-white text-xl font-bold leading-tight">Quick 3-Item Challenges</h3>
<p class="text-gray-400 text-sm leading-normal">Engage in fast-paced prediction challenges with just three key moments to predict per match.</p>
</div>
<div class="feature-card flex flex-col items-center text-center gap-4 rounded-xl border border-[#006233]/70 bg-[#2A2A2A] p-6 hover:shadow-2xl hover:shadow-[#006233]/30 transition-all duration-300">
<div class="feature-card-icon">
<i class="material-icons">leaderboard</i>
</div>
<h3 class="text-white text-xl font-bold leading-tight">Live Leaderboard</h3>
<p class="text-gray-400 text-sm leading-normal">Track your performance in real-time against other fans and climb the ranks on our dynamic leaderboard.</p>
</div>
<div class="feature-card flex flex-col items-center text-center gap-4 rounded-xl border border-[#006233]/70 bg-[#2A2A2A] p-6 hover:shadow-2xl hover:shadow-[#006233]/30 transition-all duration-300">
<div class="feature-card-icon">
<i class="material-icons">security</i>
</div>
<h3 class="text-white text-xl font-bold leading-tight">Smart Moderation</h3>
<p class="text-gray-400 text-sm leading-normal">Enjoy a respectful and engaging community environment with our robust content moderation features.</p>
</div>
</div>
</div>
</section>
<section class="py-16 sm:py-24 bg-[#1A1A1A] zellij-bg">
<div class="container mx-auto px-6">
<h2 class="text-3xl sm:text-4xl font-bold text-center text-white mb-12">How It Works</h2>
<div class="max-w-2xl mx-auto space-y-12">
<div class="how-it-works-step flex items-start gap-6">
<div class="step-number">1</div>
<div class="step-icon mt-1">
<i class="material-icons">person_add</i>
</div>
<div>
<h3 class="text-white text-xl font-semibold mb-1">Create Your Profile</h3>
<p class="text-gray-300 leading-relaxed">Select a unique nickname and upload a profile photo to personalize your experience. Make your mark in the Predicta community!</p>
</div>
</div>
<div class="how-it-works-step flex items-start gap-6">
<div class="step-number">2</div>
<div class="step-icon mt-1">
<i class="material-icons">sports_soccer</i>
</div>
<div>
<h3 class="text-white text-xl font-semibold mb-1">Choose a Match</h3>
<p class="text-gray-300 leading-relaxed">Pick a match from the upcoming schedule and predict the outcomes of key moments. Show off your football knowledge!</p>
</div>
</div>
<div class="how-it-works-step flex items-start gap-6">
<div class="step-number">3</div>
<div class="step-icon mt-1">
<i class="material-icons">emoji_events</i>
</div>
<div>
<h3 class="text-white text-xl font-semibold mb-1">View Your Score &amp; Compete</h3>
<p class="text-gray-300 leading-relaxed">See how well you predicted, share your results with friends, and compete for the top spot on the leaderboard. Glory awaits!</p>
</div>
</div>
</div>
</div>
</section>
</main>
<footer class="bg-[#006233]/20 border-t border-[#006233]/50 py-8 text-center">
<div class="container mx-auto px-6">
<div class="flex flex-col md:flex-row justify-between items-center">
<div class="mb-4 md:mb-0">
<h3 class="text-lg font-semibold text-white">Predicta</h3>
<p class="text-sm text-gray-400">Your Gateway to Moroccan Football Excitement</p>
</div>
<div class="flex space-x-6 mb-4 md:mb-0">
<a class="text-gray-300 hover:text-white transition-colors" href="#">Privacy Policy</a>
<a class="text-gray-300 hover:text-white transition-colors" href="#">Terms of Service</a>
<a class="text-gray-300 hover:text-white transition-colors" href="#">Contact Us</a>
</div>
<div class="text-sm text-gray-400">
                        © <span id="currentYear"></span> Predicta. All rights reserved.
                     </div>
</div>
<div class="mt-6 pt-6 border-t border-[#006233]/30 flex justify-center items-center space-x-2">
<span class="text-sm text-gray-400">Made with</span>
<svg class="w-5 h-5 text-[#C8102E]" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
<path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z"></path>
</svg>
<span class="text-sm text-gray-400">in Morocco</span>
<img alt="Moroccan Flag" class="w-5 h-auto ml-1 rounded-sm" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCDj-HHDmDAAUcnnmmr7zYaa4jOfs_tnMyAziDhivqp4sv4g0WJIa87l5klipTOPgQdi5bCYb513eGz9vfGzAckw73r8ANvQJ9zYlLOpR3UdkkiPwBYQ7WSUt9BHOOCif3ARe-BOzDd_guC73R8idLUfISvImrSO743IcS6AU1oe9pCrnpz2ZwMc5odIf2R-eiCh5YhBdWXRsbF5VKNlbhXkkovdfUI2kH6Vjgk2ywlpFrruhSGIq6LciSEFvyKSLrNS90WSGTgTzY"/>
</div>
</div>
</footer>
</div>
</div>
<script>
      document.getElementById('currentYear').textContent = new Date().getFullYear();
    </script>

</body></html>