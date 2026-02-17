# Design Document: Role-Based Access Control

## Overview

This design implements role-based access control (RBAC) for a Laravel POS system by extending the existing User model with role functionality and implementing middleware-based authorization. The system will support two roles: admin and cashier, with admins having full system access including user management capabilities, while cashiers are restricted to the POS interface only.

The implementation leverages Laravel's built-in authentication system, middleware, and Eloquent ORM to provide a clean, maintainable solution that integrates seamlessly with the existing codebase.

## Architecture

The RBAC system follows Laravel's MVC architecture with the following key components:

### Component Layers

1. **Database Layer**: Extended users table with role column
2. **Model Layer**: Enhanced User model with role-related methods and scopes
3. **Middleware Layer**: Custom middleware for role-based route protection
4. **Controller Layer**: 
   - UserController for cashier management (admin only)
   - Enhanced AuthController for role-aware authentication
5. **View Layer**: 
   - Admin dashboard with user management interface
   - Role-specific navigation and layouts

### Authentication Flow

```
User Login → AuthController → Validate Credentials → Check Role → Redirect to Role-Specific Interface
                                                                  ↓
                                                    Admin → Dashboard
                                                    Cashier → POS Interface
```

### Authorization Flow

```
Route Request → Middleware Check → Session Valid? → Role Check → Grant/Deny Access
                                        ↓ No                ↓ Fail
                                   Redirect Login      Redirect Appropriate Page
```

## Components and Interfaces

### 1. Database Schema Extension

**Migration: add_role_to_users_table**

```php
Schema::table('users', function (Blueprint $table) {
    $table->enum('role', ['admin', 'cashier'])->default('cashier')->after('password');
});
```

### 2. User Model Enhancement

**File: app/Models/User.php**

```php
class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
    ];

    // Role checking methods
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isCashier(): bool
    {
        return $this->role === 'cashier';
    }

    // Query scopes
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeCashiers($query)
    {
        return $query->where('role', 'cashier');
    }
}
```

### 3. Middleware Components

**File: app/Http/Middleware/AdminMiddleware.php**

```php
class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->isAdmin()) {
            return redirect()->route('pos.index')
                ->with('error', 'Access denied. Admin privileges required.');
        }

        return $next($request);
    }
}
```

**File: app/Http/Middleware/CashierMiddleware.php**

```php
class CashierMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->isCashier()) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'This area is for cashiers only.');
        }

        return $next($request);
    }
}
```

### 4. User Management Controller

**File: app/Http/Controllers/UserController.php**

```php
class UserController extends Controller
{
    public function index()
    {
        $cashiers = User::cashiers()->get();
        return view('admin.users.index', compact('cashiers'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => 'cashier',
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Cashier created successfully.');
    }

    public function edit(User $user)
    {
        if ($user->isAdmin()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Cannot edit admin accounts.');
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->isAdmin()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Cannot edit admin accounts.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->username = $validated['username'];
        
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        
        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'Cashier updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->isAdmin()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Cannot delete admin accounts.');
        }

        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Cashier deleted successfully.');
    }
}
```

### 5. Enhanced Authentication Controller

**File: app/Http/Controllers/AuthController.php**

```php
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            
            if ($user->isAdmin()) {
                return redirect()->intended(route('admin.dashboard'));
            }
            
            return redirect()->intended(route('pos.index'));
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}
```

### 6. Route Configuration

**File: routes/web.php**

```php
// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    Route::resource('users', UserController::class)->except(['show']);
});

// POS routes (accessible by both admin and cashier)
Route::middleware(['auth'])->prefix('pos')->name('pos.')->group(function () {
    Route::get('/', [POSController::class, 'index'])->name('index');
    // Other POS routes...
});
```

## Data Models

### User Model Attributes

| Attribute | Type | Description | Constraints |
|-----------|------|-------------|-------------|
| id | integer | Primary key | Auto-increment |
| name | string | Full name | Required, max 255 |
| username | string | Login username | Required, unique, max 255 |
| password | string | Hashed password | Required, min 8 chars |
| role | enum | User role | Values: 'admin', 'cashier' |
| created_at | timestamp | Creation time | Auto-managed |
| updated_at | timestamp | Last update time | Auto-managed |

