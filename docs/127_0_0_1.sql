-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2016 at 05:27 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `main`
--
CREATE DATABASE IF NOT EXISTS `main` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `main`;

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Asterisk', '1', 1424278268);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1424278227, 1424278227),
('Asterisk', 1, 'Full Access', NULL, NULL, 1424278062, 1424279109);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Asterisk', '/*');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `base_content`
--

CREATE TABLE `base_content` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `brief` tinytext NOT NULL,
  `description` text NOT NULL,
  `body` text NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(3) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_content`
--

INSERT INTO `base_content` (`id`, `type`, `title`, `slug`, `brief`, `description`, `body`, `date`, `end_date`, `sort`, `hits`, `status`, `created`, `updated`) VALUES
(2, 1, 'Home Slider', 'home-slider', '', '', '', NULL, NULL, 1, 0, NULL, '2015-09-08 15:51:41', '2015-09-08 15:51:41'),
(4, 1, 'Contact Us', 'contact-us', '', '', '<div class="app101-contacts-information">\r\n											<div class="app101-contact-information">\r\n												<div class="app101-contact-title">\r\n													<span>SC Angel Network</span>\r\n												</div>\r\n												<div class="app101-contact-details">\r\n													<span>PO Box 2525</span><br />\r\n													<span>Columbia, SC 29202</span>\r\n												</div>\r\n											</div>\r\n											<div class="app101-contact-information">\r\n												<div class="app101-contact-title">\r\n													<span>Palmetto Angel 2014 Fund</span>\r\n												</div>\r\n												<div class="app101-contact-details">\r\n													<span>411 University Ridge</span><br />\r\n													<span>Suite 211</span><br />\r\n													<span>Greenville, SC 29601</span>\r\n												</div>\r\n											</div>\r\n											<div class="app101-contact-information">\r\n												<div class="app101-contact-title">\r\n													<span>Email</span>\r\n												</div>\r\n												<div class="app101-contact-details">\r\n													<span>saleh@main.com</span><br />\r\n													<span>nojara@main.com</span><br />\r\n													<span>mohamed@main.com</span>\r\n												</div>\r\n											</div>\r\n										</div>', NULL, NULL, 3, 0, NULL, '2015-09-08 15:52:38', '2015-12-09 16:11:51'),
(5, 3, 'Angel investor tax credit - for founders', 'angel-investor-tax-credit-for-founders', '', '', '<p><a href="https://twitter.com/SCAngelNetwork/status/626036712863608832" target="_blank">Last week</a> saw the window close for claiming the SC angel investor tax credit for 2014, and last week <a href="http://www.scangelnetwork.com/our-team/">Matt</a> and <a href="http://lowcountryangelnetwork.com/" target="_blank">Lowcountry Angels</a> ran seminar explaining how the tax credit works. We have an introduction to the credit on our &quot;tax credit&quot; <a href="http://www.scangelnetwork.com/angel-investor-tax-credit/">page</a>.</p>\r\n\r\n<p>These events prompted another look at an overlooked aspect of the credit - how it can be used by founders of companies.</p>\r\n\r\n<p>The credit is limited to &quot;accredited investors&quot; based on the <a href="http://www.investor.gov/news-alerts/investor-bulletins/investor-bulletin-accredited-investors" target="_blank">SEC&#39;s rules</a> about who is allowed to invest in companies that are not &quot;public companies&quot;. &quot;Accreditation&quot; is usually based on wealth or income criteria.</p>\r\n\r\n<p>But another way to be accredited is to be &quot;a director, executive officer, or general partner of the issuer of securities, or any director, executive officer, or general partner of a general partner of the issuer.&quot;&nbsp; That enjoyable legalese basically means founders of companies are automatically accredited investors in their own companies.</p>\r\n\r\n<p>Therefore you, as a founder of a company, could get a state income tax credit of up to 35% of what you invest (in cash) in your startup - if you follow the other rules about the credit.&nbsp; We know many founders start companies from an existing job (it&#39;s the main reason why SC improved so much on <a href="http://www.kauffman.org/microsites/kauffman-index/rankings/state" target="_blank">this</a> ranking): the tax you paid on income from that job, or from the consulting work you do to pay the bills, can be reduced - giving you more resources to develop your high growth startup (so you can hopefully pay lots of capital gains tax later!).</p>\r\n\r\n<p>Too late to claim it this year, but if you&#39;re starting a company in 2015 and going to put your own money in, get the business <a href="http://www.scangelnetwork.com/angel-investor-tax-credit">qualified</a> before you do!</p>\r\n', NULL, NULL, 1, 0, NULL, '2015-12-03 15:43:54', '2015-12-03 15:43:54'),
(6, 3, 'Portfolio companies continue great momentum', 'portfolio-companies-continue-great-momentum', '', '', '<p>One of the most satisfying parts of angel investing is being able to celebrate the successes of our portfolio companies - particularly those that exemplify our motto of &quot;make money, have fun, do good.&quot;</p>\r\n\r\n<p>Today, <a href="http://www.scangelnetwork.com/s/Baebies-Financing-Press-release-FINAL-7282015.pdf" target="_blank">Baebies</a> announced the final closing of its $13 million fundraising. SCAN groups from Asheville to Columbia were proud to be involved, in partnership with some of the best early stage investors across the south east. CEO Rich West and his team have already sold one company for <a href="http://investor.illumina.com/phoenix.zhtml?c=121127&amp;p=irol-newsArticle&amp;ID=1840193&amp;highlight" target="_blank">$96 million</a>.&nbsp;Make money? Check. And now the have taken the same technology to provide newborn baby screening to help identify children with <a href="http://baebies.com/" target="_blank">rare diseases</a>. Do good? Check.</p>\r\n\r\n<p>Earlier in the week, the first investment of our <a href="http://www.scangelnetwork.com/local-angel-groups">Asheville Angels</a> group, <a href="http://www.plumprint.com" target="_blank">Plum Print</a>, was featured in the <a href="http://www.citizen-times.com/story/life/family/2015/07/26/keep-memories-toss-clutter/30496435/?utm_source=Venture+Asheville+Newsletter&amp;utm_campaign=e2032e57a1-July28_eNews_Venture_Avl&amp;utm_medium=email&amp;utm_term=0_4841c00474-e2032e57a1-221549793" target="_blank">Asheville Citizen-Times</a>. Since we invested, the company has gone from strength to strength, providing parents with unique records of their children&#39;s creativity. Have fun? Check.</p>\r\n\r\n<p>We look forward to watching both, and our 38 other investments, continue with their great momentum.</p>\r\n', NULL, NULL, 2, 0, NULL, '2015-12-03 15:44:40', '2015-12-03 15:44:40'),
(7, 2, 'SC Angel Network and CSR Angels to Speak at North Augusta Chamber Business Power Lunch', 'sc-angel-network-and-csr-angels-to-speak-at-north-augusta-chamber-business-power-lunch', '', '', '<p><strong>COLUMBIA, S.C.</strong>&nbsp;&ndash;&nbsp;<strong>The </strong><a href="https://west.exch030.serverdata.net/owa/redir.aspx?SURL=cBvc5Ny8J0f1xRyqSS8HqLpmz4JHnRRU_UolU0akEkjDf5l7S-XSCGgAdAB0AHAAOgAvAC8AdwB3AHcALgBzAGMAYQBuAGcAZQBsAG4AZQB0AHcAbwByAGsALgBjAG8AbQAvAA..&amp;URL=http%3a%2f%2fwww.scangelnetwork.com%2f" target="_blank">South Carolina Angel Network</a><strong>&nbsp;(SCAN) and </strong><a href="https://west.exch030.serverdata.net/owa/redir.aspx?SURL=kRK1Ax8u1VGm25dkPibyaB8_uHMatTclizZ3A9pbGRfDf5l7S-XSCGgAdAB0AHAAOgAvAC8AdwB3AHcALgBzAGMAYQBuAGcAZQBsAG4AZQB0AHcAbwByAGsALgBjAG8AbQAvAGMAZQBuAHQAcgBhAGwALQBzAGEAdgBhAG4AbgBhAGgALQByAGkAdgBlAHIALQBhAG4AZwBlAGwAcwAvAA..&amp;URL=http%3a%2f%2fwww.scangelnetwork.com%2fcentral-savannah-river-angels%2f" target="_blank">Central Savannah River Angels</a>&nbsp;(CRS Angels) are thrilled to be featured at the upcoming <a href="https://west.exch030.serverdata.net/owa/redir.aspx?SURL=B7aUacwmjXvwuVxL3RGP18r4BdlY8MlK7Lqg_Fg2kGjDf5l7S-XSCGgAdAB0AHAAOgAvAC8AdwB3AHcALgBuAG8AcgB0AGgAYQB1AGcAdQBzAHQAYQBjAGgAYQBtAGIAZQByAC4AbwByAGcALwBlAHYAZQBuAHQAcwAvAGQAZQB0AGEAaQBsAHMALwBiAHUAcwBpAG4AZQBzAHMALQBwAG8AdwBlAHIALQBsAHUAbgBjAGgALQBzAG8AdQB0AGgALQBjAGEAcgBvAGwAaQBuAGEALQBhAG4AZwBlAGwALQBuAGUAdAB3AG8AcgBrAC0ANAAxADMA&amp;URL=http%3a%2f%2fwww.northaugustachamber.org%2fevents%2fdetails%2fbusiness-power-lunch-south-carolina-angel-network-413" target="_blank">North Augusta Chamber&rsquo;s Business Power Lunch</a>. The event will be held on <strong>Tuesday, November 10th from 11:30am -1:00 pm at the Palmetto Terrace, located on the 4</strong><strong>th</strong><strong>&nbsp;floor of the North Augusta Municipal Building (100 Georgia Avenue, North Augusta, SC).</strong></p>\r\n\r\n<p>The power lunch provides Chamber members the opportunity to hear views and insights on economic trends, stay informed on issues relevant to the business community, and network with other professionals. Networking begins at 11:00am.&nbsp;</p>\r\n\r\n<p><a href="https://west.exch030.serverdata.net/owa/redir.aspx?SURL=yWIiym__3km6dUpWcu0VmYJLjnpaT3s6dHDM62-ckE_Df5l7S-XSCGgAdAB0AHAAOgAvAC8AdwB3AHcALgBuAG8AcgB0AGgAYQB1AGcAdQBzAHQAYQBjAGgAYQBtAGIAZQByAC4AbwByAGcALwBiAG8AYQByAGQALQBvAGYALQBkAGkAcgBlAGMAdABvAHIAcwAtAHMAdABhAGYAZgA.&amp;URL=http%3a%2f%2fwww.northaugustachamber.org%2fboard-of-directors-staff" target="_blank">Terra Carroll</a>, President/CEO of the North Augusta Chamber of Commerce, stated &ldquo;We are thrilled to have the CSR Angels present at our November Power Lunch. We truly believe that small business and new ideas are the very backbone of any community, so we are certainly excited for our members to receive this information.&rdquo;&nbsp;</p>\r\n\r\n<p><a href="https://west.exch030.serverdata.net/owa/redir.aspx?SURL=6PIYtrnqfEtdY9IQ3A5S9xA6Gu67t2GGu3WV045x8EzDf5l7S-XSCGgAdAB0AHAAOgAvAC8AdwB3AHcALgBzAGMAYQBuAGcAZQBsAG4AZQB0AHcAbwByAGsALgBjAG8AbQAvAG8AdQByAC0AdABlAGEAbQAvAA..&amp;URL=http%3a%2f%2fwww.scangelnetwork.com%2four-team%2f" target="_blank">Charlie Banks</a>, Managing Director of SCAN, added &ldquo;I look forward to discussing angel investing and its impact on the entrepreneurship ecosystem. We are excited about the launch of CSR Angels in the North Augusta and Aiken community.&rdquo;</p>\r\n\r\n<p>Pre-registration is required. For Chamber members, the cost is $25 for an individual and $200 for a table of eight. For non-members, it is $40 for an individual and $350 for a table of eight. To register, email Jessica Hanson at <a href="mailto:jessica@northaugustachamber.org">jessica@northaugustachamber.org</a>,&nbsp;call 803-279-2323, or click <a href="http://bit.ly/1Q5DDol">here.</a>&nbsp;The current event sponsors are as follows:&nbsp;</p>\r\n\r\n<p><strong>Presenting Sponsor:</strong><strong>&nbsp;</strong><strong>SRP Federal Credit Union</strong></p>\r\n\r\n<p><strong>Signature Sponsors:&nbsp;</strong><strong>Savannah River Nuclear Solutions -&nbsp;Georgia Regents University - Trace Staffing </strong><strong>EDTS- Southern Bank &amp; Trust- Savannah River Remediation LLC- SME CPAs</strong></p>\r\n\r\n<p><strong>Supporting Sponsors:&nbsp;</strong><strong>MAU &ndash; Kenneth Shuler School of Cosmetology &ndash; The Star</strong></p>\r\n', NULL, NULL, 1, 0, NULL, '2015-12-03 15:46:38', '2015-12-03 15:47:35'),
(8, 2, 'Capital Angels and Palmetto Angel Fund Invest in SC-based PharmRight Corporation', 'capital-angels-and-palmetto-angel-fund-invest-in-sc-based-pharmright-corporation', '', '', '<p><strong>COLUMBIA, S.C. &ndash;&nbsp;</strong>Capital Angels, the Midland&rsquo;s angel investor group that is part of the statewide South Carolina Angel Network (SCAN), and The Palmetto Angel Fund, a collaboration between Capital Angels and the other angel groups affiliated under SCAN, is pleased to announce a new investment in South Carolina-based PharmRight Corporation.&nbsp;</p>\r\n\r\n<p>PharmRight has developed LiviTM, a cloud-connected, automated medication dispenser for use in homes and institutional care settings to improve medication adherence and reduce the burden on caregivers. Bill Park, CEO of PharmRight explained: &ldquo;LiviTM is a product with nationwide scope and interest, but we are excited to have secured more funding from local investors to facilitate our commercial launch. SCAN&rsquo;s diligence process was rigorous, so we are pleased to have convinced their investors to support our company.&rdquo;&nbsp;</p>\r\n\r\n<p>Charlie Banks, Managing Director of Capital Angels and SCAN, noted &ldquo; We&rsquo;re excited about Pharmright and their potential to make a meaningful impact on the lives of many. They are a great team and South Carolina is fortunate to have them building a company in our state.&rdquo;&nbsp;</p>\r\n\r\n<p>SCAN groups, led by Greenville&rsquo;s Upstate Carolina Angel Network, and the Palmetto Angel Fund also recently invested in Greenville-based startup TipHive, a cloud platform for improving knowledge sharing and communication within enterprises, ending a busy summer of investing in some of South Carolina&rsquo;s most exciting early stage companies.&nbsp;</p>\r\n\r\n<p>SCAN, a professionally-managed network of over 200 angel investors, strives to generate attractive investment returns and strengthen the long-term economic health of our state by investing in innovative young companies. For more information on membership in Capital Angels, or any of the investor networks across SCAN, please visit www.scangelnetwork.com.</p>\r\n', NULL, NULL, 2, 0, NULL, '2015-12-03 15:48:56', '2015-12-03 15:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `base_media`
--

CREATE TABLE `base_media` (
  `id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED DEFAULT NULL,
  `model` varchar(64) NOT NULL,
  `path` varchar(255) NOT NULL,
  `filename` varchar(128) NOT NULL,
  `mime` varchar(128) NOT NULL,
  `size` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `embed` text NOT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_media`
--

INSERT INTO `base_media` (`id`, `model_id`, `model`, `path`, `filename`, `mime`, `size`, `title`, `description`, `link`, `embed`, `status`, `type`, `sort`, `created`, `updated`) VALUES
(1, 1, 'Project', '/shared/uploads/2015/09/08/', 'YWiyfaIy_zt_iXuD.png', 'image/png', 3054, '', '', '', '', NULL, NULL, 1, '2015-09-08 15:06:49', '2015-09-08 15:06:49'),
(2, 18, 'Tree', '/shared/uploads/2015/12/03/', '0xS88fGGVhqK8rjL.jpeg', 'image/jpeg', 24228, 'UPSTATE CAROLINA ANGEL NETWORK', 'The Upstate Carolina Angel Network is a Greenville-based group of over 50 investors. Since its launch in 2008, it has invested over $13 million in 39 portfolio companies, and in 2014 was named the 8th best angel group in the United States.', '', '', NULL, NULL, 2, '2015-12-03 12:35:52', '2015-12-03 12:39:43'),
(3, 20, 'Tree', '/shared/uploads/2015/12/03/', 'mqH4QevmqIAM9KoM.png', 'image/png', 13851, 'baebies', '', 'http://baebies.com/', '', NULL, NULL, 3, '2015-12-03 12:44:32', '2015-12-03 12:45:13'),
(4, 21, 'Tree', '/shared/uploads/2015/12/03/', '7Pkbzcj5hY7DrY1a.png', 'image/png', 8858, 'verdeeco', '', 'sensus.com/web/usca', '', NULL, NULL, 4, '2015-12-03 13:17:42', '2015-12-03 13:19:08'),
(5, 24, 'Tree', '/shared/uploads/2015/12/03/', '9xpwfg_nH03WXZN_.jpeg', 'image/jpeg', 289509, '', '', '', '', NULL, NULL, 5, '2015-12-03 13:31:18', '2015-12-03 13:31:18'),
(6, 25, 'Tree', '/shared/uploads/2015/12/03/', 'XNARabu5MLSZH87h.jpeg', 'image/jpeg', 161099, '', '', '', '', NULL, NULL, 6, '2015-12-03 13:33:19', '2015-12-03 13:33:19'),
(7, 26, 'Tree', '/shared/uploads/2015/12/03/', 'Sj_rhXsFkU-5JtCF.jpeg', 'image/jpeg', 136198, '', '', '', '', NULL, NULL, 7, '2015-12-03 13:34:45', '2015-12-03 13:34:45'),
(8, 28, 'Tree', '/shared/uploads/2015/12/03/', 'cc6DTk6iFpT2wRG9.png', 'image/png', 29640, 'venture asheville', '', 'http://ventureasheville.com/', '', NULL, NULL, 8, '2015-12-03 13:53:21', '2015-12-03 13:53:53'),
(9, 30, 'Tree', '/shared/uploads/2015/12/03/', '0cv8IwDWj2gKwLkw.jpeg', 'image/jpeg', 19555, 'ACA', '', 'http://www.angelcapitalassociation.org/', '', NULL, NULL, 9, '2015-12-03 13:59:27', '2015-12-03 13:59:49'),
(10, 32, 'Tree', '/shared/uploads/2015/12/03/', 'IztVCrG3QeNHQXRJ.jpeg', 'image/jpeg', 70592, '', '', '', '', NULL, NULL, 10, '2015-12-03 14:09:21', '2015-12-03 14:09:21'),
(11, 32, 'Tree', '/shared/uploads/2015/12/03/', 'QIOSmavPvJgj-BFT.png', 'image/png', 19766, '', '', 'https://www.wyche.com/', '', NULL, NULL, 11, '2015-12-03 14:37:17', '2015-12-03 14:37:37'),
(12, 32, 'Tree', '/shared/uploads/2015/12/03/', '0K4BLBDifrVQ5llq.jpeg', 'image/jpeg', 40563, '', '', 'https://www.palmettobank.com/', '', NULL, NULL, 12, '2015-12-03 14:38:19', '2015-12-03 14:38:46'),
(13, 33, 'Tree', '/shared/uploads/2015/12/03/', 'LJH8W4Di0__hDH4g.png', 'image/png', 59550, '', '', '', '', NULL, NULL, 13, '2015-12-03 14:40:57', '2015-12-03 14:40:57'),
(14, 33, 'Tree', '/shared/uploads/2015/12/03/', 'XiEDFrnUDMU2BLf5.png', 'image/png', 5929, '', '', 'http://chernoffnewman.com/', '', NULL, NULL, 14, '2015-12-03 14:41:36', '2015-12-03 14:42:39'),
(15, 33, 'Tree', '/shared/uploads/2015/12/03/', 'RSGxVG_s1KGcuC5p.png', 'image/png', 9445, '', '', 'http://www.colite.com/', '', NULL, NULL, 15, '2015-12-03 14:43:37', '2015-12-03 14:43:52'),
(16, 34, 'Group', '/shared/uploads/2015/12/03/', 'pHc9PXCbIkYI_eyW.png', 'image/png', 19252, '', '', 'http://www.spartanburgchamber.com/', '', NULL, NULL, 16, '2015-12-03 15:53:55', '2015-12-03 15:54:26'),
(17, 34, 'Group', '/shared/uploads/2015/12/03/', '_TLw_zDNZDOCEI-g.jpeg', 'image/jpeg', 23621, '', '', 'http://www.rjrockers.com/', '', NULL, NULL, 17, '2015-12-03 15:55:02', '2015-12-03 15:55:25'),
(18, 35, 'Group', '/shared/uploads/2015/12/03/', '88LZ4yrom4DAG6q-.jpeg', 'image/jpeg', 618249, '', '', '', '', NULL, NULL, 18, '2015-12-03 15:58:41', '2015-12-03 15:58:41'),
(19, 2, 'Page', '/shared/uploads/2015/12/08/', 'twHvpBUMYGY9JmWc.png', 'image/png', 661300, '', '', '', '', NULL, NULL, 35, '2015-12-08 09:21:12', '2015-12-08 09:21:12'),
(20, 2, 'Page', '/shared/uploads/2015/12/08/', 'Y74MWJVFc1qvEi1w.png', 'image/png', 692781, '', '', '', '', NULL, NULL, 19, '2015-12-08 09:21:27', '2015-12-08 09:21:27'),
(21, 2, 'Page', '/shared/uploads/2015/12/08/', '8TqeoA-Kg1F15Usp.png', 'image/png', 553425, '', '', '', '', NULL, NULL, 20, '2015-12-08 09:21:39', '2015-12-08 09:21:39'),
(22, 2, 'Page', '/shared/uploads/2015/12/08/', 'ekfui_ZKGMC78E1q.png', 'image/png', 845315, '', '', '', '', NULL, NULL, 21, '2015-12-08 09:21:53', '2015-12-08 09:21:53'),
(23, 2, 'Page', '/shared/uploads/2015/12/08/', 'wtzF8sMjVZNdf7XL.png', 'image/png', 694236, '', '', '', '', NULL, NULL, 22, '2015-12-08 09:22:05', '2015-12-08 09:22:05'),
(24, 2, 'Page', '/shared/uploads/2015/12/08/', '58JsxcNAb9BiQohg.png', 'image/png', 629360, '', '', '', '', NULL, NULL, 23, '2015-12-08 09:22:17', '2015-12-08 09:22:17'),
(25, 32, 'Group', '/shared/uploads/2015/12/08/', 'CUaZzKRyrMcPLDtB.png', 'image/png', 179092, '', '', '', '', NULL, NULL, 24, '2015-12-08 10:38:06', '2015-12-08 10:38:06'),
(26, 33, 'Group', '/shared/uploads/2015/12/08/', 'rTh-F_XxrbjWb9Tk.png', 'image/png', 179092, '', '', '', '', NULL, NULL, 25, '2015-12-08 11:18:53', '2015-12-08 11:18:53'),
(27, 18, 'AboutUs', '/shared/uploads/2015/12/08/', 'arXOpE4JEQmPIe34.png', 'image/png', 40212, '', 'The Upstate Carolina Angel Network is a Greenville-based group of over 50 investors. Since its launch in 2008, it has invested over $13 million in 39 portfolio companies, and in 2014 was named the 8th best angel group in the United States.', '', '', NULL, NULL, 26, '2015-12-08 15:35:14', '2015-12-08 16:17:52'),
(28, 18, 'AboutUs', '/shared/uploads/2015/12/08/', 'gEVuFW-ioVSzBOCl.png', 'image/png', 30992, '', 'Capital Angels was formed in 2014 to serve the angels in the Midlands of South Carolina. A membership based group of nearly 40 of the area''s most successful business leaders and entrepreneurs, Capital Angels began making its first investments in the summer of 2014.', '', '', NULL, NULL, 27, '2015-12-08 15:35:26', '2015-12-08 16:31:27'),
(29, 18, 'AboutUs', '/shared/uploads/2015/12/08/', 'vzh7FQmyCqf3jvWR.png', 'image/png', 42092, '', 'Formed in 2014, and making its first investments the same year, Asheville Angels is a joint venture between SCAN and Venture Asheville (the entrepreneurship initiative of the Economic Development Coalition for Asheville-Buncombe County and the Asheville Area Chamber of Commerce). At over 50 members, it already a force in angel investing in the southeast.', '', '', NULL, NULL, 28, '2015-12-08 15:35:35', '2015-12-08 16:32:12'),
(30, 18, 'AboutUs', '/shared/uploads/2015/12/08/', 'SI-sOZxsqnAI93nj.png', 'image/png', 18744, '', 'Launched in January 2015, Spartanburg Angels brings SCAN''s proven angel network model to Spartanburg in a collaboration with the Spartanburg Area Chamber of Commerce. 30 members and counting!', '', '', NULL, NULL, 29, '2015-12-08 15:58:02', '2015-12-08 16:33:06'),
(31, 18, 'AboutUs', '/shared/uploads/2015/12/08/', 'v9vhD823B5c30oJq.png', 'image/png', 38441, '', 'Lowcountry Angels met for the first time in April 2015 as a partnership between SCAN and Josh Silverman. A long-time resident of Charleston, Josh is active in the small business and entrepreneur world, and asked SCAN to help him bring more angels into the investor world. We are delighted to help.', '', '', NULL, NULL, 30, '2015-12-08 15:58:11', '2015-12-08 16:33:55'),
(32, 18, 'AboutUs', '/shared/uploads/2015/12/08/', 'qlX6mNf9SffvQP3Q.png', 'image/png', 16599, '', 'Electric City Angels launched in Anderson in the spring of 2015 and made its first investment in the summer. It is a great example of how a smaller community can bring local entrepreneurial spirit and investors into a statewide infrastructure for angel investing.', '', '', NULL, NULL, 31, '2015-12-08 15:58:21', '2015-12-08 16:34:35'),
(33, 18, 'AboutUs', '/shared/uploads/2015/12/08/', 'NuTC3nLkDS-quteE.png', 'image/png', 29149, '', 'Central Savannah River Angels (CSRA) is launching in the fall of 2015 as a partnership between SCAN and a team of local supporters in Aiken and Augusta.', '', '', NULL, NULL, 32, '2015-12-08 15:58:30', '2015-12-08 16:35:08'),
(35, 2, 'Page', '/shared/uploads/2016/02/25/', 'JUzCEBrR-ML2BCfs.jpeg', 'image/jpeg', 103332, '', '', '', '', NULL, NULL, 36, '2016-02-25 16:47:04', '2016-02-25 16:47:04'),
(36, 2, 'Page', '/shared/uploads/2016/02/28/', 'vArlLT8OCXo2YsUM.jpeg', 'image/jpeg', 119412, '', '', '', '', NULL, NULL, 33, '2016-02-28 11:47:40', '2016-02-28 11:47:40'),
(37, 2, 'Page', '/shared/uploads/2016/02/28/', 'GVplYIFQXadTzY52.jpeg', 'image/jpeg', 235556, '', '', '', '', NULL, NULL, 34, '2016-02-28 15:19:32', '2016-02-28 15:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `base_messages`
--

CREATE TABLE `base_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `sender_id` int(10) UNSIGNED DEFAULT NULL,
  `receiver_id` int(10) UNSIGNED DEFAULT NULL,
  `model_id` int(10) UNSIGNED DEFAULT NULL,
  `model` varchar(64) NOT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `base_settings`
--

CREATE TABLE `base_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(64) NOT NULL,
  `value` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `base_tree`
--

CREATE TABLE `base_tree` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Unique tree node identifier',
  `root` int(10) UNSIGNED DEFAULT NULL COMMENT 'Tree root identifier',
  `lft` int(11) NOT NULL COMMENT 'Nested set left property',
  `rgt` int(11) NOT NULL COMMENT 'Nested set right property',
  `lvl` smallint(6) NOT NULL COMMENT 'Nested set level / depth',
  `name` varchar(255) NOT NULL COMMENT 'The tree node name / label',
  `slug` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) DEFAULT NULL COMMENT 'The icon to use for the node',
  `icon_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Icon Type: 1 = CSS Class, 2 = Raw Markup',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is active (will be set to false on deletion)',
  `selected` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is selected/checked by default',
  `disabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is enabled',
  `readonly` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is read only (unlike disabled - will allow toolbar actions)',
  `visible` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is visible',
  `collapsed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is collapsed by default',
  `movable_u` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable one position up',
  `movable_d` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable one position down',
  `movable_l` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable to the left (from sibling to parent)',
  `movable_r` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable to the right (from sibling to child)',
  `removable` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is removable (any children below will be moved as siblings before deletion)',
  `removable_all` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is removable along with descendants',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_tree`
--

INSERT INTO `base_tree` (`id`, `root`, `lft`, `rgt`, `lvl`, `name`, `slug`, `link`, `description`, `icon`, `icon_type`, `active`, `selected`, `disabled`, `readonly`, `visible`, `collapsed`, `movable_u`, `movable_d`, `movable_l`, `movable_r`, `removable`, `removable_all`, `created`, `updated`) VALUES
(1, 1, 1, 2, 0, 'Menu', 'menu', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-09-08 13:13:17', '2015-09-08 13:13:17'),
(2, 2, 1, 2, 0, 'Cities', 'cities', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-09-08 13:13:43', '2015-09-08 13:13:43'),
(14, 14, 1, 20, 0, 'About Us', 'about-us', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 12:16:15', '2015-12-03 14:03:24'),
(15, 15, 1, 6, 0, 'Entrepreneurs', 'entrepreneurs', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 12:25:56', '2015-12-09 11:50:57'),
(16, 16, 1, 16, 0, 'Groups', 'groups', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, '2015-12-03 12:27:20', '2015-12-03 14:04:22'),
(18, 14, 2, 3, 1, 'Our Angel Groups', 'our-angel-groups', '', '<p>The South Carolina Angel Network is an affiliation of the leading angel groups in South Carolina and Western North Carolina. These groups consist of more than 200 individual angel investors that meet frequently to analyze the best early stage companies from around our region - and support them with their financial and intellectual capital.</p>\r\n										<p>Quick snapshots of each group are below.  Learn more about them in the Angel Groups section.</p>', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 12:32:49', '2015-12-08 15:00:01'),
(19, 14, 4, 9, 1, 'Our Portfolio', 'our-portfolio', '', 'INVESTMENT POWER\r\n\r\nSCAN groups and funds have invested nearly $15 million in 40 companies\r\n\r\n    Geography: Companies based in the Southeastern US, particularly in South Carolina and Western North Carolina\r\n    Consistent support:  We have supported our portfolio companies with advisors, Board members, follow-on capital and introductions to strategic resources\r\n    Syndication partners: Co-invested with over 20 VC funds, angels groups, and others\r\n    Foundation: Portfolio has raised over $200 million in total funding', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 12:41:37', '2015-12-03 12:41:37'),
(20, 14, 5, 6, 2, 'Active Portfolio', 'active-portfolio', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, '2015-12-03 12:42:32', '2015-12-03 12:43:47'),
(21, 14, 7, 8, 2, 'Realized Portfolio', 'realized-portfolio', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 12:43:24', '2015-12-03 12:43:24'),
(22, 15, 2, 3, 1, 'Pitching Process', 'pitching-process', '', '<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>angel groups</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Angel groups make investments in early stage companies, typically in the form of equity (rather than debt). SCAN groups aim to invest between $250,000 and $750,000 in companies looking for capital to scale an existing product or service.</p>\r\n										<p>See below for some guidelines on what our angel investors are seeking - and for some insights that we hope will make the process of pitching to investors more transparent and improve your chances of successfully raising capital.</p>\r\n										<p>If you think you fit the parameters below, please contact us; if not, check out some other potential options on our Sources of Capital page.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-hr theme01"></div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>investment criteria</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>Based in the Southeastern United States (and yes, we do have a bias for SC companies)</li>\r\n											<li>Seeking ~$200,000 to $1,000,000 for a 15%-40% preferred equity stake in the company</li>\r\n											<li>Companies at or near go-to-market stage with demonstrated customer interest</li>\r\n											<li>A business model that can scale with speed and relative capital efficiency</li>\r\n											<li>Potential to generate a 50% rate of return on investment for investors in 3-5 years</li>\r\n											<li>Management team that is talented, trustworthy, persistent and knowledgeable</li>\r\n										</ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-hr theme01"></div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-subTitle">\r\n										<span>proccess</span>\r\n									</div>\r\n									<div class="app101-area-title">\r\n										<span>initial conversation</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>If you can track us down through a warm introduction, that''s your best bet</li>\r\n											<li>If you can''t, you''re welcome to send us an email to get introduced</li>\r\n											<li>Include your three-sentence business overview and attach a 1-2 page executive summary</li>\r\n											<li>Word to the wise: don''t send a life story, long essay, or 25+ page business plan</li>\r\n										</ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>screening meeting</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>If we''re intrigued with the initial introduction, we may schedule a call to learn more</li>\r\n											<li>If we''re still intrigued, we''ll invite you to one of our screening meetings</li>\r\n											<li>Screening meetings are held monthly at each local group, during which a small group of angels and the SCAN team listens to your formal pitch. For locations, see each group''s page.</li>\r\n											<li>Screening pitches are typically 12 minutes of pitch time followed by 15 minutes of Q&amp;A</li>\r\n											<li>Please follow the basic advice on how to give good angel presentations. Try here, here, here, or here - or come to a Venture Carolina seminar on "How to Pitch to Angel Investors".</li>\r\n										</ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>full meeting</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>If you are selected from the screening meeting, we will invite you to a full member meeting</li>\r\n											<li>Held monthly at each local group, you present to the full angel membership. For locations, see each group''s page.</li>\r\n											<li>This time you''ll have 15 minutes to present, followed by up to 20 minutes of Q&amp;A. Be prepared for tough questions.</li>\r\n										</ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>due diligence</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>If you pass the membership meeting into due diligence, a group of angels and the SCAN team will take a deep dive into your business.  We''ll review your documents and meet with the management team to ask our questions.</li>\r\n											<li>Word to the wise:  the more prepared and organized you are, the more efficient this will be (so build a data room as you build your business for quick access to key documents).</li>\r\n											<li>At the end of the diligence process, the diligence team presents its report back to the group. Hopefully everyone is impressed and we can collect investment checks.</li>\r\n										</ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-hr theme01"></div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>some unsolicited advice</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Pitching to angel groups is difficult. The process above can take two months or more, and our angel groups invest in only about 3% of the companies that start the initial conversation.</p>\r\n										<p>And remember you are not the only entrepreneurs pitching. We review 20-40 introductions each month, so you''ll need to stand out.  But that''s not necessarily all that difficult to do: be prepared, do your homework on our groups, have a 1-2 page executive summary and a compelling 10-12 page investor deck, and be organized and professional - and you''ll already be ahead of the pack.</p>\r\n									</div>\r\n								</div>', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 13:26:53', '2015-12-09 11:50:20'),
(23, 15, 4, 5, 1, 'Sources Of Capital', 'sources-of-capital', '', '<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>angel groups</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Angel groups make investments in early stage companies, typically in the form of equity (rather than debt). SCAN groups aim to invest between $250,000 and $750,000 in companies looking for capital to scale an existing product or service.</p>\r\n										<p>See below for some guidelines on what our angel investors are seeking - and for some insights that we hope will make the process of pitching to investors more transparent and improve your chances of successfully raising capital.</p>\r\n										<p>If you think you fit the parameters below, please contact us; if not, check out some other potential options on our Sources of Capital page.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-hr theme01"></div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>investment criteria</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>Based in the Southeastern United States (and yes, we do have a bias for SC companies)</li>\r\n											<li>Seeking ~$200,000 to $1,000,000 for a 15%-40% preferred equity stake in the company</li>\r\n											<li>Companies at or near go-to-market stage with demonstrated customer interest</li>\r\n											<li>A business model that can scale with speed and relative capital efficiency</li>\r\n											<li>Potential to generate a 50% rate of return on investment for investors in 3-5 years</li>\r\n											<li>Management team that is talented, trustworthy, persistent and knowledgeable</li>\r\n										</ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-hr theme01"></div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-subTitle">\r\n										<span>proccess</span>\r\n									</div>\r\n									<div class="app101-area-title">\r\n										<span>initial conversation</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>If you can track us down through a warm introduction, that''s your best bet</li>\r\n											<li>If you can''t, you''re welcome to send us an email to get introduced</li>\r\n											<li>Include your three-sentence business overview and attach a 1-2 page executive summary</li>\r\n											<li>Word to the wise: don''t send a life story, long essay, or 25+ page business plan</li>\r\n										</ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>screening meeting</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>If we''re intrigued with the initial introduction, we may schedule a call to learn more</li>\r\n											<li>If we''re still intrigued, we''ll invite you to one of our screening meetings</li>\r\n											<li>Screening meetings are held monthly at each local group, during which a small group of angels and the SCAN team listens to your formal pitch. For locations, see each group''s page.</li>\r\n											<li>Screening pitches are typically 12 minutes of pitch time followed by 15 minutes of Q&amp;A</li>\r\n											<li>Please follow the basic advice on how to give good angel presentations. Try here, here, here, or here - or come to a Venture Carolina seminar on "How to Pitch to Angel Investors".</li>\r\n										</ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>full meeting</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>If you are selected from the screening meeting, we will invite you to a full member meeting</li>\r\n											<li>Held monthly at each local group, you present to the full angel membership. For locations, see each group''s page.</li>\r\n											<li>This time you''ll have 15 minutes to present, followed by up to 20 minutes of Q&amp;A. Be prepared for tough questions.</li>\r\n										</ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>due diligence</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>If you pass the membership meeting into due diligence, a group of angels and the SCAN team will take a deep dive into your business.  We''ll review your documents and meet with the management team to ask our questions.</li>\r\n											<li>Word to the wise:  the more prepared and organized you are, the more efficient this will be (so build a data room as you build your business for quick access to key documents).</li>\r\n											<li>At the end of the diligence process, the diligence team presents its report back to the group. Hopefully everyone is impressed and we can collect investment checks.</li>\r\n										</ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-hr theme01"></div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>some unsolicited advice</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Pitching to angel groups is difficult. The process above can take two months or more, and our angel groups invest in only about 3% of the companies that start the initial conversation.</p>\r\n										<p>And remember you are not the only entrepreneurs pitching. We review 20-40 introductions each month, so you''ll need to stand out.  But that''s not necessarily all that difficult to do: be prepared, do your homework on our groups, have a 1-2 page executive summary and a compelling 10-12 page investor deck, and be organized and professional - and you''ll already be ahead of the pack.</p>\r\n									</div>\r\n								</div>', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, '2015-12-03 13:28:12', '2015-12-09 11:49:56'),
(24, 14, 10, 17, 1, 'Our Team', 'our-team', '', '<p>Our Team</p>\r\n\r\n<p>Our team combines complementary skills and experience: angel network creation, management, and investing; board experience; entrepreneurship; venture capital and private equity; fund management, M&amp;A advisory; and management consulting expertise.</p>\r\n', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 13:30:42', '2015-12-03 13:30:42'),
(25, 14, 11, 12, 2, 'Matt Dunbar', 'matt-dunbar', '', '<p><a href="http://www.scangelnetwork.com/ucan/">Managing Director</a></p>\r\n\r\n<p>As the founding Managing Director of UCAN, Matt developed the operations that became the template for SCAN angel groups, and under his leadership, UCAN has been named a Top 10 Angel Group in the US.&nbsp;&nbsp;</p>\r\n\r\n<p>Matt has previous management consulting experience with the Boston Consulting Group, where he led project teams, and in technology development with Eastman Chemical, where he supported manufacturing operations and business development.</p>\r\n\r\n<p>Stanford MBA and Masters in Education; Clemson BS Chemical Engineering. &nbsp;Learn more about Matt via <a href="https://www.linkedin.com/in/dunbarmatt" target="_blank">LinkedIn</a>.&nbsp;</p>\r\n', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 13:32:45', '2015-12-03 13:32:45'),
(26, 14, 13, 14, 2, 'Charlie Banks', 'charlie-banks', '', '<p><a href="http://www.scangelnetwork.com/capital-angels/" target="_blank">Managing Director</a></p>\r\n\r\n<p>Charlie is an experienced serial entrepreneur who&nbsp;has founded, run, and invested in multiple manufacturing, financial services, building science, and real estate companies in South Carolina.</p>\r\n\r\n<p>Prior to co-founding the South Carolina Angel Network, he served as a Portfolio Manager at a start-up financial institution based in Greenville where he was also responsible for developing and implementing many of its entrepreneur engagement strategies.</p>\r\n\r\n<p>Newberry College BS in Business Administration. &nbsp;Learn more about Charlie via <a href="https://www.linkedin.com/in/charliebanks1" target="_blank">LinkedIn</a>&nbsp;or follow him on <a href="https://twitter.com/charliebanks11">Twitter</a></p>\r\n', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 13:34:20', '2015-12-03 13:34:20'),
(27, 14, 15, 16, 2, 'Paul Clark', 'paul-clark', '', '<p><a href="http://www.scangelnetwork.com/spartanburg-angels/">MANAGING DIRECTOR</a></p>\r\n\r\n<p>Before helping to establish the groups in Spartanburg, Anderson, and Asheville, Paul was Senior Vice President of M&amp;A at CertusBank in Greenville. He was part of a team responsible for investments in financial services companies and vehicles, including an SBIC fund, and developing junior lending capabilities.</p>\r\n\r\n<p>Paul has previous private equity investment and fund experience as a Principal at BC Partners in New York and London, and earlier M&amp;A advisory experience at NM Rothschild &amp; Sons in London.</p>\r\n\r\n<p>Fordham MA Medieval History; Durham (UK) BA History. &nbsp;Learn more about Paul via <a href="https://www.linkedin.com/in/paulclarkprivateequity" target="_blank">LinkedIn</a>&nbsp;or follow him on <a href="https://twitter.com/palmettoangel">Twitter.</a></p>\r\n', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 13:35:49', '2015-12-03 13:35:49'),
(28, 14, 18, 19, 1, 'Our Partners', 'our-partners', '', '<p>Our Partners</p>\r\n\r\n<p>SCAN works alongside trusted sponsors and partners in many of its communities across the Carolinas. These organizations work with angel investors, entrepreneurs, and emerging companies to help grow and strengthen our ecosystem and our economy. We encourage you to check out their services and many other important contributions to our communities.&nbsp;</p>\r\n\r\n<p>None of the groups would be possible without the support of our corporate partners. These companies provide assistance to angels, portfolio companies, and entrepreneurs for no compensation - but simply to help grow our state&#39;s companies and strengthen its economy.</p>\r\n', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 13:52:33', '2015-12-03 13:52:33'),
(32, 16, 2, 3, 1, 'upstate carolina angel network', 'upstate-carolina-angel-network', 'http://www.upstateangels.com/', '<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>about us</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>UCAN is a group of accredited investors located in the Upstate of South Carolina who invest in and support start-up and early-stage, high-growth businesses.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>history</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>UCAN officially launched in 2008. The group now has over 50 members and continues to grow. Since its inception in 2008, UCAN has invested more than $13 million in 39 companies. UCAN is a member of the Angel Capital Association.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>team</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>UCAN is run by Matt Dunbar and is a collaboration between SCAN leadership, J.B. Holeman and Tim Reed, with support from the Greater Greenville Chamber of Commerce and several founding members whose leadership and dedication help make UCAN the success it is today.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>members</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>UCAN members possess a broad array of business experiences and skills they bring to bear in helping to screen and evaluate potential portfolio companies. They also serve as a valuable resource for guidance and advice to entrepreneurs and their businesses once an investment is made.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>meetings</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>The group meets monthly, by invitation only, on the first and third Tuesday - once for screening meetings and once for full member meetings. To attend a meeting please contact us. To pitch to the group, please review our process.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>sponsors</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Thanks to our sponsors - Wyche, The Palmetto Bank, Nelson Mullins, Elliott Davis, Next, U.S. Trust, the Greenville Chamber of Commerce and Clemson  - for their support</p>\r\n									</div>\r\n								</div>', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 14:08:35', '2015-12-09 21:54:02'),
(33, 16, 4, 5, 1, 'capital angels', 'capital-angels', '', '<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>about us</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Capital Angels is a professionally-managed, membership-based group of angel investors in the Midlands of South Carolina. Capital Angels is a member of the Angel Capital Association.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>history</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Capital Angels officially launched in 2014. The group''s nearly-40 members have been investing in innovative startups that have the potential to disrupt and transform markets since 2014. </p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>team</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Capital Angels is run by Charlie Banks and is a collaboration between SCAN leadership and several founding members whose leadership and determination led to the success of Capital Angels.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>members</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Members in Capital Angels come from a broad range of backgrounds and interest:</p>\r\n                                                                                <ul>\r\n                                                                                    <li>Multiple members who are claiming the title "angel investor" for the first time </li>\r\n                                                                                    <li>Members with 20+ years of experience investing in early stage companies</li>\r\n                                                                                    <li>Over half our members have been founders and CEOs of companies</li>\r\n                                                                                    <li>Other backgrounds consist of financial investment professionals, hospice operators; valuation experts, real estate experts, management consultants, and brewers.</li>\r\n                                                                                </ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>meetings</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>This group meets monthly, by invitation only, on the first and third Thursday- once for screening meetings and once for full member meetings. To attend a meeting please contact us. To pitch to the group, please review our process.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>sponsors</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Thanks to our sponsors - Chernoff Newman, Cromers, Nelson Mullins, Bourbon, It-ology, Stokes-Trainor, Colite, and Bauknight, Pietas, & Stormer - for their support.</p>\r\n									</div>\r\n								</div>', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 14:40:23', '2015-12-08 11:30:58'),
(34, 16, 6, 7, 1, 'spartanburg angels', 'spartanburg-angels', 'http://static1.squarespace.com/static/53c67a0ee4b095e6864cdbd6/t/55e0a418e4b0c4a6bc97cc8e/1440785432778/Spartanburg+Angels.pdf', '<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>about us</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Spartanburg Angels combines the entrepreneurial culture, investor expertise, and mentoring talent of investors in Spartanburg with SCAN''s proven angel investment group model.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>history</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Spartanburg Angels officially launched in February 2015. The group now has 30 members and continues to grow rapidly thanks to the support of our members and community. </p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>team</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>The group is a collaboration between SCAN leadership (it is run by Paul Clark), the Spartanburg Area Chamber of Commerce, and several founding members whose determination led to the successful launch of Spartanburg Angels.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>members</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Members in Spartanburg Angels come from a broad range of backgrounds and interest:</p>\r\n                                                                                <ul>\r\n                                                                                    <li>Multiple members who are claiming the title "angel investor" for the first time </li>\r\n                                                                                    <li>Members with 20+ years of experience investing in early stage companies</li>\r\n                                                                                    <li>Over half our members have been founders and CEOs of companies</li>\r\n                                                                                    <li>Other backgrounds consist of financial investment professionals, hospice operators; valuation experts, real estate experts, management consultants, and brewers.</li>\r\n                                                                                </ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>meetings</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>The group meets monthly, by invitation only, on the first and third Wednesday - once for screening meetings and once for full member meetings. To attend a meeting please contact us. To pitch to the group, please review our process and then contact us.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>sponsors</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Thanks to our sponsors - the Spartanburg Chamber and RJ Rockers - for their support.</p>\r\n									</div>\r\n								</div>', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 15:53:00', '2015-12-08 11:44:48'),
(35, 16, 8, 9, 1, 'lowcountry angels', 'lowcountry-angels', '', '<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>about us</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Lowcountry Angels is an active group of accredited investors in the Charleston, South Carolina area. Our members help evaluate potential portfolio companies for investment, putting to use their broad range of successful business experiences and professional talents.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>history</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>LCA met for the first time in April 2015 to combine the entrepreneurial culture, investor expertise, and mentoring talent of investors in the Charleston area. </p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>team</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>The group is a collaboration between SCAN leadership, LCA Managing Director, Josh Silverman, and several founding members whose leadership and determination lead to the success of Lowcountry Angels.</p>\r\n									</div>\r\n								</div>\r\n								\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>meetings</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>The group meets monthly, by invitation only, on the first Wednesday of each month. To attend a meeting please contact us. To pitch to the group, please review our process.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>sponsors</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Thanks to our sponsors - the Atlantic Coast Advisory, Silicon Harbor Communications, and Jericho Advisors - for their support.</p>\r\n									</div>\r\n								</div>', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 15:58:03', '2015-12-08 12:13:01'),
(36, 16, 10, 11, 1, 'electric city angels', 'electric-city-angels', '', '<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>about us</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Electric City Angels is a group of individuals helping to develop the startup community in Anderson, SC. ECA considers the best investment opportunities from around the Upstate, with a particular focus on attractive investment opportunities in Anderson County and surrounding areas.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>history</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Electric City Angels met for the first time in February 2015, and made its first investment by the summer of 2015.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>team</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>The group is a partnership between Craig Kinley and e-Merge @ The Garage, a public-private partnership that provides small business acceleration and mentorship, and SCAN.</p>\r\n									</div>\r\n								</div>\r\n								\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>meetings</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>The group meets monthly, by invitation only, on the third Monday for a member meeting. To attend a meeting please contact us. To pitch to the group, please review our process and then contact us.</p>\r\n									</div>\r\n								</div>', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-08 11:59:15', '2015-12-08 11:59:15'),
(37, 16, 12, 13, 1, 'asheville angels', 'asheville-angels', '', '<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>about us</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Asheville Angels is a member-based angel investor group that finds and funds startups and early-stage companies in Asheville, Western North Carolina, and across the Southeast.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>history</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>The group was formed in 2014 and made its first investment by the end of 2014. They currently consists of over 50 investors who meet monthly to hear and review pitches from young, innovative, high-growth companies. Asheville Angels is a member of the Angel Capital Association. </p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>team</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Asheville Angels is a joint venture between SCAN and Josh Dorfman at Venture Asheville (the entrepreneurship initiative of the Economic Development Coalition for Asheville-Buncombe County and the Asheville Area Chamber of Commerce).</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>members</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>With over 50 members, Asheville Angels come from a broad range of backgrounds and interests:</p>\r\n                                                                                <ul>\r\n                                                                                    <li>Multiple members who are claiming the title "angel investor" for the first time - and others who have 20+ years of experience investing in early stage companies</li>\r\n                                                                                    <li>Backgrounds across a wide variety of fields - from academia to breweries, high-tech startups, marketing, and financial services</li>\r\n                                                                                    <li>A mixture of Asheville natives and transplants</li>\r\n                                                                                </ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>meetings</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>The group meets monthly, by invitation only, on the first and third Thursdays - once for screening meetings and once for full member meetings. To attend a meeting please contact us. To pitch to the group, please review our process.The group meets monthly, by invitation only, on the first and third Thursdays - once for screening meetings and once for full member meetings. To attend a meeting please contact us. To pitch to the group, please review our process.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>sponsors</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Thanks to our sponsors - McGuire Wood Bissette, Venture Asheville, and the Asheville Chamber of Commerce - for their support.</p>\r\n									</div>\r\n								</div>', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-08 12:05:05', '2015-12-08 12:05:05'),
(38, 16, 14, 15, 1, 'central savannah river angels', 'central-savannah-river-angels', '', '<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>about us</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>CSR Angels is a group of individuals dedicated to developing the startup community in Aiken and Augusta. We consider the best investment opportunities from the Central Savannah River Area, with a particular focus on developing the talent and opportunities in Aiken, Augusta and surrounding areas.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>history</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>CSR Angels launched during the summer of 2015, with its first meeting in September. </p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>team</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>The group is a partnership between Peter Buckley, Paul Newsom, Jason Rabun and the South Carolina Angel Network.</p>\r\n									</div>\r\n								</div>\r\n								\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>meetings</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>CSR Angels meets the fourth Wednesday of each month, from 4-6pm, at the Aiken Chamber of Commerce. </p>\r\n									</div>\r\n								</div>', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-08 12:09:12', '2015-12-08 12:09:12'),
(39, 39, 1, 8, 0, 'Investors', 'investors', '', '<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>angel investors</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Angel investors come from all walks of life with many varied backgrounds and interests.  While they all must be accredited (per the SEC''s definition), the more important things they have in common are an interest in making good investments and helping startup companies succeed.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>our investors</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>SCAN groups consist of over 200 angel investors, from Asheville to Charleston</li>\r\n											<li>Our members include over 100 company founders and C-level executives</li>\r\n											<li>Our members have expertise in every functional area of business, from operations to technology to finance, and across many industries from aerospace to education</li>\r\n											<li>Member information always remains confidential</li>\r\n										</ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>investors obligations</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>As a member of an angel group,  investors can be as actively involved in any aspect of the group as they wish.</p>\r\n										<ul>\r\n											<li>No obligation to invest in any company at any time (but we hope all will participate)</li>\r\n											<li>No obligation to serve on any diligence team (but volunteers enjoy the intellectual challenge)</li>\r\n											<li>No obligation to work directly with any of the portfolio companies (but members who serve on boards and as advisors enjoy it and add great value)</li>\r\n										</ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>where do we get our investment capital from?</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>Private Individuals 100%</li>\r\n											<li>Public Entities 0%</li>\r\n										</ul>\r\n									</div>\r\n								</div>', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-09 10:30:37', '2015-12-09 11:24:36'),
(40, 39, 2, 3, 1, 'angel investors', 'angel-investors', '', '<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>angel investors</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Angel investors come from all walks of life with many varied backgrounds and interests.  While they all must be accredited (per the SEC''s definition), the more important things they have in common are an interest in making good investments and helping startup companies succeed.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>our investors</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>SCAN groups consist of over 200 angel investors, from Asheville to Charleston</li>\r\n											<li>Our members include over 100 company founders and C-level executives</li>\r\n											<li>Our members have expertise in every functional area of business, from operations to technology to finance, and across many industries from aerospace to education</li>\r\n											<li>Member information always remains confidential</li>\r\n										</ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>investors obligations</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>As a member of an angel group,  investors can be as actively involved in any aspect of the group as they wish.</p>\r\n										<ul>\r\n											<li>No obligation to invest in any company at any time (but we hope all will participate)</li>\r\n											<li>No obligation to serve on any diligence team (but volunteers enjoy the intellectual challenge)</li>\r\n											<li>No obligation to work directly with any of the portfolio companies (but members who serve on boards and as advisors enjoy it and add great value)</li>\r\n										</ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>where do we get our investment capital from?</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>Private Individuals 100%</li>\r\n											<li>Public Entities 0%</li>\r\n										</ul>\r\n									</div>\r\n								</div>', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-09 10:32:25', '2015-12-09 11:26:59'),
(41, 39, 4, 5, 1, 'Investor Resources', 'investor-resources', '', '<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>deal flow and dilligence platforms</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>ProSeeder - for UCAN, Capital Angels, Asheville Angels, or the Palmetto Angel Fund</li>\r\n											<li>Venture360 - for Spartanbug Angels, Lowcountry Angels, and Electric City Angels</li>\r\n										</ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>external resources</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>As a member of an angel group,  investors can be as actively involved in any aspect of the group as they wish.</p>\r\n										<ul>\r\n											<li>SCAN groups are proud to be members of the Angel Capital Association. It has a variety of great resources for investors in its Knowledge Center and our members can log in here.</li>\r\n											<li>Angel Resource Institute - A leading provider of angel-related educational materials</li>\r\n											<li>Kauffman Foundation - the leading foundation supporting entrepreneurship</li>\r\n										</ul>\r\n									</div>\r\n								</div>', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-09 10:42:15', '2015-12-09 11:32:59'),
(42, 39, 6, 7, 1, 'Angel Tax Credit', 'angel-tax-credit', '', '<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>angel investors</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Angel investors come from all walks of life with many varied backgrounds and interests.  While they all must be accredited (per the SEC''s definition), the more important things they have in common are an interest in making good investments and helping startup companies succeed.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>our investors</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>SCAN groups consist of over 200 angel investors, from Asheville to Charleston</li>\r\n											<li>Our members include over 100 company founders and C-level executives</li>\r\n											<li>Our members have expertise in every functional area of business, from operations to technology to finance, and across many industries from aerospace to education</li>\r\n											<li>Member information always remains confidential</li>\r\n										</ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>investors obligations</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>As a member of an angel group,  investors can be as actively involved in any aspect of the group as they wish.</p>\r\n										<ul>\r\n											<li>No obligation to invest in any company at any time (but we hope all will participate)</li>\r\n											<li>No obligation to serve on any diligence team (but volunteers enjoy the intellectual challenge)</li>\r\n											<li>No obligation to work directly with any of the portfolio companies (but members who serve on boards and as advisors enjoy it and add great value)</li>\r\n										</ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>where do we get our investment capital from?</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>Private Individuals 100%</li>\r\n											<li>Public Entities 0%</li>\r\n										</ul>\r\n									</div>\r\n								</div>', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-09 10:42:56', '2015-12-09 11:47:06');

-- --------------------------------------------------------

--
-- Table structure for table `base_user`
--

CREATE TABLE `base_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` char(123) NOT NULL,
  `token` char(123) DEFAULT NULL,
  `token_type` tinyint(3) UNSIGNED DEFAULT NULL,
  `auth_key` char(123) DEFAULT NULL,
  `sso_key` char(123) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_user`
--

INSERT INTO `base_user` (`id`, `username`, `email`, `password`, `token`, `token_type`, `auth_key`, `sso_key`, `status`, `last_login`, `created`, `updated`) VALUES
(1, 'sharaf', 'a.sharaf@digitreeinc.com', '$2y$13$kikaRlsiqLeqqKNTLvnOMe/n7neQjrApbTKDAaDl7j7Loot1VMKlO', NULL, NULL, 'FhT8dCMQ-FhBOSeIZ4rUBsTidGm4q0vV', NULL, 2, '2016-02-25 16:44:50', '2015-09-08 12:58:24', '2015-09-08 12:58:24');

-- --------------------------------------------------------

--
-- Table structure for table `meta_tags`
--

CREATE TABLE `meta_tags` (
  `id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `model_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meta_tags`
--

INSERT INTO `meta_tags` (`id`, `model`, `model_id`, `title`, `keywords`, `description`, `created`, `updated`) VALUES
(1, 'Project', 1, 'First Project Test', 'First Project Test', 'First Project Test', '2015-09-08 15:06:12', '2015-09-08 15:39:55'),
(2, 'Career', 1, '', '', '', '2015-09-08 15:17:08', '2015-09-08 15:17:08'),
(3, 'Project', 2, '', '', '', '2015-09-08 15:28:53', '2015-09-08 15:28:53'),
(4, 'Page', 2, '', '', '', '2015-09-08 15:51:41', '2015-09-08 15:51:41'),
(6, 'Page', 4, '', '', '', '2015-09-08 15:52:38', '2015-12-09 16:11:51'),
(7, 'Blog', 5, '', '', '', '2015-12-03 15:43:54', '2015-12-03 15:43:54'),
(8, 'Blog', 6, '', '', '', '2015-12-03 15:44:40', '2015-12-03 15:44:40'),
(9, 'News', 7, 'blog 1', 'blog scangles', 'test', '2015-12-03 15:46:38', '2015-12-03 15:47:35'),
(10, 'News', 8, '', '', '', '2015-12-03 15:48:56', '2015-12-03 15:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `base_content`
--
ALTER TABLE `base_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base_media`
--
ALTER TABLE `base_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base_messages`
--
ALTER TABLE `base_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_base_messages_1` (`parent_id`),
  ADD KEY `fk_base_messages_2` (`sender_id`),
  ADD KEY `fk_base_messages_3` (`receiver_id`);

--
-- Indexes for table `base_settings`
--
ALTER TABLE `base_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key_UNIQUE` (`key`);

--
-- Indexes for table `base_tree`
--
ALTER TABLE `base_tree`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_tree_NK1` (`root`),
  ADD KEY `tbl_tree_NK2` (`lft`),
  ADD KEY `tbl_tree_NK3` (`rgt`),
  ADD KEY `tbl_tree_NK4` (`lvl`),
  ADD KEY `tbl_tree_NK5` (`active`);

--
-- Indexes for table `base_user`
--
ALTER TABLE `base_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `token_UNIQUE` (`token`),
  ADD UNIQUE KEY `signature_UNIQUE` (`auth_key`),
  ADD UNIQUE KEY `login_token_UNIQUE` (`sso_key`);

--
-- Indexes for table `meta_tags`
--
ALTER TABLE `meta_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `object` (`model`,`model_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `base_content`
--
ALTER TABLE `base_content`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `base_media`
--
ALTER TABLE `base_media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `base_messages`
--
ALTER TABLE `base_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `base_settings`
--
ALTER TABLE `base_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `base_tree`
--
ALTER TABLE `base_tree`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Unique tree node identifier', AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `base_user`
--
ALTER TABLE `base_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `meta_tags`
--
ALTER TABLE `meta_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Database: `main-old`
--
CREATE DATABASE IF NOT EXISTS `main-old` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `main-old`;

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Asterisk', '1', 1424278268);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1424278227, 1424278227),
('Asterisk', 1, 'Full Access', NULL, NULL, 1424278062, 1424279109);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Asterisk', '/*');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `base_content`
--

CREATE TABLE `base_content` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `brief` tinytext NOT NULL,
  `description` text NOT NULL,
  `body` text NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(3) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_content`
--

INSERT INTO `base_content` (`id`, `type`, `title`, `slug`, `brief`, `description`, `body`, `date`, `end_date`, `sort`, `hits`, `status`, `created`, `updated`) VALUES
(2, 1, 'Home Slider', 'home-slider', '', '', '', NULL, NULL, 1, 0, NULL, '2015-09-08 15:51:41', '2015-09-08 15:51:41'),
(4, 1, 'Contact Us', 'contact-us', '', '', '<div class="app101-contacts-information">\r\n											<div class="app101-contact-information">\r\n												<div class="app101-contact-title">\r\n													<span>SC Angel Network</span>\r\n												</div>\r\n												<div class="app101-contact-details">\r\n													<span>PO Box 2525</span><br />\r\n													<span>Columbia, SC 29202</span>\r\n												</div>\r\n											</div>\r\n											<div class="app101-contact-information">\r\n												<div class="app101-contact-title">\r\n													<span>Palmetto Angel 2014 Fund</span>\r\n												</div>\r\n												<div class="app101-contact-details">\r\n													<span>411 University Ridge</span><br />\r\n													<span>Suite 211</span><br />\r\n													<span>Greenville, SC 29601</span>\r\n												</div>\r\n											</div>\r\n											<div class="app101-contact-information">\r\n												<div class="app101-contact-title">\r\n													<span>Email</span>\r\n												</div>\r\n												<div class="app101-contact-details">\r\n													<span>saleh@main.com</span><br />\r\n													<span>nojara@main.com</span><br />\r\n													<span>mohamed@main.com</span>\r\n												</div>\r\n											</div>\r\n										</div>', NULL, NULL, 3, 0, NULL, '2015-09-08 15:52:38', '2015-12-09 16:11:51'),
(5, 3, 'Angel investor tax credit - for founders', 'angel-investor-tax-credit-for-founders', '', '', '<p><a href="https://twitter.com/SCAngelNetwork/status/626036712863608832" target="_blank">Last week</a> saw the window close for claiming the SC angel investor tax credit for 2014, and last week <a href="http://www.scangelnetwork.com/our-team/">Matt</a> and <a href="http://lowcountryangelnetwork.com/" target="_blank">Lowcountry Angels</a> ran seminar explaining how the tax credit works. We have an introduction to the credit on our &quot;tax credit&quot; <a href="http://www.scangelnetwork.com/angel-investor-tax-credit/">page</a>.</p>\r\n\r\n<p>These events prompted another look at an overlooked aspect of the credit - how it can be used by founders of companies.</p>\r\n\r\n<p>The credit is limited to &quot;accredited investors&quot; based on the <a href="http://www.investor.gov/news-alerts/investor-bulletins/investor-bulletin-accredited-investors" target="_blank">SEC&#39;s rules</a> about who is allowed to invest in companies that are not &quot;public companies&quot;. &quot;Accreditation&quot; is usually based on wealth or income criteria.</p>\r\n\r\n<p>But another way to be accredited is to be &quot;a director, executive officer, or general partner of the issuer of securities, or any director, executive officer, or general partner of a general partner of the issuer.&quot;&nbsp; That enjoyable legalese basically means founders of companies are automatically accredited investors in their own companies.</p>\r\n\r\n<p>Therefore you, as a founder of a company, could get a state income tax credit of up to 35% of what you invest (in cash) in your startup - if you follow the other rules about the credit.&nbsp; We know many founders start companies from an existing job (it&#39;s the main reason why SC improved so much on <a href="http://www.kauffman.org/microsites/kauffman-index/rankings/state" target="_blank">this</a> ranking): the tax you paid on income from that job, or from the consulting work you do to pay the bills, can be reduced - giving you more resources to develop your high growth startup (so you can hopefully pay lots of capital gains tax later!).</p>\r\n\r\n<p>Too late to claim it this year, but if you&#39;re starting a company in 2015 and going to put your own money in, get the business <a href="http://www.scangelnetwork.com/angel-investor-tax-credit">qualified</a> before you do!</p>\r\n', NULL, NULL, 1, 0, NULL, '2015-12-03 15:43:54', '2015-12-03 15:43:54'),
(6, 3, 'Portfolio companies continue great momentum', 'portfolio-companies-continue-great-momentum', '', '', '<p>One of the most satisfying parts of angel investing is being able to celebrate the successes of our portfolio companies - particularly those that exemplify our motto of &quot;make money, have fun, do good.&quot;</p>\r\n\r\n<p>Today, <a href="http://www.scangelnetwork.com/s/Baebies-Financing-Press-release-FINAL-7282015.pdf" target="_blank">Baebies</a> announced the final closing of its $13 million fundraising. SCAN groups from Asheville to Columbia were proud to be involved, in partnership with some of the best early stage investors across the south east. CEO Rich West and his team have already sold one company for <a href="http://investor.illumina.com/phoenix.zhtml?c=121127&amp;p=irol-newsArticle&amp;ID=1840193&amp;highlight" target="_blank">$96 million</a>.&nbsp;Make money? Check. And now the have taken the same technology to provide newborn baby screening to help identify children with <a href="http://baebies.com/" target="_blank">rare diseases</a>. Do good? Check.</p>\r\n\r\n<p>Earlier in the week, the first investment of our <a href="http://www.scangelnetwork.com/local-angel-groups">Asheville Angels</a> group, <a href="http://www.plumprint.com" target="_blank">Plum Print</a>, was featured in the <a href="http://www.citizen-times.com/story/life/family/2015/07/26/keep-memories-toss-clutter/30496435/?utm_source=Venture+Asheville+Newsletter&amp;utm_campaign=e2032e57a1-July28_eNews_Venture_Avl&amp;utm_medium=email&amp;utm_term=0_4841c00474-e2032e57a1-221549793" target="_blank">Asheville Citizen-Times</a>. Since we invested, the company has gone from strength to strength, providing parents with unique records of their children&#39;s creativity. Have fun? Check.</p>\r\n\r\n<p>We look forward to watching both, and our 38 other investments, continue with their great momentum.</p>\r\n', NULL, NULL, 2, 0, NULL, '2015-12-03 15:44:40', '2015-12-03 15:44:40'),
(7, 2, 'SC Angel Network and CSR Angels to Speak at North Augusta Chamber Business Power Lunch', 'sc-angel-network-and-csr-angels-to-speak-at-north-augusta-chamber-business-power-lunch', '', '', '<p><strong>COLUMBIA, S.C.</strong>&nbsp;&ndash;&nbsp;<strong>The </strong><a href="https://west.exch030.serverdata.net/owa/redir.aspx?SURL=cBvc5Ny8J0f1xRyqSS8HqLpmz4JHnRRU_UolU0akEkjDf5l7S-XSCGgAdAB0AHAAOgAvAC8AdwB3AHcALgBzAGMAYQBuAGcAZQBsAG4AZQB0AHcAbwByAGsALgBjAG8AbQAvAA..&amp;URL=http%3a%2f%2fwww.scangelnetwork.com%2f" target="_blank">South Carolina Angel Network</a><strong>&nbsp;(SCAN) and </strong><a href="https://west.exch030.serverdata.net/owa/redir.aspx?SURL=kRK1Ax8u1VGm25dkPibyaB8_uHMatTclizZ3A9pbGRfDf5l7S-XSCGgAdAB0AHAAOgAvAC8AdwB3AHcALgBzAGMAYQBuAGcAZQBsAG4AZQB0AHcAbwByAGsALgBjAG8AbQAvAGMAZQBuAHQAcgBhAGwALQBzAGEAdgBhAG4AbgBhAGgALQByAGkAdgBlAHIALQBhAG4AZwBlAGwAcwAvAA..&amp;URL=http%3a%2f%2fwww.scangelnetwork.com%2fcentral-savannah-river-angels%2f" target="_blank">Central Savannah River Angels</a>&nbsp;(CRS Angels) are thrilled to be featured at the upcoming <a href="https://west.exch030.serverdata.net/owa/redir.aspx?SURL=B7aUacwmjXvwuVxL3RGP18r4BdlY8MlK7Lqg_Fg2kGjDf5l7S-XSCGgAdAB0AHAAOgAvAC8AdwB3AHcALgBuAG8AcgB0AGgAYQB1AGcAdQBzAHQAYQBjAGgAYQBtAGIAZQByAC4AbwByAGcALwBlAHYAZQBuAHQAcwAvAGQAZQB0AGEAaQBsAHMALwBiAHUAcwBpAG4AZQBzAHMALQBwAG8AdwBlAHIALQBsAHUAbgBjAGgALQBzAG8AdQB0AGgALQBjAGEAcgBvAGwAaQBuAGEALQBhAG4AZwBlAGwALQBuAGUAdAB3AG8AcgBrAC0ANAAxADMA&amp;URL=http%3a%2f%2fwww.northaugustachamber.org%2fevents%2fdetails%2fbusiness-power-lunch-south-carolina-angel-network-413" target="_blank">North Augusta Chamber&rsquo;s Business Power Lunch</a>. The event will be held on <strong>Tuesday, November 10th from 11:30am -1:00 pm at the Palmetto Terrace, located on the 4</strong><strong>th</strong><strong>&nbsp;floor of the North Augusta Municipal Building (100 Georgia Avenue, North Augusta, SC).</strong></p>\r\n\r\n<p>The power lunch provides Chamber members the opportunity to hear views and insights on economic trends, stay informed on issues relevant to the business community, and network with other professionals. Networking begins at 11:00am.&nbsp;</p>\r\n\r\n<p><a href="https://west.exch030.serverdata.net/owa/redir.aspx?SURL=yWIiym__3km6dUpWcu0VmYJLjnpaT3s6dHDM62-ckE_Df5l7S-XSCGgAdAB0AHAAOgAvAC8AdwB3AHcALgBuAG8AcgB0AGgAYQB1AGcAdQBzAHQAYQBjAGgAYQBtAGIAZQByAC4AbwByAGcALwBiAG8AYQByAGQALQBvAGYALQBkAGkAcgBlAGMAdABvAHIAcwAtAHMAdABhAGYAZgA.&amp;URL=http%3a%2f%2fwww.northaugustachamber.org%2fboard-of-directors-staff" target="_blank">Terra Carroll</a>, President/CEO of the North Augusta Chamber of Commerce, stated &ldquo;We are thrilled to have the CSR Angels present at our November Power Lunch. We truly believe that small business and new ideas are the very backbone of any community, so we are certainly excited for our members to receive this information.&rdquo;&nbsp;</p>\r\n\r\n<p><a href="https://west.exch030.serverdata.net/owa/redir.aspx?SURL=6PIYtrnqfEtdY9IQ3A5S9xA6Gu67t2GGu3WV045x8EzDf5l7S-XSCGgAdAB0AHAAOgAvAC8AdwB3AHcALgBzAGMAYQBuAGcAZQBsAG4AZQB0AHcAbwByAGsALgBjAG8AbQAvAG8AdQByAC0AdABlAGEAbQAvAA..&amp;URL=http%3a%2f%2fwww.scangelnetwork.com%2four-team%2f" target="_blank">Charlie Banks</a>, Managing Director of SCAN, added &ldquo;I look forward to discussing angel investing and its impact on the entrepreneurship ecosystem. We are excited about the launch of CSR Angels in the North Augusta and Aiken community.&rdquo;</p>\r\n\r\n<p>Pre-registration is required. For Chamber members, the cost is $25 for an individual and $200 for a table of eight. For non-members, it is $40 for an individual and $350 for a table of eight. To register, email Jessica Hanson at <a href="mailto:jessica@northaugustachamber.org">jessica@northaugustachamber.org</a>,&nbsp;call 803-279-2323, or click <a href="http://bit.ly/1Q5DDol">here.</a>&nbsp;The current event sponsors are as follows:&nbsp;</p>\r\n\r\n<p><strong>Presenting Sponsor:</strong><strong>&nbsp;</strong><strong>SRP Federal Credit Union</strong></p>\r\n\r\n<p><strong>Signature Sponsors:&nbsp;</strong><strong>Savannah River Nuclear Solutions -&nbsp;Georgia Regents University - Trace Staffing </strong><strong>EDTS- Southern Bank &amp; Trust- Savannah River Remediation LLC- SME CPAs</strong></p>\r\n\r\n<p><strong>Supporting Sponsors:&nbsp;</strong><strong>MAU &ndash; Kenneth Shuler School of Cosmetology &ndash; The Star</strong></p>\r\n', NULL, NULL, 1, 0, NULL, '2015-12-03 15:46:38', '2015-12-03 15:47:35'),
(8, 2, 'Capital Angels and Palmetto Angel Fund Invest in SC-based PharmRight Corporation', 'capital-angels-and-palmetto-angel-fund-invest-in-sc-based-pharmright-corporation', '', '', '<p><strong>COLUMBIA, S.C. &ndash;&nbsp;</strong>Capital Angels, the Midland&rsquo;s angel investor group that is part of the statewide South Carolina Angel Network (SCAN), and The Palmetto Angel Fund, a collaboration between Capital Angels and the other angel groups affiliated under SCAN, is pleased to announce a new investment in South Carolina-based PharmRight Corporation.&nbsp;</p>\r\n\r\n<p>PharmRight has developed LiviTM, a cloud-connected, automated medication dispenser for use in homes and institutional care settings to improve medication adherence and reduce the burden on caregivers. Bill Park, CEO of PharmRight explained: &ldquo;LiviTM is a product with nationwide scope and interest, but we are excited to have secured more funding from local investors to facilitate our commercial launch. SCAN&rsquo;s diligence process was rigorous, so we are pleased to have convinced their investors to support our company.&rdquo;&nbsp;</p>\r\n\r\n<p>Charlie Banks, Managing Director of Capital Angels and SCAN, noted &ldquo; We&rsquo;re excited about Pharmright and their potential to make a meaningful impact on the lives of many. They are a great team and South Carolina is fortunate to have them building a company in our state.&rdquo;&nbsp;</p>\r\n\r\n<p>SCAN groups, led by Greenville&rsquo;s Upstate Carolina Angel Network, and the Palmetto Angel Fund also recently invested in Greenville-based startup TipHive, a cloud platform for improving knowledge sharing and communication within enterprises, ending a busy summer of investing in some of South Carolina&rsquo;s most exciting early stage companies.&nbsp;</p>\r\n\r\n<p>SCAN, a professionally-managed network of over 200 angel investors, strives to generate attractive investment returns and strengthen the long-term economic health of our state by investing in innovative young companies. For more information on membership in Capital Angels, or any of the investor networks across SCAN, please visit www.scangelnetwork.com.</p>\r\n', NULL, NULL, 2, 0, NULL, '2015-12-03 15:48:56', '2015-12-03 15:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `base_media`
--

CREATE TABLE `base_media` (
  `id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED DEFAULT NULL,
  `model` varchar(64) NOT NULL,
  `path` varchar(255) NOT NULL,
  `filename` varchar(128) NOT NULL,
  `mime` varchar(128) NOT NULL,
  `size` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `embed` text NOT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_media`
--

INSERT INTO `base_media` (`id`, `model_id`, `model`, `path`, `filename`, `mime`, `size`, `title`, `description`, `link`, `embed`, `status`, `type`, `sort`, `created`, `updated`) VALUES
(1, 1, 'Project', '/shared/uploads/2015/09/08/', 'YWiyfaIy_zt_iXuD.png', 'image/png', 3054, '', '', '', '', NULL, NULL, 1, '2015-09-08 15:06:49', '2015-09-08 15:06:49'),
(2, 18, 'Tree', '/shared/uploads/2015/12/03/', '0xS88fGGVhqK8rjL.jpeg', 'image/jpeg', 24228, 'UPSTATE CAROLINA ANGEL NETWORK', 'The Upstate Carolina Angel Network is a Greenville-based group of over 50 investors. Since its launch in 2008, it has invested over $13 million in 39 portfolio companies, and in 2014 was named the 8th best angel group in the United States.', '', '', NULL, NULL, 2, '2015-12-03 12:35:52', '2015-12-03 12:39:43'),
(3, 20, 'Tree', '/shared/uploads/2015/12/03/', 'mqH4QevmqIAM9KoM.png', 'image/png', 13851, 'baebies', '', 'http://baebies.com/', '', NULL, NULL, 3, '2015-12-03 12:44:32', '2015-12-03 12:45:13'),
(4, 21, 'Tree', '/shared/uploads/2015/12/03/', '7Pkbzcj5hY7DrY1a.png', 'image/png', 8858, 'verdeeco', '', 'sensus.com/web/usca', '', NULL, NULL, 4, '2015-12-03 13:17:42', '2015-12-03 13:19:08'),
(5, 24, 'Tree', '/shared/uploads/2015/12/03/', '9xpwfg_nH03WXZN_.jpeg', 'image/jpeg', 289509, '', '', '', '', NULL, NULL, 5, '2015-12-03 13:31:18', '2015-12-03 13:31:18'),
(6, 25, 'Tree', '/shared/uploads/2015/12/03/', 'XNARabu5MLSZH87h.jpeg', 'image/jpeg', 161099, '', '', '', '', NULL, NULL, 6, '2015-12-03 13:33:19', '2015-12-03 13:33:19'),
(7, 26, 'Tree', '/shared/uploads/2015/12/03/', 'Sj_rhXsFkU-5JtCF.jpeg', 'image/jpeg', 136198, '', '', '', '', NULL, NULL, 7, '2015-12-03 13:34:45', '2015-12-03 13:34:45'),
(8, 28, 'Tree', '/shared/uploads/2015/12/03/', 'cc6DTk6iFpT2wRG9.png', 'image/png', 29640, 'venture asheville', '', 'http://ventureasheville.com/', '', NULL, NULL, 8, '2015-12-03 13:53:21', '2015-12-03 13:53:53'),
(9, 30, 'Tree', '/shared/uploads/2015/12/03/', '0cv8IwDWj2gKwLkw.jpeg', 'image/jpeg', 19555, 'ACA', '', 'http://www.angelcapitalassociation.org/', '', NULL, NULL, 9, '2015-12-03 13:59:27', '2015-12-03 13:59:49'),
(10, 32, 'Tree', '/shared/uploads/2015/12/03/', 'IztVCrG3QeNHQXRJ.jpeg', 'image/jpeg', 70592, '', '', '', '', NULL, NULL, 10, '2015-12-03 14:09:21', '2015-12-03 14:09:21'),
(11, 32, 'Tree', '/shared/uploads/2015/12/03/', 'QIOSmavPvJgj-BFT.png', 'image/png', 19766, '', '', 'https://www.wyche.com/', '', NULL, NULL, 11, '2015-12-03 14:37:17', '2015-12-03 14:37:37'),
(12, 32, 'Tree', '/shared/uploads/2015/12/03/', '0K4BLBDifrVQ5llq.jpeg', 'image/jpeg', 40563, '', '', 'https://www.palmettobank.com/', '', NULL, NULL, 12, '2015-12-03 14:38:19', '2015-12-03 14:38:46'),
(13, 33, 'Tree', '/shared/uploads/2015/12/03/', 'LJH8W4Di0__hDH4g.png', 'image/png', 59550, '', '', '', '', NULL, NULL, 13, '2015-12-03 14:40:57', '2015-12-03 14:40:57'),
(14, 33, 'Tree', '/shared/uploads/2015/12/03/', 'XiEDFrnUDMU2BLf5.png', 'image/png', 5929, '', '', 'http://chernoffnewman.com/', '', NULL, NULL, 14, '2015-12-03 14:41:36', '2015-12-03 14:42:39'),
(15, 33, 'Tree', '/shared/uploads/2015/12/03/', 'RSGxVG_s1KGcuC5p.png', 'image/png', 9445, '', '', 'http://www.colite.com/', '', NULL, NULL, 15, '2015-12-03 14:43:37', '2015-12-03 14:43:52'),
(16, 34, 'Group', '/shared/uploads/2015/12/03/', 'pHc9PXCbIkYI_eyW.png', 'image/png', 19252, '', '', 'http://www.spartanburgchamber.com/', '', NULL, NULL, 16, '2015-12-03 15:53:55', '2015-12-03 15:54:26'),
(17, 34, 'Group', '/shared/uploads/2015/12/03/', '_TLw_zDNZDOCEI-g.jpeg', 'image/jpeg', 23621, '', '', 'http://www.rjrockers.com/', '', NULL, NULL, 17, '2015-12-03 15:55:02', '2015-12-03 15:55:25'),
(18, 35, 'Group', '/shared/uploads/2015/12/03/', '88LZ4yrom4DAG6q-.jpeg', 'image/jpeg', 618249, '', '', '', '', NULL, NULL, 18, '2015-12-03 15:58:41', '2015-12-03 15:58:41'),
(27, 18, 'AboutUs', '/shared/uploads/2015/12/08/', 'arXOpE4JEQmPIe34.png', 'image/png', 40212, '', 'The Upstate Carolina Angel Network is a Greenville-based group of over 50 investors. Since its launch in 2008, it has invested over $13 million in 39 portfolio companies, and in 2014 was named the 8th best angel group in the United States.', '', '', NULL, NULL, 32, '2015-12-08 15:35:14', '2015-12-08 16:17:52'),
(28, 18, 'AboutUs', '/shared/uploads/2015/12/08/', 'gEVuFW-ioVSzBOCl.png', 'image/png', 30992, '', 'Capital Angels was formed in 2014 to serve the angels in the Midlands of South Carolina. A membership based group of nearly 40 of the area''s most successful business leaders and entrepreneurs, Capital Angels began making its first investments in the summer of 2014.', '', '', NULL, NULL, 33, '2015-12-08 15:35:26', '2015-12-08 16:31:27'),
(29, 18, 'AboutUs', '/shared/uploads/2015/12/08/', 'vzh7FQmyCqf3jvWR.png', 'image/png', 42092, '', 'Formed in 2014, and making its first investments the same year, Asheville Angels is a joint venture between SCAN and Venture Asheville (the entrepreneurship initiative of the Economic Development Coalition for Asheville-Buncombe County and the Asheville Area Chamber of Commerce). At over 50 members, it already a force in angel investing in the southeast.', '', '', NULL, NULL, 34, '2015-12-08 15:35:35', '2015-12-08 16:32:12'),
(30, 18, 'AboutUs', '/shared/uploads/2015/12/08/', 'SI-sOZxsqnAI93nj.png', 'image/png', 18744, '', 'Launched in January 2015, Spartanburg Angels brings SCAN''s proven angel network model to Spartanburg in a collaboration with the Spartanburg Area Chamber of Commerce. 30 members and counting!', '', '', NULL, NULL, 35, '2015-12-08 15:58:02', '2015-12-08 16:33:06'),
(31, 18, 'AboutUs', '/shared/uploads/2015/12/08/', 'v9vhD823B5c30oJq.png', 'image/png', 38441, '', 'Lowcountry Angels met for the first time in April 2015 as a partnership between SCAN and Josh Silverman. A long-time resident of Charleston, Josh is active in the small business and entrepreneur world, and asked SCAN to help him bring more angels into the investor world. We are delighted to help.', '', '', NULL, NULL, 36, '2015-12-08 15:58:11', '2015-12-08 16:33:55'),
(32, 18, 'AboutUs', '/shared/uploads/2015/12/08/', 'qlX6mNf9SffvQP3Q.png', 'image/png', 16599, '', 'Electric City Angels launched in Anderson in the spring of 2015 and made its first investment in the summer. It is a great example of how a smaller community can bring local entrepreneurial spirit and investors into a statewide infrastructure for angel investing.', '', '', NULL, NULL, 37, '2015-12-08 15:58:21', '2015-12-08 16:34:35'),
(33, 18, 'AboutUs', '/shared/uploads/2015/12/08/', 'NuTC3nLkDS-quteE.png', 'image/png', 29149, '', 'Central Savannah River Angels (CSRA) is launching in the fall of 2015 as a partnership between SCAN and a team of local supporters in Aiken and Augusta.', '', '', NULL, NULL, 38, '2015-12-08 15:58:30', '2015-12-08 16:35:08'),
(34, 24, 'AboutUs', '/shared/uploads/2015/12/15/', 'vRafYu_qJ0SEraes.jpeg', 'image/jpeg', 289509, '', '', '', '', NULL, NULL, 39, '2015-12-15 14:49:32', '2015-12-15 14:49:32'),
(35, 25, 'AboutUs', '/shared/uploads/2015/12/15/', 'RZasIOrKjBJuLILc.jpeg', 'image/jpeg', 161099, '', '', '', '', NULL, NULL, 40, '2015-12-15 14:51:34', '2015-12-15 14:51:34'),
(36, 26, 'AboutUs', '/shared/uploads/2015/12/15/', 'wlPNfvQKBpwasG62.jpeg', 'image/jpeg', 136198, '', '', '', '', NULL, NULL, 41, '2015-12-15 14:51:53', '2015-12-15 14:51:53'),
(37, 27, 'AboutUs', '/shared/uploads/2015/12/15/', 'zwGYAzyV1wP3owwn.jpeg', 'image/jpeg', 101239, '', '', '', '', NULL, NULL, 42, '2015-12-15 14:53:07', '2015-12-15 14:53:07'),
(104, 46, 'AboutUs', '/shared/uploads/2015/12/16/', 'lpMf-ZT-6I82uu93.png', 'image/png', 19766, '', '', '', '', NULL, NULL, 103, '2015-12-16 09:24:21', '2015-12-16 09:24:21'),
(105, 46, 'AboutUs', '/shared/uploads/2015/12/16/', 'rCl5o3o449Tyru0A.png', 'image/png', 19766, '', '', '', '', NULL, NULL, 104, '2015-12-16 09:24:22', '2015-12-16 09:24:22'),
(106, 46, 'AboutUs', '/shared/uploads/2015/12/16/', 'R_M1gVN8HIb-9mg-.png', 'image/png', 19766, '', '', '', '', NULL, NULL, 105, '2015-12-16 09:24:22', '2015-12-16 09:24:22'),
(107, 46, 'AboutUs', '/shared/uploads/2015/12/16/', 'HPNvx-lnoUVDdfdX.png', 'image/png', 19766, '', '', '', '', NULL, NULL, 106, '2015-12-16 09:24:23', '2015-12-16 09:24:23'),
(108, 47, 'AboutUs', '/shared/uploads/2015/12/16/', 'Y5-2vdRwubjH0uol.png', 'image/png', 84360, '', '', '', '', NULL, NULL, 107, '2015-12-16 09:25:20', '2015-12-16 09:25:20'),
(109, 47, 'AboutUs', '/shared/uploads/2015/12/16/', 'dWNu9iuNww95dThX.png', 'image/png', 84360, '', '', '', '', NULL, NULL, 108, '2015-12-16 09:25:39', '2015-12-16 09:25:39'),
(110, 47, 'AboutUs', '/shared/uploads/2015/12/16/', 'YXOu8R8t8qDm8cGx.png', 'image/png', 84360, '', '', '', '', NULL, NULL, 109, '2015-12-16 09:25:39', '2015-12-16 09:25:39'),
(111, 47, 'AboutUs', '/shared/uploads/2015/12/16/', 'i7U31WwcioKVvSaD.png', 'image/png', 84360, '', '', '', '', NULL, NULL, 110, '2015-12-16 09:25:40', '2015-12-16 09:25:40'),
(112, 45, 'AboutUs', '/shared/uploads/2015/12/16/', 'g3mKsTvxxndaq_j9.png', 'image/png', 19766, '', '', '', '', NULL, NULL, 111, '2015-12-16 09:27:18', '2015-12-16 09:27:18'),
(113, 44, 'AboutUs', '/shared/uploads/2015/12/16/', 'jo2henj1c9-Nv4oM.png', 'image/png', 19766, '', '', '', '', NULL, NULL, 112, '2015-12-16 09:27:44', '2015-12-16 09:27:44'),
(114, 28, 'AboutUs', '/shared/uploads/2015/12/16/', 'kpgxItop5NrMudKA.png', 'image/png', 29640, '', '', '', '', NULL, NULL, 113, '2015-12-16 09:29:14', '2015-12-16 09:29:14'),
(115, 28, 'AboutUs', '/shared/uploads/2015/12/16/', 'i_S45U6xXp-QFPrv.png', 'image/png', 29640, '', '', '', '', NULL, NULL, 114, '2015-12-16 09:29:55', '2015-12-16 09:29:55'),
(116, 28, 'AboutUs', '/shared/uploads/2015/12/16/', 'FvrPl6-iH0xKiCER.png', 'image/png', 29640, '', '', '', '', NULL, NULL, 115, '2015-12-16 09:29:56', '2015-12-16 09:29:56'),
(117, 28, 'AboutUs', '/shared/uploads/2015/12/16/', 'c1AyH6RPsfvSTCRs.png', 'image/png', 29640, '', '', '', '', NULL, NULL, 116, '2015-12-16 09:29:56', '2015-12-16 09:29:56'),
(122, 20, 'AboutUs', '/shared/uploads/2015/12/16/', 'ZiOV5aeommp_bAOF.png', 'image/png', 17689, '', '', '', '', NULL, NULL, 117, '2015-12-16 09:41:24', '2015-12-16 09:41:24'),
(123, 20, 'AboutUs', '/shared/uploads/2015/12/16/', 'Qaz30XAmCdVJiifA.png', 'image/png', 10112, '', '', '', '', NULL, NULL, 118, '2015-12-16 09:41:25', '2015-12-16 09:41:25'),
(124, 20, 'AboutUs', '/shared/uploads/2015/12/16/', 'DEQrRI_qHR_QZkWE.png', 'image/png', 11835, '', '', '', '', NULL, NULL, 119, '2015-12-16 09:41:26', '2015-12-16 09:41:26'),
(125, 20, 'AboutUs', '/shared/uploads/2015/12/16/', 'qvPYeG43r82W1Hk0.png', 'image/png', 11681, '', '', '', '', NULL, NULL, 120, '2015-12-16 09:41:26', '2015-12-16 09:41:26'),
(126, 20, 'AboutUs', '/shared/uploads/2015/12/16/', 'Gd3-tND1q52-jC4c.png', 'image/png', 4231, '', '', '', '', NULL, NULL, 121, '2015-12-16 09:41:27', '2015-12-16 09:41:27'),
(127, 21, 'AboutUs', '/shared/uploads/2015/12/16/', 'F62ZHnuXVOP3x8SX.png', 'image/png', 11681, '', '', '', '', NULL, NULL, 122, '2015-12-16 09:43:17', '2015-12-16 09:43:17'),
(128, 21, 'AboutUs', '/shared/uploads/2015/12/16/', 'aGYnE_P29e_5PwYB.png', 'image/png', 17689, '', '', '', '', NULL, NULL, 123, '2015-12-16 09:43:17', '2015-12-16 09:43:17'),
(129, 21, 'AboutUs', '/shared/uploads/2015/12/16/', 'EdYIx1Do4BUlFVoW.png', 'image/png', 10112, '', '', '', '', NULL, NULL, 124, '2015-12-16 09:43:18', '2015-12-16 09:43:18'),
(130, 21, 'AboutUs', '/shared/uploads/2015/12/16/', 'yFMklczYogi0SynH.png', 'image/png', 4231, '', '', '', '', NULL, NULL, 125, '2015-12-16 09:43:18', '2015-12-16 09:43:18'),
(131, 21, 'AboutUs', '/shared/uploads/2015/12/16/', 'zf4OuYL88v4YLcw6.png', 'image/png', 11835, '', '', '', '', NULL, NULL, 126, '2015-12-16 09:43:19', '2015-12-16 09:43:19'),
(156, 2, 'Page', '/shared/uploads/2015/12/29/', 'ifLV1dYvquD-VaW0.jpeg', 'image/jpeg', 178185, '', 'These groups consist of more than 200 individual angel investors that meet frequently to analyze the best early stage companies from around our region.', 'http://main.digitreeinc.com/angel-groups/upstate-carolina-angel-network', '', NULL, NULL, 128, '2015-12-29 18:01:14', '2016-01-24 11:50:26'),
(157, 2, 'Page', '/shared/uploads/2015/12/29/', '7pkSjd2kPxgR5qJl.jpeg', 'image/jpeg', 284144, '', 'The South Carolina Angel Network is an affiliation of the leading angel groups in South Carolina and Western North Carolina.', 'http://main.digitreeinc.com/contact-us', '', NULL, NULL, 132, '2015-12-29 18:01:15', '2016-01-24 11:51:47'),
(158, 2, 'Page', '/shared/uploads/2015/12/29/', 'QNCHXsiVAWMqTPh6.jpeg', 'image/jpeg', 293587, '', 'The South Carolina Angel Network is an affiliation of the leading angel groups in South Carolina and Western North Carolina. ', 'http://main.digitreeinc.com/site/about-us?slug=about-main', '', NULL, NULL, 127, '2015-12-29 18:01:18', '2016-01-24 11:49:38'),
(159, 2, 'Page', '/shared/uploads/2015/12/29/', 'h23tiQgCqeAvg22-.jpeg', 'image/jpeg', 247428, '', 'The South Carolina Angel Network is an affiliation of the leading angel groups in South Carolina and Western North Carolina.', 'http://main.digitreeinc.com/investors/angel-investors', '', NULL, NULL, 129, '2015-12-29 18:01:18', '2016-01-24 11:50:52'),
(160, 2, 'Page', '/shared/uploads/2015/12/29/', 'wsnhGhBBH17i55ra.jpeg', 'image/jpeg', 358430, '', 'The South Carolina Angel Network is an affiliation of the leading angel groups in South Carolina and Western North Carolina.', 'http://main.digitreeinc.com/news', '', NULL, NULL, 131, '2015-12-29 18:01:19', '2016-01-24 11:51:28'),
(161, 2, 'Page', '/shared/uploads/2015/12/29/', 'q1nsioE5qYbOTQOf.jpeg', 'image/jpeg', 409671, '', 'These groups consist of more than 200 individual angel investors that meet frequently to analyze the best early stage companies from around our region.', 'http://main.digitreeinc.com/entrepreneurs/pitching-process', '', NULL, NULL, 130, '2015-12-29 18:01:59', '2016-01-24 11:51:14'),
(167, 32, 'Group', '/shared/uploads/2016/01/19/', 'wC6nQOqvPNqoX3Sz.jpeg', 'image/jpeg', 64747, '', '', '', '', NULL, NULL, 135, '2016-01-19 15:01:09', '2016-01-19 15:01:09'),
(168, 33, 'Group', '/shared/uploads/2016/01/19/', 'yQGxt5CXaDkYe16H.jpeg', 'image/jpeg', 64747, '', '', '', '', NULL, NULL, 136, '2016-01-19 15:02:06', '2016-01-19 15:02:06'),
(169, 18, 'AboutUs', '/shared/uploads/2016/01/19/', 'ZkAuqnLbwS9Sbmzs.png', 'image/png', 17413, '', '', '', '', NULL, NULL, 31, '2016-01-19 15:46:29', '2016-01-19 15:46:29'),
(170, 18, 'AboutUs', '/shared/uploads/2016/02/04/', 'QywRS5B6x9slioFl.jpeg', 'image/jpeg', 10997, 'Cairo Angels', 'The Cairo Angels [hyperlink] is Egypt’s first formal network of angel investors. Since its inception in early 2012, the Cairo Angels membership has grown to over 50 angel investors and has invested over $2 million in 14 portfolio companies, making it one of the largest and most active angel investment groups in the Middle East and Africa. Read more about the Cairo Angels in the ‘Angel Groups’ section. ', '', '', NULL, NULL, 137, '2016-02-04 11:00:48', '2016-02-04 11:02:21'),
(171, 18, 'AboutUs', '/shared/uploads/2016/02/04/', 'UGQTc1_0Gz4njgHQ.png', 'image/png', 5882, 'Oqal', 'Oqal, founded in Saudi Arabia in 2009, is a group of young entrepreneurs connecting angel investors with fresh and innovative entrepreneurs. Since its founding, Oqal has supported many rising start-ups. Read more about Oqal in the ‘Angel Groups’ section.', '', '', NULL, NULL, 138, '2016-02-04 11:06:22', '2016-02-04 11:07:09'),
(172, 18, 'AboutUs', '/shared/uploads/2016/02/04/', 'K4QppkPbXvNOpBs6.jpeg', 'image/jpeg', 18998, 'Tenmou', 'Tenmou is Bahrain´s first Business Angels Company, which provides mentorship and capital to high potential, innovative Bahraini entrepreneurs from the seed stage. Through the support and mentorship provided by our Angel shareholders, all of whom are established businessmen and successful entrepreneurs in their own right, we look to give these new entrepreneurs the greatest chance of success. Read more about Tenmou in ‘Angel Groups’ section.', '', '', NULL, NULL, 139, '2016-02-04 11:08:33', '2016-02-04 11:09:48'),
(173, 18, 'AboutUs', '/shared/uploads/2016/02/04/', '9HsBLcT89SsaTCVF.png', 'image/png', 27280, 'WOMENA', 'WOMENA provides Gulf-based high-net-worth women a supportive, professional network and dependable guidance to invest in new companies together where we facilitate the investment process from sourcing to close. Read more about WOMENA in ‘Angel Groups’ section.', '', '', NULL, NULL, 140, '2016-02-04 11:12:09', '2016-02-04 11:12:55'),
(174, 56, 'AboutUs', '/shared/uploads/2016/02/04/', 'CMGSTBey9dHIaMrx.jpeg', 'image/jpeg', 10997, 'Cairo Angels', 'The <a href="www.cairoangels.com" target="_blank">Cairo Angels</a> is Egypt’s first formal network of angel investors. Since its inception in early 2012, the Cairo Angels membership has grown to over 50 angel investors and has invested over $2 million in 14 portfolio companies, making it one of the largest and most active angel investment groups in the Middle East and Africa. Read more about the Cairo Angels in the ‘Angel Groups’ section.', '', '', NULL, NULL, 141, '2016-02-04 13:52:13', '2016-02-04 13:54:10'),
(175, 56, 'AboutUs', '/shared/uploads/2016/02/04/', 'V_4tWaPZD7u8X3_0.png', 'image/png', 5882, 'Oqal', 'Oqal, founded in Saudi Arabia in 2009, is a group of young entrepreneurs connecting angel investors with fresh and innovative entrepreneurs. Since its founding, Oqal has supported many rising start-ups. Read more about Oqal in the ‘Angel Groups’ section.', '', '', NULL, NULL, 142, '2016-02-04 13:52:20', '2016-02-04 13:54:40'),
(176, 56, 'AboutUs', '/shared/uploads/2016/02/04/', 'TW7CVm4kfp1XdiAU.jpeg', 'image/jpeg', 18998, 'Tenmou', 'Tenmou is Bahrain´s first Business Angels Company, which provides mentorship and capital to high potential, innovative Bahraini entrepreneurs from the seed stage. Through the support and mentorship provided by our Angel shareholders, all of whom are established businessmen and successful entrepreneurs in their own right, we look to give these new entrepreneurs the greatest chance of success. Read more about Tenmou in ‘Angel Groups’ section.', '', '', NULL, NULL, 143, '2016-02-04 13:52:27', '2016-02-04 13:55:17'),
(177, 56, 'AboutUs', '/shared/uploads/2016/02/04/', 'HZXMtDj41Ew6uN52.png', 'image/png', 27280, 'WOMENA', 'WOMENA provides Gulf-based high-net-worth women a supportive, professional network and dependable guidance to invest in new companies together where we facilitate the investment process from sourcing to close. Read more about WOMENA in ‘Angel Groups’ section.', '', '', NULL, NULL, 144, '2016-02-04 13:52:33', '2016-02-04 13:55:43'),
(178, 49, 'Group', '/shared/uploads/2016/02/04/', 'EWrbh01MzA82hdeg.jpeg', 'image/jpeg', 10997, '', '', '', '', NULL, NULL, 145, '2016-02-04 13:57:38', '2016-02-04 13:57:38'),
(179, 50, 'Group', '/shared/uploads/2016/02/04/', 'NwCYu0Z_irMNaBVl.png', 'image/png', 5882, '', '', '', '', NULL, NULL, 146, '2016-02-04 13:58:15', '2016-02-04 13:58:15'),
(180, 51, 'Group', '/shared/uploads/2016/02/04/', 'lGaFa5-xSIslSSNv.jpeg', 'image/jpeg', 18998, '', '', '', '', NULL, NULL, 147, '2016-02-04 13:58:32', '2016-02-04 13:58:32'),
(181, 52, 'Group', '/shared/uploads/2016/02/04/', 'hlX_NgKf2i-VnF0u.png', 'image/png', 27280, '', '', '', '', NULL, NULL, 148, '2016-02-04 13:58:45', '2016-02-04 13:58:45');

-- --------------------------------------------------------

--
-- Table structure for table `base_messages`
--

CREATE TABLE `base_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `sender_id` int(10) UNSIGNED DEFAULT NULL,
  `receiver_id` int(10) UNSIGNED DEFAULT NULL,
  `model_id` int(10) UNSIGNED DEFAULT NULL,
  `model` varchar(64) NOT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `base_settings`
--

CREATE TABLE `base_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(64) NOT NULL,
  `value` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `base_tree`
--

CREATE TABLE `base_tree` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Unique tree node identifier',
  `root` int(10) UNSIGNED DEFAULT NULL COMMENT 'Tree root identifier',
  `lft` int(11) NOT NULL COMMENT 'Nested set left property',
  `rgt` int(11) NOT NULL COMMENT 'Nested set right property',
  `lvl` smallint(6) NOT NULL COMMENT 'Nested set level / depth',
  `name` varchar(255) NOT NULL COMMENT 'The tree node name / label',
  `slug` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) DEFAULT NULL COMMENT 'The icon to use for the node',
  `icon_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Icon Type: 1 = CSS Class, 2 = Raw Markup',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is active (will be set to false on deletion)',
  `selected` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is selected/checked by default',
  `disabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is enabled',
  `readonly` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is read only (unlike disabled - will allow toolbar actions)',
  `visible` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is visible',
  `collapsed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is collapsed by default',
  `movable_u` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable one position up',
  `movable_d` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable one position down',
  `movable_l` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable to the left (from sibling to parent)',
  `movable_r` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable to the right (from sibling to child)',
  `removable` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is removable (any children below will be moved as siblings before deletion)',
  `removable_all` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is removable along with descendants',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_tree`
--

INSERT INTO `base_tree` (`id`, `root`, `lft`, `rgt`, `lvl`, `name`, `slug`, `link`, `description`, `icon`, `icon_type`, `active`, `selected`, `disabled`, `readonly`, `visible`, `collapsed`, `movable_u`, `movable_d`, `movable_l`, `movable_r`, `removable`, `removable_all`, `created`, `updated`) VALUES
(1, 1, 1, 2, 0, 'Menu', 'menu', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-09-08 13:13:17', '2015-09-08 13:13:17'),
(2, 2, 1, 2, 0, 'Cities', 'cities', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-09-08 13:13:43', '2015-09-08 13:13:43'),
(14, 14, 1, 32, 0, 'About Us', 'about-us', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 12:16:15', '2015-12-03 14:03:24'),
(15, 15, 1, 4, 0, 'Entrepreneurs', 'entrepreneurs', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 12:25:56', '2015-12-09 11:50:57'),
(16, 16, 1, 10, 0, 'Groups', 'groups', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, '2015-12-03 12:27:20', '2015-12-03 14:04:22'),
(18, 14, 2, 3, 1, 'About Main', 'about-main', '', '<p>The Middle East Angel Investment Network (MAIN) is an alliance of the leading angel investment networks across the MENA region. Together, these groups have a combined membership base of over 100 individual angel investors who regularly invest financial and intellectual capital in some of the most promising early stage companies in the region. MAIN aims to promote angel investing across the region, to facilitate the syndication and flow of deals between its members and to provide a platform for training and exchange of best practice.</p>\r\n', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 12:32:49', '2016-02-04 10:35:36'),
(19, 14, 6, 11, 1, 'Our Portfolio', 'our-portfolio', '', '<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>investment power</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>SCAN groups and funds have invested nearly $15 million in 40 companies</p>\r\n										<ul>\r\n											<li><span class="app101-content-label">geography: </span>Companies based in the Southeastern US, particularly in South Carolina and Western North Carolina</li>\r\n											<li><span class="app101-content-label">consistent support: </span>We have supported our portfolio companies with advisors, Board members, follow-on capital and introductions to strategic resources</li>\r\n											<li><span class="app101-content-label">syndication partners: </span>Co-invested with over 20 VC funds, angels groups, and others</li>\r\n											<li><span class="app101-content-label">foundation: </span>Portfolio has raised over $200 million in total funding</li>\r\n										</ul>\r\n									</div>\r\n								</div>', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 12:41:37', '2015-12-15 15:21:27'),
(20, 14, 7, 8, 2, 'Active Portfolio', 'active-portfolio', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, '2015-12-03 12:42:32', '2015-12-03 12:43:47'),
(21, 14, 9, 10, 2, 'Realized Portfolio', 'realized-portfolio', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 12:43:24', '2015-12-03 12:43:24'),
(22, 15, 2, 3, 1, 'Pitching Process', 'pitching-process', '', '<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>angel groups</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Angel groups investment in early stage companies and high growth business. Typically, these investments are made in the form of equity or convertible notes. MAIN groups aim to invest between $250,000 and $1,000,000 in companies looking for capital to scale an existing product or service.</p>\r\n										<p>See below for some guidelines on what our angel investors are looking for and insights that we hope will make the process of pitching to investors more transparent and improve your chances of successfully raising capital through our platform.</p>\r\n										<p>If you think you fit the parameters below, please <a href="main.digitreeinc.com/contact-us" target="_blank">contact us</a>.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-hr theme01"></div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>investment criteria</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>The Investee must be a startup company established in a tax optimal jurisdiction that has investor friendly laws and regulations.</li>\r\n											<li>The Investee must be seeking investment between USD 150,000 to USD 1,000,0000.</li>\r\n											<li>The investee must be seeking investment in the form of either equity or convertible notes.</li>\r\n											<li>The investee must be willing to enter into legal documentation with the Angel Investors associated with MAIN that provides customary investor protection expected for angel investors.</li>\r\n											<li>The Investee must be willing to provide the Angel Investors associated with MAIN with suffecient information rights and best endeavors shall be exerted to obtain board representation by the MAIN Angel Investors in the Investee.</li>\r\n										</ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-hr theme01"></div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-subTitle">\r\n										<span>proccess</span>\r\n									</div>\r\n									<div class="app101-area-title">\r\n										<span>direct route or via our members</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>You can either apply to us directly <a href="main.digitreeinc.com/contact-us" target="_blank">here</a> or apply to one of our Angel Groups <a href="main.digitreeinc.com/angel-groups/cairo-angels" target="_blank">here</a>.</p>\r\n									</div>\r\n									<div class="app101-area-title">\r\n										<span>initial conversation</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>If you haven’t bumped into us for a personal introduction, we suggest you send us an introductory email, with a three-sentence business overview and attach a 1-2 page executive summary.</li>\r\n											<li>If you meet our investment criteria, we will schedule a call to learn more about you and your business.</li>\r\n											<li>A Piece of Advice: don''t send a life story, long essay, or 25+ page business plan. </li>\r\n										</ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>pitch events</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>If you make it to the next stage, we''ll invite you to one of our pitch events, which are held periodically to allow our Angel Groups and their members to hear your formal pitch.</li>\r\n											<li>These sessions are recorded and made available to angels across our network.</li>\r\n											<li>Typically 10 minutes of pitch time and 5 minutes of Q&A. Be prepared for tough questions.</li>\r\n											<li>A Piece of Advice: Pitching to angel groups is highly competitive. You will need to stand out, by being well prepared, professional and organized.</li>\r\n										</ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>due diligence</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>If you pass the pitch event into due diligence, a group of angels and the MAIN team will take a deep dive into your business. We''ll review your documents and meet with the management team to ask our questions.</li>\r\n											<li>A Piece of Advice:  the more prepared and organized you are, the more efficient this will be.</li>\r\n											<li>At the end of the diligence process, the diligence team presents its report back to the group.</li>\r\n											<li>Hopefully everyone is impressed and we can collect investment checks and fund shortly afterwards - and you can get back to creating a great business.</li>\r\n										</ul>\r\n									</div>\r\n								</div>', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 13:26:53', '2016-02-04 14:24:41'),
(24, 14, 12, 19, 1, 'Our Team', 'our-team', '', '<p>Our team combines complementary skills and experience: angel network creation, management, and investing; board experience; entrepreneurship; venture capital and private equity; fund management, M&amp;A advisory; and management consulting expertise.</p>', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 13:30:42', '2015-12-15 14:48:50'),
(25, 14, 13, 14, 2, 'Matt Dunbar', 'matt-dunbar', '', '<div class="app101-member-position">\r\n												<span>managing ditector</span>\r\n											</div>\r\n											<p>As the founding Managing Director of UCAN, Matt developed the operations that became the template for SCAN angel groups, and under his leadership, UCAN has been named a Top 10 Angel Group in the US.</p>\r\n											<p>Matt has previous management consulting experience with the Boston Consulting Group, where he led project teams, and in technology development with Eastman Chemical, where he supported manufacturing operations and business development.</p>\r\n											<p>Stanford MBA and Masters in Education; Clemson BS Chemical Engineering.  Learn more about Matt via LinkedIn.</p>', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 13:32:45', '2015-12-15 14:51:05'),
(26, 14, 15, 16, 2, 'Charlie Banks', 'charlie-banks', '', '<div class="app101-member-position">\r\n												<span>managing ditector</span>\r\n											</div>\r\n											<p>Charlie is an experienced serial entrepreneur who has founded, run, and invested in multiple manufacturing, financial services, building science, and real estate companies in South Carolina.</p>\r\n											<p>Prior to co-founding the South Carolina Angel Network, he served as a Portfolio Manager at a start-up financial institution based in Greenville where he was also responsible for developing and implementing many of its entrepreneur engagement strategies.</p>\r\n											<p>Newberry College BS in Business Administration.  Learn more about Charlie via LinkedIn or follow him on Twitter</p>\r\n										', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 13:34:20', '2015-12-15 14:59:14'),
(27, 14, 17, 18, 2, 'Paul Clark', 'paul-clark', '', '<div class="app101-member-position">\r\n												<span>managing ditector</span>\r\n											</div>\r\n											<p>Before helping to establish the groups in Spartanburg, Anderson, and Asheville, Paul was Senior Vice President of M&amp;A at CertusBank in Greenville. He was part of a team responsible for investments in financial services companies and vehicles, including an SBIC fund, and developing junior lending capabilities.</p>\r\n											<p>Paul has previous private equity investment and fund experience as a Principal at BC Partners in New York and London, and earlier M&amp;A advisory experience at NM Rothschild &amp; Sons in London.</p>\r\n											<p>Fordham MA Medieval History; Durham (UK) BA History.  Learn more about Paul via LinkedIn or follow him on Twitter.</p>\r\n									', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 13:35:49', '2015-12-15 14:56:58'),
(28, 14, 20, 21, 1, 'Our Partners', 'our-partners', '', '<p>SCAN works alongside trusted sponsors and partners in many of its communities across the Carolinas. These organizations work with angel investors, entrepreneurs, and emerging companies to help grow and strengthen our ecosystem and our economy. We encourage you to check out their services and many other important contributions to our communities. </p>\r\n										<p>None of the groups would be possible without the support of our corporate partners. These companies provide assistance to angels, portfolio companies, and entrepreneurs for no compensation - but simply to help grow our state''s companies and strengthen its economy.</p>\r\n										', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-03 13:52:33', '2015-12-15 15:15:55'),
(39, 39, 1, 6, 0, 'Investors', 'investors', '', '<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>angel investors</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Angel investors come from all walks of life with many varied backgrounds and interests.  While they all must be accredited (per the SEC''s definition), the more important things they have in common are an interest in making good investments and helping startup companies succeed.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>our investors</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>SCAN groups consist of over 200 angel investors, from Asheville to Charleston</li>\r\n											<li>Our members include over 100 company founders and C-level executives</li>\r\n											<li>Our members have expertise in every functional area of business, from operations to technology to finance, and across many industries from aerospace to education</li>\r\n											<li>Member information always remains confidential</li>\r\n										</ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>investors obligations</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>As a member of an angel group,  investors can be as actively involved in any aspect of the group as they wish.</p>\r\n										<ul>\r\n											<li>No obligation to invest in any company at any time (but we hope all will participate)</li>\r\n											<li>No obligation to serve on any diligence team (but volunteers enjoy the intellectual challenge)</li>\r\n											<li>No obligation to work directly with any of the portfolio companies (but members who serve on boards and as advisors enjoy it and add great value)</li>\r\n										</ul>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>where do we get our investment capital from?</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>Private Individuals 100%</li>\r\n											<li>Public Entities 0%</li>\r\n										</ul>\r\n									</div>\r\n								</div>', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-09 10:30:37', '2015-12-09 11:24:36'),
(43, 14, 22, 31, 1, 'Our Sponsers', 'our-sponsers', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-15 14:44:54', '2015-12-15 14:44:54'),
(44, 14, 23, 24, 2, 'Platinum Sponsors', 'platinum-sponsors', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-15 14:54:33', '2015-12-15 14:54:33'),
(45, 14, 25, 26, 2, 'Gold Sponsors', 'gold-sponsors', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-15 15:01:18', '2015-12-15 15:01:18'),
(46, 14, 27, 28, 2, 'Silver Sponsors', 'silver-sponsors', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-15 15:02:26', '2015-12-15 15:02:26'),
(47, 14, 29, 30, 2, 'In-Kind Supporters', 'in-kind-supporters', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-12-15 15:07:06', '2015-12-15 15:07:06'),
(49, 16, 2, 3, 1, 'CAIRO ANGELS', 'cairo-angels', '', '<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span>about us</span>\n									</div>\n									<div class="app101-area-content">\n										<p> The <a href="http://www.cairoangels.com" target="_blank">Cairo Angels</a>  is Egypt''s first formal network of angel investors and is located in Cairo, Egypt with a standalone chapter in London, UK. The Cairo Angels invests in and supports start-ups and early stage, high growth businesses across the Middle East and Africa. </p>\n									</div>\n								</div>\n								<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span>history</span>\n									</div>\n									<div class="app101-area-content">\n										<p> Identifying the need for early-stage investments in the blossoming entrepreneurship scene in Egypt, a group of likeminded investors, professionals, entrepreneurs and business leaders formed the regions first angel network in early 2012. The network has since grown to more than 50 members with a standalone chapter in London, UK. Since its inception in early 2012, the Cairo Angels has invested more $2 million in 14 start-ups with binding offers being made on a quarterly basis.</p>\n									</div>\n								</div>\n								<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span>investment focus</span>\n									</div>\n									<div class="app101-area-content">\n										<p> The Cairo Angel’s focus is on early-stage, high growth potential and highly scalable companies across all sectors that have a developed product and are post-revenue or near monetization. Each of the Cairo Angels’ members makes his or her individual investment decision — but the network collaborates in due diligence. Collectively, the Cairo Angels’ members make equity investments in the range of $100,000 to $200,000 per investment and can syndicate larger investments with its partner organizations, such as MAIN.</p>\n									</div>\n								</div>\n								<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span> meetings</span>\n									</div>\n									<div class="app101-area-content">\n										<p>Cairo Angels convenes once a quarter to review pre-selected potential investees that meet the Cairo Angels investment criteria.  Meetings are open to members and invited guests only. Afterwards, interested angels are invited to collectively engage directly with the entrepreneurs to carry out due diligence, negotiate investment terms and finalize the legal documentation.  Angels invest their personal money, in return for a minority equity stake in the business.</p>\n									</div>\n								</div>\n								<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span> Become a member\n </span>\n									</div>\n									<div class="app101-area-content">\n										<p> If you are interested in becoming a member of the Cairo Angels, please contact us by following the instructions on <a href="http://www.cairoangels.com" target="_blank">our website</a>.\n </p>\n									</div>\n								</div>\n								<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span> entrepreneurs seeking investment\n </span>\n									</div>\n									<div class="app101-area-content">\n										<p> If you are an entrepreneur seeking investment from the Cairo Angels, please visit our <a href="http://www.cairoangels.com" target="_blank">our website</a> to review our investment criteria and for instructions on how to apply.</p>\n<p>Visit the Cairo Angels website on the following link: <a href="http://www.cairoangels.com" target="_blank">http://www.cairoangels.com</a>\n </p>\n									</div>\n								</div>\n', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2016-02-04 11:15:39', '2016-02-04 12:27:25'),
(50, 16, 4, 5, 1, 'OQAL', 'oqal', '', '<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span>about us</span>\n									</div>\n									<div class="app101-area-content">\n										<p> Oqal Group (combined from the two Arabic words "Oqool: meaning minds" and "AmwaL: meaning money"). It is a non-profit organization, the first angel investor network in Saudi Arabia with the main objective of growing the SME sector in the country. \nOQAL Connects entrepreneurs with local/regional investors who are willing to invest in startups, and provide aid to entrepreneurs through guidance from members with specific expertise in knowledge areas such as marketing, finance, accounting, etc.\n </p>\n									</div>\n								</div>\n								<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span>history</span>\n									</div>\n									<div class="app101-area-content">\n										<p> Oqal was established in 2011 by a group of likeminded investors, to lead the angel investment scene and support entrepreneurs in the kingdom. The group has 340 members across Saudi Arabia, we are organized in four regional chapters and our members have invested $6.4 million in 23 startups since its inception.</p>\n									</div>\n								</div>\n								<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span>investment focus</span>\n									</div>\n									<div class="app101-area-content">\n										<p> Oqal investors search for local early-stage highly scalable startups with high potential growth across all sectors. Oqal members make their own investment decisions either individually or in groups in the range of $80,000 to $1.3 million.</p>\n									</div>\n								</div>\n								<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span> meetings</span>\n									</div>\n									<div class="app101-area-content">\n										<p>Oqal members holds by-invitation-only pitching events every other month in each chapter, where maximum of 5 startups pitch to the members. All startups go through a selection process conducted by a selection committee that consists of around 10 investors. </p>\n									</div>\n								</div>\n								<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span> Become a member\n </span>\n									</div>\n									<div class="app101-area-content">\n										<p> If you are interested in becoming a member, please apply through our website oqal.org or contact us at info@oqal.org.\n </p>\n									</div>\n								</div>\n								<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span> entrepreneurs seeking investment\n </span>\n									</div>\n									<div class="app101-area-content">\n										<p> If you are an entrepreneur seeking investment, please visit our FAQ page <a href="http://oqal.org/ar/the-opportunities/faq" target="_blank">http://oqal.org/ar/the-opportunities/faq</a> or you can contact us at info@oqal.org for further enquiries. </p>\n									</div>\n								</div>\n', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2016-02-04 12:31:46', '2016-02-04 12:31:46'),
(51, 16, 6, 7, 1, 'TENMOU', 'tenmou', '', '<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span>about us</span>\n									</div>\n									<div class="app101-area-content">\n										<p> Tenmou is the first business angels group in Bahrain, and currently one of the first in the MENA region. Tenmou was set up by a group of motivated prominent Bahraini business men to invest in and mentor the next generation of high potential and innovative entrepreneurs. </p>\n									</div>\n								</div>\n								<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span>history</span>\n									</div>\n									<div class="app101-area-content">\n										<p> Launched in 2011, Tenmou aims to support entrepreneurs with valuable business assistance, including financial investment, mentorship, advice and guidance.  Tenmou recognizes that for many entrepreneurs, mentorship programmes can be as valuable as financial investments. Each project receives practical advice and training from the company’s board members, who bring with them a wealth of business experience.  These training sessions expose the entrepreneurs to real business situations and are conducted in the form of regular workshops. </p>\n									</div>\n								</div>\n								<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span>investment focus</span>\n									</div>\n									<div class="app101-area-content">\n										<p>A part of Tenmou’s strategic plans is to further build the startup ecosystem in Bahrain and position the Kingdom as the hub for angel investment in the MENA region. The investment focus is on idea stage start-ups in the Kingdom of Bahrain from any sector, once to twice a year. Tenmou invests an average of USD $ 53,000 – 80,000 for a stake of on average 20%- 30% in each project that meets its criteria, and will provide a three-month mentorship period, including support services, at no cost to the entrepreneurs. </p>\n									</div>\n								</div>\n								<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span>meetings</span>\n									</div>\n									<div class="app101-area-content">\n										<p>Tenmou will invest in the seed stage, providing both equity funding and mentorship to these entrepreneurs. This is a large gap that currently exists in the region – taking entrepreneurs ideas to reality. Through a structured selection process, the opportunity is available for all to take advantage of. \nTenmou then puts the selected entrepreneurs through a rigorous mentorship program, bringing the angel investors together with the entrepreneurs in order to support their development. This is something that has been in place for many years in the rest of the world, but it is Tenmou’s mission to bring angel investments into the limelight in the region.\n </p>\n									</div>\n								</div>\n								<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span> Become a member\n </span>\n									</div>\n									<div class="app101-area-content">\n										<p> If you are interested in becoming a member of Tenmou, please contact us at info@tenmou.me </p>\n									</div>\n								</div>\n								<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span> entrepreneurs seeking investment\n </span>\n									</div>\n									<div class="app101-area-content">\n										<p> If you are an entrepreneur seeking investment from Tenmou, please visit the <a href="http://tenmou.me/en/member/register/" target ="_blank">Registration Page</a> on our website to review our investment criteria and for instructions on how to apply.\nVisit Tenmou’s website on the following link <a href="http://tenmou.me" target="_blank">http://tenmou.me</a> </p>\n									</div>\n								</div>\n', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2016-02-04 12:36:06', '2016-02-04 12:56:49'),
(52, 16, 8, 9, 1, 'WOMENA', 'womena', '', '<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span>about us</span>\n									</div>\n									<div class="app101-area-content">\n										<p> <a href="http://womena.co/" target="_blank">WOMENA</a> is an angel investment platform for female investors based in Dubai. WOMENA invests in startups at the seed stage across the Middle East and supports the growth of regional startup ecosystem through its corporate and government partners. </p>\n									</div>\n								</div>\n								<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span>history</span>\n									</div>\n									<div class="app101-area-content">\n										<p> Women have been underrepresented in angel investing (and venture capital more generally) for many years around the world. WOMENA was launched in November 2014 by Chantalle Dumonceaux and Elissa Freiha, to build a platform to empower women in the Middle East, to invest and learn together. As of December 2015, WOMENA has grown with two investments and thirty members in the Middle East and the United States. </p>\n									</div>\n								</div>\n								<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span>investment focus</span>\n									</div>\n									<div class="app101-area-content">\n										<p> WOMENA’s investment focus is on early-stage Middle East-based startups with high growth potential. WOMENA is sector agnostic but tailors its deal flow to member interest. Companies should have a working product and significant traction, reflective of a demonstrated gap in the market. WOMENA co-invests with other angels and venture capital firms and looks at rounds totaling between $150,000 and $750,000. In exceptional circumstances, larger rounds of up to $1,500,000 will be considered. </p>\n									</div>\n								</div>\n								<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span> meetings</span>\n									</div>\n									<div class="app101-area-content">\n										<p>WOMENA holds pitch meetings every other month where four startups pitch to the assembled members, partners, and selected guests. Startups are pre-screened by the WOMENA team, members, and partners prior to each meeting. If there is enough member interest in a company, the WOMENA team will then facilitate the due diligence process, drawing on collective knowledge of members and broader networks. Each member makes her own investment decision. \n\nIn alternating months, WOMENA holds Series A(ngel) Workshops for individuals interested in becoming angel investors. Bringing together experts in the field, the half-day event immerses participants in angel investing with the goal to have them finish the day feeling comfortable to make their first angel investment. \n </p>\n									</div>\n								</div>\n								<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span> Become a member\n </span>\n									</div>\n									<div class="app101-area-content">\n										<p> If you are interested in becoming a member of WOMENA, please contact us at contact@womena.co or apply through our <a href="http://womena.co/application-form/" target="_blank">application form</a>. </p>\n									</div>\n								</div>\n								<div class="app101-area-box theme01">\n									<div class="app101-area-title">\n										<span> entrepreneurs seeking investment\n </span>\n									</div>\n									<div class="app101-area-content">\n										<p> If you are an entrepreneur seeking investment from WOMENA, please visit the <a href="http://womena.co/entrepreneurs/" target="_blank">entrepreneurs page</a> on our website to review our investment criteria and for instructions on how to apply. </p>\n									</div>\n								</div>\n', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2016-02-04 12:43:23', '2016-02-04 12:50:58'),
(54, 39, 4, 5, 1, 'Investor  Resources', 'investor-resources', '', '<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>Investor Resources:</span>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>Deal Flow and Diligence Platform</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>We encourage all of our members to become familiar with GUST, our online deal management platform.  Within the GUST platform you can create a profile to connect with our other members, review entrepreneur applications and review due diligence documents.</p>\r\n									</div>\r\n								</div>', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2016-02-04 13:22:16', '2016-02-04 13:22:16'),
(55, 39, 2, 3, 1, 'investors', 'angel-investors', '', '<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>investors</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<p>Angel investors are as diverse as the companies they invest in. Generally, angel investors are successful, well established mid-to-high net worth investors, entrepreneurs, professionals and business leaders who are willing to invest in high-risk high reward early stage startups and high growth potential businesses.</p>\r\n									</div>\r\n								</div>\r\n								<div class="app101-area-box theme01">\r\n									<div class="app101-area-title">\r\n										<span>our investors</span>\r\n									</div>\r\n									<div class="app101-area-content">\r\n										<ul>\r\n											<li>MAIN groups consist of over 100 angel investors from across the Middle East</li>\r\n											<li>Our members have expertise in every functional area of business, from operations to technology to finance, and across many industries from aerospace to education</li>\r\n											<li>Member information always remains confidential</li>\r\n											<li>Our investment capital is 100% from private individuals</li>\r\n										</ul>\r\n									</div>\r\n								</div>', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2016-02-04 13:24:43', '2016-02-04 13:25:22'),
(56, 14, 4, 5, 1, 'Our Angel Groups', 'our-angel-groups', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2016-02-04 13:51:41', '2016-02-04 13:51:56');

-- --------------------------------------------------------

--
-- Table structure for table `base_user`
--

CREATE TABLE `base_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` char(123) NOT NULL,
  `token` char(123) DEFAULT NULL,
  `token_type` tinyint(3) UNSIGNED DEFAULT NULL,
  `auth_key` char(123) DEFAULT NULL,
  `sso_key` char(123) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_user`
--

INSERT INTO `base_user` (`id`, `username`, `email`, `password`, `token`, `token_type`, `auth_key`, `sso_key`, `status`, `last_login`, `created`, `updated`) VALUES
(1, 'sharaf', 'a.sharaf@digitreeinc.com', '$2y$13$kikaRlsiqLeqqKNTLvnOMe/n7neQjrApbTKDAaDl7j7Loot1VMKlO', NULL, NULL, 'FhT8dCMQ-FhBOSeIZ4rUBsTidGm4q0vV', NULL, 2, '2016-02-04 13:43:04', '2015-09-08 12:58:24', '2015-09-08 12:58:24');

-- --------------------------------------------------------

--
-- Table structure for table `meta_tags`
--

CREATE TABLE `meta_tags` (
  `id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `model_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meta_tags`
--

INSERT INTO `meta_tags` (`id`, `model`, `model_id`, `title`, `keywords`, `description`, `created`, `updated`) VALUES
(1, 'Project', 1, 'First Project Test', 'First Project Test', 'First Project Test', '2015-09-08 15:06:12', '2015-09-08 15:39:55'),
(2, 'Career', 1, '', '', '', '2015-09-08 15:17:08', '2015-09-08 15:17:08'),
(3, 'Project', 2, '', '', '', '2015-09-08 15:28:53', '2015-09-08 15:28:53'),
(4, 'Page', 2, '', '', '', '2015-09-08 15:51:41', '2015-09-08 15:51:41'),
(6, 'Page', 4, '', '', '', '2015-09-08 15:52:38', '2015-12-09 16:11:51'),
(7, 'Blog', 5, '', '', '', '2015-12-03 15:43:54', '2015-12-03 15:43:54'),
(8, 'Blog', 6, '', '', '', '2015-12-03 15:44:40', '2015-12-03 15:44:40'),
(9, 'News', 7, 'blog 1', 'blog scangles', 'test', '2015-12-03 15:46:38', '2015-12-03 15:47:35'),
(10, 'News', 8, '', '', '', '2015-12-03 15:48:56', '2015-12-03 15:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `base_content`
--
ALTER TABLE `base_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base_media`
--
ALTER TABLE `base_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base_messages`
--
ALTER TABLE `base_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_base_messages_1` (`parent_id`),
  ADD KEY `fk_base_messages_2` (`sender_id`),
  ADD KEY `fk_base_messages_3` (`receiver_id`);

--
-- Indexes for table `base_settings`
--
ALTER TABLE `base_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key_UNIQUE` (`key`);

--
-- Indexes for table `base_tree`
--
ALTER TABLE `base_tree`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_tree_NK1` (`root`),
  ADD KEY `tbl_tree_NK2` (`lft`),
  ADD KEY `tbl_tree_NK3` (`rgt`),
  ADD KEY `tbl_tree_NK4` (`lvl`),
  ADD KEY `tbl_tree_NK5` (`active`);

--
-- Indexes for table `base_user`
--
ALTER TABLE `base_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `token_UNIQUE` (`token`),
  ADD UNIQUE KEY `signature_UNIQUE` (`auth_key`),
  ADD UNIQUE KEY `login_token_UNIQUE` (`sso_key`);

--
-- Indexes for table `meta_tags`
--
ALTER TABLE `meta_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `object` (`model`,`model_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `base_content`
--
ALTER TABLE `base_content`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `base_media`
--
ALTER TABLE `base_media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;
--
-- AUTO_INCREMENT for table `base_messages`
--
ALTER TABLE `base_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `base_settings`
--
ALTER TABLE `base_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `base_tree`
--
ALTER TABLE `base_tree`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Unique tree node identifier', AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `base_user`
--
ALTER TABLE `base_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `meta_tags`
--
ALTER TABLE `meta_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(11) NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

--
-- Dumping data for table `pma__designer_settings`
--

INSERT INTO `pma__designer_settings` (`username`, `settings_data`) VALUES
('root', '{"snap_to_grid":"off","angular_direct":"direct","relation_lines":"true"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{"db":"social_insight2","table":"insights"},{"db":"social_insight2","table":"authclient"},{"db":"social_insight2","table":"model"},{"db":"social_insight2","table":"base_user"},{"db":"main-old","table":"base_tree"},{"db":"main","table":"base_tree"},{"db":"social_insights","table":"model"},{"db":"social_insights","table":"authclient"},{"db":"social_insights","table":"base_user"},{"db":"social_insights","table":"insights"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT '0',
  `x` float UNSIGNED NOT NULL DEFAULT '0',
  `y` float UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'social_insights', 'model', '{"sorted_col":"`model`.`id` ASC"}', '2016-02-18 10:21:12');

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin,
  `data_sql` longtext COLLATE utf8_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2016-01-03 13:45:46', '{"collation_connection":"utf8mb4_general_ci","ThemeDefault":"pmahomme"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;--
-- Database: `social_insight2`
--
CREATE DATABASE IF NOT EXISTS `social_insight2` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `social_insight2`;

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Asterisk', '1', 1424278268);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1424278227, 1424278227),
('Asterisk', 1, 'Full Access', NULL, NULL, 1424278062, 1424279109);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Asterisk', '/*');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `authclient`
--

CREATE TABLE `authclient` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `source_id` varchar(255) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authclient`
--

INSERT INTO `authclient` (`id`, `user_id`, `source`, `source_id`, `created`, `updated`) VALUES
(15, 75, 'facebook', '1511713099130026', '2016-02-14 12:11:48', '2016-02-14 12:11:48'),
(16, 75, 'twitter', '2949392938', '2016-02-14 12:15:01', '2016-02-14 12:15:01'),
(17, 75, 'instagram', '1527813113', '2016-02-14 12:15:28', '2016-02-14 12:15:28'),
(18, 75, 'google_plus', '100080852241585525910', '2016-02-28 16:56:14', '2016-02-28 16:56:14');

-- --------------------------------------------------------

--
-- Table structure for table `base_content`
--

CREATE TABLE `base_content` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `brief` tinytext NOT NULL,
  `description` text NOT NULL,
  `body` text NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(3) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_content`
--

INSERT INTO `base_content` (`id`, `type`, `title`, `slug`, `brief`, `description`, `body`, `date`, `end_date`, `sort`, `hits`, `status`, `created`, `updated`) VALUES
(1, 1, 'Home Slider', 'home-slider', '', '', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n			\r\n			<video src="/shared/themes/frontend/images/src/chrome.mp4" controls></video>\r\n			\r\n			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>', NULL, NULL, 1, 0, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 'Arm workout lessons', 'arm-workout-lessons', 'The majority of people i see on here and at my gym i train people, have trouble gaining size and shape to their calves than simply training the gastrocnemius and soleus muscle.', 'The majority of people i see on here and at my gym i train people, have trouble gaining size and shape to their calves than simply training the gastrocnemius and soleus muscle.', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n', NULL, NULL, 1, 3, NULL, '0000-00-00 00:00:00', '2015-08-18 09:23:55'),
(3, 2, 'Arm workout lessons', 'arm-workout-lessons-2', 'The majority of people i see on here and at my gym i train people, have trouble gaining size and shape to their calves than simply training the gastrocnemius and soleus muscle.', 'The majority of people i see on here and at my gym i train people, have trouble gaining size and shape to their calves than simply training the gastrocnemius and soleus muscle.', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n', '2015-06-02 22:00:00', NULL, 2, 4, NULL, '0000-00-00 00:00:00', '2015-08-18 09:24:16'),
(4, 2, 'Arm workout lessons', 'arm-workout-lessons-3', 'The majority of people i see on here and at my gym i train people, have trouble gaining size and shape to their calves than simply training the gastrocnemius and soleus muscle.', 'The majority of people i see on here and at my gym i train people, have trouble gaining size and shape to their calves than simply training the gastrocnemius and soleus muscle.', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n', '2015-06-01 22:00:00', NULL, 3, 1, NULL, '0000-00-00 00:00:00', '2015-08-18 09:24:34'),
(5, 2, 'Arm workout lessons', 'arm-workout-lessons-4', 'The majority of people i see on here and at my gym i train people, have trouble gaining size and shape to their calves than simply training the gastrocnemius and soleus muscle.', 'The majority of people i see on here and at my gym i train people, have trouble gaining size and shape to their calves than simply training the gastrocnemius and soleus muscle.', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n', '2015-05-31 22:00:00', NULL, 4, 1, NULL, '0000-00-00 00:00:00', '2015-08-18 09:24:50'),
(6, 1, 'Home Banner', 'home-banner', '', '', '', NULL, NULL, 2, 0, NULL, '2015-07-30 12:48:31', '2015-07-30 12:48:31'),
(7, 1, 'About Us', 'about-us', '', '', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n', NULL, NULL, 3, 0, NULL, '2015-08-11 11:10:14', '2015-08-18 12:04:15'),
(8, 1, 'Contact Us', 'contact-us', '', '', '<p><strong>Address:</strong> 15 AlFustat Street, 2nd Settelment, Fustat City, Masr Al Qadeema, Cairo, Egypt.</p>\r\n\r\n<p><strong>Telephone:</strong> 02-27429783 - 02-27429783, 19402</p>\r\n\r\n<p><strong>Fax:</strong> 02-27424323</p>\r\n', NULL, NULL, 4, 0, NULL, '2015-08-11 11:20:33', '2015-08-11 13:08:14'),
(9, 1, 'Terms Of Service', 'terms-of-service', '', '', '<p>Terms Of Service</p>\r\n', NULL, NULL, 5, 0, NULL, '2015-08-11 11:21:03', '2015-08-11 11:21:03'),
(10, 1, 'Privacy Policy', 'privacy-policy', '', '', '<p>Privacy Policy</p>\r\n', NULL, NULL, 6, 0, NULL, '2015-08-11 11:21:26', '2015-08-11 11:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `base_media`
--

CREATE TABLE `base_media` (
  `id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED DEFAULT NULL,
  `model` varchar(64) NOT NULL,
  `path` varchar(255) NOT NULL,
  `filename` varchar(128) NOT NULL,
  `mime` varchar(128) NOT NULL,
  `size` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `embed` text NOT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_media`
--

INSERT INTO `base_media` (`id`, `model_id`, `model`, `path`, `filename`, `mime`, `size`, `title`, `description`, `link`, `embed`, `status`, `type`, `sort`, `created`, `updated`) VALUES
(1, 1, 'Page', '/shared/uploads/2015/06/01/', 'jjSb34LvXHteIRMd.png', 'image/png', 1439500, 'The BSN Push Training Guide', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non quod numquam sit magni expedita.', 'http://google.com', '', NULL, NULL, 1, '0000-00-00 00:00:00', '2015-06-02 16:29:32'),
(2, 1, 'Page', '/shared/uploads/2015/06/01/', 'cgRxUPubFyTHodTd.png', 'image/png', 1498917, 'The BSN Push Training Guide', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non quod numquam sit magni expedita.', 'http://google.com', '', NULL, NULL, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 'Page', '/shared/uploads/2015/06/01/', 'rjSi8k3H2Z-Ymtkr.png', 'image/png', 1497535, 'The BSN Push Training Guide', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non quod numquam sit magni expedita.', 'http://google.com', '', NULL, NULL, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 3, 'Article', '/shared/uploads/2015/06/03/', 'Tk_yI_mEiTCkWq-q.png', 'image/png', 269755, '', '', '', '', NULL, NULL, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 4, 'Article', '/shared/uploads/2015/06/03/', '_ktL48K8fTehO5yP.png', 'image/png', 269755, '', '', '', '', NULL, NULL, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 3, 'Article', '/shared/uploads/2015/06/03/', 'sB8O3ktmcHLN84Px.png', 'image/png', 420318, '', '', '', '', NULL, NULL, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 5, 'Article', '/shared/uploads/2015/06/03/', '28oP_2QkDz3XY18X.png', 'image/png', 269755, '', '', '', '', NULL, NULL, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 11, 'Brand', '/shared/uploads/2015/06/03/', 'Q5tWNI8i8MSGHWyH.png', 'image/png', 7446, '', '', '', '', NULL, NULL, 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 12, 'Brand', '/shared/uploads/2015/06/03/', 'o4dyfZVg57rZtLZs.png', 'image/png', 15010, '', '', '', '', NULL, NULL, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 13, 'Brand', '/shared/uploads/2015/06/03/', 'Cd3ICh53TdkhUdfg.png', 'image/png', 9697, '', '', '', '', NULL, NULL, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 14, 'Brand', '/shared/uploads/2015/06/03/', 'RVuSSsOpQqhaMNrP.png', 'image/png', 20098, '', '', '', '', NULL, NULL, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 15, 'Brand', '/shared/uploads/2015/06/03/', '2lzDIatGmUq35V7L.png', 'image/png', 11778, '', '', '', '', NULL, NULL, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 16, 'Brand', '/shared/uploads/2015/06/03/', 'pVs0hitQeiaZs2zP.png', 'image/png', 7642, '', '', '', '', NULL, NULL, 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 19, 'Brand', '/shared/uploads/2015/06/03/', 'nP92NzqqJ9CFvUh4.png', 'image/png', 13410, '', '', '', '', NULL, NULL, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 17, 'Brand', '/shared/uploads/2015/06/03/', 'oTpNhr6P5OnPDXzI.png', 'image/png', 15322, '', '', '', '', NULL, NULL, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 3, 'Product', '/shared/uploads/2015/06/03/', 'MAZBlgVOc_GGaegZ.png', 'image/png', 527519, '', '', '', '', NULL, NULL, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 4, 'Product', '/shared/uploads/2015/06/03/', 'N3KgK0ZdPNzapdSb.png', 'image/png', 405279, '', '', '', '', NULL, NULL, 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 5, 'Product', '/shared/uploads/2015/06/03/', 'QYarRz7hjpxWwQiZ.png', 'image/png', 500922, '', '', '', '', NULL, NULL, 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 4, 'Product', '/shared/uploads/2015/06/03/', '2bwe_y81HPys3H0N.png', 'image/png', 500922, '', '', '', '', NULL, NULL, 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 8, 'Product', '/shared/uploads/2015/07/26/', 'Vb1kvYNlfBmSgeHc.png', 'image/png', 527519, '', '', '', '', NULL, NULL, 21, '2015-07-26 17:42:34', '2015-07-26 17:42:34'),
(24, 9, 'Product', '/shared/uploads/2015/07/26/', 'YhdsCjVhHvehBM-E.png', 'image/png', 500922, '', '', '', '', NULL, NULL, 22, '2015-07-26 17:42:49', '2015-07-26 17:42:49'),
(25, 10, 'Product', '/shared/uploads/2015/07/26/', 'EaFPaKo-2zXO5UKK.png', 'image/png', 527519, '', '', '', '', NULL, NULL, 23, '2015-07-26 17:43:10', '2015-07-26 17:43:10'),
(26, 11, 'Product', '/shared/uploads/2015/07/26/', '8FhNHGilZQ6oAWGb.png', 'image/png', 262299, '', '', '', '', NULL, NULL, 24, '2015-07-26 17:43:28', '2015-07-26 17:43:28'),
(27, 13, 'Product', '/shared/uploads/2015/07/26/', 'Yo7vLbeGP2WkUELp.png', 'image/png', 405279, '', '', '', '', NULL, NULL, 25, '2015-07-26 18:16:33', '2015-07-26 18:16:33'),
(29, 14, 'Product', '/shared/uploads/2015/07/26/', 'pN2OPcwI-0uIjI1E.png', 'image/png', 405279, '', '', '', '', NULL, NULL, 27, '2015-07-26 18:17:40', '2015-07-26 18:17:40'),
(32, 16, 'Product', '/shared/uploads/2015/07/26/', 'ltoo9HaTWrlK6qwV.png', 'image/png', 248780, '', '', '', '', NULL, NULL, 30, '2015-07-26 18:19:04', '2015-07-26 18:19:04'),
(33, 15, 'Product', '/shared/uploads/2015/07/26/', 'scVS8GYgBSSQoD2p.png', 'image/png', 158498, '', '', '', '', NULL, NULL, 31, '2015-07-26 18:20:11', '2015-07-26 18:20:11'),
(34, 13, 'Product', '/shared/uploads/2015/07/27/', '1r62u4CZB5gDTxWa.gif', 'image/gif', 117695, '', '', '', '', NULL, NULL, 32, '2015-07-27 13:37:37', '2015-07-27 13:37:37'),
(35, 14, 'Product', '/shared/uploads/2015/07/27/', '7RXLPTSSgGwUnxOK.gif', 'image/gif', 15868, '', '', '', '', NULL, NULL, 33, '2015-07-27 13:37:57', '2015-07-27 13:37:57'),
(36, 17, 'Product', '/shared/uploads/2015/07/27/', '-m0GYynG-MT0BKCL.png', 'image/png', 527519, '', '', '', '', NULL, NULL, 34, '2015-07-27 13:39:21', '2015-07-27 13:39:21'),
(37, 17, 'Product', '/shared/uploads/2015/07/27/', 'mapiLo3fb3YFL5TU.gif', 'image/gif', 15868, '', '', '', '', NULL, NULL, 35, '2015-07-27 13:39:31', '2015-07-27 13:39:31'),
(38, 6, 'Page', '/shared/uploads/2015/07/30/', 'ABo4lIwzH6DxhF9k.png', 'image/png', 247081, 'BLENDER BOTTLE', 'Daily Multivitamin for Overall Men''s Health malum soccer das lansey fall left', 'http://google.com', '', NULL, NULL, 36, '2015-07-30 12:52:26', '2015-07-30 12:58:14'),
(41, 1, 'User', '/shared/uploads/2015/08/18/', 'OQnHhYujtapl_l1n.png', 'image/png', 420318, '', '', '', '', NULL, NULL, 38, '2015-08-18 16:06:50', '2015-08-18 16:06:50'),
(42, 1, 'User', '/shared/uploads/2015/08/18/', 'cIprJwFsblhfv85-.png', 'image/png', 24141, '', '', '', '', NULL, NULL, 39, '2015-08-18 16:08:54', '2015-08-18 16:08:54'),
(43, 60, 'User', '/shared/uploads/2015/08/18/', 'UDIHV2kYTZTTUgfU..jpg', 'image/jpeg', 10984, '', '', '', '', NULL, NULL, 40, '2015-08-18 16:18:14', '2015-08-18 16:18:14'),
(44, 64, 'User', '/shared/uploads/2015/08/18/', 'sV4EMoUniuicFZdr.jpg', 'image/jpeg', 10984, '', '', '', '', NULL, NULL, 41, '2015-08-18 16:51:09', '2015-08-18 16:51:09'),
(45, 65, 'User', '/shared/uploads/2015/08/18/', 'L0CzbyH8adpvQYGr.jpg', 'image/jpeg', 10984, '', '', '', '', NULL, NULL, 42, '2015-08-18 17:38:28', '2015-08-18 17:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `base_messages`
--

CREATE TABLE `base_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `sender_id` int(10) UNSIGNED DEFAULT NULL,
  `receiver_id` int(10) UNSIGNED DEFAULT NULL,
  `model_id` int(10) UNSIGNED DEFAULT NULL,
  `model` varchar(64) NOT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `base_settings`
--

CREATE TABLE `base_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(64) NOT NULL,
  `value` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_settings`
--

INSERT INTO `base_settings` (`id`, `key`, `value`, `description`, `created`, `updated`) VALUES
(1, 'title', 'Digitree CMS', 'Application Url Title', '2015-05-19 15:23:26', '2015-05-19 16:17:17'),
(2, 'test', 'test', '', '0000-00-00 00:00:00', '2015-05-28 14:25:46'),
(3, 'test2', 'test2', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `base_tree`
--

CREATE TABLE `base_tree` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Unique tree node identifier',
  `root` int(10) UNSIGNED DEFAULT NULL COMMENT 'Tree root identifier',
  `lft` int(11) NOT NULL COMMENT 'Nested set left property',
  `rgt` int(11) NOT NULL COMMENT 'Nested set right property',
  `lvl` smallint(6) NOT NULL COMMENT 'Nested set level / depth',
  `name` varchar(255) NOT NULL COMMENT 'The tree node name / label',
  `slug` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) DEFAULT NULL COMMENT 'The icon to use for the node',
  `icon_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Icon Type: 1 = CSS Class, 2 = Raw Markup',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is active (will be set to false on deletion)',
  `selected` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is selected/checked by default',
  `disabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is enabled',
  `readonly` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is read only (unlike disabled - will allow toolbar actions)',
  `visible` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is visible',
  `collapsed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is collapsed by default',
  `movable_u` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable one position up',
  `movable_d` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable one position down',
  `movable_l` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable to the left (from sibling to parent)',
  `movable_r` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable to the right (from sibling to child)',
  `removable` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is removable (any children below will be moved as siblings before deletion)',
  `removable_all` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is removable along with descendants',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_tree`
--

INSERT INTO `base_tree` (`id`, `root`, `lft`, `rgt`, `lvl`, `name`, `slug`, `link`, `description`, `icon`, `icon_type`, `active`, `selected`, `disabled`, `readonly`, `visible`, `collapsed`, `movable_u`, `movable_d`, `movable_l`, `movable_r`, `removable`, `removable_all`, `created`, `updated`) VALUES
(1, 1, 1, 14, 0, 'Categories', 'category', '', 'Product Categories', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, '0000-00-00 00:00:00', '2015-05-31 13:08:10'),
(2, 2, 1, 22, 0, 'Brands', 'brands', '', 'Product Brands', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 1, 14, 0, 'Sizes', 'sizes', '', 'Product Sizes', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 4, 1, 6, 0, 'Flavors', 'flavors', '', 'Product Flavors', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 2, 3, 1, 'Muscle Building', 'muscle-building', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 4, 5, 1, 'Weight Gaining', 'weight-gaining', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 6, 7, 1, 'Pre-Workout', 'pre-workout', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, 8, 9, 1, 'Weight Loss', 'weight-loss', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, 10, 11, 1, 'Health & Wellness', 'health-wellness', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 1, 12, 13, 1, 'Accessories', 'accessories', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 2, 2, 3, 1, 'Universal', 'universal', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 2, 4, 5, 1, 'BPI', 'bpi', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 2, 6, 7, 1, 'Inner Armour', 'inner-armour', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 2, 8, 9, 1, 'Gorilla Wear', 'gorilla-wear', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 2, 10, 11, 1, 'Grenade', 'grenade', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 2, 12, 13, 1, 'Betancourt Nutrition', 'betancourt-nutrition', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '2015-06-03 14:35:03'),
(17, 2, 14, 15, 1, 'BlenderBottle®', 'blenderbottle', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 2, 16, 17, 1, 'FA Nutrition', 'fa-nutrition', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 2, 18, 19, 1, 'Muscle Pharm', 'muscle-pharm', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 2, 20, 21, 1, 'BSN', 'bsn', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 4, 2, 3, 1, 'Chocolate', 'chocolate', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 4, 4, 5, 1, 'Vanilla', 'vanilla', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 3, 2, 3, 1, '1 KG', '1-kg', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '2015-08-11 16:01:04'),
(24, 3, 4, 5, 1, '2 KG', '2-kg', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 3, 6, 7, 1, '3 KG', '3-kg', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 5, 1, 6, 0, 'Cities', 'cities', '', 'Cities', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 5, 2, 3, 1, 'Cairo', 'cairo', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 5, 4, 5, 1, 'Alex', 'alex', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 3, 8, 9, 1, 'Large', '4-kg', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '2015-07-26 18:09:14'),
(31, 3, 10, 11, 1, 'Medium', 'medium', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-07-26 18:09:41', '2015-07-26 18:09:41'),
(32, 3, 12, 13, 1, 'Small', 'small', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-07-26 18:09:54', '2015-07-26 18:09:54');

-- --------------------------------------------------------

--
-- Table structure for table `base_user`
--

CREATE TABLE `base_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` char(123) NOT NULL,
  `token` char(123) DEFAULT NULL,
  `token_type` tinyint(3) UNSIGNED DEFAULT NULL,
  `auth_key` char(123) DEFAULT NULL,
  `sso_key` char(123) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_user`
--

INSERT INTO `base_user` (`id`, `username`, `email`, `password`, `token`, `token_type`, `auth_key`, `sso_key`, `status`, `last_login`, `created`, `updated`) VALUES
(1, 'dalia', 'dalia@digitreeinc.com', '$2y$13$yCHfzayIITzuzvPYBVEp.OVkVMnux7As0niHDNUyQ2suSUpl4cPMK', NULL, NULL, 'AMITSMZCAjVVktBlAx4sZDuCAVSZp3H2', NULL, 2, '2016-02-14 10:07:42', NULL, '2016-02-14 10:08:35'),
(75, 'daliaatef28@gmail.com', 'daliaatef28@gmail.com', '$2y$13$tOSBYC83hlyk8Onbu1i0i.tKKfamKsBBopf5aEUkl0oSpCmoROqlG', NULL, NULL, '2lcSfZig-txkxN7b0IruVgqFJ-DRsbMb', NULL, 2, NULL, '2016-02-14 12:11:48', '2016-02-14 12:11:48');

-- --------------------------------------------------------

--
-- Table structure for table `insights`
--

CREATE TABLE `insights` (
  `id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `followers` int(10) DEFAULT NULL,
  `follows` int(10) DEFAULT NULL,
  `number_of_posted_media` int(10) DEFAULT NULL,
  `total_likes` int(10) DEFAULT NULL,
  `total_comments` int(10) DEFAULT NULL,
  `total_shares` int(10) DEFAULT NULL,
  `engagement_rate` float DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `insights`
--

INSERT INTO `insights` (`id`, `model_id`, `followers`, `follows`, `number_of_posted_media`, `total_likes`, `total_comments`, `total_shares`, `engagement_rate`, `created`, `updated`) VALUES
(114, 60, 160, 405, 10, 9, 2, NULL, NULL, '2016-02-16 13:06:39', '0000-00-00 00:00:00'),
(115, 60, 162, 422, 11, 10, 2, NULL, NULL, '2016-02-17 16:46:36', '2016-02-17 16:46:34'),
(116, 60, 162, 424, 11, 11, 2, NULL, NULL, '2016-02-18 16:59:25', '2016-02-18 12:47:19'),
(117, 60, 162, 424, 11, 11, 2, NULL, NULL, '2016-02-19 01:00:00', '0000-00-00 00:00:00'),
(118, 60, 162, 424, 11, 11, 2, NULL, NULL, '2016-02-20 02:00:00', '0000-00-00 00:00:00'),
(119, 60, 162, 424, 11, 11, 2, NULL, NULL, '2016-02-21 00:00:00', '0000-00-00 00:00:00'),
(134, 60, 163, 424, 11, 11, 2, NULL, NULL, '2016-02-22 15:41:01', '2016-02-22 15:40:58'),
(138, 60, 163, 424, 12, 13, 4, NULL, NULL, '2016-02-23 12:19:26', '2016-02-23 12:19:25'),
(139, 60, 166, 425, 12, 14, 4, NULL, NULL, '2016-02-24 13:31:08', '2016-02-24 13:31:06'),
(140, 60, 166, 425, 12, 14, 4, NULL, NULL, '2016-02-25 09:19:13', '2016-02-25 09:19:12'),
(143, 144, 15, NULL, 21, 0, 1, 4, NULL, '2016-02-29 13:24:57', '2016-02-29 13:24:57');

-- --------------------------------------------------------

--
-- Table structure for table `meta_tags`
--

CREATE TABLE `meta_tags` (
  `id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `model_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meta_tags`
--

INSERT INTO `meta_tags` (`id`, `model`, `model_id`, `title`, `keywords`, `description`, `created`, `updated`) VALUES
(1, 'Page', 10, 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', NULL, '2015-08-11 11:21:26'),
(4, 'Page', 34, 'test', 'test', 'test', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Article', 35, '', '', '', '0000-00-00 00:00:00', '2015-05-31 15:13:43'),
(7, 'Page', 1, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Article', 2, '', '', '', '0000-00-00 00:00:00', '2015-08-18 09:23:55'),
(9, 'Article', 3, '', '', '', '0000-00-00 00:00:00', '2015-08-18 09:24:16'),
(10, 'Article', 4, 'Arm workout lessons', 'Arm workout lessons', 'The majority of people i see on here and at my gym i train people, have trouble gaining size and shape to their calves than simply training the gastrocnemius and soleus muscle.', '0000-00-00 00:00:00', '2015-08-18 09:24:34'),
(11, 'Article', 5, '', '', '', '0000-00-00 00:00:00', '2015-08-18 09:24:50'),
(17, 'Product', 8, 'Platinum', 'Platinum', 'Platinum is an ultra-premium lean gainer engineered', '2015-07-26 17:30:19', '2015-08-17 20:08:45'),
(18, 'Product', 9, '', '', '', '2015-07-26 17:37:18', '2015-07-26 17:37:18'),
(19, 'Product', 10, '', '', '', '2015-07-26 17:39:27', '2015-07-26 17:44:06'),
(20, 'Product', 11, '', '', '', '2015-07-26 17:41:36', '2015-07-28 13:25:57'),
(21, 'Product', 12, '', '', '', '2015-07-26 17:45:39', '2015-07-26 17:45:39'),
(22, 'Product', 13, '', '', '', '2015-07-26 17:54:11', '2015-07-26 17:54:11'),
(23, 'Product', 14, '', '', '', '2015-07-26 18:07:39', '2015-07-26 18:07:39'),
(24, 'Product', 15, '', '', '', '2015-07-26 18:10:32', '2015-07-26 18:19:31'),
(25, 'Product', 16, '', '', '', '2015-07-26 18:15:32', '2015-07-26 18:15:32'),
(26, 'Product', 17, '', '', '', '2015-07-27 12:48:05', '2015-07-27 13:38:49'),
(27, 'Page', 6, '', '', '', '2015-07-30 12:48:31', '2015-07-30 12:48:31'),
(28, 'Page', 7, 'about us', 'about us', 'about us', '2015-08-11 11:10:14', '2015-08-18 12:04:15'),
(29, 'Page', 8, 'Contact Us', 'Contact Us', 'Contact Us', '2015-08-11 11:20:33', '2015-08-11 13:08:15'),
(30, 'Page', 9, 'Terms Of Service', 'Terms Of Service', 'Terms Of Service', '2015-08-11 11:21:03', '2015-08-11 11:21:03');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1424090952),
('m010101_100001_init_comment', 1439761184),
('m010102_100002_init_hits', 1439925856),
('m130524_201442_init', 1424090958),
('m140506_102106_rbac_init', 1424263170),
('m150312_172156_meta_tags', 1432805470);

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id` int(10) UNSIGNED NOT NULL,
  `authclient_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `entity_id` varchar(100) NOT NULL,
  `type` tinyint(2) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `post_type` tinyint(2) DEFAULT NULL,
  `likes` int(10) DEFAULT NULL,
  `comments` int(10) DEFAULT NULL,
  `shares` int(10) DEFAULT NULL,
  `followers` int(10) DEFAULT NULL,
  `creation_time` varchar(30) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `authclient_id`, `parent_id`, `entity_id`, `type`, `name`, `image_url`, `post_type`, `likes`, `comments`, `shares`, `followers`, `creation_time`, `url`, `tags`, `created`, `updated`) VALUES
(60, 17, NULL, '1527813113', 0, 'dassies28', 'https://igcdn-photos-g-a.akamaihd.net/hphotos-ak-ash/t51.2885-19/10932190_1541450592803278_154574478_a.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-02-28 16:47:56', '2016-02-17 16:46:34'),
(61, 17, 60, '1186924112496339592_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e35/12748354_1661524244097687_1904519039_n.jpg?ig_cache_key=MTE4NjkyNDExMjQ5NjMzOTU5Mg%3D%3D.2', 0, 2, 0, NULL, 162, '1455712401', 'https://www.instagram.com/p/BB4zTEUsKqIvayjqA08REeJauVSSGORA_2jX5g0/', 'valentine', '2016-02-28 16:48:12', '2016-02-25 09:19:13'),
(62, 17, 60, '1108177360709003934_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e35/12142137_1013765212019423_156489864_n.jpg?ig_cache_key=MTEwODE3NzM2MDcwOTAwMzkzNA%3D%3D.2', 0, 1, 1, NULL, NULL, '1446325057', 'https://www.instagram.com/p/9hCXAtMKqeT6fQbEAM-6SNtyPiuypZ_LPK7SY0/', '', '2016-02-28 16:48:08', '2016-02-25 09:19:13'),
(63, 17, 60, '1108176533650975363_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e35/c27.0.265.265/12132884_1006161669405435_675713166_n.jpg?ig_cache_key=MTEwODE3NjUzMzY1MDk3NTM2Mw%3D%3D.2.c', 0, 1, 0, NULL, NULL, '1446324958', 'https://www.instagram.com/p/9hCK-csKqDvZrlQ9LydEtVgpJ1YMcXnSGXV7E0/', '', '2016-02-28 16:48:04', '2016-02-25 09:19:13'),
(64, 17, 60, '1108175670849088087_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e35/12142312_1663701530537913_1972707725_n.jpg?ig_cache_key=MTEwODE3NTY3MDg0OTA4ODA4Nw%3D%3D.2', 0, 0, 0, NULL, NULL, '1446324856', 'https://www.instagram.com/p/9hB-a5sKpXWihD_GU1cpzswMthK0GOaF3k6w40/', '', '2016-02-28 16:48:00', '2016-02-25 09:19:13'),
(65, 17, 60, '1108175612095277651_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e35/11925905_441740952676144_1087695194_n.jpg?ig_cache_key=MTEwODE3NTYxMjA5NTI3NzY1MQ%3D%3D.2', 0, 0, 0, NULL, NULL, '1446324849', 'https://www.instagram.com/p/9hB9kLsKpT1bj7f1GJRb8RYJTmeG6Vdt8jdko0/', '', '2016-02-28 16:48:36', '2016-02-25 09:19:13'),
(66, 17, 60, '984873100366621265_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e15/11235929_400973293419625_1568564553_n.jpg?ig_cache_key=OTg0ODczMTAwMzY2NjIxMjY1.2', 0, 0, 0, NULL, NULL, '1431626044', 'https://www.instagram.com/p/2q-N3gMKpRorux6xwtOJltwnqbmW-Y51Ng0640/', '', '2016-02-28 16:48:33', '2016-02-25 09:19:13'),
(67, 17, 60, '984871162287794705_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e15/11273132_676461625792840_651092471_n.jpg?ig_cache_key=OTg0ODcxMTYyMjg3Nzk0NzA1.2', 0, 0, 0, NULL, NULL, '1431625813', 'https://www.instagram.com/p/2q9xqhsKoRb7dESE4rWyxndt6mprVBLuUd9lA0/', '', '2016-02-28 16:48:29', '2016-02-25 09:19:13'),
(68, 17, 60, '984870008065665524_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e15/11272167_1666540690243741_926630155_n.jpg?ig_cache_key=OTg0ODcwMDA4MDY1NjY1NTI0.2', 0, 0, 0, NULL, NULL, '1431625675', 'https://www.instagram.com/p/2q9g3ksKn0dXJApPkfMBccoK7012H-6nLttEc0/', '', '2016-02-28 16:48:26', '2016-02-25 09:19:13'),
(69, 17, 60, '837972914827471509_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e15/10724899_393492184141221_593646520_n.jpg?ig_cache_key=ODM3OTcyOTE0ODI3NDcxNTA5.2', 0, 3, 1, NULL, NULL, '1414114177', 'https://www.instagram.com/p/uhE-0fsKqVdhzPKPPp-PdsM_kWMMxOmJ1cHxs0/', 'darkroomcontest,meltcosmetics,meltdarkroom', '2016-02-28 16:48:21', '2016-02-25 09:19:13'),
(70, 17, 60, '837068490621889469_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e15/10731783_1502185143364597_818856726_n.jpg?ig_cache_key=ODM3MDY4NDkwNjIxODg5NDY5.2', 0, 1, 0, NULL, NULL, '1414006361', 'https://www.instagram.com/p/ud3Vt0MKu9rVYP2Y5et-JABayZpH7VjOYvQTA0/', 'wednesdaywisdom,clean', '2016-02-28 16:48:17', '2016-02-25 09:19:13'),
(71, 17, 60, '837000346024847708_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e15/10731707_976124839071200_1897127966_n.jpg?ig_cache_key=ODM3MDAwMzQ2MDI0ODQ3NzA4.2', 0, 4, 0, NULL, NULL, '1413998238', 'https://www.instagram.com/p/udn2FNsKlcNEHe7yJ3hJYc5ZNZ7lXSo8xQ56s0/', 'tagyourstyle', '2016-02-28 16:48:44', '2016-02-25 09:19:13'),
(72, 17, 60, '1191261712250087806_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e35/1171977_827818347345739_1432529725_n.jpg?ig_cache_key=MTE5MTI2MTcxMjI1MDA4NzgwNg%3D%3D.2', 0, 2, 2, NULL, 163, '1456229484', 'https://www.instagram.com/p/BCINjc5MKl-/', '', '2016-02-28 16:48:41', '2016-02-25 09:19:13'),
(144, 18, NULL, '100080852241585525910', 0, 'Lamar Egypt', 'https://lh6.googleusercontent.com/-aME04ZnsnZ8/AAAAAAAAAAI/AAAAAAAAALk/NBNTT13dxnk/photo.jpg?sz=50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-02-29 13:24:52', '2016-02-29 13:24:52'),
(145, 18, 144, 'z13nw1qxhsjrgf2vo23kftapxsvzvx50n', 1, NULL, NULL, NULL, 0, 0, 0, NULL, '1437215282', 'https://plus.google.com/100080852241585525910/posts/LRDnM4THyv6', NULL, '2016-02-29 16:16:46', '2016-02-29 13:24:55'),
(146, 18, 144, 'z13ivfooism0dtp2t23kftapxsvzvx50n', 1, NULL, NULL, NULL, 0, 0, 0, NULL, '1437214955', 'https://plus.google.com/100080852241585525910/posts/Fzo5kMo66Uc', NULL, '2016-02-29 16:16:37', '2016-02-29 13:24:55'),
(147, 18, 144, 'z12cf5valtqpfxu5f04ci1j4urr3jzjoo2g', 1, NULL, NULL, NULL, 0, 0, 0, NULL, '1436876216', 'https://plus.google.com/100080852241585525910/posts/VjqLVLKewrP', NULL, '2016-02-29 16:16:26', '2016-02-29 13:24:55'),
(148, 18, 144, 'z12cj5fgjwzvyzqew23kftapxsvzvx50n', 1, NULL, NULL, NULL, 0, 0, 0, NULL, '1436876214', 'https://plus.google.com/100080852241585525910/posts/GWKxn4bwLF9', NULL, '2016-02-29 16:16:11', '2016-02-29 13:24:55'),
(149, 18, 144, 'z134s54zxqa5hfrpd04ci1j4urr3jzjoo2g', 1, NULL, NULL, NULL, 0, 0, 0, NULL, '1436876213', 'https://plus.google.com/100080852241585525910/posts/VPgpAQb38pQ', NULL, '2016-02-29 16:15:58', '2016-02-29 13:24:55'),
(150, 18, 144, 'z13rivwahmadfpeuf23kftapxsvzvx50n', 1, NULL, NULL, NULL, 0, 0, 0, NULL, '1436876212', 'https://plus.google.com/100080852241585525910/posts/DbtUBTUEoC1', NULL, '2016-02-29 16:15:45', '2016-02-29 13:24:55'),
(151, 18, 144, 'z13hw1lx2uzuurt0o23kftapxsvzvx50n', 1, NULL, NULL, NULL, 0, 0, 1, NULL, '1435753571', 'https://plus.google.com/100080852241585525910/posts/4UdYsBm4Bsg', NULL, '2016-02-29 16:15:27', '2016-02-29 13:24:56'),
(152, 18, 144, 'z13ozftg2taccj5zt04ci1j4urr3jzjoo2g', 1, NULL, NULL, NULL, 0, 0, 0, NULL, '1435753570', 'https://plus.google.com/100080852241585525910/posts/igMqmhHAB5r', NULL, '2016-02-29 16:15:10', '2016-02-29 13:24:56'),
(153, 18, 144, 'z13xgl0ysorzfnxdl23kftapxsvzvx50n', 1, NULL, NULL, NULL, 0, 0, 0, NULL, '1435753569', 'https://plus.google.com/100080852241585525910/posts/9MGGdNQvuX7', NULL, '2016-02-29 16:14:43', '2016-02-29 13:24:56'),
(154, 18, 144, 'z13wc5ioqlb0hjn2223kftapxsvzvx50n', 1, NULL, NULL, NULL, 0, 0, 0, NULL, '1435753567', 'https://plus.google.com/100080852241585525910/posts/C96VFSXt8xF', NULL, '2016-02-29 16:14:31', '2016-02-29 13:24:56'),
(155, 18, 144, 'z133fh1pmvrkezt5204ci1j4urr3jzjoo2g', 1, NULL, NULL, NULL, 0, 0, 1, NULL, '1434987047', 'https://plus.google.com/100080852241585525910/posts/UEDCV1zEGzh', NULL, '2016-02-29 16:14:19', '2016-02-29 13:24:56'),
(156, 18, 144, 'z13rddgxmoqhhdwex23kftapxsvzvx50n', 1, NULL, NULL, NULL, 0, 0, 0, NULL, '1434985520', 'https://plus.google.com/100080852241585525910/posts/GhqBcxLAy97', NULL, '2016-02-29 16:13:33', '2016-02-29 13:24:56'),
(157, 18, 144, 'z12pc5jqrkvkcf2y004ci1j4urr3jzjoo2g', 1, NULL, NULL, NULL, 0, 0, 0, NULL, '1434985518', 'https://plus.google.com/100080852241585525910/posts/Z8UhhUWCMgV', NULL, '2016-02-29 16:13:15', '2016-02-29 13:24:56'),
(158, 18, 144, 'z12oddeihmuwzliqc04ci1j4urr3jzjoo2g', 1, NULL, NULL, NULL, 0, 0, 0, NULL, '1434984089', 'https://plus.google.com/100080852241585525910/posts/aXidSWyEF2F', NULL, '2016-02-29 16:12:58', '2016-02-29 13:24:56'),
(159, 18, 144, 'z13zxtko4kuterubd04ci1j4urr3jzjoo2g', 1, NULL, NULL, NULL, 0, 0, 1, NULL, '1431517754', 'https://plus.google.com/100080852241585525910/posts/g7JPd3PsKoU', NULL, '2016-02-29 16:12:21', '2016-02-29 13:24:56'),
(160, 18, 144, 'z12hs3ryuk2nh3txw04ci1j4urr3jzjoo2g', 1, NULL, NULL, NULL, 0, 0, 0, NULL, '1431346116', 'https://plus.google.com/100080852241585525910/posts/Yah2YDdR8yp', NULL, '2016-02-29 16:12:01', '2016-02-29 13:24:56'),
(161, 18, 144, 'z132f5g5lsykxhv2w23kftapxsvzvx50n', 1, NULL, NULL, NULL, 0, 0, 0, NULL, '1404320199', 'https://plus.google.com/100080852241585525910/posts/GXkbu4T7txs', NULL, '2016-02-29 16:11:49', '2016-02-29 13:24:56'),
(162, 18, 144, 'z12hulwicleyhfyt223kftapxsvzvx50n', 1, NULL, NULL, NULL, 0, 0, 0, NULL, '1404318218', 'https://plus.google.com/100080852241585525910/posts/6rDVvmDCCLA', NULL, '2016-02-29 16:11:26', '2016-02-29 13:24:56'),
(163, 18, 144, 'z13cfvajlzamxlata23kftapxsvzvx50n', 1, NULL, NULL, NULL, 0, 0, 0, NULL, '1404267002', 'https://plus.google.com/100080852241585525910/posts/7PkHMVx9AZV', NULL, '2016-02-29 16:11:08', '2016-02-29 13:24:56'),
(164, 18, 144, 'z125htfquuacvtsqm04ci1j4urr3jzjoo2g', 1, NULL, NULL, NULL, 0, 1, 1, NULL, '1404234739', 'https://plus.google.com/100080852241585525910/posts/cFj7tn3WV3X', NULL, '2016-02-29 16:00:14', '2016-02-29 13:24:56'),
(165, 18, 144, 'z13rzxf4yrftwh3el23kftapxsvzvx50n', 1, NULL, NULL, NULL, 0, 0, 0, NULL, '1404224894', 'https://plus.google.com/100080852241585525910/posts/EZq4rGRaBhp', NULL, '2016-02-29 15:59:52', '2016-02-29 13:24:56');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `comment` text NOT NULL,
  `payment_method` tinyint(3) UNSIGNED DEFAULT NULL,
  `amount` decimal(8,2) UNSIGNED DEFAULT '0.00',
  `token` char(123) DEFAULT NULL,
  `new` tinyint(1) UNSIGNED DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT NULL,
  `paid` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `comment`, `payment_method`, `amount`, `token`, `new`, `status`, `paid`, `created`, `updated`) VALUES
(1, 1, '', '', '', '', '', NULL, '0.00', NULL, NULL, 0, 0, '2015-08-03 14:46:40', '2015-08-03 14:46:40'),
(2, NULL, 'Ahmed Sharaf1', 'a.sharaf+1@digitreeinc.com', '12345678911', 'Address Address Address, Alex', '', 1, '700.00', 'QnIg-NmBCrJP40_ccvf_1439419289', NULL, 1, 0, '2015-08-05 11:02:32', '2015-08-12 22:41:29'),
(3, NULL, 'Ahmed Sharaf1', 'a.sharaf+1@digitreeinc.com', '12345678911', 'Address Address Address, Alex', '', 1, '200.00', 'fBorSP1BhECXqXZ_1439455213', NULL, 1, 0, '2015-08-12 22:43:35', '2015-08-13 08:40:13'),
(4, NULL, 'Ahmed Sharaf1', 'a.sharaf+1@digitreeinc.com', '12345678911', 'Address Address Address, Alex', '', 1, '2400.00', 'ngqNtNdvkOqIeyM_1439466994', NULL, 1, 0, '2015-08-13 11:47:01', '2015-08-13 11:56:34'),
(5, NULL, 'Ahmed Sharaf1', 'a.sharaf+1@digitreeinc.com', '12345678911', 'Address Address Address, Alex', '', 2, '700.00', 'H8TdACMxOL2_1440008199', NULL, 1, 1, '2015-08-16 12:13:56', '2015-08-19 21:34:57'),
(6, NULL, '', '', '', '', '', NULL, '0.00', NULL, NULL, 0, 0, '2015-08-16 21:10:34', '2015-08-16 21:10:34'),
(7, NULL, 'Ahmed Sharaf', 'sharaf.developer@gmail.com', '1111111111', 'adress', 'comment', 1, '400.00', 'ULkvlQ00lFwItC1hbpohv3g8TMtuwiA4_1439921356', NULL, 1, 0, '2015-08-18 18:08:50', '2015-08-18 18:09:16'),
(8, NULL, 'Ahmed Sharaf', 'sharaf.developer@gmail.com', '1111111111', 'adress', '', 1, '300.00', 'br86pMpeSzok6IcS_1439921476', NULL, 1, 0, '2015-08-18 18:11:04', '2015-08-18 18:11:16');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `gateway` varchar(45) DEFAULT NULL,
  `transaction_reference` varchar(45) DEFAULT NULL,
  `response` text,
  `status` varchar(45) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `order_id`, `gateway`, `transaction_reference`, `response`, `status`, `created`, `updated`) VALUES
(2, 5, 'Migs_ThreeParty', '523207587497', '{"vpc_3DSXID":"tKUO1yKegVuxvZ+l0mfL+J\\/Pxa8=","vpc_3DSenrolled":"N","vpc_AVSRequestCode":"Z","vpc_AVSResultCode":"Unsupported","vpc_AVS_City":"","vpc_AVS_Country":"EGY","vpc_AVS_PostCode":"12345","vpc_AVS_StateProv":"","vpc_AVS_Street01":"Address","vpc_AcqAVSRespCode":"Unsupported","vpc_AcqCSCRespCode":"Unsupported","vpc_AcqResponseCode":"00","vpc_Amount":"70000","vpc_AuthorizeId":"587497","vpc_BatchNo":"20150820","vpc_CSCResultCode":"Unsupported","vpc_Card":"VC","vpc_CardNum":"xxxxxxxxxxxx0001","vpc_Command":"pay","vpc_Locale":"en","vpc_MerchTxnRef":"H8TdACMxOL2_1440008199","vpc_Merchant":"TEST512345USD","vpc_Message":"Approved","vpc_ReceiptNo":"523207587497","vpc_SecureHash":"731DDD441A63173704E41BD8C3899014","vpc_TransactionNo":"2000069506","vpc_TxnResponseCode":"0","vpc_VerSecurityLevel":"06","vpc_VerStatus":"E","vpc_VerType":"3DS","vpc_Version":"1"}', NULL, '2015-08-19 21:34:57', '2015-08-19 21:34:57');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `city_id` int(10) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `bio` text NOT NULL,
  `gender` tinyint(1) UNSIGNED DEFAULT NULL,
  `address` text NOT NULL,
  `country_phone_code` varchar(5) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `authclient`
--
ALTER TABLE `authclient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_authclient_1_idx` (`user_id`);

--
-- Indexes for table `base_content`
--
ALTER TABLE `base_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base_media`
--
ALTER TABLE `base_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base_messages`
--
ALTER TABLE `base_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_base_messages_1` (`parent_id`),
  ADD KEY `fk_base_messages_2` (`sender_id`),
  ADD KEY `fk_base_messages_3` (`receiver_id`);

--
-- Indexes for table `base_settings`
--
ALTER TABLE `base_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key_UNIQUE` (`key`);

--
-- Indexes for table `base_tree`
--
ALTER TABLE `base_tree`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_tree_NK1` (`root`),
  ADD KEY `tbl_tree_NK2` (`lft`),
  ADD KEY `tbl_tree_NK3` (`rgt`),
  ADD KEY `tbl_tree_NK4` (`lvl`),
  ADD KEY `tbl_tree_NK5` (`active`);

--
-- Indexes for table `base_user`
--
ALTER TABLE `base_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `token_UNIQUE` (`token`),
  ADD UNIQUE KEY `signature_UNIQUE` (`auth_key`),
  ADD UNIQUE KEY `login_token_UNIQUE` (`sso_key`);

--
-- Indexes for table `insights`
--
ALTER TABLE `insights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ModelInsights` (`model_id`);

--
-- Indexes for table `meta_tags`
--
ALTER TABLE `meta_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `object` (`model`,`model_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_AuthModel` (`authclient_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_1_idx` (`user_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_payment_1_idx` (`order_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mstql_profiles_1` (`user_id`),
  ADD KEY `fk_mstql_profiles_2` (`city_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authclient`
--
ALTER TABLE `authclient`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `base_content`
--
ALTER TABLE `base_content`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `base_media`
--
ALTER TABLE `base_media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `base_messages`
--
ALTER TABLE `base_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `base_settings`
--
ALTER TABLE `base_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `base_tree`
--
ALTER TABLE `base_tree`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Unique tree node identifier', AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `base_user`
--
ALTER TABLE `base_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `insights`
--
ALTER TABLE `insights`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;
--
-- AUTO_INCREMENT for table `meta_tags`
--
ALTER TABLE `meta_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `authclient`
--
ALTER TABLE `authclient`
  ADD CONSTRAINT `fk_authclient_1` FOREIGN KEY (`user_id`) REFERENCES `base_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `insights`
--
ALTER TABLE `insights`
  ADD CONSTRAINT `fk_ModelInsights` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`);

--
-- Constraints for table `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `fk_AuthModel` FOREIGN KEY (`authclient_id`) REFERENCES `authclient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_1` FOREIGN KEY (`user_id`) REFERENCES `base_user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_profile_1` FOREIGN KEY (`user_id`) REFERENCES `base_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_profile_2` FOREIGN KEY (`city_id`) REFERENCES `base_tree` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
--
-- Database: `social_insights`
--
CREATE DATABASE IF NOT EXISTS `social_insights` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `social_insights`;

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Asterisk', '1', 1424278268);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1424278227, 1424278227),
('Asterisk', 1, 'Full Access', NULL, NULL, 1424278062, 1424279109);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Asterisk', '/*');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `authclient`
--

CREATE TABLE `authclient` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `source_id` varchar(255) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authclient`
--

INSERT INTO `authclient` (`id`, `user_id`, `source`, `source_id`, `created`, `updated`) VALUES
(15, 75, 'facebook', '1511713099130026', '2016-02-14 12:11:48', '2016-02-14 12:11:48'),
(16, 75, 'twitter', '2949392938', '2016-02-14 12:15:01', '2016-02-14 12:15:01'),
(17, 75, 'instagram', '1527813113', '2016-02-14 12:15:28', '2016-02-14 12:15:28');

-- --------------------------------------------------------

--
-- Table structure for table `base_content`
--

CREATE TABLE `base_content` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `brief` tinytext NOT NULL,
  `description` text NOT NULL,
  `body` text NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(3) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_content`
--

INSERT INTO `base_content` (`id`, `type`, `title`, `slug`, `brief`, `description`, `body`, `date`, `end_date`, `sort`, `hits`, `status`, `created`, `updated`) VALUES
(1, 1, 'Home Slider', 'home-slider', '', '', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n			\r\n			<video src="/shared/themes/frontend/images/src/chrome.mp4" controls></video>\r\n			\r\n			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>', NULL, NULL, 1, 0, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 'Arm workout lessons', 'arm-workout-lessons', 'The majority of people i see on here and at my gym i train people, have trouble gaining size and shape to their calves than simply training the gastrocnemius and soleus muscle.', 'The majority of people i see on here and at my gym i train people, have trouble gaining size and shape to their calves than simply training the gastrocnemius and soleus muscle.', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n', NULL, NULL, 1, 3, NULL, '0000-00-00 00:00:00', '2015-08-18 09:23:55'),
(3, 2, 'Arm workout lessons', 'arm-workout-lessons-2', 'The majority of people i see on here and at my gym i train people, have trouble gaining size and shape to their calves than simply training the gastrocnemius and soleus muscle.', 'The majority of people i see on here and at my gym i train people, have trouble gaining size and shape to their calves than simply training the gastrocnemius and soleus muscle.', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n', '2015-06-02 22:00:00', NULL, 2, 4, NULL, '0000-00-00 00:00:00', '2015-08-18 09:24:16'),
(4, 2, 'Arm workout lessons', 'arm-workout-lessons-3', 'The majority of people i see on here and at my gym i train people, have trouble gaining size and shape to their calves than simply training the gastrocnemius and soleus muscle.', 'The majority of people i see on here and at my gym i train people, have trouble gaining size and shape to their calves than simply training the gastrocnemius and soleus muscle.', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n', '2015-06-01 22:00:00', NULL, 3, 1, NULL, '0000-00-00 00:00:00', '2015-08-18 09:24:34'),
(5, 2, 'Arm workout lessons', 'arm-workout-lessons-4', 'The majority of people i see on here and at my gym i train people, have trouble gaining size and shape to their calves than simply training the gastrocnemius and soleus muscle.', 'The majority of people i see on here and at my gym i train people, have trouble gaining size and shape to their calves than simply training the gastrocnemius and soleus muscle.', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n', '2015-05-31 22:00:00', NULL, 4, 1, NULL, '0000-00-00 00:00:00', '2015-08-18 09:24:50'),
(6, 1, 'Home Banner', 'home-banner', '', '', '', NULL, NULL, 2, 0, NULL, '2015-07-30 12:48:31', '2015-07-30 12:48:31'),
(7, 1, 'About Us', 'about-us', '', '', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n', NULL, NULL, 3, 0, NULL, '2015-08-11 11:10:14', '2015-08-18 12:04:15'),
(8, 1, 'Contact Us', 'contact-us', '', '', '<p><strong>Address:</strong> 15 AlFustat Street, 2nd Settelment, Fustat City, Masr Al Qadeema, Cairo, Egypt.</p>\r\n\r\n<p><strong>Telephone:</strong> 02-27429783 - 02-27429783, 19402</p>\r\n\r\n<p><strong>Fax:</strong> 02-27424323</p>\r\n', NULL, NULL, 4, 0, NULL, '2015-08-11 11:20:33', '2015-08-11 13:08:14'),
(9, 1, 'Terms Of Service', 'terms-of-service', '', '', '<p>Terms Of Service</p>\r\n', NULL, NULL, 5, 0, NULL, '2015-08-11 11:21:03', '2015-08-11 11:21:03'),
(10, 1, 'Privacy Policy', 'privacy-policy', '', '', '<p>Privacy Policy</p>\r\n', NULL, NULL, 6, 0, NULL, '2015-08-11 11:21:26', '2015-08-11 11:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `base_media`
--

CREATE TABLE `base_media` (
  `id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED DEFAULT NULL,
  `model` varchar(64) NOT NULL,
  `path` varchar(255) NOT NULL,
  `filename` varchar(128) NOT NULL,
  `mime` varchar(128) NOT NULL,
  `size` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `embed` text NOT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_media`
--

INSERT INTO `base_media` (`id`, `model_id`, `model`, `path`, `filename`, `mime`, `size`, `title`, `description`, `link`, `embed`, `status`, `type`, `sort`, `created`, `updated`) VALUES
(1, 1, 'Page', '/shared/uploads/2015/06/01/', 'jjSb34LvXHteIRMd.png', 'image/png', 1439500, 'The BSN Push Training Guide', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non quod numquam sit magni expedita.', 'http://google.com', '', NULL, NULL, 1, '0000-00-00 00:00:00', '2015-06-02 16:29:32'),
(2, 1, 'Page', '/shared/uploads/2015/06/01/', 'cgRxUPubFyTHodTd.png', 'image/png', 1498917, 'The BSN Push Training Guide', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non quod numquam sit magni expedita.', 'http://google.com', '', NULL, NULL, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 'Page', '/shared/uploads/2015/06/01/', 'rjSi8k3H2Z-Ymtkr.png', 'image/png', 1497535, 'The BSN Push Training Guide', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non quod numquam sit magni expedita.', 'http://google.com', '', NULL, NULL, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 3, 'Article', '/shared/uploads/2015/06/03/', 'Tk_yI_mEiTCkWq-q.png', 'image/png', 269755, '', '', '', '', NULL, NULL, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 4, 'Article', '/shared/uploads/2015/06/03/', '_ktL48K8fTehO5yP.png', 'image/png', 269755, '', '', '', '', NULL, NULL, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 3, 'Article', '/shared/uploads/2015/06/03/', 'sB8O3ktmcHLN84Px.png', 'image/png', 420318, '', '', '', '', NULL, NULL, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 5, 'Article', '/shared/uploads/2015/06/03/', '28oP_2QkDz3XY18X.png', 'image/png', 269755, '', '', '', '', NULL, NULL, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 11, 'Brand', '/shared/uploads/2015/06/03/', 'Q5tWNI8i8MSGHWyH.png', 'image/png', 7446, '', '', '', '', NULL, NULL, 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 12, 'Brand', '/shared/uploads/2015/06/03/', 'o4dyfZVg57rZtLZs.png', 'image/png', 15010, '', '', '', '', NULL, NULL, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 13, 'Brand', '/shared/uploads/2015/06/03/', 'Cd3ICh53TdkhUdfg.png', 'image/png', 9697, '', '', '', '', NULL, NULL, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 14, 'Brand', '/shared/uploads/2015/06/03/', 'RVuSSsOpQqhaMNrP.png', 'image/png', 20098, '', '', '', '', NULL, NULL, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 15, 'Brand', '/shared/uploads/2015/06/03/', '2lzDIatGmUq35V7L.png', 'image/png', 11778, '', '', '', '', NULL, NULL, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 16, 'Brand', '/shared/uploads/2015/06/03/', 'pVs0hitQeiaZs2zP.png', 'image/png', 7642, '', '', '', '', NULL, NULL, 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 19, 'Brand', '/shared/uploads/2015/06/03/', 'nP92NzqqJ9CFvUh4.png', 'image/png', 13410, '', '', '', '', NULL, NULL, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 17, 'Brand', '/shared/uploads/2015/06/03/', 'oTpNhr6P5OnPDXzI.png', 'image/png', 15322, '', '', '', '', NULL, NULL, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 3, 'Product', '/shared/uploads/2015/06/03/', 'MAZBlgVOc_GGaegZ.png', 'image/png', 527519, '', '', '', '', NULL, NULL, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 4, 'Product', '/shared/uploads/2015/06/03/', 'N3KgK0ZdPNzapdSb.png', 'image/png', 405279, '', '', '', '', NULL, NULL, 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 5, 'Product', '/shared/uploads/2015/06/03/', 'QYarRz7hjpxWwQiZ.png', 'image/png', 500922, '', '', '', '', NULL, NULL, 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 4, 'Product', '/shared/uploads/2015/06/03/', '2bwe_y81HPys3H0N.png', 'image/png', 500922, '', '', '', '', NULL, NULL, 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 8, 'Product', '/shared/uploads/2015/07/26/', 'Vb1kvYNlfBmSgeHc.png', 'image/png', 527519, '', '', '', '', NULL, NULL, 21, '2015-07-26 17:42:34', '2015-07-26 17:42:34'),
(24, 9, 'Product', '/shared/uploads/2015/07/26/', 'YhdsCjVhHvehBM-E.png', 'image/png', 500922, '', '', '', '', NULL, NULL, 22, '2015-07-26 17:42:49', '2015-07-26 17:42:49'),
(25, 10, 'Product', '/shared/uploads/2015/07/26/', 'EaFPaKo-2zXO5UKK.png', 'image/png', 527519, '', '', '', '', NULL, NULL, 23, '2015-07-26 17:43:10', '2015-07-26 17:43:10'),
(26, 11, 'Product', '/shared/uploads/2015/07/26/', '8FhNHGilZQ6oAWGb.png', 'image/png', 262299, '', '', '', '', NULL, NULL, 24, '2015-07-26 17:43:28', '2015-07-26 17:43:28'),
(27, 13, 'Product', '/shared/uploads/2015/07/26/', 'Yo7vLbeGP2WkUELp.png', 'image/png', 405279, '', '', '', '', NULL, NULL, 25, '2015-07-26 18:16:33', '2015-07-26 18:16:33'),
(29, 14, 'Product', '/shared/uploads/2015/07/26/', 'pN2OPcwI-0uIjI1E.png', 'image/png', 405279, '', '', '', '', NULL, NULL, 27, '2015-07-26 18:17:40', '2015-07-26 18:17:40'),
(32, 16, 'Product', '/shared/uploads/2015/07/26/', 'ltoo9HaTWrlK6qwV.png', 'image/png', 248780, '', '', '', '', NULL, NULL, 30, '2015-07-26 18:19:04', '2015-07-26 18:19:04'),
(33, 15, 'Product', '/shared/uploads/2015/07/26/', 'scVS8GYgBSSQoD2p.png', 'image/png', 158498, '', '', '', '', NULL, NULL, 31, '2015-07-26 18:20:11', '2015-07-26 18:20:11'),
(34, 13, 'Product', '/shared/uploads/2015/07/27/', '1r62u4CZB5gDTxWa.gif', 'image/gif', 117695, '', '', '', '', NULL, NULL, 32, '2015-07-27 13:37:37', '2015-07-27 13:37:37'),
(35, 14, 'Product', '/shared/uploads/2015/07/27/', '7RXLPTSSgGwUnxOK.gif', 'image/gif', 15868, '', '', '', '', NULL, NULL, 33, '2015-07-27 13:37:57', '2015-07-27 13:37:57'),
(36, 17, 'Product', '/shared/uploads/2015/07/27/', '-m0GYynG-MT0BKCL.png', 'image/png', 527519, '', '', '', '', NULL, NULL, 34, '2015-07-27 13:39:21', '2015-07-27 13:39:21'),
(37, 17, 'Product', '/shared/uploads/2015/07/27/', 'mapiLo3fb3YFL5TU.gif', 'image/gif', 15868, '', '', '', '', NULL, NULL, 35, '2015-07-27 13:39:31', '2015-07-27 13:39:31'),
(38, 6, 'Page', '/shared/uploads/2015/07/30/', 'ABo4lIwzH6DxhF9k.png', 'image/png', 247081, 'BLENDER BOTTLE', 'Daily Multivitamin for Overall Men''s Health malum soccer das lansey fall left', 'http://google.com', '', NULL, NULL, 36, '2015-07-30 12:52:26', '2015-07-30 12:58:14'),
(41, 1, 'User', '/shared/uploads/2015/08/18/', 'OQnHhYujtapl_l1n.png', 'image/png', 420318, '', '', '', '', NULL, NULL, 38, '2015-08-18 16:06:50', '2015-08-18 16:06:50'),
(42, 1, 'User', '/shared/uploads/2015/08/18/', 'cIprJwFsblhfv85-.png', 'image/png', 24141, '', '', '', '', NULL, NULL, 39, '2015-08-18 16:08:54', '2015-08-18 16:08:54'),
(43, 60, 'User', '/shared/uploads/2015/08/18/', 'UDIHV2kYTZTTUgfU..jpg', 'image/jpeg', 10984, '', '', '', '', NULL, NULL, 40, '2015-08-18 16:18:14', '2015-08-18 16:18:14'),
(44, 64, 'User', '/shared/uploads/2015/08/18/', 'sV4EMoUniuicFZdr.jpg', 'image/jpeg', 10984, '', '', '', '', NULL, NULL, 41, '2015-08-18 16:51:09', '2015-08-18 16:51:09'),
(45, 65, 'User', '/shared/uploads/2015/08/18/', 'L0CzbyH8adpvQYGr.jpg', 'image/jpeg', 10984, '', '', '', '', NULL, NULL, 42, '2015-08-18 17:38:28', '2015-08-18 17:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `base_messages`
--

CREATE TABLE `base_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `sender_id` int(10) UNSIGNED DEFAULT NULL,
  `receiver_id` int(10) UNSIGNED DEFAULT NULL,
  `model_id` int(10) UNSIGNED DEFAULT NULL,
  `model` varchar(64) NOT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `base_settings`
--

CREATE TABLE `base_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(64) NOT NULL,
  `value` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_settings`
--

INSERT INTO `base_settings` (`id`, `key`, `value`, `description`, `created`, `updated`) VALUES
(1, 'title', 'Digitree CMS', 'Application Url Title', '2015-05-19 15:23:26', '2015-05-19 16:17:17'),
(2, 'test', 'test', '', '0000-00-00 00:00:00', '2015-05-28 14:25:46'),
(3, 'test2', 'test2', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `base_tree`
--

CREATE TABLE `base_tree` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Unique tree node identifier',
  `root` int(10) UNSIGNED DEFAULT NULL COMMENT 'Tree root identifier',
  `lft` int(11) NOT NULL COMMENT 'Nested set left property',
  `rgt` int(11) NOT NULL COMMENT 'Nested set right property',
  `lvl` smallint(6) NOT NULL COMMENT 'Nested set level / depth',
  `name` varchar(255) NOT NULL COMMENT 'The tree node name / label',
  `slug` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) DEFAULT NULL COMMENT 'The icon to use for the node',
  `icon_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Icon Type: 1 = CSS Class, 2 = Raw Markup',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is active (will be set to false on deletion)',
  `selected` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is selected/checked by default',
  `disabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is enabled',
  `readonly` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is read only (unlike disabled - will allow toolbar actions)',
  `visible` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is visible',
  `collapsed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is collapsed by default',
  `movable_u` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable one position up',
  `movable_d` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable one position down',
  `movable_l` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable to the left (from sibling to parent)',
  `movable_r` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable to the right (from sibling to child)',
  `removable` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is removable (any children below will be moved as siblings before deletion)',
  `removable_all` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is removable along with descendants',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_tree`
--

INSERT INTO `base_tree` (`id`, `root`, `lft`, `rgt`, `lvl`, `name`, `slug`, `link`, `description`, `icon`, `icon_type`, `active`, `selected`, `disabled`, `readonly`, `visible`, `collapsed`, `movable_u`, `movable_d`, `movable_l`, `movable_r`, `removable`, `removable_all`, `created`, `updated`) VALUES
(1, 1, 1, 14, 0, 'Categories', 'category', '', 'Product Categories', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, '0000-00-00 00:00:00', '2015-05-31 13:08:10'),
(2, 2, 1, 22, 0, 'Brands', 'brands', '', 'Product Brands', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 1, 14, 0, 'Sizes', 'sizes', '', 'Product Sizes', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 4, 1, 6, 0, 'Flavors', 'flavors', '', 'Product Flavors', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 2, 3, 1, 'Muscle Building', 'muscle-building', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 4, 5, 1, 'Weight Gaining', 'weight-gaining', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 6, 7, 1, 'Pre-Workout', 'pre-workout', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, 8, 9, 1, 'Weight Loss', 'weight-loss', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, 10, 11, 1, 'Health & Wellness', 'health-wellness', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 1, 12, 13, 1, 'Accessories', 'accessories', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 2, 2, 3, 1, 'Universal', 'universal', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 2, 4, 5, 1, 'BPI', 'bpi', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 2, 6, 7, 1, 'Inner Armour', 'inner-armour', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 2, 8, 9, 1, 'Gorilla Wear', 'gorilla-wear', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 2, 10, 11, 1, 'Grenade', 'grenade', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 2, 12, 13, 1, 'Betancourt Nutrition', 'betancourt-nutrition', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '2015-06-03 14:35:03'),
(17, 2, 14, 15, 1, 'BlenderBottle®', 'blenderbottle', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 2, 16, 17, 1, 'FA Nutrition', 'fa-nutrition', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 2, 18, 19, 1, 'Muscle Pharm', 'muscle-pharm', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 2, 20, 21, 1, 'BSN', 'bsn', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 4, 2, 3, 1, 'Chocolate', 'chocolate', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 4, 4, 5, 1, 'Vanilla', 'vanilla', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 3, 2, 3, 1, '1 KG', '1-kg', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '2015-08-11 16:01:04'),
(24, 3, 4, 5, 1, '2 KG', '2-kg', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 3, 6, 7, 1, '3 KG', '3-kg', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 5, 1, 6, 0, 'Cities', 'cities', '', 'Cities', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 5, 2, 3, 1, 'Cairo', 'cairo', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 5, 4, 5, 1, 'Alex', 'alex', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 3, 8, 9, 1, 'Large', '4-kg', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '2015-07-26 18:09:14'),
(31, 3, 10, 11, 1, 'Medium', 'medium', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-07-26 18:09:41', '2015-07-26 18:09:41'),
(32, 3, 12, 13, 1, 'Small', 'small', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-07-26 18:09:54', '2015-07-26 18:09:54');

-- --------------------------------------------------------

--
-- Table structure for table `base_user`
--

CREATE TABLE `base_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` char(123) NOT NULL,
  `token` char(123) DEFAULT NULL,
  `token_type` tinyint(3) UNSIGNED DEFAULT NULL,
  `auth_key` char(123) DEFAULT NULL,
  `sso_key` char(123) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_user`
--

INSERT INTO `base_user` (`id`, `username`, `email`, `password`, `token`, `token_type`, `auth_key`, `sso_key`, `status`, `last_login`, `created`, `updated`) VALUES
(1, 'dalia', 'dalia@digitreeinc.com', '$2y$13$yCHfzayIITzuzvPYBVEp.OVkVMnux7As0niHDNUyQ2suSUpl4cPMK', NULL, NULL, 'AMITSMZCAjVVktBlAx4sZDuCAVSZp3H2', NULL, 2, '2016-02-14 10:07:42', NULL, '2016-02-14 10:08:35'),
(75, 'daliaatef28@gmail.com', 'daliaatef28@gmail.com', '$2y$13$tOSBYC83hlyk8Onbu1i0i.tKKfamKsBBopf5aEUkl0oSpCmoROqlG', NULL, NULL, '2lcSfZig-txkxN7b0IruVgqFJ-DRsbMb', NULL, 2, NULL, '2016-02-14 12:11:48', '2016-02-14 12:11:48');

-- --------------------------------------------------------

--
-- Table structure for table `insights`
--

CREATE TABLE `insights` (
  `id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `followers` int(10) DEFAULT NULL,
  `follows` int(10) DEFAULT NULL,
  `number_of_posted_media` int(10) DEFAULT NULL,
  `total_likes` int(10) DEFAULT NULL,
  `total_comments` int(10) DEFAULT NULL,
  `engagement_rate` float DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `insights`
--

INSERT INTO `insights` (`id`, `model_id`, `followers`, `follows`, `number_of_posted_media`, `total_likes`, `total_comments`, `engagement_rate`, `created`, `updated`) VALUES
(114, 60, 160, 405, 10, 9, 2, NULL, '2016-02-16 13:06:39', '0000-00-00 00:00:00'),
(115, 60, 162, 422, 11, 10, 2, NULL, '2016-02-17 16:46:36', '2016-02-17 16:46:34'),
(116, 60, 162, 424, 11, 11, 2, NULL, '2016-02-18 16:59:25', '2016-02-18 12:47:19'),
(117, 60, 162, 424, 11, 11, 2, NULL, '2016-02-19 01:00:00', '0000-00-00 00:00:00'),
(118, 60, 162, 424, 11, 11, 2, NULL, '2016-02-20 02:00:00', '0000-00-00 00:00:00'),
(119, 60, 162, 424, 11, 11, 2, NULL, '2016-02-21 00:00:00', '0000-00-00 00:00:00'),
(134, 60, 163, 424, 11, 11, 2, NULL, '2016-02-22 15:41:01', '2016-02-22 15:40:58'),
(138, 60, 163, 424, 12, 13, 4, NULL, '2016-02-23 12:19:26', '2016-02-23 12:19:25'),
(139, 60, 166, 425, 12, 14, 4, NULL, '2016-02-24 13:31:08', '2016-02-24 13:31:06'),
(140, 60, 166, 425, 12, 14, 4, NULL, '2016-02-25 09:19:13', '2016-02-25 09:19:12');

-- --------------------------------------------------------

--
-- Table structure for table `meta_tags`
--

CREATE TABLE `meta_tags` (
  `id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `model_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meta_tags`
--

INSERT INTO `meta_tags` (`id`, `model`, `model_id`, `title`, `keywords`, `description`, `created`, `updated`) VALUES
(1, 'Page', 10, 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', NULL, '2015-08-11 11:21:26'),
(4, 'Page', 34, 'test', 'test', 'test', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Article', 35, '', '', '', '0000-00-00 00:00:00', '2015-05-31 15:13:43'),
(7, 'Page', 1, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Article', 2, '', '', '', '0000-00-00 00:00:00', '2015-08-18 09:23:55'),
(9, 'Article', 3, '', '', '', '0000-00-00 00:00:00', '2015-08-18 09:24:16'),
(10, 'Article', 4, 'Arm workout lessons', 'Arm workout lessons', 'The majority of people i see on here and at my gym i train people, have trouble gaining size and shape to their calves than simply training the gastrocnemius and soleus muscle.', '0000-00-00 00:00:00', '2015-08-18 09:24:34'),
(11, 'Article', 5, '', '', '', '0000-00-00 00:00:00', '2015-08-18 09:24:50'),
(17, 'Product', 8, 'Platinum', 'Platinum', 'Platinum is an ultra-premium lean gainer engineered', '2015-07-26 17:30:19', '2015-08-17 20:08:45'),
(18, 'Product', 9, '', '', '', '2015-07-26 17:37:18', '2015-07-26 17:37:18'),
(19, 'Product', 10, '', '', '', '2015-07-26 17:39:27', '2015-07-26 17:44:06'),
(20, 'Product', 11, '', '', '', '2015-07-26 17:41:36', '2015-07-28 13:25:57'),
(21, 'Product', 12, '', '', '', '2015-07-26 17:45:39', '2015-07-26 17:45:39'),
(22, 'Product', 13, '', '', '', '2015-07-26 17:54:11', '2015-07-26 17:54:11'),
(23, 'Product', 14, '', '', '', '2015-07-26 18:07:39', '2015-07-26 18:07:39'),
(24, 'Product', 15, '', '', '', '2015-07-26 18:10:32', '2015-07-26 18:19:31'),
(25, 'Product', 16, '', '', '', '2015-07-26 18:15:32', '2015-07-26 18:15:32'),
(26, 'Product', 17, '', '', '', '2015-07-27 12:48:05', '2015-07-27 13:38:49'),
(27, 'Page', 6, '', '', '', '2015-07-30 12:48:31', '2015-07-30 12:48:31'),
(28, 'Page', 7, 'about us', 'about us', 'about us', '2015-08-11 11:10:14', '2015-08-18 12:04:15'),
(29, 'Page', 8, 'Contact Us', 'Contact Us', 'Contact Us', '2015-08-11 11:20:33', '2015-08-11 13:08:15'),
(30, 'Page', 9, 'Terms Of Service', 'Terms Of Service', 'Terms Of Service', '2015-08-11 11:21:03', '2015-08-11 11:21:03');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1424090952),
('m010101_100001_init_comment', 1439761184),
('m010102_100002_init_hits', 1439925856),
('m130524_201442_init', 1424090958),
('m140506_102106_rbac_init', 1424263170),
('m150312_172156_meta_tags', 1432805470);

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `entity_id` varchar(100) NOT NULL,
  `type` tinyint(2) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `image_url` varchar(255) NOT NULL,
  `post_type` tinyint(2) DEFAULT NULL,
  `likes` int(10) DEFAULT NULL,
  `comments` int(10) DEFAULT NULL,
  `followers` int(10) DEFAULT NULL,
  `creation_time` varchar(30) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `user_id`, `parent_id`, `entity_id`, `type`, `name`, `image_url`, `post_type`, `likes`, `comments`, `followers`, `creation_time`, `url`, `tags`, `created`, `updated`) VALUES
(60, 75, NULL, '1527813113', 0, 'dassies28', 'https://igcdn-photos-g-a.akamaihd.net/hphotos-ak-ash/t51.2885-19/10932190_1541450592803278_154574478_a.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-02-17 16:46:34', '2016-02-17 16:46:34'),
(61, 75, 60, '1186924112496339592_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e35/12748354_1661524244097687_1904519039_n.jpg?ig_cache_key=MTE4NjkyNDExMjQ5NjMzOTU5Mg%3D%3D.2', 0, 2, 0, 162, '1455712401', 'https://www.instagram.com/p/BB4zTEUsKqIvayjqA08REeJauVSSGORA_2jX5g0/', 'valentine', '2016-02-25 09:19:13', '2016-02-25 09:19:13'),
(62, 75, 60, '1108177360709003934_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e35/12142137_1013765212019423_156489864_n.jpg?ig_cache_key=MTEwODE3NzM2MDcwOTAwMzkzNA%3D%3D.2', 0, 1, 1, NULL, '1446325057', 'https://www.instagram.com/p/9hCXAtMKqeT6fQbEAM-6SNtyPiuypZ_LPK7SY0/', '', '2016-02-25 09:19:13', '2016-02-25 09:19:13'),
(63, 75, 60, '1108176533650975363_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e35/c27.0.265.265/12132884_1006161669405435_675713166_n.jpg?ig_cache_key=MTEwODE3NjUzMzY1MDk3NTM2Mw%3D%3D.2.c', 0, 1, 0, NULL, '1446324958', 'https://www.instagram.com/p/9hCK-csKqDvZrlQ9LydEtVgpJ1YMcXnSGXV7E0/', '', '2016-02-25 09:19:13', '2016-02-25 09:19:13'),
(64, 75, 60, '1108175670849088087_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e35/12142312_1663701530537913_1972707725_n.jpg?ig_cache_key=MTEwODE3NTY3MDg0OTA4ODA4Nw%3D%3D.2', 0, 0, 0, NULL, '1446324856', 'https://www.instagram.com/p/9hB-a5sKpXWihD_GU1cpzswMthK0GOaF3k6w40/', '', '2016-02-25 09:19:13', '2016-02-25 09:19:13'),
(65, 75, 60, '1108175612095277651_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e35/11925905_441740952676144_1087695194_n.jpg?ig_cache_key=MTEwODE3NTYxMjA5NTI3NzY1MQ%3D%3D.2', 0, 0, 0, NULL, '1446324849', 'https://www.instagram.com/p/9hB9kLsKpT1bj7f1GJRb8RYJTmeG6Vdt8jdko0/', '', '2016-02-25 09:19:13', '2016-02-25 09:19:13'),
(66, 75, 60, '984873100366621265_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e15/11235929_400973293419625_1568564553_n.jpg?ig_cache_key=OTg0ODczMTAwMzY2NjIxMjY1.2', 0, 0, 0, NULL, '1431626044', 'https://www.instagram.com/p/2q-N3gMKpRorux6xwtOJltwnqbmW-Y51Ng0640/', '', '2016-02-25 09:19:13', '2016-02-25 09:19:13'),
(67, 75, 60, '984871162287794705_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e15/11273132_676461625792840_651092471_n.jpg?ig_cache_key=OTg0ODcxMTYyMjg3Nzk0NzA1.2', 0, 0, 0, NULL, '1431625813', 'https://www.instagram.com/p/2q9xqhsKoRb7dESE4rWyxndt6mprVBLuUd9lA0/', '', '2016-02-25 09:19:13', '2016-02-25 09:19:13'),
(68, 75, 60, '984870008065665524_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e15/11272167_1666540690243741_926630155_n.jpg?ig_cache_key=OTg0ODcwMDA4MDY1NjY1NTI0.2', 0, 0, 0, NULL, '1431625675', 'https://www.instagram.com/p/2q9g3ksKn0dXJApPkfMBccoK7012H-6nLttEc0/', '', '2016-02-25 09:19:13', '2016-02-25 09:19:13'),
(69, 75, 60, '837972914827471509_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e15/10724899_393492184141221_593646520_n.jpg?ig_cache_key=ODM3OTcyOTE0ODI3NDcxNTA5.2', 0, 3, 1, NULL, '1414114177', 'https://www.instagram.com/p/uhE-0fsKqVdhzPKPPp-PdsM_kWMMxOmJ1cHxs0/', 'darkroomcontest,meltcosmetics,meltdarkroom', '2016-02-25 09:19:13', '2016-02-25 09:19:13'),
(70, 75, 60, '837068490621889469_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e15/10731783_1502185143364597_818856726_n.jpg?ig_cache_key=ODM3MDY4NDkwNjIxODg5NDY5.2', 0, 1, 0, NULL, '1414006361', 'https://www.instagram.com/p/ud3Vt0MKu9rVYP2Y5et-JABayZpH7VjOYvQTA0/', 'wednesdaywisdom,clean', '2016-02-25 09:19:13', '2016-02-25 09:19:13'),
(71, 75, 60, '837000346024847708_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e15/10731707_976124839071200_1897127966_n.jpg?ig_cache_key=ODM3MDAwMzQ2MDI0ODQ3NzA4.2', 0, 4, 0, NULL, '1413998238', 'https://www.instagram.com/p/udn2FNsKlcNEHe7yJ3hJYc5ZNZ7lXSo8xQ56s0/', 'tagyourstyle', '2016-02-25 09:19:13', '2016-02-25 09:19:13'),
(72, 75, 60, '1191261712250087806_1527813113', 1, NULL, 'https://scontent.cdninstagram.com/t51.2885-15/s150x150/e35/1171977_827818347345739_1432529725_n.jpg?ig_cache_key=MTE5MTI2MTcxMjI1MDA4NzgwNg%3D%3D.2', 0, 2, 2, 163, '1456229484', 'https://www.instagram.com/p/BCINjc5MKl-/', '', '2016-02-25 09:19:13', '2016-02-25 09:19:13');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `comment` text NOT NULL,
  `payment_method` tinyint(3) UNSIGNED DEFAULT NULL,
  `amount` decimal(8,2) UNSIGNED DEFAULT '0.00',
  `token` char(123) DEFAULT NULL,
  `new` tinyint(1) UNSIGNED DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT NULL,
  `paid` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `comment`, `payment_method`, `amount`, `token`, `new`, `status`, `paid`, `created`, `updated`) VALUES
(1, 1, '', '', '', '', '', NULL, '0.00', NULL, NULL, 0, 0, '2015-08-03 14:46:40', '2015-08-03 14:46:40'),
(2, NULL, 'Ahmed Sharaf1', 'a.sharaf+1@digitreeinc.com', '12345678911', 'Address Address Address, Alex', '', 1, '700.00', 'QnIg-NmBCrJP40_ccvf_1439419289', NULL, 1, 0, '2015-08-05 11:02:32', '2015-08-12 22:41:29'),
(3, NULL, 'Ahmed Sharaf1', 'a.sharaf+1@digitreeinc.com', '12345678911', 'Address Address Address, Alex', '', 1, '200.00', 'fBorSP1BhECXqXZ_1439455213', NULL, 1, 0, '2015-08-12 22:43:35', '2015-08-13 08:40:13'),
(4, NULL, 'Ahmed Sharaf1', 'a.sharaf+1@digitreeinc.com', '12345678911', 'Address Address Address, Alex', '', 1, '2400.00', 'ngqNtNdvkOqIeyM_1439466994', NULL, 1, 0, '2015-08-13 11:47:01', '2015-08-13 11:56:34'),
(5, NULL, 'Ahmed Sharaf1', 'a.sharaf+1@digitreeinc.com', '12345678911', 'Address Address Address, Alex', '', 2, '700.00', 'H8TdACMxOL2_1440008199', NULL, 1, 1, '2015-08-16 12:13:56', '2015-08-19 21:34:57'),
(6, NULL, '', '', '', '', '', NULL, '0.00', NULL, NULL, 0, 0, '2015-08-16 21:10:34', '2015-08-16 21:10:34'),
(7, NULL, 'Ahmed Sharaf', 'sharaf.developer@gmail.com', '1111111111', 'adress', 'comment', 1, '400.00', 'ULkvlQ00lFwItC1hbpohv3g8TMtuwiA4_1439921356', NULL, 1, 0, '2015-08-18 18:08:50', '2015-08-18 18:09:16'),
(8, NULL, 'Ahmed Sharaf', 'sharaf.developer@gmail.com', '1111111111', 'adress', '', 1, '300.00', 'br86pMpeSzok6IcS_1439921476', NULL, 1, 0, '2015-08-18 18:11:04', '2015-08-18 18:11:16');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `gateway` varchar(45) DEFAULT NULL,
  `transaction_reference` varchar(45) DEFAULT NULL,
  `response` text,
  `status` varchar(45) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `order_id`, `gateway`, `transaction_reference`, `response`, `status`, `created`, `updated`) VALUES
(2, 5, 'Migs_ThreeParty', '523207587497', '{"vpc_3DSXID":"tKUO1yKegVuxvZ+l0mfL+J\\/Pxa8=","vpc_3DSenrolled":"N","vpc_AVSRequestCode":"Z","vpc_AVSResultCode":"Unsupported","vpc_AVS_City":"","vpc_AVS_Country":"EGY","vpc_AVS_PostCode":"12345","vpc_AVS_StateProv":"","vpc_AVS_Street01":"Address","vpc_AcqAVSRespCode":"Unsupported","vpc_AcqCSCRespCode":"Unsupported","vpc_AcqResponseCode":"00","vpc_Amount":"70000","vpc_AuthorizeId":"587497","vpc_BatchNo":"20150820","vpc_CSCResultCode":"Unsupported","vpc_Card":"VC","vpc_CardNum":"xxxxxxxxxxxx0001","vpc_Command":"pay","vpc_Locale":"en","vpc_MerchTxnRef":"H8TdACMxOL2_1440008199","vpc_Merchant":"TEST512345USD","vpc_Message":"Approved","vpc_ReceiptNo":"523207587497","vpc_SecureHash":"731DDD441A63173704E41BD8C3899014","vpc_TransactionNo":"2000069506","vpc_TxnResponseCode":"0","vpc_VerSecurityLevel":"06","vpc_VerStatus":"E","vpc_VerType":"3DS","vpc_Version":"1"}', NULL, '2015-08-19 21:34:57', '2015-08-19 21:34:57');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `city_id` int(10) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `bio` text NOT NULL,
  `gender` tinyint(1) UNSIGNED DEFAULT NULL,
  `address` text NOT NULL,
  `country_phone_code` varchar(5) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `authclient`
--
ALTER TABLE `authclient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_authclient_1_idx` (`user_id`);

--
-- Indexes for table `base_content`
--
ALTER TABLE `base_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base_media`
--
ALTER TABLE `base_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base_messages`
--
ALTER TABLE `base_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_base_messages_1` (`parent_id`),
  ADD KEY `fk_base_messages_2` (`sender_id`),
  ADD KEY `fk_base_messages_3` (`receiver_id`);

--
-- Indexes for table `base_settings`
--
ALTER TABLE `base_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key_UNIQUE` (`key`);

--
-- Indexes for table `base_tree`
--
ALTER TABLE `base_tree`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_tree_NK1` (`root`),
  ADD KEY `tbl_tree_NK2` (`lft`),
  ADD KEY `tbl_tree_NK3` (`rgt`),
  ADD KEY `tbl_tree_NK4` (`lvl`),
  ADD KEY `tbl_tree_NK5` (`active`);

--
-- Indexes for table `base_user`
--
ALTER TABLE `base_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `token_UNIQUE` (`token`),
  ADD UNIQUE KEY `signature_UNIQUE` (`auth_key`),
  ADD UNIQUE KEY `login_token_UNIQUE` (`sso_key`);

--
-- Indexes for table `insights`
--
ALTER TABLE `insights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ModelInsights` (`model_id`);

--
-- Indexes for table `meta_tags`
--
ALTER TABLE `meta_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `object` (`model`,`model_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_UserModel` (`user_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_1_idx` (`user_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_payment_1_idx` (`order_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mstql_profiles_1` (`user_id`),
  ADD KEY `fk_mstql_profiles_2` (`city_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authclient`
--
ALTER TABLE `authclient`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `base_content`
--
ALTER TABLE `base_content`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `base_media`
--
ALTER TABLE `base_media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `base_messages`
--
ALTER TABLE `base_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `base_settings`
--
ALTER TABLE `base_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `base_tree`
--
ALTER TABLE `base_tree`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Unique tree node identifier', AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `base_user`
--
ALTER TABLE `base_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `insights`
--
ALTER TABLE `insights`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;
--
-- AUTO_INCREMENT for table `meta_tags`
--
ALTER TABLE `meta_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `authclient`
--
ALTER TABLE `authclient`
  ADD CONSTRAINT `fk_authclient_1` FOREIGN KEY (`user_id`) REFERENCES `base_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `insights`
--
ALTER TABLE `insights`
  ADD CONSTRAINT `fk_ModelInsights` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`);

--
-- Constraints for table `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `fk_UserModel` FOREIGN KEY (`user_id`) REFERENCES `base_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_1` FOREIGN KEY (`user_id`) REFERENCES `base_user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_profile_1` FOREIGN KEY (`user_id`) REFERENCES `base_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_profile_2` FOREIGN KEY (`city_id`) REFERENCES `base_tree` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
