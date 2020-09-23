DROP DATABASE IF EXISTS tpl_company_tpl_tpl_project_tpl;

CREATE DATABASE tpl_company_tpl_tpl_project_tpl CHARACTER SET utf8 COLLATE utf8_general_ci;

USE tpl_company_tpl_tpl_project_tpl;


create table users
(
    user_id       varchar(36)  not null
        primary key,
    name          varchar(36)  null,
    password_hash varchar(255) null,
    email         varchar(100) null,
    type          varchar(10)  null
);

create table sessions
(
    session_id      varchar(36) not null
        primary key,
    user_id         varchar(36) null,
    creation_date   datetime    null,
    expiration_date datetime    null,
    state           varchar(36) null
);

