create table instructions (
    id int(10) primary key not null auto_increment,
    content longtext
);


create table examinee (
    id int(10) primary key not null auto_increment,
    first_name varchar(50),
    last_name varchar(50),
    email varchar(150),
    institution varchar(255),
    initial_training_date date,
    refresher_training_date date,
    fibroscan_device_serial_no varchar(150),
    scan_done int(10),
    is_verified tinyint
);


create table topics (
    id int(10) primary key not null auto_increment,
    title varchar(255),
    content longtext
);


create table studied (
    id int(10) primary key not null auto_increment,
    examinee_id int(10),
    topics_id int(10),
    foreign key (examinee_id) references examinee(id) on delete cascade,
    foreign key (topics_id) references topics(id) on delete cascade
);


create table questions (
    id int(10) primary key not null auto_increment,
    question longtext
);


create table choices (
    id int(10) primary key not null auto_increment,
    question_id int(10),
    choice_1 mediumtext,
    choice_2 mediumtext,
    choice_3 mediumtext,
    choice_4 mediumtext,
    choice_5 mediumtext,
    choice_6 mediumtext,
    answer varchar(50),
    foreign key (question_id) references questions(id) on delete cascade
);

create table results (
    id int(10) primary key not null auto_increment,
    examinee_id int(10),
    marks int(10),
    passed tinyint,
    submit_date date,
    foreign key (examinee_id) references examinee(id) on delete cascade
);
