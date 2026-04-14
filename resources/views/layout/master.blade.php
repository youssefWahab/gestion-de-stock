<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>@yield('title','Fiche de commande')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- <style>
      .-ml-64 { margin-left: -16rem; }
    </style> --}}

    {{-- @vite(['resources/css/app.css']) --}}
  </head>
  <body class="antialiased bg-gray-100">
    <div class="flex flex-col h-screen">
      
      <!-- Navbar -->
      <header class="h-16 bg-white flex items-center justify-between px-6 border-b border-gray-200">
        <!-- Left: Logo + Name -->
        <div class="flex items-center gap-3">
          <button id="menu-toggle" class="px-3 py-2 rounded-lg hover:bg-gray-100">
            <i class="fa-solid fa-bars text-xl"></i>
          </button>
          <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-12 object-contain">
          <span class="text-2xl font-bold tracking-wide">Gestion De Stock</span>
        </div>

        <!-- Right: Notification -->
        <div class="relative">
          <button class="p-2 rounded-full hover:bg-gray-100 transition relative">
            <i class="fa-solid fa-bell text-gray-600 text-xl"></i>
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
              5
            </span>
          </button>
        </div>
      </header>

      <!-- Body (Sidebar + Main) -->
      <div class="flex flex-1 overflow-hidden">
        {{-- <aside id="sidebar" class="fixed lg:relative top-0 left-0 h-full w-64 bg-gradient-to-b from-gray-900 to-gray-800 text-white flex flex-col shadow-xl transform -translate-x-64 lg:translate-x-0 transition-transform duration-300 z-50"> --}}
