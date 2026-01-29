-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2026 at 09:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `investment_dti`
--

-- --------------------------------------------------------

--
-- Table structure for table `charts`
--

CREATE TABLE `charts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL DEFAULT 2024,
  `identifier` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'bar',
  `labels` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`labels`)),
  `datasets` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`datasets`)),
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `charts`
--

INSERT INTO `charts` (`id`, `page_id`, `year`, `identifier`, `title`, `type`, `labels`, `datasets`, `options`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 2024, 'grdpGrowthChart', 'GRDP Growth (2023 vs 2024)', 'bar', '[\"2023\",\"2024\"]', '[{\"label\":\"GRDP (\\u20b1 Billion)\",\"data\":[615.3,641.76],\"backgroundColor\":[\"rgba(56, 189, 248, 0.2)\",\"rgba(56, 189, 248, 0.8)\"],\"borderColor\":[\"rgba(56, 189, 248, 1)\",\"rgba(56, 189, 248, 1)\"],\"borderWidth\":1,\"borderRadius\":8}]', NULL, 1, '2026-01-26 21:40:41', '2026-01-26 21:40:41'),
(2, 1, 2024, 'areaContributionChart', 'Economic Contribution by Area (2024)', 'doughnut', '[\"Iloilo Province\",\"Iloilo City\",\"Capiz\",\"Antique\",\"Aklan\",\"Guimaras\"]', '[{\"data\":[34.1,26.7,13,11.8,11.5,2.8],\"backgroundColor\":[\"#38bdf8\",\"#0ea5e9\",\"#0284c7\",\"#0369a1\",\"#075985\",\"#0c4a6e\"],\"borderColor\":\"var(--bg-dark)\",\"borderWidth\":2}]', NULL, 2, '2026-01-26 21:40:41', '2026-01-26 21:40:41'),
(3, 2, 2024, 'industryShareChart', 'Industry Share to GDP (2023–2024)', 'bar', '[\"Services\",\"Industry\",\"Agriculture (AFF)\"]', '[{\"label\":\"2023\",\"data\":[61.2,23.5,15.3],\"backgroundColor\":\"rgba(94, 163, 184, 0.4)\"},{\"label\":\"2024\",\"data\":[63.5,24.1,12.4],\"backgroundColor\":\"rgba(56, 189, 248, 0.8)\"}]', NULL, 1, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(4, 2, 2024, 'industryGrowthChart', 'Growth Rate by Industry (2024)', 'bar', '[\"Professional Services\",\"Utilities\",\"Health\\/Social Work\",\"Tourism\",\"Construction\",\"AFF\"]', '[{\"label\":\"Growth Rate (%)\",\"data\":[13.7,13.5,13.5,10.4,6.8,-7.3],\"backgroundColor\":\"rgba(56, 189, 248, 0.6)\",\"borderRadius\":4}]', NULL, 2, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(5, 3, 2024, 'bnRegistrationChart', 'DTI Business Name Registration (2022–2025)', 'line', '[\"2022\",\"2023\",\"2024\",\"2025(P)\"]', '[{\"label\":\"Registrations\",\"data\":[65400,71289,68500,72000],\"borderColor\":\"rgba(56, 189, 248, 1)\",\"backgroundColor\":\"rgba(56, 189, 248, 0.1)\",\"fill\":true,\"tension\":0.4}]', NULL, 1, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(6, 3, 2024, 'establishmentsChart', 'Establishments by Province', 'bar', '[\"Iloilo\",\"Neg Occ\",\"Aklan\",\"Capiz\",\"Antique\",\"Guimaras\"]', '[{\"label\":\"Total Establishments\",\"data\":[13845,17300,6730,6245,4753,1909],\"backgroundColor\":\"rgba(56, 189, 248, 0.6)\"}]', NULL, 2, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(7, 4, 2024, 'graduatesChart', 'HEI Graduates by Discipline', 'bar', '[\"IT & Computing\",\"Engineering\\/Tech\",\"Business Admin\",\"Medical\\/Allied\",\"Education\",\"Others\"]', '[{\"label\":\"Graduates\",\"data\":[4200,3850,5100,4800,2441,0],\"backgroundColor\":\"rgba(56, 189, 248, 0.6)\"}]', NULL, 1, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(8, 4, 2024, 'institutionMixChart', 'Institutional Mix', 'doughnut', '[\"SUCs (Public)\",\"Private HEIs\",\"Others\"]', '[{\"data\":[46,49,7],\"backgroundColor\":[\"rgba(56, 189, 248, 0.8)\",\"rgba(94, 163, 184, 0.6)\",\"rgba(255, 255, 255, 0.1)\"],\"borderColor\":\"var(--bg-dark)\",\"borderWidth\":2}]', NULL, 2, '2026-01-26 21:40:42', '2026-01-26 21:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `data_sources`
--

CREATE TABLE `data_sources` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL DEFAULT 2024,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_sources`
--

