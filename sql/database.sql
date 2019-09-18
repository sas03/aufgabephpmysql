/**
 * Modified by Atom.
 * User: sumo stephane
 * Date: 16/09/2019
 * Time: 17:30
 */
# Tabelle registered_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `registered_users`;

CREATE TABLE `registered_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Tabelle vehicles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vehicles`;

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registered_id` int(11) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `displayed_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;

INSERT INTO `vehicles` (`id`, `category`, `displayed_name`)
VALUES
	(1,'Land','Coupé'),
	(2,'Land','LKW'),
	(3,'Land','Bagger'),
	(4,'Luft','Airliner'),
	(5,'Luft','Hubschrauber'),
	(6,'Luft','Business-Jet'),
	(7,'Wasser','Öltanker'),
	(8,'Wasser','Jetski'),
	(9,'Wasser','Yacht');

/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;

ALTER TABLE `vehicles` ADD CONSTRAINT `fkregistered_id` FOREIGN KEY (`registered_id`) REFERENCES `registered_users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
