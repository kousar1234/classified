<div class="nav flex-column border-right2 py-3" aria-orientation="vertical">
    @if (auth()->user()->can('Manage General Settings'))
        <a class="nav-link {{ Request::routeIs(['plugin.classilookscore.classified.settings.general']) ? 'active ' : '' }}"
            href="{{ route('plugin.classilookscore.classified.settings.general') }}">
            <i class="icofont-ui-settings" title="{{ translate('General') }}"></i>
            <span>{{ translate('General') }}</span>
        </a>
    @endif
    @if (auth()->user()->can('Manage Member Settings'))
        <a class="nav-link {{ Request::routeIs(['plugin.classilookscore.classified.settings.member']) ? 'active ' : '' }}"
            href="{{ route('plugin.classilookscore.classified.settings.member') }}">
            <i class="icofont-users-alt-1" title="{{ translate('Member settings') }}"></i>
            <span>{{ translate('Member settings') }}</span>
        </a>
    @endif

    @if (auth()->user()->can('Manage Currency Settings'))
        <a class="nav-link {{ Request::routeIs(['plugin.classilookscore.classified.settings.currency']) ? 'active ' : '' }}"
            href="{{ route('plugin.classilookscore.classified.settings.currency') }}">
            <i class="icofont-money" title="{{ translate('Currency Settings') }}"></i>
            <span>{{ translate('Currency Settings') }}</span>
        </a>
    @endif

    @if (auth()->user()->can('Manage Ads Settings'))
        <a class="nav-link {{ Request::routeIs(['plugin.classilookscore.classified.settings.ads']) ? 'active ' : '' }}"
            href="{{ route('plugin.classilookscore.classified.settings.ads') }}">
            <i class="icofont-horn" title="{{ translate('Ads Settings') }}"></i>
            <span>{{ translate('Ads Settings') }}</span>
        </a>
    @endif
    @if (auth()->user()->can('Manage Safety Tips'))
        <a class="nav-link {{ Request::routeIs(['plugin.classilookscore.classified.settings.safety.tips.list']) ? 'active ' : '' }}"
            href="{{ route('plugin.classilookscore.classified.settings.safety.tips.list') }}">
            <i class="icofont-safety" title="{{ translate('Safety Tips') }}"></i>
            <span>{{ translate('Safety Tips') }}</span>
        </a>
    @endif
    @if (auth()->user()->can('Manage Quick Sell Tips'))
        <a class="nav-link {{ Request::routeIs(['plugin.classilookscore.classified.settings.quick.sell.tips.list']) ? 'active ' : '' }}"
            href="{{ route('plugin.classilookscore.classified.settings.quick.sell.tips.list') }}">
            <i class="icofont-sale-discount" title="{{ translate('Quick Sell Tips') }}"></i>
            <span>{{ translate('Quick Sell Tips') }}</span>
        </a>
    @endif
    @if (auth()->user()->can('Manage Ad Share Options'))
        <a class="nav-link {{ Request::routeIs(['plugin.classilookscore.classified.settings.share.options.list']) ? 'active ' : '' }}"
            href="{{ route('plugin.classilookscore.classified.settings.share.options.list') }}">
            <i class="icofont-share-alt" title="{{ translate('Share Options') }}"></i>
            <span>{{ translate('Share Options') }}</span>
        </a>
    @endif
    @if (auth()->user()->can('Manage Map Settings'))
        <a class="nav-link {{ Request::routeIs(['plugin.classilookscore.classified.settings.map']) ? 'active ' : '' }}"
            href="{{ route('plugin.classilookscore.classified.settings.map') }}">
            <i class="icofont-google-map" title="{{ translate('Map settings') }}"></i>
            <span>{{ translate('Map settings') }}</span>
        </a>
    @endif
</div>