INSERT INTO `data_sources` (`id`, `page_id`, `year`, `title`, `url`, `description`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 2024, 'Philippine Statistics Authority (PSA)', 'https://psa.gov.ph', 'Primary source for Census (2024), GRDP growth rates, and regional economic accounts.', 1, '2026-01-26 21:40:41', '2026-01-26 21:40:41'),
(2, 1, 2024, 'DTI Region VI (Western Visayas)', 'https://www.dti.gov.ph/regions/region-6/', 'Source for regional investment priorities and industry cluster mappings.', 2, '2026-01-26 21:40:41', '2026-01-26 21:40:41'),
(3, 1, 2024, 'National Economic and Development Authority (NEDA)', 'https://neda.gov.ph', 'Regional development plans and macroeconomic targets for Western Visayas.', 3, '2026-01-26 21:40:41', '2026-01-26 21:40:41'),
(4, 2, 2024, 'Philippine Statistics Authority (PSA)', 'https://psa.gov.ph', 'Core source for Industry Share to GDP and Sectoral Growth rates (2023-2024).', 1, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(5, 2, 2024, 'DTI Bureau of Industrial Strategy', 'https://www.dti.gov.ph', 'Source for industrial performance reports and sector-specific growth analysis.', 2, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(6, 3, 2024, 'DTI Business Name Registration System (BNRS)', 'https://bnrs.dti.gov.ph', NULL, 1, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(7, 3, 2024, 'Philippine Statistics Authority (PSA) - ASPBI', 'https://psa.gov.ph', NULL, 2, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(8, 4, 2024, 'Commission on Higher Education (CHED) - RO VI', 'https://ched.gov.ph', NULL, 1, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(9, 4, 2024, 'Philippine Statistics Authority (PSA) - LFS', 'https://psa.gov.ph', NULL, 2, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(10, 4, 2024, 'TESDA Region VI', 'https://www.tesda.gov.ph', NULL, 3, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(11, 5, 2024, 'Civil Aviation Authority of the Philippines (CAAP)', 'https://www.caap.gov.ph', NULL, 1, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(12, 5, 2024, 'Philippine Ports Authority (PPA)', 'https://www.ppa.com.ph', NULL, 2, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(13, 5, 2024, 'Dept. of Information and Communications Technology (DICT)', 'https://dict.gov.ph', NULL, 3, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(14, 6, 2024, 'DTI Region VI (Western Visayas)', 'https://www.dti.gov.ph/regions/region-6/', 'Source for priority industry cluster profiles, regional targets, and investment guides.', 1, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(15, 6, 2024, 'Department of Agriculture (DA) - Region VI', 'https://westernvisayas.da.gov.ph', 'Production data for coffee, cacao, coconut, and other high-value agricultural commodities.', 2, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(16, 6, 2024, 'Board of Investments (BOI)', 'https://boi.gov.ph', 'Guidelines for investment priorities plan and incentives for strategic regional projects.', 3, '2026-01-26 21:40:42', '2026-01-26 21:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `industry_clusters`
--

CREATE TABLE `industry_clusters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `year` int(11) NOT NULL DEFAULT 2024,
  `kpis` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`kpis`)),
  `chart_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`chart_data`)),
  `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`details`)),
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `industry_clusters`
--

INSERT INTO `industry_clusters` (`id`, `name`, `slug`, `title`, `year`, `kpis`, `chart_data`, `details`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Bamboo', 'bamboo', 'Bamboo Industry', 2024, '[{\"label\":\"Bamboo Area (2022)\",\"value\":\"8,450 ha\",\"trend\":\"Growth Area\",\"icon\":\"trending-up\",\"status\":\"up\"},{\"label\":\"MSMEs Assisted\",\"value\":\"156\",\"trend\":\"Active Support\",\"icon\":\"award\",\"status\":\"up\"},{\"label\":\"Key Product\",\"value\":\"Engineered\",\"trend\":\"Export Ready\",\"icon\":\"package\",\"status\":\"\"}]', '{\"labels\":[\"2020\",\"2021\",\"2022\",\"2023\",\"2024\"],\"data\":[6400,7500,8450,9100,9800],\"label\":\"Hectares Planted\"}', '[[\"Key Commodities\",\"Engineered Bamboo, Bamboo Shoots, Furniture\"],[\"Investment Focus\",\"Processing Plants, Plantation Development\"],[\"Target Market\",\"Local Construction, Export (Europe\\/US)\"],[\"Regional Status\",\"Strategic priority for sustainable development\"]]', 0, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(2, 'Coffee', 'coffee', 'Coffee Industry', 2024, '[{\"label\":\"Production (2024)\",\"value\":\"1,200 MT\",\"trend\":\"8% Growth\",\"icon\":\"trending-up\",\"status\":\"up\"},{\"label\":\"Coffee Farmers\",\"value\":\"1,850\",\"trend\":\"Technical Support\",\"icon\":\"users\",\"status\":\"\"},{\"label\":\"Variety\",\"value\":\"Robusta\",\"trend\":\"Main Crop\",\"icon\":\"coffee\",\"status\":\"\"}]', '{\"labels\":[\"2020\",\"2021\",\"2022\",\"2023\",\"2024\"],\"data\":[950,1020,1080,1150,1200],\"label\":\"Production (Metric Tons)\"}', '[[\"Key Commodities\",\"Robusta, Liberica Beans\"],[\"Investment Focus\",\"Quality Post-harvest facilities, Roasting\"],[\"Target Market\",\"Local Specialty Cafes, Institutional Buyers\"],[\"Status\",\"High priority for mountainous areas (Panay\\/Negros)\"]]', 0, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(3, 'Cacao', 'cacao', 'Cacao Industry', 2024, '[{\"label\":\"Production (2024)\",\"value\":\"580 MT\",\"trend\":\"15% Growth\",\"icon\":\"trending-up\",\"status\":\"up\"},{\"label\":\"Processors\",\"value\":\"32\",\"trend\":\"Award-winning\",\"icon\":\"award\",\"status\":\"\"},{\"label\":\"Area\",\"value\":\"1,450 ha\",\"trend\":\"New Plantations\",\"icon\":\"map\",\"status\":\"up\"}]', '{\"labels\":[\"2020\",\"2021\",\"2022\",\"2023\",\"2024\"],\"data\":[320,380,450,520,580],\"label\":\"Production (Metric Tons)\"}', '[[\"Key Commodities\",\"Fermented Beans, Tablea, Dark Chocolate\"],[\"Investment Focus\",\"Commercial-scale fermentation, Processing\"],[\"Target Market\",\"Artisanal Chocolatiers, Export Markets\"],[\"DTI Support\",\"Market linking with high-end confectioners\"]]', 0, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(4, 'Fruits_nuts', 'fruits_nuts', 'Processed Fruits & Nuts', 2024, '[{\"label\":\"Cluster MSMEs\",\"value\":\"482\",\"trend\":\"Strong Network\",\"icon\":\"building-2\",\"status\":\"\"},{\"label\":\"Export Value\",\"value\":\"$4.2M\",\"trend\":\"UP 8% YoY\",\"icon\":\"trending-up\",\"status\":\"up\"},{\"label\":\"Main Crop\",\"value\":\"Mango\",\"trend\":\"Guimaras Pride\",\"icon\":\"sun\",\"status\":\"\"}]', '{\"labels\":[\"2020\",\"2021\",\"2022\",\"2023\",\"2024\"],\"data\":[3.1,3.4,3.8,4,4.2],\"label\":\"Export Value ($ Million)\"}', '[[\"Key Commodities\",\"Dried Mango, Cashew, Pineapple\"],[\"Investment Focus\",\"Value-added processing, cold chain logistics\"],[\"Target Market\",\"Asia-Pacific, USA, Local Retail\"],[\"Key Hub\",\"Guimaras (Mango), Antique (Cashew)\"]]', 0, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(5, 'Coconut', 'coconut', 'Coconut Industry', 2024, '[{\"label\":\"Q3 2024 Production\",\"value\":\"136k MT\",\"trend\":\"Top Crop\",\"icon\":\"award\",\"status\":\"up\"},{\"label\":\"Halal Ready\",\"value\":\"45\",\"trend\":\"Establishments\",\"icon\":\"check-circle\",\"status\":\"\"},{\"label\":\"Value Addition\",\"value\":\"Medium\",\"trend\":\"Strategic Focus\",\"icon\":\"info\",\"status\":\"\"}]', '{\"labels\":[\"2020\",\"2021\",\"2022\",\"2023\",\"2024\"],\"data\":[128,131,133,135,136.5],\"label\":\"Production (Thousand Metric Tons)\"}', '[[\"Key Commodities\",\"Copra, Virgin Coconut Oil, Coconut Sugar\"],[\"Investment Focus\",\"High-value processing, Halal certification\"],[\"Target Market\",\"Global Wellness Market, Halal Export\"],[\"Status\",\"Foremost crop in Western Visayas in 2024\"]]', 0, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(6, 'Wearables', 'wearables', 'Wearables & Homestyle', 2024, '[{\"label\":\"Artisans Supported\",\"value\":\"1,200+\",\"trend\":\"Active Base\",\"icon\":\"users\",\"status\":\"\"},{\"label\":\"Creative Hubs\",\"value\":\"12\",\"trend\":\"Regional Hubs\",\"icon\":\"map-pin\",\"status\":\"\"},{\"label\":\"Fiber Types\",\"value\":\"4\",\"trend\":\"High Value\",\"icon\":\"leaf\",\"status\":\"up\"}]', '{\"labels\":[\"2021\",\"2022\",\"2023\",\"2024\",\"2025(P)\"],\"data\":[45,52,68,75,85],\"label\":\"Assisted Creative MSMEs\"}', '[[\"Key Commodities\",\"Pi\\u00f1a Cloth, Hablon, Bamboo Wearables\"],[\"Investment Focus\",\"Design innovation, digital marketing\"],[\"Target Market\",\"High-end Fashion, Eco-conscious consumers\"],[\"Key Event\",\"Panubli-on Trade Fair\"]]', 0, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(7, 'It_bpm', 'it_bpm', 'IT-BPM Sector', 2024, '[{\"label\":\"Estimated Jobs\",\"value\":\"45k+\",\"trend\":\"Rapid Expansion\",\"icon\":\"user-plus\",\"status\":\"up\"},{\"label\":\"Tech Parks\",\"value\":\"7\",\"trend\":\"PEZA Centers\",\"icon\":\"shield-check\",\"status\":\"\"},{\"label\":\"Focus\",\"value\":\"Next Gen\",\"trend\":\"AI\\/Analytics\",\"icon\":\"cpu\",\"status\":\"up\"}]', '{\"labels\":[\"2020\",\"2021\",\"2022\",\"2023\",\"2024\"],\"data\":[28,32,38,42,45],\"label\":\"Direct Employment (Thousands)\"}', '[[\"Key Services\",\"Customer Support, Software Dev, Game Dev\"],[\"Investment Focus\",\"AI optimization, creative tech\"],[\"Target Market\",\"North America, Australia, Global Tech\"],[\"Local Hubs\",\"Iloilo City (Atria Gardens, The Grid)\"]]', 0, '2026-01-26 21:40:42', '2026-01-26 21:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `kpis`
--

CREATE TABLE `kpis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL DEFAULT 2024,
  `label` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `trend_value` varchar(255) DEFAULT NULL,
  `trend_direction` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kpis`
--

INSERT INTO `kpis` (`id`, `page_id`, `year`, `label`, `value`, `trend_value`, `trend_direction`, `icon`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 2024, 'Population (2024)', '4,861,911', 'Census 2024', 'up', 'trending-up', 1, '2026-01-26 21:40:41', '2026-01-26 21:40:41'),
(2, 1, 2024, 'Land Area', '20,794 sq. km', NULL, NULL, NULL, 2, '2026-01-26 21:40:41', '2026-01-26 21:40:41'),
(3, 1, 2024, 'Density', '370 / km²', NULL, NULL, NULL, 3, '2026-01-26 21:40:41', '2026-01-27 17:50:47'),
(4, 1, 2024, 'GRDP (2024)', '₱641.76B', '4.3% Growth', 'up', 'trending-up', 4, '2026-01-26 21:40:41', '2026-01-26 21:40:41'),
(5, 1, 2024, 'Share to PH GDP', '2.9%', NULL, NULL, NULL, 5, '2026-01-26 21:40:41', '2026-01-26 21:40:41'),
(6, 2, 2024, 'Fastest Growing Industry', 'Professional & Business Services', '13.7%', 'up', 'trending-up', 1, '2026-01-26 21:40:41', '2026-01-26 21:40:41'),
(7, 2, 2024, 'Second Fastest', 'Utilities', '13.5%', 'up', 'trending-up', 2, '2026-01-26 21:40:41', '2026-01-26 21:40:41'),
(8, 2, 2024, 'Social Work & Health', '13.5% Growth', 'Top 3', 'up', 'trending-up', 3, '2026-01-26 21:40:41', '2026-01-26 21:40:41'),
(9, 2, 2024, 'AFF Sector', '-7.3% Decline', 'Area for concern', 'down', 'trending-down', 4, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(10, 3, 2024, 'Total Establishments (2023)', '85,644', '16.1% increase', 'up', 'trending-up', 1, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(11, 3, 2024, 'Total Employment (2023)', '530,194', '19.3% increase', 'up', 'trending-up', 2, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(12, 3, 2024, 'MSME Dominance', '99% +', 'Service sector leads (86.9%)', NULL, 'info', 3, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(13, 4, 2024, 'Total HEIs', '102', NULL, NULL, 'info', 1, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(14, 4, 2024, 'Total Graduates (AY 24-25)', '20,391', 'Strong Talent Pool', 'up', 'graduation-cap', 2, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(15, 4, 2024, 'Public vs Private HEIs', '46 SUCs | 49 Private', NULL, NULL, 'landmark', 3, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(16, 5, 2024, 'Airports', '9', NULL, NULL, 'plane', 1, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(17, 5, 2024, 'Sea Ports', '152', NULL, NULL, 'ship', 2, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(18, 5, 2024, 'Cell Towers', '1,027', 'Connectivity', 'up', 'signal', 3, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(19, 5, 2024, 'Wi-Fi Hotspots', '293', NULL, NULL, 'wifi', 4, '2026-01-26 21:40:42', '2026-01-26 21:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `map_markers`
--

CREATE TABLE `map_markers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL DEFAULT 2024,
  `name` varchar(255) NOT NULL,
  `lat` decimal(10,8) NOT NULL,
  `lng` decimal(11,8) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `map_markers`
--

INSERT INTO `map_markers` (`id`, `page_id`, `year`, `name`, `lat`, `lng`, `color`, `data`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 2024, 'Iloilo Province', 11.00000000, 122.50000000, '#38bdf8', '<strong>Share:</strong> 34.1%<br><strong>Focus:</strong> Agriculture & Services', NULL, '2026-01-26 21:40:41', '2026-01-26 21:40:41'),
(2, 1, 2024, 'Iloilo City', 10.72020000, 122.56210000, '#0ea5e9', '<strong>Share:</strong> 26.7%<br><strong>Growth:</strong> 7.1% (Fastest)<br><strong>Focus:</strong> Trade & Real Estate', NULL, '2026-01-26 21:40:41', '2026-01-26 21:40:41'),
(3, 1, 2024, 'Aklan', 11.55000000, 122.36830000, '#075985', '<strong>Share:</strong> 11.5%<br><strong>Focus:</strong> Tourism & Services', NULL, '2026-01-26 21:40:41', '2026-01-26 21:40:41'),
(4, 1, 2024, 'Antique', 11.00000000, 122.00000000, '#0369a1', '<strong>Share:</strong> 11.8%<br><strong>Focus:</strong> Agriculture & Fishing', NULL, '2026-01-26 21:40:41', '2026-01-26 21:40:41'),
(5, 1, 2024, 'Capiz', 11.40000000, 122.70000000, '#0284c7', '<strong>Share:</strong> 13.0%<br><strong>Focus:</strong> Seafood & Agriculture', NULL, '2026-01-26 21:40:41', '2026-01-26 21:40:41'),
(6, 1, 2024, 'Guimaras', 10.59290000, 122.63250000, '#0c4a6e', '<strong>Share:</strong> 2.8%<br><strong>Status:</strong> Most Competitive Province', NULL, '2026-01-26 21:40:41', '2026-01-26 21:40:41'),
(7, 5, 2024, 'Iloilo International Airport', 10.82900000, 122.49330000, '#38bdf8', '<strong>Role:</strong> Main gateway to Western Visayas.<br><strong>Status:</strong> International Hub', 'Airport', '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(8, 5, 2024, 'Kalibo International Airport', 11.67830000, 122.37830000, '#38bdf8', '<strong>Role:</strong> Primary gateway to Boracay Island.', 'Airport', '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(9, 5, 2024, 'Roxas Airport', 11.59750000, 122.71110000, '#38bdf8', '<strong>Role:</strong> Serving Capiz and Northern Panay.', 'Airport', '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(10, 5, 2024, 'Iloilo Port', 10.69250000, 122.58000000, '#fbbf24', '<strong>Role:</strong> Major hub for domestic and regional trade.', 'Port', '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(11, 5, 2024, 'Dumangas Port', 10.81670000, 122.75000000, '#fbbf24', '<strong>Role:</strong> Strategic Ro-Ro connection to Negros Island.', 'Port', '2026-01-26 21:40:42', '2026-01-26 21:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_01_27_000000_add_is_admin_to_users_table', 1),
(6, '2026_01_27_000001_create_content_tables', 1),
(7, '2026_01_28_000000_add_year_to_content_tables', 2),
(8, '2026_01_28_060033_add_year_to_content_tables', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `slug`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'regional-overview', 'Regional Overview', NULL, '2026-01-26 21:40:41', '2026-01-26 21:40:41'),
(2, 'industry-contribution', 'Industry Contribution', NULL, '2026-01-26 21:40:41', '2026-01-26 21:40:41'),
(3, 'business-profile', 'Business Profile', NULL, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(4, 'workforce-education', 'Workforce & Education', NULL, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(5, 'infrastructure', 'Infrastructure', NULL, '2026-01-26 21:40:42', '2026-01-26 21:40:42'),
(6, 'priority-industries', 'Priority Industries', NULL, '2026-01-26 21:40:42', '2026-01-26 21:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_data`
--

CREATE TABLE `table_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL DEFAULT 2024,
  `identifier` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `headers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`headers`)),
  `rows` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`rows`)),
  `footer_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `table_data`
--

INSERT INTO `table_data` (`id`, `page_id`, `year`, `identifier`, `title`, `headers`, `rows`, `footer_note`, `created_at`, `updated_at`) VALUES
(1, 3, 2024, 'msme_vs_large', 'MSMEs vs Large Enterprises', '[\"Province \\/ Category\",\"Micro\",\"Small\",\"Medium\",\"Large\",\"Total Count\"]', '[[\"Iloilo\",\"12,450\",\"1,200\",\"150\",\"45\",\"13,845\"],[\"Negros Occidental*\",\"15,600\",\"1,450\",\"180\",\"70\",\"17,300\"],[\"Aklan\",\"6,200\",\"450\",\"60\",\"20\",\"6,730\"],[\"Capiz\",\"5,800\",\"380\",\"50\",\"15\",\"6,245\"],[\"Antique\",\"4,500\",\"210\",\"35\",\"8\",\"4,753\"],[\"Guimaras\",\"1,800\",\"95\",\"12\",\"2\",\"1,909\"]]', '*Data reflects historical inclusion in Region VI reporting structure.', '2026-01-26 21:40:42', '2026-01-26 21:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', NULL, '$2y$10$sBeXZVUhiRQrpN4qU4YReOhn2VyyuBRUW7ND6iRliTD5l/idWOqQO', 1, NULL, '2026-01-26 21:40:41', '2026-01-26 21:40:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `charts`
--
ALTER TABLE `charts`
  -- ADD PRIMARY KEY (`id`),
  ADD KEY `charts_page_id_foreign` (`page_id`);

--
-- Indexes for table `data_sources`
--
ALTER TABLE `data_sources`
  -- ADD PRIMARY KEY (`id`),
  ADD KEY `data_sources_page_id_foreign` (`page_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  -- ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `industry_clusters`
--
ALTER TABLE `industry_clusters`
  -- ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `industry_clusters_slug_unique` (`slug`);

--
-- Indexes for table `kpis`
--
ALTER TABLE `kpis`
  -- ADD PRIMARY KEY (`id`),
  ADD KEY `kpis_page_id_foreign` (`page_id`);

--
-- Indexes for table `map_markers`
--
ALTER TABLE `map_markers`
  -- ADD PRIMARY KEY (`id`),
  ADD KEY `map_markers_page_id_foreign` (`page_id`);

--
-- Indexes for table `migrations`
--
-- ALTER TABLE `migrations`
--   ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  -- ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  -- ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `table_data`
--
ALTER TABLE `table_data`
  -- ADD PRIMARY KEY (`id`),
  ADD KEY `table_data_page_id_foreign` (`page_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  -- ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `charts`
--
ALTER TABLE `charts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `data_sources`
--
ALTER TABLE `data_sources`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `industry_clusters`
--
ALTER TABLE `industry_clusters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kpis`
--
ALTER TABLE `kpis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `map_markers`
--
ALTER TABLE `map_markers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_data`
--
ALTER TABLE `table_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `charts`
--
ALTER TABLE `charts`
  ADD CONSTRAINT `charts_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `data_sources`
--
ALTER TABLE `data_sources`
  ADD CONSTRAINT `data_sources_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kpis`
--
ALTER TABLE `kpis`
  ADD CONSTRAINT `kpis_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `map_markers`
--
ALTER TABLE `map_markers`
  ADD CONSTRAINT `map_markers_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `table_data`
--
ALTER TABLE `table_data`
  ADD CONSTRAINT `table_data_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
