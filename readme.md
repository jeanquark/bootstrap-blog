## Bootstrap blog on Laravel 5.4

[![Build Status](https://travis-ci.org/jeanquark/bootstrap-blog.svg?branch=master)](https://travis-ci.org/jeanquark/bootstrap-blog)

Ever wanted to play around the famous [bootstrap blog](hhttps://startbootstrap.com/template-overviews/blog-home) live? This project is a fully functional blog application based on the bootstrap blog template and the bootstrap 3 [adminsb](http://startbootstrap.com/template-overviews/sb-admin) theme for the admin area. It is written in PHP using [Laravel 5.4](https://laravel.com) as a framework. It takes advantage of Laravel [built-in authentication](https://laravel.com/docs/5.4/authentication) and adds a minimal number of highly recommended external packages, so that you're free to expand the blog as you like! **No fancy visual effects, no weird plug-ins, no complex backend code, just a clean and expandable blogging platform!**

![homepage](https://github.com/jeanquark/bootstrap-blog/raw/master/public/homepage.jpg "Homepage")

## Installation

You need to have a local server working on your computer to run this project locally. I recommand you initialize a complete local development environment with [Homestead](https://laravel.com/docs/master/homestead) but you can also use [Xampp](https://www.apachefriends.org/fr/index.html), which is more straightforward to install on a windows machine. So first make sure a local server is running on your computer. Next create the database on which blog posts will reside (for example using phpmyadmin). Then type the following commands in your favorite CLI (xampp users: make sure your emplacement is the *xampp/htdocs* folder):

Clone the repo:
```
git clone https://github.com/jeanquark/bootstap-blog.git
```

Move to the newly created folder and install all dependencies:
```
cd bootstrap-blog
composer install
```

Open the .env.example file, edit it to match your database name, username and password (required step) as well as your email credentials (optional, but required for the contact form to work) and save it as .env file. Then build tables with command:
```
php artisan migrate
```

Now fill the tables:
```
php artisan db:seed
```

Generate application key 
```
php artisan key:generate
```

And voilà! Now you should be able to test the application. Go to the login page and enter the provided credentials. Then click on the top nav email address to get to the admin area and... enjoy!


## Features
1. Create blog posts that consist of formatted text and images.
2. Link those posts to tags for quick reference.
3. Allow posts to be commented and comments to be replied.
4. Search among posts based on text excerpt.
5. Send a message with the contact form.


## Contact Form
Submitted messages from the contact form are saved in the database. However, you can also make sure they're sent to your email address by commenting out proper lines in the HomeContoller. I have preconfigured a Gmail address in the *.env.example* file. All you have to do is entering your actual email address and password!


## Screenshots
Login:
![Login](https://github.com/jeanquark/bootstrap-blog/raw/master/public/login.jpg "Login")

Post:
![Post](https://github.com/jeanquark/bootstrap-blog/raw/master/public/post.jpg "Post")

Comment:
![Comment](https://github.com/jeanquark/bootstrap-blog/raw/master/public/comment.jpg "Comment")

Admin:
![Admin](https://github.com/jeanquark/bootstrap-blog/raw/master/public/admin.jpg "Admin")

List posts:
![Posts](https://github.com/jeanquark/bootstrap-blog/raw/master/public/posts.jpg "Posts List")


## External packages
* [image-validator](https://github.com/cviebrock/image-validator) for image upload validation
* [markdown](https://github.com/NextStepWebs/simplemde-markdown-editor) for clean writing in Markdown
* [hashids](https://github.com/ivanakimov/hashids.php) for quick hash of user ids
* [active](https://github.com/letrunghieu/active) for active class on current url



## Testing
This app comes with full integration tests. Simply run:
```
phpunit
```
This is what you should get:
![PHPUnit](https://github.com/jeanquark/bootstrap-blog/raw/master/public/phpunit.jpg "PHPUnit results")


Replies to comments, which involve JavaScript, can be properly tested with Laravel Dusk. I have written a special test for this purpose. Just run:

```
php artisan dusk
```

## License

Please refer to the [bootstrap blog](http://startbootstrap.com/template-overviews/blog-home) license.

## Author

Visit my blog: [www.jmkleger.com](http://www.jmkleger.com)
