# Hsoub Academy CMS

A full-featured Content Management System (CMS) built with Laravel 10.

This project was developed as a practical Laravel application that demonstrates authentication, authorization, role and permission management, post management, comments and replies, notifications, user profiles, admin dashboards, image uploads, search, and API authentication.

---

## 📌 Overview

Hsoub Academy CMS is a blog/content management platform where users can create and manage posts, interact with other users through comments and replies, receive notifications, and manage their profiles.

The system also includes a dedicated administration panel for managing:

- Posts
- Categories
- Users
- Roles
- Permissions
- Pages
- Comments
- Dashboard statistics

The project focuses on applying Laravel concepts in a real-world application structure rather than building a simple CRUD application.

---

## ✨ Features

### 👤 User Authentication

The project uses Laravel Jetstream and Laravel Fortify for authentication.

Supported authentication features include:

- User registration
- Login
- Logout
- Email verification
- Password reset
- Profile management
- Profile photo
- Password confirmation
- Two-factor authentication
- Session management
- API authentication using Laravel Sanctum

---

### 📝 Post Management

Authenticated users can create and manage their own posts.

Post functionality includes:

- Create posts
- View posts
- Edit posts
- Delete posts
- Post categories
- Post images
- Automatic slug generation
- Post approval system
- Author information
- Pagination
- Search
- Authorization policies

Each post contains information such as:

- Title
- Body
- Slug
- Image
- Author
- Category
- Approval status
- Creation date

---

### 🔐 Post Approval System

New posts created by users do not immediately appear on the public website.

Instead, they are submitted for administrator approval.

The workflow is:

```text
User creates post
       ↓
Post is stored
       ↓
Post remains unapproved
       ↓
Administrator reviews the post
       ↓
Administrator approves the post
       ↓
Post becomes visible to users
```

This provides a simple moderation workflow for the CMS.

---

### 🔗 Automatic Slug Generation

Post slugs are automatically generated from the post title.

A custom helper is used to generate unique slugs.

Example:

```text
Title:
Laravel Authentication Guide

Slug:
laravel-authentication-guide
```

The slug is also regenerated when the post title is updated.

---

### 🔍 Post Search

Users can search for posts through the search functionality.

The search system supports searching post content using a keyword.

Example:

```text
POST /search
```

Search results are paginated and only approved posts are displayed.

---

### 🗂️ Categories

Posts can be assigned to categories.

Users can browse posts belonging to a specific category.

Example route:

```text
/category/{id}/{slug}
```

Category functionality is also available through the administration panel.

---

### 💬 Comments

Authenticated users can comment on posts.

Comment functionality includes:

- Create comments
- Delete comments
- Associate comments with users
- Associate comments with posts
- Comment notifications
- Comment replies

Comments are connected to posts using Laravel Eloquent relationships.

---

### ↩️ Comment Replies

Users can reply to existing comments.

Replies are connected to their parent comment using:

```text
parent_id
```

This allows the application to support threaded conversations.

Example structure:

```text
Post
 └── Comment
      ├── Reply
      ├── Reply
      └── Reply
```

---

### 🔔 Notifications

The application includes a notification system for post interactions.

When a user comments on another user's post, the post owner can receive a notification.

Notifications are also connected to the application's event system.

Main notification routes include:

```text
GET  /notification
POST /notification
```

---

### ⚡ Events

The project uses Laravel events for handling comment-related notifications.

When a comment is created, a custom event is dispatched:

```text
CommentNotification
```

This allows notification-related logic to be separated from the main controller logic.

---

### 👨‍💻 User Profiles

Each user has a profile page.

Users can view:

- User information
- User posts
- User comments
- Profile photo

Routes include:

```text
/profile/{id}
/profile/{id}/comments
```

---

# 🛡️ Authorization

Authorization is implemented to control what users can do inside the application.

The project uses Laravel authorization mechanisms to protect post operations.

Examples include:

