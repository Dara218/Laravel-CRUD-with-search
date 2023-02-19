@include('partials.header')

<div class="main-container">
    <div class="inside-container">

        <form action="{{ route('loginUser') }}" method="POST" class="form">

            @csrf

        <h2>Login</h2>

        @if (session()->has('login-error'))
            <p class="error-message">{{ session('login-error') }}</p>
        @endif

        @if (session()->has('reg-complete'))
            <p class="success-message">{{ session('reg-complete') }}</p>
        @endif

            <div class="form-input-container">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" value="" placeholder="Enter your email address">

                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror

            </div>

            <div class="form-input-container">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password">
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="submit-btn form-btn" name="submit-login">Submit</button>

            <p class="has-account">Click <a href="/register" class="click-here">here</a> to register.</p>

        </form>
    </div>
</div>

@include('partials.footer')
