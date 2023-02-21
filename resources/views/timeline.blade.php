@include('partials.header')
    <div class="main-container">
        <div class="inside-container">
            <nav class="main-nav">
                <p>Hello, {{ Auth::user()->fname ?? ''}}</p>
                <form action="{{ route('logout') }}" method="post">

                    @csrf

                    <button type="submit" name="logout-btn" class="logout-btn">Logout</button>
                </form>
            </nav>

            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                  <a class="navbar-brand" href="#">Navbar</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Dropdown link
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Another action</a></li>
                          <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>

            <div class="overlay"></div>

            <div class="main-content">

                @if (session()->has('login-success'))
                    <p class="success-message">{{ session('login-success') }}</p>
                @endif

                <form action="{{ route('postProcess') }}" method="post" class="post textarea-create-post">

                    @csrf

                    <textarea class="post_value" name="post_value" id="post-value"  placeholder="Hello {{ Auth::user()->fname ?? ''}}, type your post here..." rows="4"></textarea>

                    <button class="post-btn" type="submit" id="button-addon2" name="submit-post">Post</button>

                    <input type="hidden" name="email" value="{{ Auth::user()->email ?? ''}}">

                </form>

                {{-- <form action="{{ route() }}" method="post"></form> --}}

                @if (session()->has('post-created'))
                    <p class="success-message">{{ session('post-created') }}</p>
                @endif

                @if (session()->has('post-deleted'))
                    <p class="success-message">{{ session('post-deleted') }}</p>
                @endif

                @if (session()->has('post-updated'))
                    <p class="success-message">{{ session('post-updated') }}</p>
                @endif

                @error('post_value')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <h2>Recent Posts</h2>

                @foreach ($activeUser as $active)

                <form action="{{ route('edit', $active->id) }}" method="POST" class="post-modal">

                    @method('put')
                    @csrf

                    <i class="fa-solid fa-x"></i>
                    <p>{{ Auth::user()->fname . ' ' . Auth::user()->lname}}</p>

                    <div>
                        <textarea class="form-control" name="post_value" id="post-value"  placeholder="Hello {{ Auth::user()->fname ?? ''}}, type your post here..." rows="4"></textarea>

                        <input type="hidden" name="email" value="{{ $active->email }}">

                        <input type="hidden" name="id" value="{{ $active->id }}" class="hidden-id">

                        <button class="post-btn" type="submit" id="button-addon2" name="submit-post">Post</button>
                    </div>

                </form>

                    <div class='content-editor'>
                        <h3>{{ Auth::user()->fname . ' ' . Auth::user()->lname ?? ''}}</h3>

                        <div class='post'>
                            {{ $active->post_value }}
                        </div>

                        <div class='content-control'>

                            <div>
                                <span id="date-created">{{ $active->created_at }}</span>

                                <a href='' class='edit-post' data-post-value="{{ $active->post_value }}" data-id="{{ $active->id }}">Edit <i class="fa-solid fa-pen-to-square"></i></a>

                                <form action="{{ route('delete', $active->id) }}" method="POST">
                                    @method('delete')

                                    @csrf

                                    <button type="submit" name="delete-btn" class="delete-btn">Delete <i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>

                @endforeach
                {{ $activeUser->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

@include('partials.footer')
