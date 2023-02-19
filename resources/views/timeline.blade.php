@include('partials.header')
    @if (session()->has('login-success'))
        {{ session('login-success') }}
    @endif

    <div class="main-container">
        <div class="inside-container">
            <nav class="main-nav">
                <p>Hello, {{ Auth::user()->fname }}</p>
                <form action="{{ route('logout') }}" method="post">

                    @csrf

                    <button type="submit" name="logout-btn">Logout</button>
                </form>
            </nav>

            <div class="main-content">
                <form action="{{ route('postProcess') }}" method="post" class="post textarea-create-post">

                    @csrf

                    <textarea name="post_value" id="post-value"  placeholder="Hello NAME OF USER, type your post here..."></textarea>
                    <div class="btn-container">
                        <button type="submit" class="main-btn post-btn" name="submit-post">Post</button>
                    </div>

                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                </form>

                <h2>Recent Posts</h2>
                {{-- @foreach ($collection as $item) --}}
                    <div class='content-editor'>
                        <h3>{{ Auth::user()->fname . ' ' . Auth::user()->lname }}</h3>
                        <div class='post'>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla iste natus harum officia, error exercitationem quia porro tempora aperiam, illum asperiores unde placeat? Error dolorem alias numquam aliquid voluptatem eum.</div>

                        <div class='content-control'>
                            <span id="date-created">Post created</span>

                            <div>
                                <a href='' class='edit-post'>Edit <i class="fa-solid fa-pen-to-square"></i></a>

                                <form action="" method="POST">
                                    <button type="submit" name="delete-btn" class="delete-btn">Delete <i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                {{-- @endforeach --}}

            </div>
        </div>
    </div>

@include('partials.footer')
