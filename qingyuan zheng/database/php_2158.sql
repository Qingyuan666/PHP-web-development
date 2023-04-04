-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2022-12-11 20:21:43
-- 服务器版本： 5.7.26
-- PHP 版本： 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `php_2158`
--
CREATE DATABASE IF NOT EXISTS `php_2158` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `php_2158`;

-- --------------------------------------------------------

--
-- 表的结构 `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `tags` varchar(255) DEFAULT NULL COMMENT 'tag',
  `users_id` int(11) DEFAULT NULL COMMENT 'id',
  `title` varchar(255) DEFAULT NULL COMMENT 'title',
  `content` text COMMENT 'content',
  `zan` int(11) DEFAULT '0' COMMENT 'like',
  `fav` int(11) DEFAULT '0' COMMENT 'comments',
  `hits` int(11) DEFAULT '0' COMMENT 'read',
  `images` varchar(255) DEFAULT NULL,
  `is_view` int(2) DEFAULT '0',
  `c_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `blogs`
--

INSERT INTO `blogs` (`id`, `tags`, `users_id`, `title`, `content`, `zan`, `fav`, `hits`, `images`, `is_view`, `c_date`) VALUES
(1, '学习', 2, '漫画星空', '123', 8, 2, 43, '2021052415543579_2021-05-22_184723.jpg', 1, '2021-06-15 15:54:35'),
(2, '青春', 1, '人间，应有的幸福', '《人间，应有的幸福》\r\n\r\n剪辑，一段美好\r\n\r\n年轻的妈妈，身旁有\r\n\r\n五岁左右的小宝贝\r\n\r\n一大一小的自行车，荡悠悠\r\n\r\n荡出锦瑟和琴的时光\r\n\r\n\r\n\r\n母子两，脸上，身上\r\n\r\n灿烂的阳光\r\n\r\n射进\r\n\r\n一个又一个路人的心窝窝\r\n\r\n\r\n\r\n我把他们想象成\r\n\r\n一只青蛙领着小蝌蚪\r\n\r\n离开浅滩，亦或，鹰妈妈\r\n', 4, 0, 42, '2021052421195369_2021-05-24_203232.jpg', 1, '2021-06-15 15:54:35'),
(3, '青春', 9, '一个人的惆怅', '《一个人的惆怅》\r\n\r\n细数流年，还有吗\r\n\r\n摇摇头，回到往事\r\n\r\n豁了口的心，风不停地吹\r\n\r\n\\\r\n\r\n天空之城，有低低的诉语\r\n\r\n路人匆匆的脚步\r\n\r\n深深，浅浅\r\n\r\n\\\r\n\r\n月亮也会瘦，从满圆\r\n\r\n一点，   一点的瘦\r\n\r\n只有一弯月牙，再瘦\r\n\r\n执着的心，退出了你的世界\r\n', 12, 24, 69, '2021052421221938_2021-05-24_203336.jpg', 1, '2021-06-15 15:54:35'),
(4, '旅游', 1, '把时间花在心灵上__林清玄', '朋友带我去看一位收藏家的收藏，据说他收藏的都是顶级的东西，随便拿一件来都是价逾千万。\r\n<br>\r\n我们穿过一条条的巷子，来到一家不起眼的公寓前面，我心中正自纳闷，顶级的古董怎么会收藏在这种地方呢？\r\n<br>\r\n收藏家来开门了，连续打开三扇不锈钢门，才走进屋内。室内的灯光非常幽暗，等了几秒钟，我才适应了室内的光线，这时，才赫然看到整个房子堆满古董，多到连走路都要小心，侧身才能前进。\r\n<br>\r\n到处都是陶瓷器、铜器、锡器，还有好多书画卷轴拥挤地插在大缸里，主人好不容易带我们找到沙发，沙发也是埋在古物堆中，经过一番整理，我们才得以落座。', 2, 0, 7, '2021052420345120_2021-05-24_203213.jpg', 1, '2021-06-15 15:54:35'),
(5, '青春', 1, '话说谦让__梁实秋', '一群客人挤在客厅里，谁也不肯先坐，谁也不肯坐首座，好像“常常登上座，渐渐入祠堂”的道理是人人所不能忘的。于是你推我让，人声鼎沸。辈分小的、官职低的，垂着手远远地立在屋角，听候调遣。自以为有占首座或次座资格的人，无不攘臂而前，拉拉扯扯，不肯放过他们表现谦让的美德的机会。有的说：“我们叙齿，你年长！”有的说：“我常来，你是稀客！”有的说：“今天非你上座不可！”事实固然是为让座，但是当时的声浪和唾沫星子却都表示像在争座。主人摆一张笑脸，偶然插一两句嘴，作鹭鸶笑。这场纷扰，要直到大家的兴致均已低落，该说的话差不多都已说完，然后急转直下，突然平息，本就该坐上座的人便去就了上座，并无苦恼之相，而往往是显得踌躇满志、顾盼自雄。', 0, 1, 1, '2021052420360156_2021-05-24_203151.jpg', 0, '2021-06-15 15:54:35'),
(6, '旅游', 9, '煽铁坪村，原本不叫煽铁坪村，叫金盆村', '在距零陵城区100里左右的石岩头镇有一个远近闻名、神奇美丽的古村落。这个古村落西连广西，北挨珠山，东是高耸的大头岭，南与起伏连绵的千亩梨林接壤。一条条青石板铺就的崎岖山道通向村子外的世界。村庄就如一个巨大的聚宝盆，这个村就是煽铁坪村。\r\n\r\n       煽铁坪村，原本不叫煽铁坪村，叫金盆村，因为这个村庄不但形象如一个聚宝盆，而且村里有曾有一大户人家，他良田千亩、果树万棵，房屋百栋，而且每座房屋雕龙画凤，飞檐峭壁，每个门窗、天井、照墙都是精雕细琢，匠心独具，极有艺术风味。村里遗留下的石水缸、石磨子、石对坑、石料子都巧夺天工，是一件件不可多得的珍宝，特别是那还保存完好的清未民国时期的古建筑群书写着昔日的辉煌。后来，由于金盆村大炼钢铁(可惜绝大多数树木被砍伐了)。该村被改为了煽铁坪村\r\n', 1, 0, 4, '2021052421230413_2021-05-24_203325.jpg', 1, '2021-06-15 15:54:35');