```php
auth()->user()->can('edit-post', $post);
```

and:

```php
auth()->user()->can('delete-post', $post);
```

This prevents users from modifying resources they should not be allowed to access.

---

# 👑 Roles & Permissions

The CMS contains a role and permission system.

Users can be assigned roles.

Roles can have multiple permissions.

The relationship is:

```text
User
  ↓
Role
  ↓
Permissions
```

The application uses:

```text
Role
Permission
```

models with a many-to-many relationship.

---

## 🔐 Role Management

Administrators can:

- Create roles
- View roles
- Delete roles
- Assign permissions to roles

Example:

```text
Admin
 ├── create-post
 ├── edit-post
 ├── delete-post
 ├── manage-users
 └── manage-categories
```

---

## 🔑 Permission Management

Administrators can assign permissions to roles.

Permissions are synchronized using Laravel Eloquent relationships.

Example:

```php
$role->permissions()->sync($request->permission);
```

This makes the authorization system flexible and easy to extend.

---

# 🖥️ Admin Dashboard

The project contains a dedicated administration dashboard.

Admin dashboard statistics include:

- Total posts
- Total users
- Total comments
- Total categories

Example dashboard structure:

```text
Admin Dashboard
│
├── Posts
├── Users
├── Comments
└── Categories
```

---

# ⚙️ Admin Panel

The admin panel is protected by custom admin middleware.

The main administration routes use:

```text
/admin
```

Available sections include:

```text
/admin/dashboard
/admin/category
/admin/posts
/admin/role
/admin/permission
/admin/user
/admin/page
```

---

# 📚 Admin Features

Administrators can manage:

### Posts

- View posts
- Create posts
- Edit posts
- Delete posts
- Approve posts

### Categories

- Create categories
- Edit categories
- Delete categories

### Users

- Manage users
- Assign roles
- Manage user accounts

### Roles

- Create roles
- Delete roles
- Manage role permissions

### Permissions

- View permissions
- Assign permissions to roles

### Pages

- Create pages
- Edit pages
- Delete pages

---

# 🖼️ Image Uploads

Users can upload images when creating posts.

Uploaded images are stored inside:

```text
public/image/
```

If the user does not provide an image, the application uses:

```text
default.jpg
```

Example:

```text
public/
└── image/
    ├── default.jpg
    ├── post-image.jpg
    └── ...
```

---

# 🔗 Eloquent Relationships

The project makes extensive use of Laravel Eloquent relationships.

## User Relationships

A user can have:

```text
User
├── hasMany Posts
├── hasMany Comments
├── belongsTo Role
├── hasMany Notifications
└── hasOne Alert
```

---

## Post Relationships

A post belongs to:

```text
Post
├── belongsTo User
├── belongsTo Category
└── morphMany Comments
```

---

## Comment Relationships

A comment can have:

```text
Comment
├── belongsTo User
├── belongsTo Post
├── morphTo Commentable
└── hasMany Replies
```

---

## Role Relationships

A role belongs to many permissions:

```text
Role
└── belongsToMany Permissions
```

---

## Permission Relationships

A permission belongs to many roles:

```text
Permission
└── belongsToMany Roles
```

---

# 🧩 Polymorphic Relationships

Comments use Laravel polymorphic relationships.

The main relationship is:

```php
public function commentable()
{
    return $this->morphTo();
}
```

Posts can then have multiple comments through:

```php
public function comments()
{
    return $this->morphMany(Comment::class, 'commentable');
}
```

This demonstrates how Laravel polymorphic relationships can be used to create flexible comment systems.

---

# 📊 Query Scopes

The `Post` model contains a custom query scope for retrieving approved posts.

Example:

```php
public function scopeApproved($query)
{
    return $query->whereApproved(1)->latest();
}
```

This allows controllers to easily retrieve approved posts:

```php
Post::approved()->paginate(10);
```

---

# 📄 Pagination

The application uses Laravel pagination for posts and search results.