<aside id="sidebar"
       class="w-64 bg-gradient-to-b from-gray-900 to-gray-800 text-white flex flex-col shadow-xl
              transform -translate-x-64 lg:translate-x-0 transition-transform duration-300 z-50
              fixed top-16 left-0 h-[calc(100%-4rem)] lg:relative lg:top-0 lg:h-full">

            {{-- translate-x-0     --}}
          <nav class="flex-1 py-5 mt-5 pl-3.5 pr-5 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 py-2 px-4 rounded-lg hover:bg-gray-700 transition">
              <i class="fas fa-chart-line w-6 h-6"></i>
              Tableau de bord
            </a>
            <a href="{{ route('entrees.index') }}" class="flex items-center gap-2 py-2 px-4 rounded-lg hover:bg-gray-700 transition">
              <i class="fa-solid fa-circle-arrow-down w-6 h-6"></i>
              Les entrées du stock
            </a>
            <a href="{{ route('sorties.index') }}" class="flex items-center gap-2 py-2 px-4 rounded-lg hover:bg-gray-700 transition">
              <i class="fa-solid fa-circle-arrow-up w-6 h-6"></i>
              Les sortie du stock
            </a>
            <a href="{{ route('emprunts.index') }}" class="flex items-center gap-2 py-2 px-4 rounded-lg hover:bg-gray-700 transition">
              <i class="fa-solid fa-hand-holding w-6 h-6"></i>
              Les emprunts
            </a>
            <a href="{{ route('retours.index') }}" class="flex items-center gap-2 py-2 px-4 rounded-lg hover:bg-gray-700 transition">
              <i class="fa-solid fa-rotate-left w-6 h-6"></i>
              Les retours
            </a>
            <a href="{{ route('stock.index') }}" class="flex items-center gap-2 py-2 px-4 rounded-lg hover:bg-gray-700 transition">
              <i class="fas fa-boxes-stacked w-6 h-6"></i>
              l'inventaire
            </a>

            {{-- <div>
              <button class="w-full flex items-center justify-between py-2 px-2 rounded hover:bg-gray-700 parent-btn">
                  <div class="flex items-center gap-2.5">
                      <i class="fa-solid fa-file-contract w-6 h-6"></i>
                      <span>Fiche de commande</span>
                  </div>
                  <i class="fas fa-chevron-down transition-transform"></i>
              </button>
                <div class="submenu ml-8 space-y-1 hidden">
                  <a href="{{ route('fiche-article.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700 flex items-center gap-3.5">Les articles</a>
                  <a href="{{ route('fiche-commande.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700 flex items-center gap-3.5">Toutes les fiches</a>
                </div>
            </div>

            <div>
              <button class="w-full flex items-center justify-between py-2 px-2 rounded hover:bg-gray-700 parent-btn">
                  <div class="flex items-center gap-2.5">
                      <i class="fa-solid fa-file-invoice-dollar w-6 h-6"></i>
                      <span>Demande d'achat</span>
                  </div>
                  <i class="fas fa-chevron-down transition-transform"></i>
              </button>
                <div class="submenu ml-8 space-y-1 hidden">
                  <a href="{{ route('article-achat.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700 flex items-center gap-3.5">Les articles</a>
                  <a href="{{ route('demande-achat.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700 flex items-center gap-3.5">Toutes les demandes</a>
                </div>
            </div>

            <div>
                <button class="w-full flex items-center justify-between py-2 px-2 rounded hover:bg-gray-700 parent-btn">
                    <div class="flex items-center gap-3.5">
                        <i class="fa-solid fa-sitemap w-6 h-6"></i>
                        <span>Production</span>
                    </div>
                    <i class="fas fa-chevron-down transition-transform"></i>
                </button>
                  <div class="submenu ml-8 space-y-1 hidden">
                    <a href="{{ route('production-article.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700 flex items-center gap-3.5">Les articles</a>
                    <a href="{{ route('production.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700 flex items-center gap-3.5">Toutes les productions</a>
                  </div>
            </div>

            <div>
              <button class="w-full flex items-center justify-between py-2 px-2 rounded hover:bg-gray-700 parent-btn">
                  <div class="flex items-center gap-2.5">
                      <i class="fa-solid fa-boxes-stacked w-6 h-6"></i>
                      <span>Stock</span>
                  </div>
                  <i class="fas fa-chevron-down transition-transform"></i>
              </button>
                <div class="submenu ml-8 space-y-1 hidden">
                  <a href="{{ route('entrees.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700 flex items-center gap-3.5">Les entrée</a>
                  <a href="{{ route('sorties.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700 flex items-center gap-3.5">Les sortie</a>
                  <a href="{{ route('emprunts.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700 flex items-center gap-3.5">Les emprunts</a>
                  <a href="{{ route('stock.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700 flex items-center gap-3.5">Inventaire</a>
                </div>
            </div> --}}

            
          </nav>
        </aside>

        <!-- Main -->
        <main id="main" 
        {{-- class="flex-1 p-6 bg-gray-50 overflow-y-auto transition-all duration-300"> --}}
        class="flex-1 p-6 bg-gray-50 overflow-y-auto transition-all duration-300">
         
          @yield('content')
        </main>
      </div>
    </div>

    <script>
      // Sidebar dropdowns
      document.addEventListener('DOMContentLoaded', () => {
        const parents = document.querySelectorAll('.parent-btn');
        parents.forEach(btn => {
          btn.addEventListener('click', () => {
            const submenu = btn.nextElementSibling;
            const chevron = btn.querySelector('i.fas');
            submenu.classList.toggle('hidden');
            chevron.classList.toggle('rotate-180');

            parents.forEach(other => {
              if (other !== btn) {
                other.nextElementSibling.classList.add('hidden');
                other.querySelector('i.fas').classList.remove('rotate-180');
              }
            });
          });
        });
        // const menuToggle = document.getElementById('menu-toggle');
        // const sidebar = document.getElementById('sidebar');
        // const main = document.getElementById('main');

        // menuToggle.addEventListener('click', () => {
        //   if (window.innerWidth >= 1024) {
        //     // Desktop → push content
        //     sidebar.classList.toggle('-ml-64'); // move sidebar left
        //     main.classList.toggle('lg:ml-0');
        //   } else {
        //     // Mobile → overlay
        //     sidebar.classList.toggle('-translate-x-full');
        //   }
        // });
const menuToggle = document.getElementById('menu-toggle');
const sidebar = document.getElementById('sidebar');

// Restore state
if (sessionStorage.getItem('sidebar') === 'hidden') {
    if (window.innerWidth >= 1024) {
        sidebar.classList.add('-ml-64'); // desktop
    } else {
        sidebar.classList.add('-translate-x-64'); // mobile
    }
}

// Toggle sidebar
menuToggle.addEventListener('click', () => {
    if (window.innerWidth >= 1024) {
        sidebar.classList.toggle('-ml-64'); // desktop pushes content
    } else {
        sidebar.classList.toggle('-translate-x-64'); // mobile overlays
    }

    // Save state
    let hidden = (window.innerWidth >= 1024) ? sidebar.classList.contains('-ml-64') : sidebar.classList.contains('-translate-x-64');
    sessionStorage.setItem('sidebar', hidden ? 'hidden' : 'shown');
});


      });
    </script>
  </body>
</html>