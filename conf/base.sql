-- user
create table user
(
    id          bigint unsigned auto_increment comment 'ID'
        primary key,
    tel         varchar(50)             null comment '手机号',
    nickname    varchar(255)            null comment '昵称',
    open_id     varchar(100)            null comment 'OpenID',
    union_id    varchar(100)            null comment 'UnionID',
    avatar      varchar(255) default '' null comment '头像',
    sex         tinyint      default 0  null comment '性别0不明1男2女',
    pwd         varchar(255)            null comment '密码',
    account     varchar(50)             null comment '账号',
    create_time bigint                  null comment '创建时间',
    update_time bigint                  null comment '更新时间',
    delete_time bigint       default 0  null comment '删除时间'
)
    collate = utf8mb4_general_ci;

create index index_account
    on user (account);

create index index_tel
    on user (tel);

-- role
create table role
(
    id          bigint auto_increment comment 'ID'
        primary key,
    name        varchar(50)      null comment '名称',
    cn_name     varchar(50)      null comment '中文名称',
    create_time bigint           null comment '添加时间',
    update_time bigint           null comment '更新时间',
    delete_time bigint default 0 null comment '删除时间'
)
    collate = utf8mb4_general_ci;

-- user-role
create table user_role
(
    id          bigint unsigned auto_increment comment 'ID'
        primary key,
    user_id     bigint unsigned             not null comment '用户ID',
    role_id     bigint unsigned             not null comment '角色ID(role)',
    role_key    varchar(50)                 null,
    relation_id bigint unsigned default '0' not null comment '关系ID',
    school_id   bigint          default 0   null comment '冗余字段便于查询',
    create_time bigint                      null comment '创建时间',
    update_time bigint                      null comment '更新时间',
    delete_time bigint          default 0   null comment '删除时间'
)
    collate = utf8mb4_general_ci;

create index index_user_id
    on user_role (user_id);

-- school
create table school
(
    id                     bigint auto_increment
        primary key,
    name                   varchar(255)         null,
    create_time            bigint               null,
    update_time            bigint               null,
    delete_time            bigint  default 0    null
)
    comment '学校';

-- student
create table student
(
    id                   bigint auto_increment
        primary key,
    name                 varchar(255)      null,
    tel                  varchar(15)       null comment '手机号',
    id_number            varchar(20)       null comment '学号',
    sex                  tinyint default 0 null,
    birthday             varchar(15)       null,
    school_id            bigint            null,
    create_time          bigint            null,
    update_time          bigint            null,
    delete_time          bigint  default 0 null
)
    comment '学生';

-- teacher
create table teacher
(
    id          bigint auto_increment
        primary key,
    name        varchar(255)      null,
    tel         varchar(15)       null,
    id_number   varchar(20)       null comment '工号/身份证号',
    sex         tinyint default 0 null,
    birthday    varchar(15)       null,
    school_id   bigint            null,
    create_time bigint            null,
    update_time bigint            null,
    delete_time bigint  default 0 null
)
    comment '老师';


-- 插入数据
-- user
INSERT INTO user (id, tel, nickname, pwd, create_time, update_time) VALUES (1, '10000', '超级管理员', '$2y$10$uaJWa18TIGaph2oWnHxZte2wEb/ixOX3u0ObA19Yk3TnkhT6MqJlK', 1, 1);
-- school
insert into school (name, create_time, update_time) VALUES ('午山小学', 1, 1);
-- teacher
insert into teacher (name, tel, sex, birthday, school_id, create_time, update_time) VALUES ('派大星', '19900001111', 1, '2010-01-01', 1, 1 ,1);
-- student
insert into  student (name, tel, sex, birthday, school_id, create_time, update_time) VALUES ('海绵宝宝', '19911110000', 1, '2010-01-01', 1, 1, 1);
-- role
INSERT INTO role (id, name, cn_name, create_time, update_time, delete_time) VALUES (1, 'root', '超级管理员', 1, 1, 0);
INSERT INTO role (id, name, cn_name, create_time, update_time, delete_time) VALUES (2, 'admin', '次级管理员', 1, 1, 0);
INSERT INTO role (id, name, cn_name, create_time, update_time, delete_time) VALUES (3, 'student', '学生', 1, 1, 0);
INSERT INTO role (id, name, cn_name, create_time, update_time, delete_time) VALUES (4, 'teacher', '老师', 1, 1, 0);