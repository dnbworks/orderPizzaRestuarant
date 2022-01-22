<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->title; ?> - Pizza </title>

    <link rel="stylesheet" href="/asset/css/bootstrap-grid.min.css">
    <script src="/asset/js/font_awesome.js"></script>
</head>
<body>
    <header>
        <p>Pizzapp administration</p>
        <p>Hi Ricardo Miller</p>
    </header>
    {{content}}
</body>
</html>

<!-- create table users (
    user_id int unsigned not null auto_increment primary key,
    firstname varchar(190),
    lastname varchar(190),
    email varchar(190) unique,
    password_hash varchar(190),
    create_at timestamp DEFAULT CURRENT_TIMESTAMP,
    modified_at timestamp DEFAULT CURRENT_TIMESTAMP,
    avatar varchar(190),
    status varchar(24),
    role_id int unsigned not null,
    foreign key (role_id) references roles (role_id)
)
role superadmin

ALTER TABLE `users` CHANGE `password_hash` `password` VARCHAR(190)

permission 
have_admin_access
can_view_user
can_add_user
can_edit_user
can_view_permission
can_edit_permission
can_view_role -->