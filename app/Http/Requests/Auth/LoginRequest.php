<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;




class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            // 'email' => ['required', 'string', 'email'],
            'user_login' => ['required', 'string'],
            'user_pass' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Get the user credentials from the request
        $credentials = $this->only('user_login', 'user_pass');
        $credentials['password'] = $credentials['user_pass']; // Map 'user_pass' to 'password'

        // Retrieve the user by login
        $user = User::where('user_login', $credentials['user_login'])->first();

        if ($user) {
            // WordPress password check (using WordPress's native function)
            if (! $this->checkWordPressPassword($credentials['password'], $user->user_pass)) {
                RateLimiter::hit($this->throttleKey());
                throw ValidationException::withMessages([
                    'user_login' => trans('auth.failed'),
                ]);
            }
        } else {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'user_login' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    private function checkWordPressPassword($plainPassword, $hashedPassword)
    {
        // Use WordPress's password checking function via exec or directly if you can import WordPress functions
        if (function_exists('wp_check_password')) {
            return wp_check_password($plainPassword, $hashedPassword);
        }

        // If wp_check_password is not available, use an external library or custom implementation
        // For example, you can use a custom hashing function to check WordPress passwords manually
        // Placeholder for non-WordPress environments:
        return false;  // Replace this with custom implementation if needed
    }
    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'user_login' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('user_login')).'|'.$this->ip());
    }
}
