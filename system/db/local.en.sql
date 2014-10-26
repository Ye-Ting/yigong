-- Insert data into `eps_block`;
INSERT INTO `eps_block` (`id`, `type`, `title`, `content`, `template`) VALUES
(1, 'latestArticle', 'Latest Article', '{"category":"0","limit":"7"}', 'default'),
(2, 'hotArticle', 'Hot Article', '{"category":"0","limit":"7"}', 'default'),
(3, 'latestProduct', 'Latest Product', '{"category":"0","limit":"3","image":"show"}', 'default'),
(4, 'hotProduct', 'Hot Product', '{"category":"0","limit":"3","image":"show"}', 'default'),
(5, 'slide', 'Slide', '', 'default'),
(6, 'articleTree', 'Article Category', '{"showChildren":"0"}', 'default'),
(7, 'productTree', 'Product Category', '{"showChildren":"0"}', 'default'),
(8, 'blogTree', 'Blog Category', '{"showChildren":"1"}', 'default'),
(9, 'contact', 'Contact Us', '', 'default'),
(10, 'about', 'About Us', '', 'default'),
(11, 'links', 'Link', '', 'default'),
(12, 'header', 'Header', '', 'default'),
(13, 'followUs', 'Follow Us', '', 'default');
