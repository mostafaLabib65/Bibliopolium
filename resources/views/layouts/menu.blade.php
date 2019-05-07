<li class="{{ Request::is('books*') ? 'active' : '' }}">
    <a href="{!! route('books.index') !!}"><i class="fa fa-edit"></i><span>Books</span></a>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('activeCarts*') ? 'active' : '' }}">
    <a href="{!! route('activeCarts.index') !!}"><i class="fa fa-edit"></i><span>Active Carts</span></a>
</li>

<li class="{{ Request::is('activeOrders*') ? 'active' : '' }}">
    <a href="{!! route('activeOrders.index') !!}"><i class="fa fa-edit"></i><span>Active Orders</span></a>
</li>

<li class="{{ Request::is('authors*') ? 'active' : '' }}">
    <a href="{!! route('authors.index') !!}"><i class="fa fa-edit"></i><span>Authors</span></a>
</li>

<li class="{{ Request::is('bookEditions*') ? 'active' : '' }}">
    <a href="{!! route('bookEditions.index') !!}"><i class="fa fa-edit"></i><span>Book Editions</span></a>
</li>

<li class="{{ Request::is('bookIsbns*') ? 'active' : '' }}">
    <a href="{!! route('bookIsbns.index') !!}"><i class="fa fa-edit"></i><span>Book Isbns</span></a>
</li>

<li class="{{ Request::is('historyOrders*') ? 'active' : '' }}">
    <a href="{!! route('historyOrders.index') !!}"><i class="fa fa-edit"></i><span>History Orders</span></a>
</li>

<li class="{{ Request::is('items*') ? 'active' : '' }}">
    <a href="{!! route('items.index') !!}"><i class="fa fa-edit"></i><span>Items</span></a>
</li>

<li class="{{ Request::is('publishers*') ? 'active' : '' }}">
    <a href="{!! route('publishers.index') !!}"><i class="fa fa-edit"></i><span>Publishers</span></a>
</li>

<li class="{{ Request::is('purchaseHistories*') ? 'active' : '' }}">
    <a href="{!! route('purchaseHistories.index') !!}"><i class="fa fa-edit"></i><span>Purchase Histories</span></a>
</li>

<li class="{{ Request::is('roleCredentials*') ? 'active' : '' }}">
    <a href="{!! route('roleCredentials.index') !!}"><i class="fa fa-edit"></i><span>Role Credentials</span></a>
</li>

<li class="{{ Request::is('statistics*') ? 'active' : '' }}">
    <a href="{!! route('statistics.index') !!}"><i class="fa fa-edit"></i><span>Statistics</span></a>
</li>

