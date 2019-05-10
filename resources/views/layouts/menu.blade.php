@if(auth()->user()->hasPermissionTo('book.read','customer') || auth()->user()->hasPermissionTo('book.read','admin') )
<li class="{{ Request::is('books*') ? 'active' : '' }}">
    <a href="{!! route('books.index') !!}"><i class="glyphicon glyphicon-book"></i><span>Books</span></a>
</li>
@endif

{{--@if(auth()->user()->hasPermissionTo('user.read','customer') || auth()->user()->hasPermissionTo('users.read','admin') )--}}
<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="glyphicon glyphicon-user"></i><span>Users</span></a>
</li>
{{--@endif--}}

@if(auth()->user()->hasPermissionTo('active_cart.read','customer') || auth()->user()->hasPermissionTo('active_cart.read','admin') )

<li class="{{ Request::is('activeCarts*') ? 'active' : '' }}">
    <a href="{!! route('activeCarts.index') !!}"><i class="glyphicon glyphicon-shopping-cart"></i><span>Active Carts</span></a>
</li>
@endif

@if(auth()->user()->hasPermissionTo('active_order.read','customer') || auth()->user()->hasPermissionTo('active_order.read','admin') )
<li class="{{ Request::is('activeOrders*') ? 'active' : '' }}">
    <a href="{!! route('activeOrders.index') !!}"><i class="glyphicon glyphicon-tasks"></i><span>Active Orders</span></a>
</li>
@endif

@if(auth()->user()->hasPermissionTo('author.read','customer') || auth()->user()->hasPermissionTo('author.read','admin') )
<li class="{{ Request::is('authors*') ? 'active' : '' }}">
    <a href="{!! route('authors.index') !!}"><i class="glyphicon glyphicon-pencil"></i><span>Authors</span></a>
</li>
@endif

@if(auth()->user()->hasPermissionTo('book_edition.read','customer') || auth()->user()->hasPermissionTo('book_edition.read','admin') )
<li class="{{ Request::is('bookEditions*') ? 'active' : '' }}">
    <a href="{!! route('bookEditions.index') !!}"><i class="glyphicon glyphicon-book"></i><span>Book Editions</span></a>
</li>
@endif

@if(auth()->user()->hasPermissionTo('book_isbn.read','customer') || auth()->user()->hasPermissionTo('book_isbn.read','admin') )
<li class="{{ Request::is('bookIsbns*') ? 'active' : '' }}">
    <a href="{!! route('bookIsbns.index') !!}"><i class="glyphicon glyphicon-book"></i><span>Book Isbns</span></a>
</li>
@endif

@if(auth()->user()->hasPermissionTo('history_order.read','customer') || auth()->user()->hasPermissionTo('history_order.read','admin') )
<li class="{{ Request::is('historyOrders*') ? 'active' : '' }}">
    <a href="{!! route('historyOrders.index') !!}"><i class="glyphicon glyphicon-tasks"></i><span>History Orders</span></a>
</li>
@endif

@if(auth()->user()->hasPermissionTo('item.read','customer') || auth()->user()->hasPermissionTo('item.read','admin') )
<li class="{{ Request::is('items*') ? 'active' : '' }}">
    <a href="{!! route('items.index') !!}"><i class="glyphicon glyphicon-list-alt"></i><span>Items</span></a>
</li>
@endif

@if(auth()->user()->hasPermissionTo('publisher.read','customer') || auth()->user()->hasPermissionTo('publisher.read','admin') )
<li class="{{ Request::is('publishers*') ? 'active' : '' }}">
    <a href="{!! route('publishers.index') !!}"><i class="glyphicon glyphicon-print"></i><span>Publishers</span></a>
</li>
@endif

@if(auth()->user()->hasPermissionTo('purchase_history.read','customer') || auth()->user()->hasPermissionTo('purchase_history.read','admin') )
<li class="{{ Request::is('purchaseHistories*') ? 'active' : '' }}">
    <a href="{!! route('purchaseHistories.index') !!}"><i class="glyphicon glyphicon-th-list"></i><span>Purchase Histories</span></a>
</li>
@endif

{{--@if(auth()->user()->hasPermissionTo('role_credential.read','customer') || auth()->user()->hasPermissionTo('role_credential.read','admin') )--}}
{{--<li class="{{ Request::is('roleCredentials*') ? 'active' : '' }}">--}}
    {{--<a href="{!! route('roleCredentials.index') !!}"><i class="glyphicon glyphicon-wrench"></i><span>Role Credentials</span></a>--}}
{{--</li>--}}
{{--@endif--}}

@if(auth()->user()->hasPermissionTo('statistic.read','customer') || auth()->user()->hasPermissionTo('statistic.read','admin') )
<li class="{{ Request::is('statistics*') ? 'active' : '' }}">
    <a href="{!! route('statistics.index') !!}"><i class="glyphicon glyphicon-stats"></i><span>Statistics</span></a>
</li>
@endif

{{--@if(auth()->user()->hasPermissionTo('users.read','customer') || auth()->user()->hasPermissionTo('users.read','admin') )--}}
{{--<li class="{{ Request::is('authorBooks*') ? 'active' : '' }}">--}}
    {{--<a href="{!! route('authorBooks.index') !!}"><i class="fa fa-edit"></i><span>Author Books</span></a>--}}
{{--</li>--}}
{{--@endif--}}
