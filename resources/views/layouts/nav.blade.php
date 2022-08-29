@guest()
@endguest
@auth
@if(auth()->user()->role==1)
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{ route("admin.account.index") }}">Accounts</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{ route("admin.import.index") }}">Import</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{ route("admin.user.index") }}">User</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{ route("admin.settings.ip.index") }}">Setting</a>
        </li>
    </ul>
</nav>
@endif
@if(auth()->user()->role==2)
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{ route("member.account.index") }}">Accounts</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{ route("member.user.index") }}">User</a>
        </li>
    </ul>
</nav>
@endif
@endauth
