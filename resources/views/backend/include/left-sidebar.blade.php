<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            <li class=""><a href="{{route("backend.index")}}"><i class="fa fa-dashboard"></i> <span>Homepage</span></a></li>

            <li class=""><a href="{{route("backend.menus.show")}}"><i class="fa fa-list"></i> <span>Menus</span></a></li>
            <li class=""><a href="{{route("backend.portfolios.show")}}"><i class="fa fa-image"></i> <span>Portfolios</span></a></li>

            <li class=""><a href="{{route("backend.roles.show")}}"><i class="fa fa-image"></i> <span>Roles</span></a></li>
            <li class=""><a href="{{route("backend.rolegroups.show")}}"><i class="fa fa-image"></i> <span>Role Groups</span></a></li>


            <li class=""><a href="{{route("backend.logout")}}"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>

            {{--
            <li class=""><a href="{{route("backend.statics.show")}}"><i class="fa fa-file-text"></i> <span>Static Pages</span></a></li>
            <li class=""><a href="{{route("backend.menus.show")}}"><i class="fa fa-list"></i> <span>Menus</span></a></li>
            <li class=""><a href="{{route("backend.settings.show")}}"><i class="fa fa-cog"></i> <span>Web Site Settings</span></a></li>
            <li class=""><a href="{{route("backend.modules.show")}}"><i class="fa fa-link"></i> <span>Modules</span></a></li>
            <li class=""><a href="{{route("backend.blogs.show")}}"><i class="fa fa-newspaper-o"></i> <span>Blogs</span></a></li>
            <li class=""><a href="{{route("backend.blogs.categories.show")}}"><i class="fa fa-list-alt"></i> <span>Blog Categories</span></a></li>
            <li class=""><a href="{{route("backend.blogs.comments.show")}}"><i class="fa fa-comments-o"></i> <span>Blog Comments</span></a></li>
            <li class=""><a href="{{route("backend.portfolios.show")}}"><i class="fa fa-image"></i> <span>Portfolios</span></a></li>
            <li class=""><a href="{{route("backend.sliders.show")}}"><i class="fa fa-image"></i> <span>Sliders</span></a></li>
            <li class=""><a href="{{route("backend.users.show")}}"><i class="fa fa-users"></i> <span>Users</span></a></li>



            <li class=""><a href="{{route("backend.logout")}}"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
            --}}
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>