Examples include:

```php
Post::approved()->paginate(10);
```

and:

```php
Post::where('body', 'LIKE', '%' . $keyword . '%')
    ->paginate(10);
```

Pagination helps keep large datasets manageable and improves the user experience.

---

# 🚦 Routing

The application contains both web and API routes.

---

## 🌐 Web Routes

Main public routes include:

```text
GET  /
POST /search
GET  /category/{id}/{slug}
GET  /profile/{id}
GET  /profile/{id}/comments
```

---

## 📝 Post Routes

The application uses Laravel resource routing:

```php
Route::resource('post', PostController::class);
```

This provides the standard CRUD routes for posts.

---

## 💬 Comment Routes

Comments use resource routing:

```php
Route::resource('comment', CommentController::class);
```

Replies are handled through:

```text
POST /reply/store
```

---

## 🔔 Notification Routes

Notification endpoints include:

```text
GET  /notification
POST /notification
```

---

# 👑 Admin Routes

Administration routes are grouped using an `/admin` prefix and protected by custom middleware.

```text
/admin/dashboard
/admin/category
/admin/posts
/admin/role
/admin/permission
/admin/user
/admin/page
```

Example:

```php
Route::prefix('admin')
    ->middleware('Admin')
    ->group(function () {
        // Admin routes
    });
```

---

# 🔌 API

The project also provides API authentication using Laravel Sanctum.

The API contains an authenticated user endpoint:

```text
GET /api/user
```

The endpoint is protected using:

```php
auth:sanctum
```

This demonstrates how Laravel Sanctum can be used to protect API routes.

---

# 🔐 Authentication Architecture

The project combines multiple Laravel authentication features.

```text
Laravel Jetstream
       ↓
Laravel Fortify
       ↓
Authentication
       ↓
Email Verification
       ↓
Two-Factor Authentication
       ↓
Laravel Sanctum
       ↓
API Authentication
```

---

# 📡 Broadcasting & Real-Time Infrastructure

The project includes Laravel Echo and Pusher dependencies.

These technologies provide the foundation for real-time application features and event broadcasting.

Installed packages include:

```text
laravel-echo
pusher-js
pusher/pusher-php-server
```

This architecture can be used for features such as:

- Real-time notifications
- Live updates
- Event broadcasting
- Real-time UI interactions

---

# 🎨 Frontend

The project uses a modern Laravel frontend stack.

Technologies include:

- Blade
- Tailwind CSS
- Alpine.js
- Laravel Vite
- Axios
- Laravel Echo

---

# 🧰 Tech Stack

## Backend

- PHP 8.1+
- Laravel 10
- Laravel Jetstream
- Laravel Fortify
- Laravel Sanctum
- Laravel Livewire
- Laravel Eloquent
- Laravel Events
- Laravel Notifications
- Laravel Policies
- Laravel Middleware

## Frontend

- Blade
- Tailwind CSS
- Alpine.js
- Axios
- Vite

## Real-Time

- Laravel Echo
- Pusher
- Pusher PHP Server

## Database

- MySQL / Compatible Relational Database
- Laravel Migrations
- Eloquent ORM
- Relationships

## Development Tools

- Composer
- NPM
- Git
- GitHub
- Laravel Sail
- Laravel Pint
- PHPUnit
- VS Code

---

# 📦 Main Dependencies

The project uses the following major Laravel packages:

```text
laravel/framework
laravel/jetstream
laravel/sanctum
livewire/livewire
guzzlehttp/guzzle
pusher/pusher-php-server
laravel/tinker
```

Development dependencies include:

```text
fakerphp/faker
laravel/pint
laravel/sail
mockery/mockery
nunomaduro/collision
phpunit/phpunit
spatie/laravel-ignition
```

---

# 🏗️ Project Architecture

The application follows Laravel's MVC architecture.

