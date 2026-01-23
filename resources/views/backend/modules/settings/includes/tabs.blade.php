<div class="nav flex-column border-right2 py-3" aria-orientation="vertical">
    @if (auth()->user()->can('Manage General Settings'))
        <a class="nav-link {{ Request::routeIs(['plugin.classilookscore.classified.settings.general']) ? 'active ' : '' }}"
            href="{{ route('plugin.classilookscore.classified.settings.general') }}">
            <i class="icofont-ui-settings" title="{{ translation('General') }}"></i>
            <span>{{ translation('General') }}</span>
        </a>
    @endif
    @if (auth()->user()->can('Manage Member Settings'))
        <a class="nav-link {{ Request::routeIs(['plugin.classilookscore.classified.settings.member']) ? 'active ' : '' }}"
            href="{{ route('plugin.classilookscore.classified.settings.member') }}">
            <i class="icofont-users-alt-1" title="{{ translation('Member settings') }}"></i>
            <span>{{ translation('Member settings') }}</span>
        </a>
    @endif

    @if (auth()->user()->can('Manage Currency Settings'))
        <a class="nav-link {{ Request::routeIs(['plugin.classilookscore.classified.settings.currency']) ? 'active ' : '' }}"
            href="{{ route('plugin.classilookscore.classified.settings.currency') }}">
            <i class="icofont-money" title="{{ translation('Currency Settings') }}"></i>
            <span>{{ translation('Currency Settings') }}</span>
        </a>
    @endif

    @if (auth()->user()->can('Manage Ads Settings'))
        <a class="nav-link {{ Request::routeIs(['plugin.classilookscore.classified.settings.ads']) ? 'active ' : '' }}"
            href="{{ route('plugin.classilookscore.classified.settings.ads') }}">
            <i class="icofont-horn" title="{{ translation('Ads Settings') }}"></i>
            <span>{{ translation('Ads Settings') }}</span>
        </a>
    @endif
    @if (auth()->user()->can('Manage Safety Tips'))
        <a class="nav-link {{ Request::routeIs(['plugin.classilookscore.classified.settings.safety.tips.list']) ? 'active ' : '' }}"
            href="{{ route('plugin.classilookscore.classified.settings.safety.tips.list') }}">
            <i class="icofont-safety" title="{{ translation('Safety Tips') }}"></i>
            <span>{{ translation('Safety Tips') }}</span>
        </a>
    @endif
    @if (auth()->user()->can('Manage Quick Sell Tips'))
        <a class="nav-link {{ Request::routeIs(['plugin.classilookscore.classified.settings.quick.sell.tips.list']) ? 'active ' : '' }}"
            href="{{ route('plugin.classilookscore.classified.settings.quick.sell.tips.list') }}">
            <i class="icofont-sale-discount" title="{{ translation('Quick Sell Tips') }}"></i>
            <span>{{ translation('Quick Sell Tips') }}</span>
        </a>
    @endif
    @if (auth()->user()->can('Manage Ad Share Options'))
        <a class="nav-link {{ Request::routeIs(['plugin.classilookscore.classified.settings.share.options.list']) ? 'active ' : '' }}"
            href="{{ route('plugin.classilookscore.classified.settings.share.options.list') }}">
            <i class="icofont-share-alt" title="{{ translation('Share Options') }}"></i>
            <span>{{ translation('Share Options') }}</span>
        </a>
    @endif
    @if (auth()->user()->can('Manage Map Settings'))
        <a class="nav-link {{ Request::routeIs(['plugin.classilookscore.classified.settings.map']) ? 'active ' : '' }}"
            href="{{ route('plugin.classilookscore.classified.settings.map') }}">
            <i class="icofont-google-map" title="{{ translation('Map settings') }}"></i>
            <span>{{ translation('Map settings') }}</span>
        </a>
    @endif
</div>
