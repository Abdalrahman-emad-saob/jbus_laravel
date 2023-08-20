{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>


<x-backpack::menu-item title="Buses" icon="la la-question" :link="backpack_url('bus')" />
<x-backpack::menu-item title="Favorite points" icon="la la-question" :link="backpack_url('favorite-point')" />
<x-backpack::menu-item title="O t ps" icon="la la-question" :link="backpack_url('o-t-p')" />
<x-backpack::menu-item title="Passenger profiles" icon="la la-question" :link="backpack_url('passenger-profile')" />
<x-backpack::menu-item title="Payment transactions" icon="la la-question" :link="backpack_url('payment-transaction')" />
<x-backpack::menu-item title="Routes" icon="la la-question" :link="backpack_url('route')" />
<x-backpack::menu-item title="Trips" icon="la la-question" :link="backpack_url('trip')" />
<x-backpack::menu-item title="Universities" icon="la la-question" :link="backpack_url('university')" />
<x-backpack::menu-item title="Users" icon="la la-question" :link="backpack_url('user')" />
