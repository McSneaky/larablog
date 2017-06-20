# LaraBlog
Blog test work, made on Laravel 5.4 <br />

## Starting up
- **Setting up**
  - run: ``git clone https://github.com/McSneaky/larablog``
  - run: ``composer install``
  - rename .env.example to .env and configure database, url, debug level etc
  - run: ``php artisan migrate``
- **Database seeding with test data**
  - run: ``php artisan db:seed --class=RolesTableSeeder`` <br /> 
  Populates roles
  - run: ``php artisan db:seed --class=UsersTableSeeder`` <br />
  Generates 10 random users including administrator and moderator (see below)
  - run: ``php artisan db:seed --class=PostsTableSeeder`` <br />
  Generates 50 random posts to random users
  - To generate more 10 users run: ``php artisan db:seed --class=UsersTableSeeder`` <br />
  Or go into database/seeds/UsersTableSeeder and increase $users count for custom ammount of users
  - To generate more 50 posts run: ``php artisan db:seed --class=PostsTableSeeder`` <br />
  Or go into database/seeds/PostsTableSeeder and increase $posts count for custom ammount of posts
- **Database seeding without test data**
  - run: ``php artisan db:seed --class=RolesTableSeeder``
 
- **Work with CSS and JS**
- run: ``npm install``
- run: ``npm run prod`` OR ``npm run dev`` depending on environment

## Usage
After seeding users table administrator and moderator users are created. <br />
**Admin details:**
- name: admin
- email: admin@admin.com
- password: admin

**Moderator details:** 
- name: modem
- email: modem@modem.com
- password: modem

**Moderator rights:**
- Edit posts
- Delete posts
- Delete images

**Admin rights:**
- Change users name
- Change users email
- Delete users
- +All Moderator rights

English and estonian languages are supported www.larablog.dev and www.larablog.dev/et (no prefix for english and */et* prefix for estonian)

## Notes
- Document root should be in larablog/public
- AppServiceProvider -> Schema default string length is limited to 191 to support older databases. <br />
- If images uploaded images are unaccessable then run: ``php artisan storage:link`` to create symbolic link from public/storage to storage/app/public 
- No copyright or anything attached, if you find this code you are free to use it wherever you want and modify as much as you like =)