### Role Enumeration

```php
enum UserRole: string
{
    case ADMIN = 'admin';
    case CASHIER = 'cashier';
}
```

## Correctness Properties

*A property is a characteristic or behavior that should hold true across all valid executions of a system—essentially, a formal statement about what the system should do. Properties serve as the bridge between human-readable specifications and machine-verifiable correctness guarantees.*


### Property Reflection

After analyzing all acceptance criteria, I've identified the following redundancies:

- **6.3 and 8.3** are identical: Both test that cashiers cannot access admin routes
- **2.3 and 8.4** are identical: Both test that authentication accepts username and password fields
- **4.2 and 10.2** are identical: Both test password hashing on update
- **3.4 and 10.1** overlap significantly: Both test password hashing on creation
- **2.1 and 8.1** are similar but for different roles: Can be combined into one property that tests authentication for any user role
- **2.4 and 9.1** overlap: Session creation with role information subsumes basic session creation

Consolidated approach:
- Combine role-specific authentication tests into general authentication properties
- Remove duplicate password hashing tests
- Combine access control tests into comprehensive authorization properties
- Keep edge cases and examples separate

### Properties

Property 1: Role field validity
*For any* user in the system, the role field must exist and contain only valid values ('admin' or 'cashier')
**Validates: Requirements 1.1, 1.3, 1.4**

Property 2: Role assignment requirement
*For any* user creation attempt without a role, the system must reject the creation
**Validates: Requirements 1.2**

Property 3: Authentication with valid credentials
*For any* user with valid credentials, authentication must succeed and create a session containing role information
**Validates: Requirements 2.1, 2.4, 8.1, 9.1**

Property 4: Authentication with invalid credentials
*For any* authentication attempt with invalid credentials, the system must reject the attempt and return an error
**Validates: Requirements 2.2**

Property 5: Role-based redirect after login
*For any* authenticated user, the system must redirect admins to the admin dashboard and cashiers to the POS interface
**Validates: Requirements 8.2**

Property 6: Cashier creation stores all fields
*For any* valid cashier creation request, the system must store username, hashed password, and role
**Validates: Requirements 3.1, 3.4, 10.1**

Property 7: Username uniqueness on creation
*For any* user creation attempt with a duplicate username, the system must reject the creation
**Validates: Requirements 3.2**

Property 8: Validation errors on invalid creation
*For any* user creation attempt with invalid data, the system must reject the creation and return validation errors
**Validates: Requirements 3.3**

Property 9: User update modifies fields
*For any* valid user update request, the system must persist the specified field changes
**Validates: Requirements 4.1**

Property 10: Password hashing on update
*For any* password update, the system must hash the new password before storage
**Validates: Requirements 4.2, 10.2**

Property 11: Validation errors on invalid update
*For any* user update attempt with invalid data, the system must reject the update and return validation errors
**Validates: Requirements 4.3**

Property 12: Username uniqueness on update
*For any* username update attempt that conflicts with an existing username, the system must reject the update
**Validates: Requirements 4.4**

Property 13: Cashier deletion removes user
*For any* cashier account deletion by an admin, the system must remove the user from the database
**Validates: Requirements 5.1**

Property 14: Self-deletion prevention
*For any* admin attempting to delete their own account, the system must prevent the deletion
**Validates: Requirements 5.2**

Property 15: Admin access to all routes
*For any* authenticated admin user, the middleware must grant access to both admin dashboard and POS interface routes
**Validates: Requirements 6.1**

Property 16: Cashier restricted access
*For any* authenticated cashier user, the middleware must grant access to POS routes and deny access to admin routes
**Validates: Requirements 6.2, 6.3, 8.3**

Property 17: Unauthenticated access denial
*For any* unauthenticated request to protected routes, the middleware must redirect to the login page
**Validates: Requirements 6.4**

Property 18: Cashier list display
*For any* admin viewing the dashboard, the system must display all cashier accounts with their username and role
**Validates: Requirements 7.1, 7.2**

