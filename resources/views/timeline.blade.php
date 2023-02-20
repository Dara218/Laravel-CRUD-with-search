@include('partials.header')
    @if (session()->has('login-success'))
        {{ session('login-success') }}
    @endif

    <div class="main-container">
        <div class="inside-container">
            <nav class="main-nav">
                <p>Hello, {{ Auth::user()->fname ?? ''}}</p>
                <form action="{{ route('logout') }}" method="post">

                    @csrf

                    <button type="submit" name="logout-btn">Logout</button>
                </form>
            </nav>

            <div class="main-content">
                @if (session()->has('post-created'))
                    {{ session('post-created') }}
                @endif

                @error('post_value')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <form action="{{ route('postProcess') }}" method="post" class="post textarea-create-post">

                    @csrf

                    {{-- <textarea name="post_value" ></textarea> --}}

                    <div class="input-group mb-5">
                        <textarea class="form-control" aria-label="With textarea" name="post_value" id="post-value"  placeholder="Hello {{ Auth::user()->fname ?? ''}}, type your post here..." rows="3"></textarea>

                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2" name="submit-post">Post</button>
                      </div>

                    <input type="hidden" name="email" value="{{ Auth::user()->email ?? ''}}">

                    {{-- <div class="btn-container">
                        <button type="submit" class="main-btn post-btn" name="submit-post">Post</button>
                    </div> --}}
                </form>

                <h2>Recent Posts</h2>
                @foreach ($activeUser as $active)
                    <div class='content-editor'>
                        <h3>{{ Auth::user()->fname . ' ' . Auth::user()->lname ?? ''}}</h3>

                        <div class='post'>
                            {{ $active->post_value }}
                        </div>

                        <div class='content-control'>

                            <div>
                                <span id="date-created">Post created</span>

                                <a href='' class='edit-post'>Edit <i class="fa-solid fa-pen-to-square"></i></a>

                                <form action="" method="POST">

                                    @csrf

                                    <button type="submit" name="delete-btn" class="delete-btn">Delete <i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

@include('partials.footer')
