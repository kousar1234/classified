 <div class="nav flex-column nav-tabs h-100" role="tablist" aria-orientation="vertical">
     <a class="nav-link {{ Request::routeIs(['admin.page.content.home']) ? 'active' : '' }}"
         href="{{ route('admin.page.content.home') }}">
         {{ translation('Home Page') }}
     </a>

     <a class="nav-link {{ Request::routeIs(['admin.page.content.about']) ? 'active' : '' }}"
         href="{{ route('admin.page.content.about') }}">
         {{ translation('About Page') }}
     </a>
     <a class="nav-link {{ Request::routeIs(['admin.page.content.contact']) ? 'active' : '' }}"
         href="{{ route('admin.page.content.contact') }}">
         {{ translation('Contact Page') }}
     </a>
 </div>
