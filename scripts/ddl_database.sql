/*
Para ingresar a mysql en ubuntu
sudo mysql --defaults-file=/etc/mysql/debian.cnf
*/


CREATE USER 'tpl_company_tpl_tpl_project_tpl_app_user'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON tpl_company_tpl_tpl_project_tpl.* TO 'tpl_company_tpl_tpl_project_tpl_app_user'@'localhost';


DROP DATABASE IF EXISTS tpl_company_tpl_tpl_project_tpl;

CREATE DATABASE tpl_company_tpl_tpl_project_tpl CHARACTER SET utf8 COLLATE utf8_general_ci;

USE tpl_company_tpl_tpl_project_tpl;
