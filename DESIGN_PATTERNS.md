# Laravel Design Patterns & Best Practices Reference

This document outlines key design patterns and practices that can improve the structure, maintainability, and security of a Laravel project.

---

### 1. Service Layer

*   **What it is:** A design pattern where you extract business logic from controllers into dedicated "Service" classes. The controller's job becomes simply to handle the HTTP request and delegate the core work to a service.

*   **Why it's a best practice:** It leads to "skinny" controllers that are easy to read. It makes your core business logic reusable across different parts of the application (e.g., other controllers, console commands, or queued jobs) and much easier to test in isolation.

*   **Example in this project:** The `StripeController`'s `checkoutStripe` method is a prime candidate.

    ```php
    // Bad: "Fat Controller" with all logic inside
    class StripeController extends Controller
    {
        public function checkoutStripe(Request $request)
        {
            // 1. Stripe API logic...
            // 2. Order creation logic...
            // 3. OrderItem creation logic...
            // 4. Email sending logic...
            // 5. Cart destruction logic...
            return redirect('/')->with('success', 'Order complete!');
        }
    }

    // Good: "Skinny Controller" delegating to a service
    class StripeController extends Controller
    {
        public function checkoutStripe(Request $request, OrderService $orderService)
        {
            $orderService->createOrderFromStripe($request);
            return redirect('/')->with('success', 'Order complete!');
        }
    }
    ```

---

### 2. Repository Pattern

*   **What it is:** An abstraction layer between your business logic and your data/models. The repository handles all database queries for a specific model.

*   **Why it's a best practice:** It decouples your application from the database implementation (e.g., Eloquent). This makes your code easier to test (you can "mock" the repository) and centralizes all data-access logic, preventing scattered queries throughout your controllers.

*   **Example in this project:** Instead of writing queries directly in a controller, use a repository.

    ```php
    // Bad: Query logic inside the controller
    class AdminController extends Controller
    {
        public function manageVendor()
        {
            $active_vendor = User::where('role', 'vendor')->where('status', 'active')->latest()->get();
            return view('admin.manage-vendor', compact('active_vendor'));
        }
    }

    // Good: Controller uses a UserRepository
    class AdminController extends Controller
    {
        public function manageVendor(UserRepository $userRepository)
        {
            $active_vendor = $userRepository->getActiveVendors();
            return view('admin.manage-vendor', compact('active_vendor'));
        }
    }
    ```

---

### 3. Form Requests for Validation

*   **What it is:** Dedicated classes that handle the validation logic for a specific incoming HTTP request.

*   **Why it's a best practice:** It cleans up your controllers by removing validation clutter. The validation rules are self-contained and can be reused. Laravel automatically resolves and runs these requests before your controller method is even called, failing with a validation response if the rules don't pass.

*   **Example in this project:** The `updatePasswordProfile` method in `AdminController` has validation logic. This could be moved to a `UpdatePasswordRequest` class:

    ```php
    // Bad: Validation logic inside the controller
    class AdminController extends Controller
    {
        public function updatePasswordProfile(Request $request)
        {
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|same:confirm_password',
            ]);
            // ... logic to update password
        }
    }

    // Good: Controller uses a dedicated Form Request
    class AdminController extends Controller
    {
        // The request is automatically validated before this method is called.
        public function updatePasswordProfile(UpdatePasswordRequest $request)
        {
            // ... logic to update password
        }
    }
    ```

---

### 4. Use `.env` for Configuration and Secrets

*   **What it is:** Storing all environment-specific variables (like database credentials) and sensitive secrets (like API keys) in the `.env` file at the root of your project.

*   **Why it's a best practice:** This is **critical for security**. It prevents you from committing secret keys directly into your version control system (like Git). It also allows different developers and environments (local, staging, production) to use different configurations without changing the code.

*   **Example in this project:** The Stripe API key is hardcoded in `StripeController`. This is a major security risk. It should be:
    1.  Added to `.env` file: `STRIPE_SECRET=sk_test_...`
    2.  Referenced in `config/services.php`: `'stripe' => ['secret' => env('STRIPE_SECRET')]`
    3.  Used in your code: `\Stripe\Stripe::setApiKey(config('services.stripe.secret'));`

---

### 5. Expanded Use of Blade Components

*   **What it is:** Breaking down your UI into small, reusable, and self-contained Blade files called components.

*   **Why it's a best practice:** It makes your main view files cleaner and more readable by composing them from smaller pieces. It promotes a DRY (Don't Repeat Yourself) approach to your frontend code, making it easier to update and maintain.

*   **Example in this project:** A complex modal dialog can be turned into a simple, reusable component.

    ```html
    <!-- Bad: Large block of modal HTML inside a main view file -->
    <div class="modal fade" id="exampleModal" ...>
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- ... lots of modal HTML ... -->
        </div>
      </div>
    </div>

    <!-- Good: A clean, reusable component tag in the main view -->
    <x-login-modal />
    ```