```text
User Request
     ↓
Routes
     ↓
Middleware
     ↓
Controller
     ↓
Model / Eloquent
     ↓
Database
     ↓
View
     ↓
Response
```

For event-based functionality:

```text
Controller
     ↓
Event
     ↓
Listener / Notification
     ↓
User
```

---

# 🗃️ Application Structure

Important directories include:

```text
app/
├── Events/
├── Helpers/
├── Http/
│   ├── Controllers/
│   └── Middleware/
├── Models/
└── ...

database/
├── factories/
├── migrations/
└── seeders/

resources/
├── css/
├── js/
└── views/

routes/
├── api.php
├── channels.php
├── console.php
└── web.php

public/
└── image/
```

---

# 🔄 Main Application Workflow

## User Registration

```text
User
 ↓
Registration
 ↓
Authentication
 ↓
Email Verification
 ↓
Dashboard
```

---

## Creating a Post

```text
Authenticated User
        ↓
Create Post
        ↓
Validate Data
        ↓
Upload Image
        ↓
Generate Slug
        ↓
Create Post
        ↓
Post Pending Approval
```

---

## Approving a Post

```text
Admin
 ↓
Admin Dashboard
 ↓
View Posts
 ↓
Review Post
 ↓
Approve Post
 ↓
Post Becomes Public
```

---

## Commenting

```text
User
 ↓
Create Comment
 ↓
Save Comment
 ↓
Check Post Owner
 ↓
Create Notification
 ↓
Dispatch CommentNotification Event
 ↓
Update Alert
```

---

## Replying to Comments

```text
User
 ↓
Reply to Comment
 ↓
Create Comment
 ↓
Set parent_id
 ↓
Save Reply
```

---

# 🔒 Security

The project applies several Laravel security mechanisms.

These include:

- Authentication
- Authorization
- Middleware
- Policies
- Email verification
- Two-factor authentication
- CSRF protection
- Password hashing
- Sanctum API authentication
- Protected admin routes
- Validated form requests / request validation
- Mass-assignment protection using `$fillable`

---

# 🛡️ Admin Middleware

Administration routes are protected using a custom middleware.

The middleware ensures that users without administrative privileges cannot access the administration panel.

The `User` model contains:

```php
public function isAdmin()
{
    return $this->role_id == 1;
}
```

This is used as part of the application's administrator authorization flow.

---

# 🧠 Permission Checking

Users can also be checked against specific permissions.

The `User` model contains:

```php
public function hasAllow($permission)
{
    return $this->role->permissions
        ->where('name', $permission)
        ->count();
}
```

This allows application logic to determine whether the authenticated user's role has a particular permission.

---

# 🧪 Testing

The project includes PHPUnit and Laravel testing infrastructure.

Testing tools include:

```text
PHPUnit
Mockery
Laravel Testing Utilities
```

Tests can be executed with:

```bash
php artisan test
```

---

# ⚡ Laravel Artisan Commands

Useful Laravel commands during development include:

```bash
php artisan serve
```

Run migrations:

```bash
php artisan migrate
```

Run migrations with seeders:

```bash
php artisan migrate --seed
```

Clear application cache:

```bash
php artisan optimize:clear
```

Run tests:

```bash
php artisan test
```

---

# 📥 Installation

Follow these steps to run the project locally.

## 1. Clone the Repository

```bash
git clone https://github.com/MoamenRamy/CMS-hsoub-academy.git
```

Navigate into the project:

```bash
cd CMS-hsoub-academy
```

---

## 2. Install PHP Dependencies

```bash
composer install
```

---

## 3. Install Frontend Dependencies

```bash
npm install
```

---

## 4. Create Environment File

Copy the example environment file:

```bash
cp .env.example .env
```

On Windows, you can manually copy:

```text
.env.example
```

to:

```text
.env
```

---

## 5. Generate Application Key

```bash
php artisan key:generate
```

---

## 6. Configure Database

Update your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

---

## 7. Run Migrations

```bash
php artisan migrate
```