-- --------------------------------------------------------

--
-- 表的结构 `blogs_reply`
--

DROP TABLE IF EXISTS `blogs_reply`;
CREATE TABLE `blogs_reply` (
  `id` int(8) NOT NULL,
  `b_id` int(11) DEFAULT NULL,
  `content` text COMMENT '回复内容',
  `users_id` int(11) DEFAULT NULL COMMENT '回复用户id',
  `c_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `blogs_vote_log`
--

DROP TABLE IF EXISTS `blogs_vote_log`;
CREATE TABLE `blogs_vote_log` (
  `id` int(8) NOT NULL,
  `b_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL COMMENT '点赞用户id',
  `type` varchar(20) DEFAULT NULL COMMENT '类型',
  `c_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `blogs_vote_log`
--

INSERT INTO `blogs_vote_log` (`id`, `b_id`, `users_id`, `type`, `c_date`) VALUES
(1, 1, 3, 'zan', '2022-12-03 22:25:52'),
(2, 2, 3, 'zan', '2022-12-03 22:26:16'),
(3, 2, 1, 'zan', '2022-12-03 22:55:01'),
(4, 4, 1, 'zan', '2022-12-03 22:57:59'),
(5, 1, 3, 'fav', '2022-12-11 20:06:13');

-- --------------------------------------------------------

--
-- 表的结构 `c_user`
--

DROP TABLE IF EXISTS `c_user`;
CREATE TABLE `c_user` (
  `id` int(4) NOT NULL,
  `account_name` varchar(11) DEFAULT NULL COMMENT 'reader name',
  `nickname` varchar(255) DEFAULT NULL,
  `qizhi` varchar(255) DEFAULT NULL COMMENT 'animal style',
  `password` varchar(255) DEFAULT NULL,
  `sex` varchar(20) DEFAULT NULL COMMENT 'gender',
  `birthday` varchar(255) DEFAULT NULL COMMENT 'birthday',
  `email` varchar(255) DEFAULT NULL COMMENT 'email',
  `tmp_name` varchar(255) DEFAULT NULL COMMENT 'portrait',
  `remark` varchar(255) DEFAULT NULL COMMENT 'maxim',
  `c_date` varchar(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `c_user`
--

INSERT INTO `c_user` (`id`, `account_name`, `nickname`, `qizhi`, `password`, `sex`, `birthday`, `email`, `tmp_name`, `remark`, `c_date`) VALUES
(1, '123', '123', NULL, '123', '1', '2022-12-16', '123@123', '', NULL, '1670069915'),
(2, 'abc', 'abc', '马', 'abc', '0', '2022-11-29', '123@123', '', NULL, '1670077470'),
(3, '小菜', '小菜', '大象', '小菜', '1', '2022-12-02', 'xiaocai@11.com', '202212032225311756144558_ban1.jpg', NULL, '1670077531');

--
-- 转储表的索引
--

--
-- 表的索引 `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `blogs_reply`
--
ALTER TABLE `blogs_reply`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `blogs_vote_log`
--
ALTER TABLE `blogs_vote_log`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `c_user`
--
ALTER TABLE `c_user`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `blogs_reply`
--
ALTER TABLE `blogs_reply`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `blogs_vote_log`
--
ALTER TABLE `blogs_vote_log`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `c_user`
--
ALTER TABLE `c_user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
