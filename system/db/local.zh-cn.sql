-- Insert data into `eps_block`;
INSERT INTO `eps_block` (`id`, `type`, `title`, `content`, `template`) VALUES
(1, 'latestArticle', '最新文章', '{"category":"0","limit":"7"}', 'default'),
(2, 'hotArticle', '热门文章', '{"category":"0","limit":"7"}', 'default'),
(3, 'latestProduct', '最新产品', '{"category":"0","limit":"3","image":"show"}', 'default'),
(4, 'hotProduct', '热门产品', '{"category":"0","limit":"3","image":"show"}', 'default'),
(5, 'slide', '幻灯片', '', 'default'),
(6, 'articleTree', '文章分类', '{"showChildren":"0"}', 'default'),
(7, 'productTree', '产品分类', '{"showChildren":"0"}', 'default'),
(8, 'blogTree', '博客分类', '{"showChildren":"1"}', 'default'),
(9, 'contact', '联系我们', '', 'default'),
(10, 'about', '公司简介', '', 'default'),
(11, 'links', '友情链接', '', 'default'),
(12, 'header', '网站头部', '', 'default'),
(13, 'followUs', '关注我们', '', 'default');
