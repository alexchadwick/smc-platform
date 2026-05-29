# Laravel Training

**With this package you can easily get assignable course functionality into your Laravel project.**

## Features
- Supported Course Types: Document, Media, Quiz
- Add your own Course Types and define your own methods to handle them
- Any type of User of your application can be a Participant of a Course
- Any type of User, and any number of Users of your application can be Authors (different roles) For a Course
- FUTURE
  - Reports
    - OpenEnrollmentReport - View open enrollments
    - EnrollmentReport - View all enrollments
    - UserReport - View details by user
    - CourseReport - View details by course

## Installation

You can install the package via composer:

```bash
composer require smc-dev/smc-training
```

- Laravel Version: 9.X
- PHP Version: 8.X

## Usage

### Class Diagram

### Publish Vendor Files (config, migrations, seeder)

```bash
php artisan vendor:publish --provider="Training\TrainingServiceProvider"
```

If you are updating the package, you may need to run the above command to publish the vendor files. 

But please take a backup of the config file. 

Also run the migration command to add new columns to the existing tables.

### Create course

```php
$course = \Training\Api\Models\Course::create([
    'name' => 'Computer Science'
]);
```
Run seder after install
```bash
php artisan db:seed --class="Training\\Api\\Database\\Seeders\\CourseTypeSeeder"
php artisan db:seed --class="Training\\Api\\Database\\Seeders\\UserCsvSeeder"
php artisan db:seed --class="Training\\Api\\Database\\Seeders\\CsvSeeder"
```

### Course Types

A seeder class `CourseTypeSeeder ` will be published into the `database/seeders` folder.

Run the following command to seed course types.

```bash
php artisan db:seed --class=\\Training\\Api\\Database\\Seeders\\CourseTypeSeeder
```

Currently, this package is configured to only handle the following type of courses:

- `document`
- `media`
- `quiz`

Create a CourseType:

```php
\Training\Api\Models\Course::create(['name'=>'interview']);
```

### User Defined Methods To Evaluate The Answer For Each Course Type

Though this package provides three question types you can easily change the method that is used to evaluate the answer.

You can do this by updating the `get_view_for_course_type` property in config file.

```php
'get_view_for_course_type' => [
    1 => '\Training\Api\Models\CourseAttempt::get_view_for_type_1_course',
    2 => '\Training\Api\Models\CourseAttempt::get_view_for_type_2_course',
    3 => '\Training\Api\Models\CourseAttempt::get_view_for_type_3_course',
    4 => 'Your custom method'
]
```

But your method has needs to have the following signature

```php
/**
 * @param QuizAttemptAnswer[] $quizQuestionAnswers All the answers of the quiz question
 */
public static function get_view_for_type_4_course(CourseAttempt $courseAttempt, QuizQuestion $quizQuestion, array $quizQuestionAnswers, $data = null): float
{
    // Your logic here
}
```

### Adding An Author(s) To A Course

```php
$admin = Author::create(
            ['name' => "John Doe"]
        );
$course = Course::factory()->make()->create([
            'name' => 'Sample Course'
        ]);
CourseAuthor::create([
            'course_id' => $course->id,
            'author_id' => $admin->id,
            'author_type' => get_class($admin),
            'author_role' => 'admin',
        ]);
$course->courseAuthors->first()->author; //Original User
```

### CanAuthorCourse trait

Add `CanAuthorCourse` trait to your model, and you can get all the courses associated by calling the `courses` relation. 

You can give any author role you want and implement ACL as per your use-case.

### Attempt The Course

```php
$course_attempt = CourseAttempt::create([
    'course_id' => $course->id,
    'participant_id' => $participant->id,
    'participant_type' => get_class($participant)
]);
```

### Get the Course Attempt Participant

`MorphTo` relation.

```php
$course_attempt->participant
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

### Security

If you discover any security related issues, please email durgaharish5@gmail.com instead of using the issue tracker.

## Credits

- [Tory Chadwick](https://github.com/alexchadwick)
- [All Contributors](../../contributors)

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).