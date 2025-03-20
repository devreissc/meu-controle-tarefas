<x-guest-layout>
    <div class="d-flex align-items-center justify-content-center vh-100 bg-light">
        <div class="p-4 bg-white shadow rounded" style="width: 100%; max-width: 500px;">
            <p class="text-muted text-center">
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? 
                If you didn’t receive the email, we will gladly send you another.
            </p>
    
            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success text-center">
                    A new verification link has been sent to the email address you provided during registration.
                </div>
            @endif
    
            <div class="mt-4 d-flex justify-content-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Resend Verification Email</button>
                </form>
    
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link text-decoration-none">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