Property 19: Edit form pre-population
*For any* cashier edit form request, the system must pre-fill the form with the cashier's current data
**Validates: Requirements 7.5**

Property 20: Session destruction on logout
*For any* user logout, the system must destroy the session
**Validates: Requirements 9.2**

Property 21: Session validity check
*For any* request to protected routes, the middleware must verify session validity before granting access
**Validates: Requirements 9.3**

Property 22: Password never stored in plain text
*For any* user in the database, the password field must be hashed and not equal to any plain text password
**Validates: Requirements 10.3**

## Error Handling

### Validation Errors

**User Creation/Update Validation**:
- Missing required fields: Return 422 with field-specific error messages
- Invalid username format: Return 422 with descriptive error
- Duplicate username: Return 422 with "Username already exists" error
- Password too short: Return 422 with "Password must be at least 8 characters" error
- Invalid role value: Return 422 with "Invalid role specified" error

**Authentication Errors**:
- Invalid credentials: Return 401 with "Invalid username or password" message
- Missing credentials: Return 422 with field-specific errors
- Account locked/disabled: Return 403 with appropriate message

### Authorization Errors

**Access Denied**:
- Cashier accessing admin routes: Redirect to POS interface with flash message
- Unauthenticated user: Redirect to login page with intended URL stored
- Admin attempting to edit/delete admin accounts: Redirect with error message

### Database Errors

**Integrity Violations**:
- Foreign key constraints: Log error, return 500 with generic message
- Unique constraint violations: Return 422 with user-friendly message
- Connection failures: Log error, return 503 with "Service temporarily unavailable"

### Session Errors

**Session Management**:
- Expired session: Redirect to login with "Session expired" message
- Invalid session token: Clear session, redirect to login
- Session fixation attempts: Regenerate session token, log security event

## Testing Strategy

This feature will use a dual testing approach combining unit tests for specific scenarios and property-based tests for universal correctness properties.

### Unit Testing

Unit tests will focus on:
- Specific examples of user creation, update, and deletion workflows
- Edge cases like self-deletion prevention and admin account protection
- Integration between authentication and authorization components
- UI rendering of user management interfaces
- Error message formatting and validation responses

Example unit tests:
- Test that admin can create a cashier with valid data
- Test that deleting own account is prevented
- Test that login form displays correctly
- Test that validation errors are returned for missing fields

### Property-Based Testing

Property-based tests will verify universal properties across randomized inputs using a PHP property testing library (e.g., Eris or Pest with property testing plugin).

**Configuration**:
- Minimum 100 iterations per property test
- Each test tagged with: **Feature: role-based-access-control, Property {N}: {property text}**
- Generators for: random usernames, passwords, roles, user objects

**Property Test Coverage**:
- Each of the 22 correctness properties listed above will have a corresponding property-based test
- Tests will generate random valid and invalid inputs to verify properties hold universally
- Focus on data integrity, authentication flows, authorization rules, and password security

Example property tests:
- **Property 1**: Generate random users, verify all have valid role values
- **Property 6**: Generate random cashier data, verify all fields stored correctly with hashed passwords
- **Property 16**: Generate random cashier users, verify they cannot access any admin routes

### Test Organization

```
tests/
├── Unit/
│   ├── Models/
│   │   └── UserTest.php
│   ├── Middleware/
│   │   ├── AdminMiddlewareTest.php
│   │   └── CashierMiddlewareTest.php
│   └── Controllers/
│       ├── UserControllerTest.php
│       └── AuthControllerTest.php
└── Property/
    ├── UserRolePropertiesTest.php
    ├── AuthenticationPropertiesTest.php
    ├── AuthorizationPropertiesTest.php
    └── PasswordSecurityPropertiesTest.php
```

### Testing Tools

- **PHPUnit**: Primary testing framework
- **Laravel Testing Utilities**: Database factories, HTTP testing, authentication helpers
- **Eris or Pest Property Testing**: Property-based testing library
- **Laravel Dusk** (optional): Browser testing for UI workflows

Both unit tests and property tests are essential for comprehensive coverage. Unit tests catch specific bugs and validate concrete examples, while property tests verify that the system behaves correctly across all possible inputs.
