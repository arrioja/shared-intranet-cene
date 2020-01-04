create database if not exists `guru`;

USE `guru`;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
		
/*Table structure for table `employees` */
	
CREATE TABLE `employees` (
	  `id` int(6) NOT NULL auto_increment,
	  `name` char(20) default NULL,
	  `lastname` char(20) default NULL,
	  `salary` float default NULL,
	  `age` int(2) default NULL,
	  `afiliation` date default NULL,
	  `status` int(1) default NULL,
	  `active` tinyint(1) default NULL,
	  `workeddays` int(2) default NULL,
	  `photo` char(30) default NULL,
	  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	
/*Data for the table `employees` */
		
insert into `employees`
	(`id`,`name`,`lastname`,`salary`,`age`,`afiliation`,`status`,`active`,`workeddays`,`photo`) 
	values (1, 'Ana', 'Trujillo',2000,45, '2005-05-13',1,1,10, '1.jpg');
insert into `employees` 
	(`id`,`name`,`lastname`,`salary`,`age`,`afiliation`,`status`,`active`,`workeddays`,`photo`)
	values (2, 'Jennifer', 'Aniston',3500,23, '2004-10-22',1,0,0, '2.jpg');
insert into `employees` 
	(`id`,`name`,`lastname`,`salary`,`age`,`afiliation`,`status`,`active`,`workeddays`,`photo`)
	values (3, 'Michael', 'Norman',1200,19, '2007-01-10',1,1,5, '3.jpg');
insert into `employees` 
	(`id`,`name`,`lastname`,`salary`,`age`,`afiliation`,`status`,`active`,`workeddays`,`photo`)
	values (4, 'Vanessa', 'Black',6500,31, '2000-11-05',1,1,30, '4.jpg');
insert into `employees` 
	(`id`,`name`,`lastname`,`salary`,`age`,`afiliation`,`status`,`active`,`workeddays`,`photo`)
	values (5, 'Michael', 'Strauss',3200,45, '2006-10-21',2,0,22, '5.jpg');
insert into `employees` 
	(`id`,`name`,`lastname`,`salary`,`age`,`afiliation`,`status`,`active`,`workeddays`,`photo`)
	values (6, 'William', 'Brown',2300,21, '2001-03-10',3,1,10, '6.jpg');
insert into `employees` 
	(`id`,`name`,`lastname`,`salary`,`age`,`afiliation`,`status`,`active`,`workeddays`,`photo`)
	values (7, 'Lucca', 'Normany',2800,36, '2006-10-02',3,1,20, '7.jpg');
	
SET SQL_MODE=@OLD_SQL_MODE;";
