-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- 主機: localhost
-- 產生時間： 2019-03-12 00:50:13
-- 伺服器版本: 5.7.13-log
-- PHP 版本： 5.6.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `sample-muli-test`
--

-- --------------------------------------------------------

--
-- 資料表結構 `erp_scaleordersourcedetail`
--

CREATE TABLE `erp_scaleordersourcedetail` (
  `id` int(11) NOT NULL COMMENT '編號',
  `oserial` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '標題',
  `code` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `author` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '作者',
  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '類別',
  `bound` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'in' COMMENT '入庫/出庫',
  `state` int(2) NOT NULL DEFAULT '1' COMMENT '狀態1開啟0鎖定',
  `pic1` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `pic2` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `warehouse` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Totalweight` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Minweight` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Oriweight` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci COMMENT '內容',
  `postdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '發布日期',
  `indicate` int(2) NOT NULL DEFAULT '1' COMMENT '是否顯示',
  `sdescription` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '簡要描述',
  `skeyword` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '關鍵字',
  `skeywordindicate` int(2) NOT NULL DEFAULT '1',
  `menutype` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'news' COMMENT '選單類型',
  `pushtop` int(2) NOT NULL DEFAULT '0',
  `notes1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '備註1',
  `notes2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '備註2',
  `num` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `people` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sortid` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `lang` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'zh-tw' COMMENT '語系',
  `userid` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='最新訊息';

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `erp_scaleordersourcedetail`
--
ALTER TABLE `erp_scaleordersourcedetail`
  ADD PRIMARY KEY (`id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `erp_scaleordersourcedetail`
--
ALTER TABLE `erp_scaleordersourcedetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '編號';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
