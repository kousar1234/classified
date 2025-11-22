 <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
     @can('Update Environment')
         <li class="nav-item">
             <a class="nav-link {{ Request::routeIs(['admin.system.settings.environment']) ? 'active ' : '' }}"
                 href="{{ route('admin.system.settings.environment') }}" role="tab">{{ translation('Environment Setup') }}
             </a>
         </li>
     @endcan
     @can('Update Environment')
         <li class="nav-item">
             <a class="nav-link {{ Request::routeIs(['admin.system.settings.smtp']) ? 'active ' : '' }}"
                 href="{{ route('admin.system.settings.smtp') }}" role="tab">{{ translation('SMTP Setup') }}
             </a>
         </li>
     @endcan

 </ul>
