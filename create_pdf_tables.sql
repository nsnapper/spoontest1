DROP TABLE IF EXISTS `pdf_pages`;
CREATE TABLE `pdf_pages` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `parent_id` int(5) NOT NULL,
  `page_image` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `pdf_links`;
CREATE TABLE `pdf_links` (
  `id` int(5)  NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `pdf_filename` varchar(256) NOT NULL,
  `pdf_image` varchar(256) NOT NULL,
  `pdf_page_id` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;
