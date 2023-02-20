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

            <div class="overlay"></div>

            <div class="main-content">

                <form action="{{ route('postProcess') }}" method="post" class="post textarea-create-post">

                    @csrf

                    <div class="input-group mb-5">
                        <textarea class="form-control" aria-label="With textarea" name="post_value" id="post-value"  placeholder="Hello {{ Auth::user()->fname ?? ''}}, type your post here..." rows="3"></textarea>

                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2" name="submit-post">Post</button>
                      </div>

                    <input type="hidden" name="email" value="{{ Auth::user()->email ?? ''}}">

                </form>

                @if (session()->has('post-created'))
                <p class="success-message">{{ session('post-created') }}</p>
                @endif

                @if (session()->has('post-deleted'))
                <p class="success-message">{{ session('post-deleted') }}</p>

                @endif

                @error('post_value')
                <p class="error-message">{{ $message }}</p>
                @enderror

                <h2>Recent Posts</h2>

                <div class="post-modal">
                    <i class="fa-solid fa-x"></i>
                    <p>{{ Auth::user()->fname . ' ' . Auth::user()->lname}}</p>

                    <div class="input-group mb-5">
                        <textarea class="form-control" aria-label="With textarea" name="post_value" id="post-value"  placeholder="Hello {{ Auth::user()->fname ?? ''}}, type your post here..." rows="3"></textarea>

                        <button class="btn btn-dark" type="submit" id="button-addon2" name="submit-post">Post</button>
                      </div>

                </div>

                @foreach ($activeUser as $active)
                    <div class='content-editor'>
                        <h3>{{ Auth::user()->fname . ' ' . Auth::user()->lname ?? ''}}</h3>

                        <div class='post'>
                            {{ $active->post_value }}
                        </div>

                        <div class='content-control'>

                            <div>
                                <span id="date-created">{{ $active->created_at }}</span>

                                <a href='' class='edit-post' data-post-value="{{ $active->post_value }}">Edit <i class="fa-solid fa-pen-to-square"></i></a>

                                <form action="{{ route('delete', $active->id) }}" method="POST">

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