If the project contains seed data:

```bash
php artisan migrate --seed
```

---

## 8. Create Storage Link

If storage files are required:

```bash
php artisan storage:link
```

---

## 9. Start Laravel Development Server

```bash
php artisan serve
```

The application will be available at:

```text
http://127.0.0.1:8000
```

---

## 10. Start Vite

For frontend development:

```bash
npm run dev
```

For production assets:

```bash
npm run build
```

---

# ⚙️ Environment Configuration

Important environment variables include:

```env
APP_NAME="Hsoub Academy CMS"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost
```

Database configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

Additional configuration may be required for:

- Mail
- Pusher
- Broadcasting
- Sanctum
- File storage

depending on the environment.

---

# 📌 Example Post Model

The `Post` model contains the main post attributes:

```php
protected $fillable = [
    'title',
    'body',
    'slug',
    'image_path',
    'approved',
    'category_id',
    'user_id',
];
```

---

# 📌 Example Relationships

Post → User:

```php
public function user()
{
    return $this->belongsTo(User::class);
}
```

Post → Category:

```php
public function category()
{
    return $this->belongsTo(Category::class);
}
```

Post → Comments:

```php
public function comments()
{
    return $this->morphMany(Comment::class, 'commentable');
}
```

---

# 🧱 Database Relationships

The main application relationships can be represented as:

```text
                    ┌──────────────┐
                    │     Role     │
                    └──────┬───────┘
                           │
                           │
                    ┌──────▼───────┐
                    │     User     │
                    └──────┬───────┘
                           │
             ┌─────────────┼──────────────┐
             │             │              │
             ▼             ▼              ▼
          Posts         Comments      Notifications
             │             │
             │             │
             ▼             ▼
         Category       Replies
```

---

# 🎯 Project Goals

This project demonstrates practical experience with:

- Laravel MVC
- Authentication
- Authorization
- CRUD operations
- Eloquent ORM
- Model relationships
- Polymorphic relationships
- Middleware
- Policies
- Roles and permissions
- Events
- Notifications
- API authentication
- Sanctum
- Pagination
- Search
- Image uploads
- Admin dashboards
- Blade
- Livewire
- Tailwind CSS
- Alpine.js
- Vite
- Real-time infrastructure

---

# 💡 What This Project Demonstrates

This project goes beyond basic CRUD functionality by implementing several important backend concepts.

### Authentication

Secure user authentication with Jetstream, Fortify, email verification, and two-factor authentication.

### Authorization

Role and permission based authorization combined with Laravel authorization features.

### Database Design

Multiple Eloquent relationships including:

- One-to-many
- Many-to-many
- Polymorphic relationships

### Application Architecture

Separation of responsibilities using:

- Controllers
- Models
- Middleware
- Policies
- Events
- Notifications
- Helpers

### API Development

Sanctum-protected API endpoints demonstrate token-based API authentication.

### Admin Management

A dedicated administration area provides centralized management of application resources.

---

# 🚀 Future Improvements

Possible improvements for future versions include:

- Advanced post filtering
- Rich text editor
- Post drafts
- Scheduled publishing
- Advanced notification center
- More REST API endpoints
- API Resources
- Automated feature tests
- Advanced permission management
- Full real-time notifications
- Redis caching
- Queue-based background processing
- Improved search using Laravel Scout
- Docker production setup
- CI/CD pipeline
- Production deployment automation

---

# 🧑‍💻 Author

## Moamen Ramy Rahmo

PHP & Laravel Backend Developer

GitHub:

https://github.com/MoamenRamy

LinkedIn:

https://www.linkedin.com/in/moamen-ramy-492a8b212/

---

# 📄 License

This project is open-sourced software licensed under the MIT license.

---

# ⭐ If You Like This Project

If you find this project useful or interesting, feel free to explore the repository and check out the other projects on my GitHub profile.

**GitHub:**  
https://github.com/MoamenRamy
