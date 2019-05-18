<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">   
            <img src="{{ asset('storage/user/'. Auth::user()->image) }}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
            <div class="email">{{ Auth::user()->email }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="{{ Auth::user()->role_id == 1 ? route('admin.settings.index') : route('author.settings.index')}}">
                        <i class="material-icons">settings</i>Setting</a>
                    </li>
                    <li role="separator" class="divider"></li> {{-- ----
                    <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>--}}
                    <li role="separator" class="divider"></li>
                    <li>
                        <a  href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">input</i>
                        Sign Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            @if (Request::is('admin*'))
                <li class="{{ Request::is('admin/dashboard') ? 'active':'' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">label</i>
                        <span>Tag</span>
                    </a>
                    <ul class="ml-menu">
                        <li> 
                            <a href="{{ route('admin.tag.create') }}">
                                <i class="material-icons">add</i>
                                <span>Add Tag</span>
                            </a>
                        </li>
                        <li> 
                            <a href="{{ route('admin.tag.index') }}">
                                <i class="material-icons">list</i>
                                <span>All Tags</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">apps</i>
                        <span>Category</span>
                    </a>
                    <ul class="ml-menu">
                        <li> 
                            <a href="{{ route('admin.category.create') }}">
                                <i class="material-icons">add</i>
                                <span>Add Category</span>
                            </a>
                        </li>
                        <li> 
                            <a href="{{ route('admin.category.index') }}">
                                <i class="material-icons">list</i>
                                <span>All Categories</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">apps</i>
                        <span>Post</span>
                    </a>
                    <ul class="ml-menu">
                        <li> 
                            <a href="{{ route('admin.post.create') }}">
                                <i class="material-icons">add</i>
                                <span>Add Post</span>
                            </a>
                        </li>
                        <li> 
                            <a href="{{ route('admin.post.index') }}">
                                <i class="material-icons">list</i>
                                <span>All Posts</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">apps</i>
                        <span>Pending Post</span>
                    </a>
                    <ul class="ml-menu">
                        <li> 
                            <a href="{{ route('admin.post.pending') }}">
                                <i class="material-icons">list</i>
                                <span>All Pending Post</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">favorite</i>
                        <span>Favorite Post</span>
                    </a>
                    <ul class="ml-menu">
                         <li> 
                            <a href="{{ route('admin.favorite.index') }}">
                                <i class="material-icons">list</i>
                                <span>All Favorite Post</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">comment</i>
                        <span>Comments</span>
                    </a>
                    <ul class="ml-menu">
                         <li> 
                            <a href="{{ route('admin.comment.index') }}">
                                <i class="material-icons">comment</i>
                                <span>All Comment</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">subscriptions</i>
                        <span>Subscriber</span>
                    </a>
                    <ul class="ml-menu">
                        <li> 
                            <a href="{{ route('admin.subscriber.index') }}">
                                <i class="material-icons">list</i>
                                <span>All Subsctibrt</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">account_circle</i>
                        <span>Authors</span>
                    </a>
                    <ul class="ml-menu">
                        <li> 
                            <a href="{{ route('admin.author.index') }}">
                                <i class="material-icons">list</i>
                                <span>All Author</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="header">System</li>
                <li>
                    <a href="{{ route('admin.settings.index') }}">
                        <i class="material-icons">settings</i>
                        <span>Setting</span>
                    </a>
                </li>
                <li>
                    <a  href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">input</i>
                    <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif
            @if (Request::is('author*'))
            <li class="{{ Request::is('author/dashboard') ? 'active':'' }}">
                <a href="{{ route('author.dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">label</i>
                    <span>Post</span>
                </a>
                <ul class="ml-menu">
                    <li> 
                        <a href="{{ route('author.post.create') }}">
                            <i class="material-icons">add</i>
                            <span>Add Post</span>
                        </a>
                    </li>
                    <li> 
                        <a href="{{ route('author.post.index') }}">
                            <i class="material-icons">list</i>
                            <span>All Posts</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">comment</i>
                    <span>Comments</span>
                </a>
                <ul class="ml-menu">
                     <li> 
                        <a href="{{ route('author.comment.index') }}">
                            <i class="material-icons">comment</i>
                            <span>All Comment</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">favorite</i>
                    <span>Favorite Post</span>
                </a>
                <ul class="ml-menu">
                    <li> 
                        <a href="{{ route('author.favorite.index') }}">
                            <i class="material-icons">list</i>
                            <span>All Favorite Post</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="header">System</li>
            <li>
                <a href="{{ route('author.settings.index') }}">
                    <i class="material-icons">settings</i>
                    <span>Setting</span>
                </a>    
            </li>
            <li>
                <a  href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">input</i>
                <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            @endif
            
           
            
           
            
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>