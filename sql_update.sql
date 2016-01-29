
CREATE TABLE IF NOT EXISTS `customers` (
  `cutomer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`cutomer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `locations` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `zip_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;


INSERT INTO `locations` (`location_id`, `zip_code`, `city`, `province`) VALUES
(1, '1111', 'Colombo', 'Western'),
(2, '2222', 'Galle', 'Southern');

======================================================

CREATE TABLE IF NOT EXISTS `po` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `po_no` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `po_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `po_item_no` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` double NOT NULL,
  `po_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `po_id` (`po_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

ALTER TABLE `po_item`
  ADD CONSTRAINT `po_item_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `po` (`id`);

======================================================

ALTER TABLE `po_item` DROP FOREIGN KEY `po_item_ibfk_1` ;

ALTER TABLE `po_item` ADD CONSTRAINT `po_item_ibfk_1` FOREIGN KEY ( `po_id` ) REFERENCES `yii2advanced`.`po` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;
