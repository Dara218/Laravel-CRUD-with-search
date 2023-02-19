@include('partials.header')

@if (session()->has('reg-complete'))
        {{ session('reg-complete') }}
@endif

<div class="main-container">
    <div class="inside-container">

        <form method="POST" action="{{ route('registerUser') }}" class="form reg-form">

            @csrf

            <h2>Register</h2>
            <div class="form-input-container">
                <label for="fname">First Name</label>
                <input type="text" name="fname" id="fname" value="{{ old('fname') }}">
            </div>

            @error('fname')
                <p class="error-message">{{ $message }}<p>
            @enderror

            <div class="form-input-container">
                <label for="lname">Last Name</label>
                <input type="text" name="lname" id="lname" value="{{ old('lname') }}">
            </div>

            @error('lname')
                <p class="error-message">{{ $message }}<p>
            @enderror

            <div class="form-input-container">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}">
            </div>

            @error('email')
                <p class="error-message">{{ $message }}<p>
            @enderror

            <div class="form-input-container">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" value="{{ old('password') }}">
            </div>

            <div class="form-input-container">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}">
            </div>

           @error('password')
                <p class="error-message">{{ $message }}<p>
           @enderror

            <button type="submit" class="submit-btn form-btn" name="submit-reg" id="submit-reg">Submit</button>

            <p class="has-account">Already have an account? <a href="/login" class="click-here">Click here.</a></p>

        </form>
    </div>
</div>

@include('partials.footer')
